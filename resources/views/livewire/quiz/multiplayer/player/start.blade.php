<div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
                <div class="divide-y divide-gray-200">
                    <h1 class="text-2xl font-bold mb-5 text-center">Multiplayer Quiz</h1>
                    
                    <div class="text-center py-4">
                        <h2 id="timer" class="text-xl font-semibold text-indigo-600"></h2>
                    </div>

                    <!-- Opening Container -->
                    <div id="opening-container" class="hidden py-8 text-center">
                        <div class="animate-bounce">
                            <h2 class="text-2xl font-bold text-gray-800"></h2>
                        </div>
                    </div>

                    <!-- Quiz Container -->
                    <div id="quiz-container" class="hidden py-8">
                        <div class="space-y-4">
                            <h3 class="text-xl font-semibold text-gray-800"></h3>
                            <ul id="answers" class="space-y-2"></ul>
                        </div>
                    </div>

                    <!-- Meme Container -->
                    <div id="meme-container" class="hidden py-8 text-center">
                        <div class="animate-pulse">
                            <p class="text-lg text-gray-600"></p>
                        </div>
                    </div>

                    <!-- Standings Container -->
                    <div id="standings-container" class="hidden py-8">
                        <div class="overflow-x-auto">
                            <table id="standings-table" class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200"></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Results Container -->
                    <div id="result-container" class="hidden py-8"></div>
                </div>
            </div>
        </div>
    </div>

    @script
    <script>
        const quiz = {
            countdown: null,
            hasAnswered: false,
            questionCounter: 0,

            init() {
                this.initializeEventListeners();
                this.setupContainers();
            },

            initializeEventListeners() {
                Echo.private('quiz.{{ $quiz->id }}')
                    .listen('QuestionBroadcasted', this.handleQuestionEvent.bind(this))
                    .listen('StandingsUpdated', this.handleStandingsEvent.bind(this));
            },

            setupContainers() {
                this.containers = {
                    opening: document.getElementById("opening-container"),
                    quiz: document.getElementById("quiz-container"),
                    meme: document.getElementById("meme-container"),
                    standings: document.getElementById("standings-container"),
                    result: document.getElementById("result-container")
                };
                this.timerText = document.getElementById("timer");
            },

            handleQuestionEvent(event) {
                this.questionCounter++;
                this.hasAnswered = false;
                const now = new Date();

                const timings = {
                    opening: new Date(event.openingAt),
                    question: new Date(event.questionAt),
                    meme: new Date(event.memeAt)
                };

                this.schedulePhases(timings, now, event);
            },

            schedulePhases(timings, now, event) {
                const delays = {
                    opening: Math.max(0, timings.opening - now),
                    question: Math.max(0, timings.question - now),
                    meme: Math.max(0, timings.meme - now)
                };

                this.scheduleOpeningPhase(delays.opening, event);
                this.scheduleQuestionPhase(delays.question, event);
                this.scheduleMemePhase(delays.meme, event);
            },

            scheduleOpeningPhase(delay, event) {
                setTimeout(() => {
                    this.startTimer(event.openingAt, 5);
                    this.displaySection("opening", () => {
                        this.containers.opening.innerHTML = `<h1>New Questions! Get Ready...</h1>`;
                    });
                }, delay);
            },

            scheduleQuestionPhase(delay, event) {
                setTimeout(() => {
                    const timeoutDuration = {{ $questionDuration }} * 1000;
                    this.startTimer(event.questionAt, {{ $questionDuration }});
                    this.displaySection("quiz", () => this.renderQuestion(event.question));
                    setTimeout(() => {
                        if (!this.hasAnswered) {
                            @this.call('handlePlayerAnswer', 0, null, false, event.question.id);
                        }
                    }, timeoutDuration);
                }, delay);
            },

            scheduleMemePhase(delay, event) {
                setTimeout(() => {
                    this.startTimer(event.memeAt, 5);
                    this.displaySection("meme", () => {
                        this.containers.meme.innerHTML = `
                            <div class="flex flex-col items-center space-y-4">
                                <p class="text-xl font-semibold text-gray-700">Time for a meme!</p>
                            </div>
                        `;
                    });
                }, delay);
            },

            renderQuestion(question) {
                const answersHTML = Object.entries(question.answers)
                    .map(([key, text]) => text ? `
                        <li>
                            <input type="radio" name="question" value="${key}" class="answer-option"> ${text}
                        </li>` : '')
                    .join('');

                this.containers.quiz.innerHTML = `
                    <h3>${question.question}</h3>
                    <ul id="answers">${answersHTML}</ul>
                `;

                document.querySelectorAll(".answer-option").forEach(option => {
                    option.addEventListener("change", () => {
                        this.hasAnswered = true;
                        const userAnswer = option.value;
                        const correctAnswer = this.getCorrectAnswer(question.correct_answers);

                        document.querySelectorAll(".answer-option").forEach(input => input.disabled = true);
                        const isTrue = this.checkAnswer(correctAnswer, userAnswer);

                        let correctPoint = 0;
                        let bonusPoint = this.countdown * 10;

                        if (isTrue) correctPoint = 100 + bonusPoint;

                        // Add question ID to the call
                        @this.call('handlePlayerAnswer', correctPoint, userAnswer, isTrue, question.id);
                    });
                });
            },

            getCorrectAnswer(correctAnswers) {
                return Object.entries(correctAnswers)
                    .find(([_, value]) => value === "true")?.[0].replace("_correct", "");
            },

            checkAnswer(correct, selected) {
                if(correct === selected){
                    console.log("Benar");
                    // edit DOM
                    return true;
                } else {
                    console.log(`Salah, jawaban benar ${correct}`);
                    // edit DOM
                    return false;
                }
            },

            displaySection(sectionName, renderCallback) {
                console.log(`Switching to ${sectionName} section at ${new Date().toISOString()}`);
                Object.keys(this.containers).forEach(name => {
                    this.containers[name].style.display = name === sectionName ? "block" : "none";
                });
                renderCallback();
            },

            startTimer(eventScheduledAt, duration) {
                const scheduledAt = new Date(eventScheduledAt);
                const now = new Date();
                const elapsed = Math.floor((now - scheduledAt) / 1000);
                let timeLeft = Math.max(0, duration - elapsed);

                console.log(`Starting timer for ${duration} seconds at ${now.toISOString()}`);
                
                clearInterval(this.countdown);
                this.timerText.textContent = `Timer: ${timeLeft}`;

                this.countdown = setInterval(() => {
                    timeLeft--;
                    this.timerText.textContent = `Timer: ${timeLeft}`;
                    if (timeLeft <= 0) {
                        clearInterval(this.countdown);
                        console.log(`Timer finished at ${new Date().toISOString()}`);
                    }
                }, 1000);
            },

            handleStandingsEvent(event) {
                const now = new Date();
                const standingsTime = new Date(event.standingsAt);
                const standingsDelay = Math.max(0, standingsTime - now);

                setTimeout(() => {
                    this.startTimer(event.standingsAt, 10);
                    this.displaySection("standings", () => {
                        this.renderStandings(event.players);
                        
                        // If this is the last standings sequence
                        if (event.isLast) {

                            setTimeout(() => {
                                this.displaySection("result", () => {
                                    this.renderFinalResults(event.players, event.category, event.difficulty);
                                });
                            }, 10000); 
                        }
                    });
                }, standingsDelay);
            },

            renderStandings(players) {
                const tableBody = document.querySelector('#standings-table tbody');
                tableBody.innerHTML = players.map((player, i) => `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${player.username}</td>
                        <td>${player.point}</td>
                    </tr>
                `).join('');
            },

            renderFinalResults(players, category, difficulty) {
                @this.call('endQuiz');
                const winner = players[0]; // First player has highest points
                this.containers.result.innerHTML = `
                    <div class="text-center space-y-6">
                        <h2 class="text-2xl font-bold text-gray-800">Quiz Complete!</h2>
                        <div class="bg-yellow-100 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Winner</h3>
                            <p class="text-lg text-gray-600">${winner.username}</p>
                            <p class="text-2xl font-bold text-yellow-600">${winner.point} points</p>
                        </div>
                        <div class="mt-4 text-gray-600">
                            <p>Category: ${category}</p>
                            <p>Difficulty: ${difficulty}</p>
                        </div>
                        <a href="/home" 
                           class="inline-block mt-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Back to Home
                        </a>
                    </div>
                `;
            }
        };

        quiz.init();
    </script>
    @endscript
</div>
