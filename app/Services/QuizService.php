<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuizService
{
    protected $apiUrl;
    protected $apiKey;
    protected const MAX_QUESTIONS_PER_REQUEST = 20;
    protected const MAX_ATTEMPTS = 3; 

    public function __construct()
    {
        $this->apiUrl = config('services.quizapi.url');
        $this->apiKey = config('services.quizapi.key');
    }

    public function fetchQuestions($category, $difficulty, $limit)
    {
        $validQuestions = [];
        $attempts = 0;

        while (count($validQuestions) < $limit && $attempts < self::MAX_ATTEMPTS) {
            $remainingQuestions = $limit - count($validQuestions);
            
            $requestLimit = min(
                self::MAX_QUESTIONS_PER_REQUEST, 
                max($remainingQuestions, (int)($remainingQuestions * 1.5))
            );

            $questions = $this->makeApiRequest($category, $difficulty, $requestLimit);
            
            if (empty($questions)) {
                Log::warning('Quiz API returned empty response', [
                    'attempt' => $attempts + 1,
                    'category' => $category,
                    'difficulty' => $difficulty
                ]);
                break; 
            }

            $newValidQuestions = $this->filterValidQuestions($questions);
            
            foreach ($newValidQuestions as $question) {
                if (count($validQuestions) >= $limit) {
                    break 2; 
                }
                
                if (!$this->isDuplicateQuestion($validQuestions, $question)) {
                    $validQuestions[] = $question;
                }
            }

            $attempts++;
        }

        // Log if we couldn't get enough questions
        if (count($validQuestions) < $limit) {
            Log::info('Could not fetch enough valid questions', [
                'requested' => $limit,
                'found' => count($validQuestions),
                'attempts' => $attempts
            ]);
        }

        return array_slice($validQuestions, 0, $limit);
    }

    protected function makeApiRequest($category = null, $difficulty = null, $limit = 20)
    {
        $params = ['limit' => $limit];

        if ($category) {
            $params['category'] = $category;
        }

        if ($difficulty) {
            $params['difficulty'] = $difficulty;
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders(['X-Api-Key' => $this->apiKey])
                ->get($this->apiUrl, $params);

            if (!$response->successful()) {
                Log::error('Quiz API request failed', [
                    'status' => $response->status(),
                    'params' => $params
                ]);
                return [];
            }

            return $response->json() ?? [];
            
        } catch (\Exception $e) {
            Log::error('Quiz API request exception', [
                'message' => $e->getMessage(),
                'params' => $params
            ]);
            return [];
        }
    }

    protected function filterValidQuestions(array $questions)
    {
        return array_filter($questions, function($question) {
            return $this->isValidQuestion($question);
        });
    }

    protected function isValidQuestion($question)
    {
        // Check if question text exists and is not empty
        if (empty($question['question']) || trim($question['question']) === '') {
            return false;
        }

        // Check if answers exist and is an array
        if (!isset($question['answers']) || !is_array($question['answers'])) {
            return false;
        }

        // Count non-null answers
        $validAnswers = array_filter($question['answers'], function($answer) {
            return $answer !== null && trim($answer) !== '';
        });

        // Must have at least 2 valid answers for a proper quiz
        if (count($validAnswers) < 2) {
            return false;
        }

        // Check if correct answers information exists
        if (!isset($question['correct_answers']) || !is_array($question['correct_answers'])) {
            return false;
        }

        // Verify that there's at least one correct answer marked as true
        $hasCorrectAnswer = false;
        foreach ($question['correct_answers'] as $correctAnswer) {
            if ($correctAnswer === 'true' || $correctAnswer === true) {
                $hasCorrectAnswer = true;
                break;
            }
        }

        return $hasCorrectAnswer;
    }

    protected function isDuplicateQuestion(array $existingQuestions, array $newQuestion)
    {
        if (!isset($newQuestion['id'])) {
            return false;
        }

        foreach ($existingQuestions as $existing) {
            if (isset($existing['id']) && $existing['id'] === $newQuestion['id']) {
                return true;
            }
        }

        return false;
    }
}