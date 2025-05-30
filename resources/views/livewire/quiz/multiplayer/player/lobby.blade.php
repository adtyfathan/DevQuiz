<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multiplayer Lobby') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg sm:rounded-xl p-6">
                <!-- Lobby Code -->
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Lobby Code</h1>
                        <p class="text-xl text-indigo-600 font-mono tracking-wider" id="lobbyCode">
                            {{ $quiz->lobby_code }}
                        </p>
                    </div>
                    <button onclick="copyCode()" class="text-indigo-600 hover:text-indigo-800">
                        copy
                    </button>
                </div>

                <!-- Quiz Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                    <div>
                        <span class="font-semibold">Host:</span> {{ $host->name }}
                    </div>
                    <div>
                        <span class="font-semibold">Name:</span> {{ $quiz->lobby_name }}
                    </div>
                    <div>
                        <span class="font-semibold">Description:</span> {{ $quiz->lobby_description }}
                    </div>
                    <div>
                        <span class="font-semibold">Category:</span> {{ $quiz->category }}
                    </div>
                    <div>
                        <span class="font-semibold">Difficulty:</span> {{ $quiz->difficulty }}
                    </div>
                    <div>
                        <span class="font-semibold">Total Questions:</span> {{ $quiz->total_questions }}
                    </div>
                </div>

                <!-- Players -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Players Joined
                        ({{ count($players) }})</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        @foreach ($players as $player)
                            <div
                                class="bg-indigo-50 border border-indigo-200 rounded-xl p-2 text-center text-indigo-700 font-semibold">
                                {{ $player->username }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyCode() {
            const code = document.getElementById('lobbyCode').innerText;
            navigator.clipboard.writeText(code)
        }
    </script>
</div>