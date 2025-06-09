<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multiplayer Host Lobby') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-xl p-6">
                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 mb-6 pb-4 border-b border-gray-200">
                    <!-- Edit Button -->
                    <a href="/quiz/multiplayer/host/edit/{{ $quiz->id }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Quiz
                    </a>

                    <!-- Delete Button -->
                    <button wire:click="deleteLobby" {{ $quiz->status === 'in_progress' ? 'disabled' : '' }}
                        wire:confirm="Are you sure you want to delete this lobby?"
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Delete Lobby
                    </button>

                    <button wire:click="startQuiz" {{ $quiz->status !== 'waiting' ? 'disabled' : '' }}
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Start Quiz
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
                    <button type="button" id="copyButton"
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

                @if ($quiz->status === 'in_progress')
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Quiz Status</h2>
                        <div
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            {{ ucfirst($quiz->status) }}
                        </div>
                    </div>

                @endif

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

    @script
    <script>
        const lobby = {
            init() {
                document.addEventListener('livewire:initialized', () => {
                    this.initializeEventListeners();
                    this.initializeCopyButton();
                });
            },

            initializeEventListeners() {
                Echo.private('quiz-lobby.{{ $quiz->lobby_code }}')
                    .listen('PlayerJoinedLobby', (data) => {
                        @this.call('playerChanged', data);
                    })
                    .listen('PlayerLeaveLobby', (data) => {
                        @this.call('playerChanged', data);
                    });
                Echo.private('quiz-ended.{{ $quiz->id }}')
                    .listen('QuizEnded', (data) => {
                        @this.call('quizEnded', data);
                    });
            },

            initializeCopyButton() {
                const copyButton = document.getElementById('copyButton');
                if (copyButton) {
                    copyButton.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        this.copyCode(copyButton);
                    });
                }
            },

            async copyCode(button) {
                const codeElement = document.getElementById('lobbyCode');
                if (!codeElement) {
                    console.error('Lobby code element not found');
                    return;
                }

                const code = codeElement.textContent.trim();

                try {
                    // Try modern clipboard API first
                    if (navigator.clipboard && window.isSecureContext) {
                        await navigator.clipboard.writeText(code);
                        this.showCopySuccess(button);
                    } else {
                        // Fallback for older browsers or non-secure contexts
                        this.fallbackCopyToClipboard(code, button);
                    }
                } catch (err) {
                    console.error('Copy failed, trying fallback:', err);
                    this.fallbackCopyToClipboard(code, button);
                }
            },

            showCopySuccess(button) {
                const originalHTML = button.innerHTML;
                const originalClasses = button.className;

                // Update button to show success
                button.innerHTML = `
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Copied!
                `;

                // Update classes for success state
                button.className = button.className
                    .replace('text-indigo-600', 'text-white')
                    .replace('hover:text-white', '')
                    .replace('hover:bg-indigo-600', '')
                    .replace('border-indigo-600', 'border-green-600') + ' bg-green-600';

                // Reset after 2 seconds
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.className = originalClasses;
                }, 2000);
            },

            fallbackCopyToClipboard(text, button) {
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);

                textArea.focus();
                textArea.select();

                try {
                    const successful = document.execCommand('copy');
                    if (successful) {
                        this.showCopySuccess(button);
                    } else {
                        console.error('Fallback copy command failed');
                    }
                } catch (err) {
                    console.error('Fallback copy failed:', err);
                } finally {
                    document.body.removeChild(textArea);
                }
            }
        };

        lobby.init();
    </script>
    @endscript
</div>