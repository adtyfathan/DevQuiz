<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lobby') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-indigo-50 via-white to-cyan-50 min-h-screen">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                        </path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Edit Quiz Lobby</h1>
                <p class="text-gray-600 text-lg">Set up a multiplayer quiz experience for your participants</p>
            </div>

            <!-- Main Form Card -->
            <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
                <div class="p-8 lg:p-12">
                    <form class="space-y-8" wire:submit.prevent="updateLobby">
                        <!-- Quiz Configuration Section -->
                        <div class="space-y-6">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Quiz Configuration</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Category Selection -->
                                <div class="space-y-2">
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Quiz
                                        Category</label>
                                    <div class="relative">
                                        <select name="category" id="category" wire:model.live="category"
                                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300 @error('category') border-red-500 @enderror">
                                            <option value="">Select a category</option>
                                            <option value="Code" {{ $category == 'Code' ? 'selected' : '' }}>💻 Code
                                            </option>
                                            <option value="VueJS" {{ $category == 'VueJS' ? 'selected' : '' }}>🟢 VueJS
                                            </option>
                                            <option value="NodeJS" {{ $category == 'NodeJS' ? 'selected' : '' }}>⚡ NodeJS
                                            </option>
                                            <option value="Linux" {{ $category == 'Linux' ? 'selected' : '' }}>🐧 Linux
                                            </option>
                                            <option value="cPanel" {{ $category == 'cPanel' ? 'selected' : '' }}>⚙️ cPanel
                                            </option>
                                            <option value="Django" {{ $category == 'Django' ? 'selected' : '' }}>🐍 Django
                                            </option>
                                            <option value="Postgres" {{ $category == 'Postgres' ? 'selected' : '' }}>🐘
                                                Postgres</option>
                                            <option value="React" {{ $category == 'React' ? 'selected' : '' }}>⚛️ React
                                            </option>
                                            <option value="Next.js" {{ $category == 'Next.js' ? 'selected' : '' }}>▲
                                                Next.js</option>
                                            <option value="DevOps" {{ $category == 'DevOps' ? 'selected' : '' }}>🚀 DevOps
                                            </option>
                                            <option value="SQL" {{ $category == 'SQL' ? 'selected' : '' }}>🗃️ SQL
                                            </option>
                                            <option value="Apache Kafka" {{ $category == 'Apache Kafka' ? 'selected' : '' }}>📊 Apache Kafka</option>
                                            <option value="Wordpress" {{ $category == 'Wordpress' ? 'selected' : '' }}>📝
                                                Wordpress</option>
                                            <option value="Bash" {{ $category == 'Bash' ? 'selected' : '' }}>💻 Bash
                                            </option>
                                            <option value="Docker" {{ $category == 'Docker' ? 'selected' : '' }}>🐳 Docker
                                            </option>
                                            <option value="Laravel" {{ $category == 'Laravel' ? 'selected' : '' }}>🔴
                                                Laravel</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('category')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Difficulty Selection -->
                                <div class="space-y-2">
                                    <label for="difficulty"
                                        class="block text-sm font-medium text-gray-700 mb-2">Difficulty Level</label>
                                    <div class="relative">
                                        <select name="difficulty" id="difficulty" wire:model.live="difficulty"
                                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300 @error('difficulty') border-red-500 @enderror">
                                            <option value="">Select difficulty</option>
                                            <option value="easy" {{ $difficulty == 'easy' ? 'selected' : '' }}>🟢 Easy
                                            </option>
                                            <option value="medium" {{ $difficulty == 'medium' ? 'selected' : '' }}>🟡
                                                Medium</option>
                                            <option value="hard" {{ $difficulty == 'hard' ? 'selected' : '' }}>🔴 Hard
                                            </option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('difficulty')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Total Questions -->
                                <div class="space-y-2">
                                    <label for="total_questions"
                                        class="block text-sm font-medium text-gray-700 mb-2">Total Questions</label>
                                    <input type="number" name="total_questions" id="total_questions"
                                        wire:model.live="total_questions" placeholder="Enter number of questions"
                                        min="1" max="20" value="{{ $total_questions }}"
                                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300 @error('total_questions') border-red-500 @enderror">
                                    @error('total_questions')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Question Duration -->
                                <div class="space-y-2">
                                    <label for="question_duration"
                                        class="block text-sm font-medium text-gray-700 mb-2">Question Duration
                                        (seconds)</label>
                                    <input type="number" name="question_duration" id="question_duration"
                                        wire:model.live="question_duration" placeholder="Time per question" min="10"
                                        max="60" value="{{ $question_duration }}"
                                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300 @error('question_duration') border-red-500 @enderror">
                                    @error('question_duration')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Lobby Details Section -->
                        <div class="space-y-6 pt-8 border-t border-gray-100">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Lobby Details</h3>
                            </div>

                            <div class="space-y-6">
                                <!-- Lobby Name -->
                                <div class="space-y-2">
                                    <label for="lobby_name" class="block text-sm font-medium text-gray-700 mb-2">Lobby
                                        Name</label>
                                    <input type="text" name="lobby_name" id="lobby_name" wire:model.live="lobby_name"
                                        placeholder="Give your lobby a catchy name" maxlength="255"
                                        value="{{ $lobby_name }}"
                                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-300 @error('lobby_name') border-red-500 @enderror">
                                    @error('lobby_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Lobby Description -->
                                <div class="space-y-2">
                                    <label for="lobby_description"
                                        class="block text-sm font-medium text-gray-700 mb-2">Lobby Description</label>
                                    <textarea name="lobby_description" id="lobby_description" rows="4"
                                        wire:model.live="lobby_description"
                                        placeholder="Describe what participants can expect from this quiz..."
                                        maxlength="1000"
                                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none hover:border-gray-300 @error('lobby_description') border-red-500 @enderror">{{ $lobby_description }}</textarea>
                                    @error('lobby_description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Quiz Settings Section -->
                        <div class="space-y-6 pt-8 border-t border-gray-100">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">Quiz Settings</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Show Score Toggle -->
                                <div class="space-y-3">
                                    <label for="show_score" class="block text-sm font-medium text-gray-700">Show Score
                                        to Participants</label>
                                    <div class="relative">
                                        <select name="show_score" id="show_score" wire:model.live="show_score"
                                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300 @error('show_score') border-red-500 @enderror">
                                            <option value="true" {{ $show_score == 'true' ? 'selected' : '' }}>✅ Yes, show
                                                scores</option>
                                            <option value="false" {{ $show_score == 'false' ? 'selected' : '' }}>❌ No,
                                                keep scores hidden</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('show_score')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Show Review Toggle -->
                                <div class="space-y-3">
                                    <label for="show_review" class="block text-sm font-medium text-gray-700">Show Answer
                                        Review</label>
                                    <div class="relative">
                                        <select name="show_review" id="show_review" wire:model.live="show_review"
                                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer hover:border-gray-300 @error('show_review') border-red-500 @enderror">
                                            <option value="true" {{ $show_review == 'true' ? 'selected' : '' }}>✅ Yes,
                                                show review</option>
                                            <option value="false" {{ $show_review == 'false' ? 'selected' : '' }}>❌ No,
                                                skip review</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('show_review')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Error Message Display -->
                        @if($errorMessage)
                            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-red-700">{{ $errorMessage }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <div class="pt-8">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    <span>Update Quiz Lobby</span>
                                </div>
                            </button>
                        </div>

                    </form>
                </div>

                <!-- Decorative Elements -->
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/10 to-purple-400/10 rounded-full -translate-y-16 translate-x-16">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-cyan-400/10 to-blue-400/10 rounded-full translate-y-12 -translate-x-12">
                </div>
            </div>

            <!-- Footer Info -->
            <div class="text-center mt-8">
                <p class="text-gray-500 text-sm">
                    🎯 Create engaging quiz experiences • 🏆 Track participant performance • 🎮 Interactive multiplayer
                    fun
                </p>
            </div>
        </div>
    </div>
</div>