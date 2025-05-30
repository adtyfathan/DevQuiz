<!-- Multiplayer Section -->
<div class="mb-12 flex justify-center">
    <div
        class="overflow-hidden bg-gradient-to-br from-blue-50 to-purple-50 shadow-xl sm:rounded-2xl border border-blue-100 w-fit">
        <div class="p-6 sm:p-8 lg:p-10">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                    DevQuiz
                </h2>
            </div>

            <form wire:submit.prevent="joinLobby" class="w-96 space-y-6">
                <!-- Error Message -->
                @if($errorMessage)
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        <span class="block sm:inline">{{ $errorMessage }}</span>
                    </div>
                @endif

                @error('username')
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        {{ $message }}
                    </div>
                @enderror

                @error('lobbyCode')
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Username Input -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-semibold text-gray-700">
                        Username
                    </label>
                    <div class="relative">
                        <input type="text" id="username" wire:model="username"
                            class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-900 placeholder-gray-500"
                            placeholder="Enter your username" maxlength="20" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Lobby Code Input -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">
                        Lobby Code (6 digit)
                    </label>
                    <input type="text" wire:model="lobbyCode"
                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-900 placeholder-gray-500 text-center text-lg font-bold tracking-widest"
                        maxlength="6" pattern="[0-9]{6}" />
                </div>

                <!-- Join Button -->
                <button type="submit" wire:loading.attr="disabled" wire:target="joinLobby"
                    wire:loading.class="opacity-75 cursor-not-allowed transform-none"
                    class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg focus:ring-4 focus:ring-blue-200 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                
                    <span wire:target="joinLobby" class="flex items-center justify-center space-x-2">
                        {{-- <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1">
                            </path>
                        </svg> --}}
                        <span>Join Lobby</span>
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>