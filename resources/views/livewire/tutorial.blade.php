<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Multiplayer Lobby') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="min-h-screen bg-gradient-to-b from-blue-50 via-white to-blue-100 py-12 px-6">
            <div class="max-w-5xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-blue-600">Welcome to DevQuiz Tutorial</h1>
                    <p class="mt-3 text-gray-600 text-lg">Learn how to play quizzes in singleplayer and multiplayer modes.</p>
                </div>
        
                <!-- Tutorial Steps -->
                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Step 1 -->
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-blue-500">1. Create an Account</h2>
                        <p class="mt-3 text-gray-600">
                            Sign up with your email or log in to your DevQuiz account to start playing.
                            Your progress and scores will be saved.
                        </p>
                    </div>
        
                    <!-- Step 2 -->
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-blue-500">2. Choose a Mode</h2>
                        <p class="mt-3 text-gray-600">
                            Select <span class="font-medium text-blue-600">Singleplayer</span> for solo practice
                            or <span class="font-medium text-blue-600">Multiplayer</span> to compete with friends in real-time.
                        </p>
                    </div>
        
                    <!-- Step 3 -->
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-blue-500">3. Select a Quiz</h2>
                        <p class="mt-3 text-gray-600">
                            Pick from categories like <span class="font-medium">Programming, Databases, AI</span>
                            and set the difficulty level. New quizzes are added regularly!
                        </p>
                    </div>
        
                    <!-- Step 4 -->
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-blue-500">4. Play & Compete</h2>
                        <p class="mt-3 text-gray-600">
                            Answer timed questions, earn points, and climb the leaderboard.
                            Multiplayer mode syncs questions across all players in real-time.
                        </p>
                    </div>
                </div>
        
                <!-- Tips Section -->
                <div class="mt-16 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg p-8">
                    <h3 class="text-2xl font-bold">Tips for Success 🚀</h3>
                    <ul class="mt-4 list-disc list-inside space-y-2 text-lg">
                        <li>Practice in singleplayer to improve your speed and accuracy.</li>
                        <li>Invite friends and challenge them in multiplayer mode.</li>
                        <li>Check your profile stats to track your progress.</li>
                        <li>Stay active—weekly challenges give extra rewards!</li>
                    </ul>
                </div>
        
                <!-- Call to Action -->
                <div class="text-center mt-12">
                    <a href=""
                        class="inline-block px-8 py-3 bg-blue-600 text-white text-lg font-semibold rounded-full shadow-md hover:bg-blue-700 transition">
                        Start Playing Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>