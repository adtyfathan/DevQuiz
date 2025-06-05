<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multiplayer Summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <!-- Summary Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Username Card -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-blue-100 text-sm font-medium">Username</p>
                            <p class="text-xl font-bold">{{ $username }}</p>
                        </div>
                    </div>
                </div>

                <!-- Accuracy Card -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-green-100 text-sm font-medium">Accuracy</p>
                            <p class="text-xl font-bold">{{ number_format($accuracy, 1) }}%</p>
                        </div>
                    </div>
                </div>

                <!-- Score Card -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-purple-100 text-sm font-medium">Score</p>
                            <p class="text-xl font-bold">{{ number_format($point) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Questions Card -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg">
                    <div class="flex items-center">
                        <div class="p-3 bg-white bg-opacity-20 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-orange-100 text-sm font-medium">Questions</p>
                            <p class="text-xl font-bold">{{ $totalQuestions }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Answer Statistics -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Answer Statistics</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Correct Answers -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-green-600">{{ $trueCount }}</p>
                        <p class="text-sm text-gray-600">Correct Answers</p>
                    </div>

                    <!-- Incorrect Answers -->
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <p class="text-2xl font-bold text-red-600">{{ $falseCount }}</p>
                        <p class="text-sm text-gray-600">Incorrect Answers</p>
                    </div>

                    <!-- Progress Ring -->
                    <div class="text-center">
                        <div class="relative w-16 h-16 mx-auto mb-3">
                            <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831">
                                </path>
                                <path class="text-blue-600" stroke="currentColor" stroke-width="3" fill="none"
                                    stroke-dasharray="{{ $accuracy }}, 100"
                                    d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831">
                                </path>
                            </svg>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span
                                    class="text-xs font-semibold text-blue-600">{{ number_format($accuracy, 0) }}%</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">Quiz Accuracy</p>
                    </div>
                </div>
            </div>

            <!-- Questions Review -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Questions Review</h3>
                    <p class="text-sm text-gray-600 mt-1">Review your answers and see the correct solutions</p>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach($playerAnswers as $index => $playerAnswer)
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
                                    <span
                                        class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-800 rounded-full flex items-center justify-center text-sm font-medium">
                                        {{ $index + 1 }}
                                    </span>
                                    <div>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $question->difficulty === 'Easy' ? 'bg-green-100 text-green-800' : ($question->difficulty === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $question->difficulty }}
                                        </span>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 ml-2">
                                            {{ $question->category }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    @if($isCorrect)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Correct
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
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
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @elseif($answerKey === $playerAnswer->answer && !$isCorrect)
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M6 18L18 6M6 6l12 12"></path>
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
                                                <span class="ml-auto text-xs font-medium text-red-600">Your Answer</span>
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
                                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
            </div>
        </div>
    </div>
</div>