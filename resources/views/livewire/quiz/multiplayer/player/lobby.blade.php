<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multiplayer Lobby') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-xl p-6">
                <!-- Leave lobby button -->
                <div class="flex flex-wrap gap-3 mb-6 pb-4 border-b border-gray-200">
                    <button wire:click="leaveLobby" wire:confirm="Are you sure you want to leave this lobby?"
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        Leave Lobby
                    </button>
                </div>

                <!-- Lobby Code -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Lobby Code</h1>
                        <p class="text-xl text-indigo-600 font-mono tracking-wider" id="lobbyCode">
                            {{ $quiz->lobby_code }}
                        </p>
                    </div>
                    <button onclick="copyCode(event)"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-indigo-600 hover:text-white hover:bg-indigo-600 border border-indigo-600 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                            </path>
                        </svg>
                        Copy
                    </button>
                </div>

                <!-- Quiz Info -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Quiz Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700 bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center">
                            <span class="font-semibold text-gray-600 min-w-[100px]">Host:</span>
                            <span class="text-gray-800">{{ $host->name }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold text-gray-600 min-w-[100px]">Name:</span>
                            <span class="text-gray-800">{{ $quiz->lobby_name }}</span>
                        </div>
                        <div class="flex items-start md:col-span-2">
                            <span class="font-semibold text-gray-600 min-w-[100px]">Description:</span>
                            <span class="text-gray-800">{{ $quiz->lobby_description }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold text-gray-600 min-w-[100px]">Category:</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $quiz->category }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold text-gray-600 min-w-[100px]">Difficulty:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($quiz->difficulty === 'easy') bg-green-100 text-green-800
                                @elseif($quiz->difficulty === 'medium') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($quiz->difficulty) }}
                            </span>
                        </div>
                        <div class="flex items-center">
                            <span class="font-semibold text-gray-600 min-w-[100px]">Questions:</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $quiz->total_questions }}</span>
                        </div>
                    </div>
                </div>

                <!-- Players -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Players Joined</h2>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            {{ count($players) }} {{ count($players) === 1 ? 'Player' : 'Players' }}
                        </span>
                    </div>

                    @if(count($players) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                            @foreach ($players as $index => $player)
                                <div wire:key="player-{{ $player->id }}"
                                    class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center text-indigo-700 font-semibold hover:bg-indigo-100 transition-colors duration-200">
                                    <div class="flex items-center justify-center mb-1">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    {{ $player->username }}
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No players yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Waiting for players to join the lobby!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Echo.private('quiz-lobby.{{ $quiz->lobby_code }}')
                .listen('PlayerJoinedLobby', (data) => {
                    @this.call('playerChanged', data);
                })
                .listen('PlayerLeaveLobby', (data) => {
                    @this.call('playerChanged', data);
                });
            Echo.private('multiplayer.{{ $quiz->id }}')
                .listen('QuizStarted', (data) => {
                    let retries = 0;
                    const maxRetries = 3;

                    const tryRedirect = () => {
                        if (retries >= maxRetries) return;

                        @this.call('quizStarted', data)
                            .catch(() => {
                                retries++;
                                setTimeout(tryRedirect, 1000);
                            });
                    };

                    tryRedirect();
                });
        });

        function copyCode(event) {
            const code = document.getElementById('lobbyCode').innerText.trim();
            navigator.clipboard.writeText(code).then(function () {
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Copied!
                `;
                button.classList.add('bg-green-600', 'text-white', 'border-green-600');
                button.classList.remove('text-indigo-600', 'hover:text-white', 'hover:bg-indigo-600', 'border-indigo-600');

                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-green-600', 'text-white', 'border-green-600');
                    button.classList.add('text-indigo-600', 'hover:text-white', 'hover:bg-indigo-600', 'border-indigo-600');
                }, 2000);
            }).catch(function (err) {
                // Fallback for older browsers
                console.error('Could not copy text: ', err);

                // Create a temporary textarea for fallback
                const textArea = document.createElement('textarea');
                textArea.value = code;
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    const button = event.target.closest('button');
                    const originalText = button.innerHTML;
                    button.innerHTML = `
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Copied!
                    `;
                    button.classList.add('bg-green-600', 'text-white', 'border-green-600');
                    button.classList.remove('text-indigo-600', 'hover:text-white', 'hover:bg-indigo-600', 'border-indigo-600');

                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.classList.remove('bg-green-600', 'text-white', 'border-green-600');
                        button.classList.add('text-indigo-600', 'hover:text-white', 'hover:bg-indigo-600', 'border-indigo-600');
                    }, 2000);
                } catch (fallbackErr) {
                    console.error('Fallback copy failed: ', fallbackErr);
                }

                document.body.removeChild(textArea);
            });
        }
    </script>
</div>