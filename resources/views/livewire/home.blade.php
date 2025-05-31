<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50 min-h-screen">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

            <!-- Active Quiz Notifications -->
            <div class="space-y-4">

                <!-- Joined Quiz Card -->
                @if (!empty($joinedQuiz))
                    <div
                        class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                        <div class="relative p-6 lg:p-8">
                            <!-- Animated Background Pattern -->
                            <div class="absolute inset-0 opacity-10">
                                <div
                                    class="absolute top-0 left-0 w-32 h-32 bg-white rounded-full -translate-x-16 -translate-y-16 animate-pulse">
                                </div>
                                <div
                                    class="absolute bottom-0 right-0 w-24 h-24 bg-white rounded-full translate-x-12 translate-y-12 animate-pulse">
                                </div>
                            </div>

                            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 animate-bounce">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-white">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h3 class="text-lg font-bold">Quiz in Progress</h3>
                                            <span
                                                class="bg-white/30 text-xs px-2 py-1 rounded-full font-medium animate-pulse">LIVE</span>
                                        </div>
                                        <p class="text-2xl font-bold mb-1">{{ $joinedQuiz->lobby_name }}</p>
                                        <p class="text-emerald-100 text-sm">You have an ongoing quiz session</p>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3">
                                    <a href="{{ $this->getRejoinQuizUrl() }}" wire:navigate
                                        class="bg-white text-emerald-600 px-6 py-3 rounded-xl font-semibold hover:bg-emerald-50 transform hover:scale-105 transition-all duration-200 shadow-lg flex items-center gap-2 justify-center text-center no-underline">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path>
                                        </svg>
                                        Rejoin Quiz                                 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Hosted Quiz Card -->
                @if (!empty($hostedQuiz))
                    <div
                        class="bg-gradient-to-r from-violet-500 to-purple-600 rounded-2xl shadow-xl overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                        <div class="relative p-6 lg:p-8">
                            <!-- Animated Background Pattern -->
                            <div class="absolute inset-0 opacity-10">
                                <div
                                    class="absolute top-0 right-0 w-40 h-40 bg-white rounded-full translate-x-20 -translate-y-20 animate-pulse">
                                </div>
                                <div
                                    class="absolute bottom-0 left-0 w-28 h-28 bg-white rounded-full -translate-x-14 translate-y-14 animate-pulse">
                                </div>
                            </div>

                            <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-3 animate-bounce">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="text-white">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h3 class="text-lg font-bold">Your Quiz Lobby</h3>
                                            <span
                                                class="bg-white/30 text-xs px-2 py-1 rounded-full font-medium animate-pulse">HOST</span>
                                        </div>
                                        <p class="text-2xl font-bold mb-1">{{ $hostedQuiz->lobby_name }}</p>
                                        <p class="text-violet-100 text-sm">Manage your quiz lobby and participants</p>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3">
                                    <a href="{{ $this->getHostedQuizUrl() }}" wire:navigate
                                        class="bg-white text-violet-600 px-6 py-3 rounded-xl font-semibold hover:bg-violet-50 transform hover:scale-105 transition-all duration-200 shadow-lg flex items-center gap-2 justify-center text-center no-underline">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View Lobby
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Multiplayer Join Section -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
                <div class="p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl p-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Join Multiplayer Quiz</h2>
                            <p class="text-gray-600 text-sm">Enter a lobby code to join an existing quiz</p>
                        </div>
                    </div>
                    <livewire:quiz.join-lobby />
                </div>
            </div>

            @if (empty($hostedQuiz))
                <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
                    <div class="p-6 lg:p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl p-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Create Multiplayer Quiz</h2>
                                <p class="text-gray-600 text-sm">Enter a lobby code to join an existing quiz</p>
                            </div>
                        </div>

                        <form wire:submit.prevent="createLobby" class="w-96 space-y-6">
                            <button type="submit" wire:loading.attr="disabled" wire:target="createLobby"
                                wire:loading.class="opacity-75 cursor-not-allowed transform-none"
                                class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg focus:ring-4 focus:ring-blue-200 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                <span wire:target="createLobby" class="flex items-center justify-center space-x-2">
                                    {{-- <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1">
                                        </path>
                                    </svg> --}}
                                    <span>Create Lobby</span>
                                </span>
                            </button>
                        </form>      
                    </div>
                </div>
            @endif
            
            <!-- Quiz Categories Section -->
            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-gray-200/50 overflow-hidden">
                <div class="p-6 lg:p-8">
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl p-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                                    Start a Solo Quiz
                                </h1>
                                <p class="text-gray-600 text-sm sm:text-base">
                                    Choose your favorite topic and test your knowledge
                                </p>
                            </div>
                        </div>
                        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">
                        <livewire:quiz.quiz-card category="Code" img="code.jpg" />
                        <livewire:quiz.quiz-card category="VueJS" img="vue.png" />
                        <livewire:quiz.quiz-card category="NodeJS" img="node.png" />
                        <livewire:quiz.quiz-card category="Linux" img="linux.png" />
                        <livewire:quiz.quiz-card category="cPanel" img="cpanel.png" />
                        <livewire:quiz.quiz-card category="Django" img="django.png" />
                        <livewire:quiz.quiz-card category="Postgres" img="postgres.png" />
                        <livewire:quiz.quiz-card category="React" img="react.png" />
                        <livewire:quiz.quiz-card category="Next.js" img="next.png" />
                        <livewire:quiz.quiz-card category="DevOps" img="devops.png" />
                        <livewire:quiz.quiz-card category="SQL" img="sql.png" />
                        <livewire:quiz.quiz-card category="Apache Kafka" img="apache_kafka.png" />
                        <livewire:quiz.quiz-card category="Wordpress" img="wordpress.png" />
                        <livewire:quiz.quiz-card category="Bash" img="bash.png" />
                        <livewire:quiz.quiz-card category="Docker" img="docker.png" />
                        <livewire:quiz.quiz-card category="Laravel" img="laravel.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>