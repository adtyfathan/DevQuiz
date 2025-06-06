<?php

namespace App\Services;

use App\Models\MultiplayerQuiz;
use App\Services\QuizService;
use App\Models\MultiplayerPlayer;
use App\Models\Question;
use App\Jobs\BroadcastQuestion;
use App\Jobs\BroadcastStandings;
use App\Models\CompletedQuiz;
use App\Models\PlayerAnswer;
use Exception;

class QuestionSchedulerService
{
    private const OPENING_DURATION = 5;
    private const MEME_DURATION = 5;
    private const STANDINGS_DURATION = 10;

    public function __construct(protected QuizService $quizService){}
    
    public function start(MultiplayerQuiz $quiz)
    {
        try {
            $quiz = $this->loadQuizWithPlayers($quiz);
            $players = $quiz->multiplayerPlayer;

            $questions = $this->quizService->fetchQuestions(
                $quiz->category, 
                $quiz->difficulty, 
                $quiz->total_questions
            );

            $startTime = now()->addSeconds(3);

            foreach ($players as $player) {
                $player->update([
                    'status' => 'in_progress'
                ]);

                CompletedQuiz::create([
                    'quiz_type' => 'multiplayer',
                    'user_id' => $player->player_id,
                    'multiplayer_quiz_id' => $quiz->id,
                    'single_player_quiz_id' => null,
                    'score' => 0,
                    'true_answer_count' => 0,
                    'category' => $quiz->category,
                    'difficulty' => $quiz->difficulty,
                    'completed_at' => null
                ]);
            }
            
            foreach ($questions as $index => $question) {
                Question::firstOrCreate(
                    ['id' => $question['id']],
                    [
                        'question' => $question['question'],
                        'category' => $question['category'],
                        'difficulty' => $question['difficulty'],
                        'description' => $question['description'],
                        'answers' => json_encode($question['answers']),
                        'correct_answers' => json_encode($question['correct_answers']),
                        'explanation' => $question['explanation']
                    ]
                );

                foreach ($players as $player) {
                    PlayerAnswer::create([
                        'player_id' => $player->player_id,
                        'question_id' => $question['id'],
                        'multiplayer_quiz_id' => $quiz->id,
                        'singleplayer_quiz_id' => null,
                        'quiz_type' => 'multiplayer',
                        'answer' => null,
                    ]);
                }

                $timings = $this->calculateTimings(
                    $startTime, 
                    $index, 
                    $quiz->question_duration
                );
                
                $this->dispatchEvents(
                    $quiz,
                    $question,
                    $timings,
                    $index === count($questions) - 1
                );
            }
        } catch (Exception $e) {
            report($e);
            throw $e;
        }
    }

    private function loadQuizWithPlayers(MultiplayerQuiz $quiz): MultiplayerQuiz
    {
        return MultiplayerQuiz::with(['multiplayerPlayer' => function ($query) {
            $query->orderByDesc('point');
        }])->where('id', $quiz->id)->firstOrFail();
    }

    private function calculateTimings($startTime, $index, $questionDuration): array
    {
        $cycleTime = self::OPENING_DURATION + $questionDuration + 
                     self::MEME_DURATION + self::STANDINGS_DURATION;
        
        $openingAt = $startTime->copy()->addSeconds($cycleTime * $index);
        $questionAt = $openingAt->copy()->addSeconds(self::OPENING_DURATION);
        $memeAt = $questionAt->copy()->addSeconds($questionDuration);
        $standingsAt = $memeAt->copy()->addSeconds(self::MEME_DURATION);

        return compact('openingAt', 'questionAt', 'memeAt', 'standingsAt');
    }

    private function dispatchEvents(
        MultiplayerQuiz $quiz, 
        array $question, 
        array $timings,
        bool $isLast
    ): void {
        BroadcastQuestion::dispatch(
            $quiz, 
            $question, 
            $timings['openingAt'], 
            $timings['questionAt'], 
            $timings['memeAt']
        )->delay(max(0, now()->diffInSeconds($timings['openingAt'])));

        BroadcastStandings::dispatch(
            $quiz, 
            $quiz->multiplayerPlayer, 
            $timings['standingsAt'],
            $isLast,
            $quiz->category,
            $quiz->difficulty
        )->delay(max(0, now()->diffInSeconds($timings['standingsAt'])));
    }
}