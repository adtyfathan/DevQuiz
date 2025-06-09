<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multiplayer Host Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Summary Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Players Card -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <!-- Fixed Total Players Icon -->
                            <svg class="w-5 h-5 white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Total Players</p>
                            <p class="text-xl font-bold">{{ count($completedQuizzes) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Average Score Card -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Average Score</p>
                            <p class="text-xl font-bold">{{ number_format($completedQuizzes->avg('score'), 1) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Highest Score Card -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <!-- Fixed Highest Score Icon - Trophy -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Highest Score</p>
                            <p class="text-xl font-bold">{{ number_format($completedQuizzes->max('score')) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Completion Rate Card -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-orange-100 text-sm font-medium">Average Accuracy</p>
                            <p class="text-xl font-bold">{{ number_format($averageAccuracy, 1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Podium Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-6 text-center">🏆 Top Performers</h3>
                <div class="flex justify-center items-end space-x-8">
                    @if($completedQuizzes->count() >= 2)
                        <!-- Second Place -->
                        <div class="text-center">
                            <div class="w-20 h-16 bg-gradient-to-t from-gray-300 to-gray-400 rounded-t-lg flex items-center justify-center mb-3">
                                <span class="text-white font-bold text-lg">2</span>
                            </div>
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <p class="font-semibold text-gray-800">{{ $completedQuizzes[1]->multiplayerPlayer->username }}</p>
                            <p class="text-sm text-gray-600">{{ number_format($completedQuizzes[1]->score) }} pts</p>
                        </div>
                    @endif

                    @if($completedQuizzes->count() >= 1)
                        <!-- First Place -->
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gradient-to-t from-yellow-400 to-yellow-500 rounded-t-lg flex items-center justify-center mb-3">
                                <span class="text-white font-bold text-xl">1</span>
                            </div>
                            <div class="w-20 h-20 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <p class="font-bold text-gray-800">{{ $completedQuizzes[0]->multiplayerPlayer->username }}</p>
                            <p class="text-sm text-gray-600">{{ number_format($completedQuizzes[0]->score) }} pts</p>
                        </div>
                    @endif

                    @if($completedQuizzes->count() >= 3)
                        <!-- Third Place -->
                        <div class="text-center">
                            <div class="w-20 h-12 bg-gradient-to-t from-amber-600 to-amber-700 rounded-t-lg flex items-center justify-center mb-3">
                                <span class="text-white font-bold text-lg">3</span>
                            </div>
                            <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <p class="font-semibold text-gray-800">{{ $completedQuizzes[2]->multiplayerPlayer->username }}</p>
                            <p class="text-sm text-gray-600">{{ number_format($completedQuizzes[2]->score) }} pts</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-center space-x-4">
                <button 
                    wire:click="exportResults"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Results
                </button>
            </div>

            <!-- Final Rankings Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-8">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Final Rankings</h3>
                    <p class="text-sm text-gray-600 mt-1">Complete leaderboard of all participants</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Player</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accuracy</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($completedQuizzes as $index => $completedQuiz)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($index === 0)
                                                <span class="inline-flex items-center justify-center w-8 h-8 bg-yellow-100 text-yellow-800 rounded-full font-bold text-sm">
                                                    🥇
                                                </span>
                                            @elseif($index === 1)
                                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-700 rounded-full font-bold text-sm">
                                                    🥈
                                                </span>
                                            @elseif($index === 2)
                                                <span class="inline-flex items-center justify-center w-8 h-8 bg-amber-100 text-amber-700 rounded-full font-bold text-sm">
                                                    🥉
                                                </span>
                                            @else
                                                <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-800 rounded-full font-bold text-sm">
                                                    {{ $index + 1 }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $completedQuiz->multiplayerPlayer->username }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ number_format($completedQuiz->score) }} pts
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
    $playerAccuracy = $completedQuiz->true_answer_count / $completedQuiz->multiplayerQuiz->total_questions * 100;
                                        @endphp
                                        <div class="flex items-center">
                                            <div class="w-16 bg-gray-200 rounded-full h-2 mr-3">
                                                <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full" 
                                                     style="width: {{ $playerAccuracy }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-600">{{ number_format($playerAccuracy, 1) }}%</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

<!-- Questions Review -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mt-8">
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800">Questions Review</h3>
        <p class="text-sm text-gray-600 mt-1">Review player answers and see the correct solutions</p>
    </div>

    <!-- Player Selection -->
    <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
        <div class="flex items-center space-x-4">
            <label for="selectedPlayer" class="text-sm font-medium text-gray-700">Select Player:</label>
            <select 
                wire:model.live="selectedPlayerId" 
                id="selectedPlayer"
                class="block w-64 px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm cursor-pointer"
            >
                <option value="">-- Select a player --</option>
                @foreach ($completedQuizzes as $completedQuiz)
                    <option value="{{ $completedQuiz->id }}">
                        {{ $completedQuiz->multiplayerPlayer->username }} 
                        ({{ number_format($completedQuiz->score) }} pts)
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Questions Display -->
    @if($selectedPlayerId && $selectedPlayerQuiz)
        <div class="divide-y divide-gray-200">
            <!-- Player Info Header -->
            <div class="px-6 py-4 bg-blue-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900">
                                {{ $selectedPlayerQuiz->multiplayerPlayer->username }}
                            </h4>
                            <p class="text-sm text-gray-600">
                                Score: {{ number_format($selectedPlayerQuiz->score) }} pts | 
                                Accuracy: {{ number_format(($selectedPlayerQuiz->true_answer_count / $selectedPlayerQuiz->multiplayerQuiz->total_questions) * 100, 1) }}%
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-sm text-gray-500">
                            {{ $selectedPlayerQuiz->true_answer_count }} / {{ $selectedPlayerQuiz->multiplayerQuiz->total_questions }} correct
                        </span>
                    </div>
                </div>
            </div>


            <!-- Questions Loop -->
            @foreach($selectedPlayerQuiz->multiplayerQuiz->playerAnswers->where('player_id', $selectedPlayerQuiz->user_id) as $playerAnswer)
                @php
        $question = $playerAnswer->question;
        $answers = json_decode($question->answers, true);
        $correctAnswers = json_decode($question->correct_answers, true);

        // Find the correct answer
        $correctAnswerKey = null;
        foreach ($correctAnswers as $key => $value) {
            if ($value === 'true') {
                $correctAnswerKey = str_replace('_correct', '', $key);
                break;
            }
        }

        $isCorrect = $playerAnswer->answer === $correctAnswerKey;
                @endphp

                <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                    <!-- Question Header -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <span class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-medium">
                                {{ $loop->iteration }}
                            </span>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $question->difficulty === 'Easy' ? 'bg-green-100 text-green-800' : ($question->difficulty === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $question->difficulty }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 ml-2">
                                    {{ $question->category }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            @if($isCorrect)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Correct
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Incorrect
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Question Text -->
                    <div class="mb-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $question->question }}</h4>
                        @if($question->description)
                            <p class="text-sm text-gray-600">{{ $question->description }}</p>
                        @endif
                    </div>

                    <!-- Answer Options -->
                    <div class="space-y-2 mb-4">
                        @foreach($answers as $answerKey => $answerText)
                            @if (!empty($answerText))
                                <div class="flex items-center p-3 rounded-lg border-2 {{ 
                                    $answerKey === $correctAnswerKey ? 'border-green-200 bg-green-50' :
                    ($answerKey === $playerAnswer->answer && !$isCorrect ? 'border-red-200 bg-red-50' : 'border-gray-200 bg-gray-50') 
                                }}">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full border-2 {{ 
                                        $answerKey === $correctAnswerKey ? 'border-green-500 bg-green-500' :
                    ($answerKey === $playerAnswer->answer ? 'border-red-500 bg-red-500' : 'border-gray-300') 
                                    }} flex items-center justify-center">
                                        @if($answerKey === $correctAnswerKey)
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @elseif($answerKey === $playerAnswer->answer && !$isCorrect)
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        @endif
                                    </div>
                                    <span class="ml-3 text-sm font-medium {{ 
                                        $answerKey === $correctAnswerKey ? 'text-green-800' :
                    ($answerKey === $playerAnswer->answer && !$isCorrect ? 'text-red-800' : 'text-gray-700') 
                                    }}">
                                        {{ strtoupper(substr($answerKey, -1)) }}. {{ $answerText }}
                                    </span>
                                    @if($answerKey === $correctAnswerKey)
                                        <span class="ml-auto text-xs font-medium text-green-600">Correct Answer</span>
                                    @elseif($answerKey === $playerAnswer->answer && !$isCorrect)
                                        <span class="ml-auto text-xs font-medium text-red-600">Player's Answer</span>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <!-- Explanation -->
                    @if($question->explanation)
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-blue-800">Explanation</p>
                                    <p class="text-sm text-blue-700 mt-1">{{ $question->explanation }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="px-6 py-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No player selected</h3>
            <p class="mt-1 text-sm text-gray-500">Select a player from the dropdown above to review their answers.</p>
        </div>
    @endif
</div>

        </div>
    </div>
</div>