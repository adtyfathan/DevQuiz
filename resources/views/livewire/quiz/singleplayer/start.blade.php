<div class="bg-gradient-to-br from-indigo-900 via-purple-800 to-pink-700 min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.05) 0%, transparent 50%);"></div>
    
    <div class="relative min-h-screen py-4 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-6">
                <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Solo Quiz</h1>
            </div>

            <!-- Main Container -->
            <div class="bg-white bg-opacity-95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-white border-opacity-30">
                
                <!-- Loading Container (for mid-game joins) -->
                <!-- <div id="loading-container" class="py-16 text-center">
                    <div class="flex flex-col items-center space-y-6">
                        <div class="relative">
                            <div class="w-24 h-24 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="w-12 h-12 bg-indigo-600 rounded-full animate-pulse"></div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <h2 class="text-2xl font-bold text-gray-800">Joining Quiz...</h2>
                            <p class="text-gray-600">Waiting for the next question</p>
                            <div class="flex justify-center space-x-1 mt-4">
                                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce"></div>
                                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Opening Container -->
                <div id="opening-container" class="hidden py-16 text-center">
                    <div class="animate-bounce">
                        <div class="text-6xl mb-4">🚀</div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Get Ready!</h2>
                        <p class="text-xl text-gray-600">New question coming up...</p>
                    </div>
                </div>

                <!-- Quiz Container -->
                <div id="quiz-container" class=" p-8">
                    <div class="space-y-6">
                        <div class="text-center">
                            <div class="flex justify-center items-center space-x-2 text-sm text-gray-500">
                                <span>Question</span>
                                <span id="question-counter" class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md font-semibold">{{$questionNumber}}</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 leading-relaxed">{{ $playerAnswer->question->question }}</h3>
                        </div>
                        
                        <div id="answers" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto">
                            @foreach ( $answers as $Index => $answer )
                                <button 
                                    type="button" 
                                    wire:click="handlePlayerAnswer('{{ $answer['key'] }}', '{{ $playerAnswer->point }}')" 
                                    class="answer-option group relative p-6 bg-gradient-to-r {{ $color[$Index ]}} text-white rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg border-4 border-white border-opacity-30 hover:-translate-y-1 hover:shadow-2xl">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex-1 text-left">{{ $answer['text'] }}</span>
                                    </div>
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-2xl transition-all duration-300"></div>
                                </button>
                            @endforeach
                    </div>

                    </div>
                </div>

                <!-- Meme Container -->
                <div id="meme-container" class="hidden py-16 text-center">
                    <div class="flex flex-col items-center space-y-6">
                        <div class="text-8xl animate-bounce">😄</div>
                        <div class="space-y-2">
                            <p class="text-2xl font-bold text-gray-800">Time for a break!</p>
                            <p class="text-gray-600">Get ready for the next question</p>
                        </div>
                        <button class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg focus:ring-4 focus:ring-blue-200 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <span>Next Question</span>
                        </button>
                    </div>
                </div>

                <!-- Standings Container -->
                <!-- <div id="standings-container" class="hidden p-8">
                    <div class="text-center mb-6">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">🏆 Leaderboard</h2>
                        <p class="text-gray-600">Current standings</p>
                    </div>
                    
                    <div class="max-w-2xl mx-auto">
                        <div id="standings-list" class="space-y-3"></div>
                    </div>
                </div> -->

                <!-- Results Container -->
                <!-- <div id="result-container" class="hidden p-8"></div> -->
            </div>
        </div>
    </div>
</div>

@script

@endscript