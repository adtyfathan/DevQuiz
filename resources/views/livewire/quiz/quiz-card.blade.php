<div class="w-full max-w-lg mx-auto bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-100">
    <!-- Quiz Header with Image -->
    <div class="relative h-48 sm:h-54 overflow-hidden">
        <img src="{{ asset('images/' . $img) }}" alt="{{ $category }} quiz" class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
        
        <!-- Category Badge -->
        <div class="absolute top-4 left-4">
            <div class="bg-white/10 backdrop-blur-sm text-gray-800 px-3 py-1.5 rounded-lg">
                <span class="text-xs font-medium uppercase tracking-wide">{{ $category }}</span>
            </div>
        </div>

        <!-- Quiz Title -->
        <div class="absolute bottom-4 left-4 right-4">
            <h1 class="text-xl sm:text-2xl font-semibold text-white mb-1 capitalize">
                {{ $category }} Quiz
            </h1>
        </div>
    </div>

    <!-- Quiz Setup Form -->
    <div class="p-6">
        <div class="space-y-6">
            <!-- Current Selection Display -->
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <div class="flex items-center gap-3">
                    <span class="text-gray-600 font-medium text-sm">Current selection:</span>
                    <div class="flex items-center gap-2">
                        @if($difficulty || $limit)
                            @if($difficulty)
                                <span class="bg-white px-3 py-1 rounded-md text-xs font-medium text-gray-700 border border-gray-200">
                                    {{ ucfirst($difficulty) }} Level
                                </span>
                            @endif
                            @if($limit)
                                <span class="bg-white px-3 py-1 rounded-md text-xs font-medium text-gray-700 border border-gray-200">
                                    {{ $limit }} Questions
                                </span>
                            @endif
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>

            <!-- Difficulty Selection -->
            <div class="space-y-3">
                <h3 class="text-base font-semibold text-gray-900">Choose Difficulty Level</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    @foreach([['level' => 'easy', 'color' => 'green', 'emoji' => '😊', 'desc' => 'Perfect for beginners'], ['level' => 'medium', 'color' => 'yellow', 'emoji' => '🤔', 'desc' => 'Good challenge level'], ['level' => 'hard', 'color' => 'red', 'emoji' => '😤', 'desc' => 'Expert level test']] as $option)
                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                name="difficulty"
                                value="{{ $option['level'] }}"
                                wire:model.live="difficulty"
                                class="sr-only peer"
                            />
                            <div class="relative rounded-lg border-2 transition-colors duration-75 border-gray-200 hover:border-gray-300 bg-white peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                <div class="p-4 text-center">
                                    <div class="text-2xl mb-2">{{ $option['emoji'] }}</div>
                                    <h4 class="text-sm font-semibold capitalize mb-1 text-gray-700 peer-checked:text-blue-900">
                                        {{ $option['level'] }}
                                    </h4>
                                </div>
                                
                                <div class="absolute top-2 right-2 w-5 h-5 bg-blue-500 rounded-full items-center justify-center hidden peer-checked:flex">
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Question Limit Selection -->
            <div class="space-y-3">
                <h3 class="text-base font-semibold text-gray-900">Number of Questions</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    @foreach(['5', '10', '15', '20'] as $num)
                        <label class="cursor-pointer">
                            <input
                                type="radio"
                                name="limit"
                                value="{{ $num }}"
                                wire:model.live="limit"
                                class="sr-only peer"
                            />
                            <div class="relative rounded-lg border-2 transition-colors duration-75 border-gray-200 hover:border-gray-300 bg-white peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                <div class="p-3 text-center">
                                    <div class="text-lg font-semibold mb-1 text-gray-700 peer-checked:text-blue-900">
                                        {{ $num }}
                                    </div>
                                </div>
                                
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-blue-500 rounded-full items-center justify-center hidden peer-checked:flex">
                                    <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Start Quiz Button -->
            <div class="pt-2">
                <button
                    type="button"
                    wire:click="handleSubmit"
                    @disabled(!$difficulty || !$limit)
                    class="w-full transition-colors duration-200 {{ $difficulty && $limit ? 'bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:shadow-lg focus:ring-4 focus:ring-blue-200 focus:outline-none' : 'bg-gray-200 text-gray-500 cursor-not-allowed' }} rounded-lg py-4 px-6"
                >
                    <div class="flex items-center justify-center gap-3">
                        @if($difficulty && $limit)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold">Start {{ $category }} Quiz</span>
                        @else
                            <span class="font-medium">Select difficulty and questions</span>
                        @endif
                    </div>
                </button>

                @if($difficulty && $limit)
                    <p class="text-center text-sm text-gray-500 mt-3">
                        Ready to test your {{ $category }} knowledge!
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>