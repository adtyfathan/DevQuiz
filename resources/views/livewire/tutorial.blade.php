<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tutorial') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
        
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-blue-600">Welcome to DevQuiz</h1>
                <p class="mt-3 text-gray-600 text-lg">Learn how to play quizzes in singleplayer and multiplayer modes.</p>
            </div>
            
            <!-- Tutorial Steps -->
            <div class="grid gap-8 md:grid-cols-2">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-blue-500">1. Create a Lobby</h2>
                    <p class="mt-3 text-gray-600">
                        Invite your friends to play multiplayer quiz together with the same lobby, you can create a lobby and customized the quiz content and rules!
                    </p>
                </div>
            
                <!-- Step 2 -->
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-blue-500">2. Share the lobby code</h2>
                    <p class="mt-3 text-gray-600">
                        After creating a lobby, you’ll receive a unique lobby code. Share it with your friends so they can join.
                    </p>
                </div>
            
                <!-- Step 3 -->
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-blue-500">3. Start the quiz</h2>
                    <p class="mt-3 text-gray-600">
                        Once everyone has joined, the host can start the quiz. All players will receive the same questions in sync.
                    </p>
                </div>
            
                <!-- Step 4 -->
                <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-blue-500">4. Play & compete</h2>
                    <p class="mt-3 text-gray-600">
                        Answer the timed questions, earn points, and compete to reach the top of the leaderboard.
                    </p>
                </div>
            </div>
            
            <!-- Tips Section -->
            <div class="mt-16 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg p-8">
                <h3 class="text-2xl font-bold">Tips for Success 🚀</h3>
                <ul class="mt-4 list-disc list-inside space-y-2 text-lg">
                    <li>Practice in singleplayer to improve your speed and accuracy.</li>
                    <li>Invite friends and challenge them in multiplayer mode.</li>
                    <li>Review the quiz you already finished to increase your knowledge.</li>
                    <li>Stay active through different quizzes!</li>
                </ul>
            </div>

        </div>
    </div>
</div>