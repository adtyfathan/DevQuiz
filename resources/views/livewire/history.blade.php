<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            
            <!-- Page Header -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Quiz History</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Track your quiz journey and review your performance across all completed and hosted quizzes
                </p>
                <div class="w-32 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mx-auto mt-6"></div>
            </div>

            <div class="space-y-16">
                
                <!-- Quiz Finished Section -->
                <section class="space-y-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">Completed Quizzes</h2>
                            <p class="text-gray-600">Quizzes you've participated in and finished</p>
                        </div>
                    </div>

                    @if (!empty($completedQuizzes))
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach ($completedQuizzes as $completedQuiz)
                                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-gray-200">
                                    <!-- Quiz Header with Image -->
                                    <div class="relative h-48 overflow-hidden">
                                        <!-- <img src="{{ asset('images/' . $completedQuiz->quiz_type === 'singleplayer' ? $completedQuiz->singleplayerQuiz->category : $completedQuiz->multiplayerQuiz->category . '.png') }}" 
                                            alt="{{ $completedQuiz->quiz_type === 'singleplayer' ? $completedQuiz->singleplayerQuiz->category : $completedQuiz->multiplayerQuiz->category }} quiz" 
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" /> -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                                        <!-- Badges -->
                                        <div class="absolute top-4 left-4 flex gap-2">
                                            <span class="bg-white/20 backdrop-blur-md text-black px-3 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-white/20">
                                                {{ $completedQuiz->quiz_type === 'singleplayer' ? $completedQuiz->singleplayerQuiz->category : $completedQuiz->multiplayerQuiz->category }}
                                            </span>
                                            <span class="bg-white/20 backdrop-blur-md text-black px-3 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-white/20">
                                                {{ $completedQuiz->quiz_type === 'singleplayer' ? $completedQuiz->singleplayerQuiz->difficulty : $completedQuiz->multiplayerQuiz->difficulty }}
                                            </span>
                                        </div>

                                        <!-- Quiz Title -->
                                        <div class="absolute bottom-4 left-4 right-4">
                                            <h3 class="text-xl font-bold text-white mb-1 line-clamp-2 capitalize">
                                                {{ $completedQuiz->quiz_type === 'singleplayer' ? $completedQuiz->singleplayerQuiz->category . ' Quiz' : $completedQuiz->multiplayerQuiz->lobby_name }}
                                            </h3>
                                        </div>
                                    </div>

                                    <!-- Quiz Details -->
                                    <div class="p-6 space-y-4">
                                        <div class="pt-2">
                                            <p class="text-sm text-gray-600 font-medium">{{ $completedQuiz->quiz_type === 'singleplayer' ? $completedQuiz->singleplayerQuiz->user->name : $completedQuiz->multiplayerPlayer->username }}</p>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Quiz Type</p>
                                                <p class="text-sm font-semibold text-gray-900 capitalize">{{ $completedQuiz->quiz_type }}</p>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-3">
                                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Score</p>
                                                <p class="text-sm font-semibold text-gray-900">{{ $completedQuiz->score }}</p>
                                            </div>
                                        </div>

                                        <div class="bg-blue-50 rounded-lg p-3">
                                            <div class="flex justify-between items-center mb-2">
                                                <p class="text-xs font-medium text-blue-700 uppercase tracking-wide">Accuracy</p>
                                                <p class="text-sm font-bold text-blue-900">
                                                    {{ $completedQuiz->true_answer_count }} / {{ $completedQuiz->quiz_type === 'singleplayer' ? $completedQuiz->singleplayerQuiz->total_questions : $completedQuiz->multiplayerQuiz->total_questions }}
                                                </p>
                                            </div>
                                            <div class="w-full bg-blue-200 rounded-full h-2">
                                                <div 
                                                    class="bg-gradient-to-r from-blue-500 to-blue-600 h-2 rounded-full transition-all duration-300"
                                                    style="width: {{
                                                        (
                                                            $completedQuiz->true_answer_count /
                                                            ($completedQuiz->quiz_type === 'singleplayer' 
                                                                ? $completedQuiz->singleplayerQuiz->total_questions 
                                                                : $completedQuiz->multiplayerQuiz->total_questions
                                                            )
                                                        ) * 100
                                                    }}%">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <form wire:submit.prevent="redirectPlayerSummary({{ $completedQuiz->id }})" class="pt-2">
                                            <button type="submit" 
                                                wire:loading.attr="disabled" 
                                                wire:target="redirectPlayerSummary({{ $completedQuiz->id }})"
                                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg focus:ring-4 focus:ring-purple-200 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                                <span wire:target="redirectPlayerSummary({{ $completedQuiz->id }})" class="flex items-center justify-center gap-2">
                                                    <span>View Summary</span>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No completed quizzes yet</h3>
                            <p class="text-gray-600">Start participating in quizzes to see your history here</p>
                        </div>
                    @endif
                </section>

                <!-- Quiz Hosted Section -->
                <section class="space-y-8">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">Hosted Quizzes</h2>
                            <p class="text-gray-600">Quizzes you've created and managed</p>
                        </div>
                    </div>

                    @if (!empty($hostedQuizzes))
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                            @foreach ($hostedQuizzes as $hostedQuiz)
                                <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-gray-200">
                                    <!-- Quiz Header with Image -->
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ asset('images/' . $hostedQuiz->category . '.png') }}" 
                                             alt="{{ $hostedQuiz->category }} quiz" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                                        <!-- Host Badge -->
                                        <div class="absolute top-4 right-4">
                                            <span class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide flex items-center gap-1">
                                                Host
                                            </span>
                                        </div>

                                        <!-- Category & Difficulty Badges -->
                                        <div class="absolute top-4 left-4 flex gap-2">
                                            <span class="bg-white/20 backdrop-blur-md text-black px-3 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-white/20">
                                                {{ $hostedQuiz->category }}
                                            </span>
                                            <span class="bg-white/20 backdrop-blur-md text-black px-3 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-white/20">
                                                {{ $hostedQuiz->difficulty }}
                                            </span>
                                        </div>

                                        <!-- Quiz Title -->
                                        <div class="absolute bottom-4 left-4 right-4">
                                            <h3 class="text-xl font-bold text-white mb-1 line-clamp-2 capitalize">
                                                {{ $hostedQuiz->lobby_name }}
                                            </h3>
                                        </div>
                                    </div>

                                    <!-- Quiz Details -->
                                    <div class="p-6 space-y-4">
                                        <div class="grid grid-cols-1 gap-3">
                                            <div class="bg-green-50 rounded-lg p-3 flex justify-between items-center">
                                                <div>
                                                    <p class="text-xs font-medium text-green-700 uppercase tracking-wide">Started</p>
                                                    <p class="text-sm font-semibold text-green-900">{{ $hostedQuiz->started_at }}</p>
                                                </div>
                                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                            </div>

                                            <div class="bg-red-50 rounded-lg p-3 flex justify-between items-center">
                                                <div>
                                                    <p class="text-xs font-medium text-red-700 uppercase tracking-wide">Finished</p>
                                                    <p class="text-sm font-semibold text-red-900">{{ $hostedQuiz->finished_at }}</p>
                                                </div>
                                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                            </div>

                                            <div class="bg-purple-50 rounded-lg p-3 flex justify-between items-center">
                                                <div>
                                                    <p class="text-xs font-medium text-purple-700 uppercase tracking-wide">Participants</p>
                                                    <p class="text-sm font-semibold text-purple-900">{{ count($hostedQuiz->completedQuiz) }} players</p>
                                                </div>
                                                <div class="flex -space-x-1">
                                                    @for($i = 0; $i < min(3, count($hostedQuiz->completedQuiz)); $i++)
                                                        <div class="w-6 h-6 bg-purple-400 rounded-full border-2 border-white flex items-center justify-center">
                                                            <span class="text-white text-xs font-bold">{{ $i + 1 }}</span>
                                                        </div>
                                                    @endfor
                                                    @if(count($hostedQuiz->completedQuiz) > 3)
                                                        <div class="w-6 h-6 bg-gray-400 rounded-full border-2 border-white flex items-center justify-center">
                                                            <span class="text-white text-xs font-bold">+</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Button -->
                                        <form wire:submit.prevent="redirectHostSummary({{ $hostedQuiz->id }})" class="pt-2">
                                            <button type="submit" 
                                                wire:loading.attr="disabled" 
                                                wire:target="redirectHostSummary({{ $hostedQuiz->id }})"
                                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg focus:ring-4 focus:ring-purple-200 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                                <span wire:target="redirectHostSummary({{ $hostedQuiz->id }})" class="flex items-center justify-center gap-2">
                                                    <span>View Results</span>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hosted quizzes yet</h3>
                            <p class="text-gray-600">Create your first quiz to see your hosting history here</p>
                        </div>
                    @endif
                </section>

            </div>
        </div>
    </div>
</div>