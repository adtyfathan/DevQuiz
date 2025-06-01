<?php

namespace App\Services;

use App\Models\MultiplayerQuiz;
use App\Services\QuizService;
use App\Models\MultiplayerPlayer;
use App\Jobs\BroadcastQuestion;
use App\Jobs\BroadcastStandings;

class QuestionSchedulerService{
    public function __construct(protected QuizService $quizService){
        
    }
    
    public function start(MultiplayerQuiz $quiz){
        $quiz = MultiplayerQuiz::with(['multiplayerPlayer' => function ($query) {
            $query->orderByDesc('point');
        }])->find($quiz->id);
        
        $category = $quiz->category;
        $difficulty = $quiz->difficulty;
        $questionCount = $quiz->total_questions;
            
        $questions = $this->quizService->fetchQuestions($category, $difficulty, $questionCount);
        
        // define durasi per section
        $openingDuration = 5;
        $questionDuration = $quiz->question_duration;
        $memeDuration = 5;
        $standingsDuration = 10;

        $startTime = now()->addSeconds(3);
        
        foreach ($questions as $index => $question) {
            $openingAt = $startTime->copy()->addSeconds(($openingDuration + $questionDuration + $memeDuration + $standingsDuration) * $index);
            $questionAt = $openingAt->copy()->addSeconds($openingDuration);
            $memeAt = $questionAt->copy()->addSeconds($questionDuration);
            $standingsAt = $memeAt->copy()->addSeconds($memeDuration);
            $isLast = $index === count($questions) - 1;

            BroadcastQuestion::dispatch(
                $quiz, 
                $question, 
                $openingAt, 
                $questionAt, 
                $memeAt
            )->delay(max(0, now()->diffInSeconds($openingAt)));

            $players = $quiz->multiplayerPlayer;

            // LANJUT DISINI        
            BroadcastStandings::dispatch(
                $quiz, 
                $players, 
                $standingsAt,
                $isLast,
                $category,
                $difficulty
            )->delay(max(0, now()->diffInSeconds($standingsAt)));
        }
    }
}