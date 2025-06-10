<div class="bg-gradient-to-br from-indigo-900 via-purple-800 to-pink-700 min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="absolute inset-0"
        style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.05) 0%, transparent 50%);">
    </div>

    <div class="relative min-h-screen py-4 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-6">
                <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Multiplayer Quiz</h1>
                <div id="timer"
                    class="text-2xl font-semibold text-white bg-black bg-opacity-30 rounded-full px-6 py-2 inline-block backdrop-blur-sm border border-white border-opacity-20">
                </div>
            </div>

            <!-- Main Container -->
            <div
                class="bg-white bg-opacity-95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-white border-opacity-30">

                <!-- Loading Container (for mid-game joins) -->
                <div id="loading-container" class="py-16 text-center">
                    <div class="flex flex-col items-center space-y-6">
                        <div class="space-y-2">
                            <p class="text-gray-600">Waiting for next section</p>
                            <div class="flex justify-center space-x-1 mt-4">
                                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce"></div>
                                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce"
                                    style="animation-delay: 0.1s"></div>
                                <div class="w-2 h-2 bg-indigo-600 rounded-full animate-bounce"
                                    style="animation-delay: 0.2s"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opening Container -->
                <div id="opening-container" class="hidden py-16 text-center">
                    <div class="animate-bounce">
                        <div class="text-6xl mb-4">🚀</div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Get Ready!</h2>
                        <p class="text-xl text-gray-600">New question coming up...</p>
                    </div>
                </div>

                <!-- Quiz Container -->
                <div id="quiz-container" class="hidden p-8">
                    <div class="space-y-6">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 leading-relaxed"></h3>
                            <div class="flex justify-center items-center space-x-2 text-sm text-gray-500">
                                <span>Question</span>
                                <span id="question-counter"
                                    class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-md font-semibold">1</span>
                            </div>
                        </div>

                        <div id="answers" class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto"></div>

                        <div class="text-center text-sm text-gray-500 mt-6">
                            <p>⚡ Faster answers get bonus points!</p>
                        </div>
                    </div>
                </div>

                <!-- Meme Container -->
                <div id="meme-container" class="hidden py-16 text-center">
                    <div class="flex flex-col items-center space-y-6">
                        <div class="space-y-2">
                            <img src="" id="meme-image" width="200">
                            <p class="text-gray-600">Get ready for the next question</p>
                        </div>
                    </div>
                </div>

                <!-- Standings Container -->
                <div id="standings-container" class="hidden p-8">
                    <div class="text-center mb-6">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">🏆 Leaderboard</h2>
                        <p class="text-gray-600">Current standings</p>
                    </div>

                    <div class="max-w-2xl mx-auto">
                        <div id="standings-list" class="space-y-3"></div>
                    </div>
                </div>

                <!-- Results Container -->
                <div id="result-container" class="hidden p-8"></div>
            </div>
        </div>
    </div>

    @script
    <script>
        const quiz = {
            countdown: null,
            hasAnswered: false,
            questionCounter: 0,
            isWaitingForFirstQuestion: true,
            answerState: false,

            init() {
                this.initializeEventListeners();
                this.setupContainers();
                this.showLoadingIfNeeded();
            },

            initializeEventListeners() {
                Echo.private('quiz.{{ $quiz->id }}')
                    .listen('QuestionBroadcasted', this.handleQuestionEvent.bind(this))
                    .listen('StandingsUpdated', this.handleStandingsEvent.bind(this));
            },

            setupContainers() {
                this.containers = {
                    loading: document.getElementById("loading-container"),
                    opening: document.getElementById("opening-container"),
                    quiz: document.getElementById("quiz-container"),
                    meme: document.getElementById("meme-container"),
                    standings: document.getElementById("standings-container"),
                    result: document.getElementById("result-container")
                };
                this.timerText = document.getElementById("timer");
            },

            showLoadingIfNeeded() {
                if (this.isWaitingForFirstQuestion) {
                    this.displaySection("loading");
                }
            },

            handleQuestionEvent(event) {
                this.isWaitingForFirstQuestion = false;
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
                    this.displaySection("opening");
                }, delay);
            },

            scheduleQuestionPhase(delay, event) {
                setTimeout(() => {
                    this.answerState = false;
                    const timeoutDuration = {{ $questionDuration }} * 1000;
                    this.startTimer(event.questionAt, {{ $questionDuration }});
                    this.displaySection("quiz", () => this.renderQuestion(event.question));

                    // Only handle timeout answer if player hasn't answered
                    setTimeout(() => {
                        if (!this.hasAnswered) {
                            @this.call('handlePlayerAnswer', 0, null, false, event.question.id);
                        }
                        // Don't change section here - let meme phase handle the transition
                    }, timeoutDuration);
                }, delay);
            },

            scheduleMemePhase(delay, event) {
                setTimeout(() => {
                    this.startTimer(event.memeAt, 5);
                    this.displaySection("meme");
                    const randomNumber = this.randomIntFromInterval(1, 5);
                    document.getElementById("meme-image").src = "{{ asset('images/meme-') }}" + this.answerState + "-" + randomNumber + ".jpeg";
                }, delay);
            },

            randomIntFromInterval(min, max) {
                return Math.floor(Math.random() * (max - min + 1) + min);
            },

            renderQuestion(question) {
                const colors = [
                    'from-red-500 to-red-600 hover:from-red-600 hover:to-red-700',
                    'from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700',
                    'from-green-500 to-green-600 hover:from-green-600 hover:to-green-700',
                    'from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700',
                    'from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700',
                    'from-cyan-500 to-cyan-600 hover:from-cyan-600 hover:to-cyan-700',
                ];

                document.querySelector('#quiz-container h3').textContent = question.question;
                document.getElementById('question-counter').textContent = this.questionCounter;

                const answersHTML = Object.entries(question.answers)
                    .filter(([key, text]) => text)
                    .map(([key, text], index) => `
                        <button class="answer-option group relative p-6 bg-gradient-to-r ${colors[index]} text-white rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg border-4 border-white border-opacity-30 hover:-translate-y-1 hover:shadow-2xl" 
                                data-value="${key}">
                            <div class="flex items-center space-x-4">
                                <span class="flex-1 text-left">${text}</span>
                            </div>
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-2xl transition-all duration-300"></div>
                        </button>
                    `)
                    .join('');

                document.getElementById('answers').innerHTML = answersHTML;

                document.querySelectorAll(".answer-option").forEach(option => {
                    option.addEventListener("click", () => {
                        if (this.hasAnswered) return;

                        this.hasAnswered = true;
                        const userAnswer = option.dataset.value;
                        const correctAnswer = this.getCorrectAnswer(question.correct_answers);

                        this.showAnswerFeedback(option, correctAnswer, userAnswer);

                        const isCorrect = this.checkAnswer(correctAnswer, userAnswer);
                        let correctPoint = 0;
                        let bonusPoint = this.countdown * 0.1;

                        if (isCorrect) {
                            correctPoint = 100 + bonusPoint;
                            this.answerState = true;
                        }

                        @this.call('handlePlayerAnswer', correctPoint, userAnswer, isCorrect, question.id);
                    });
                });
            },

            showAnswerFeedback(selectedOption, correctAnswer, userAnswer) {
                document.querySelectorAll(".answer-option").forEach(option => {
                    option.disabled = true;
                    option.style.pointerEvents = 'none';

                    const optionValue = option.dataset.value;
                    if (optionValue === correctAnswer) {
                        // Correct answer styling
                        option.className = 'answer-option group relative p-6 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl font-bold text-lg transition-all duration-300 transform shadow-lg border-4 border-green-400';
                        option.innerHTML += '<div class="absolute top-2 right-2 text-2xl">✅</div>';
                    } else if (optionValue === userAnswer) {
                        // Incorrect user answer styling
                        option.className = 'answer-option group relative p-6 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-2xl font-bold text-lg transition-all duration-300 transform shadow-lg border-4 border-red-400 animate-pulse';
                        option.innerHTML += '<div class="absolute top-2 right-2 text-2xl">❌</div>';
                    } else {
                        // Other options styling
                        option.style.opacity = '0.5';
                        option.style.transform = 'scale(0.95)';
                    }
                });
            },

            getCorrectAnswer(correctAnswers) {
                return Object.entries(correctAnswers)
                    .find(([_, value]) => value === "true")?.[0].replace("_correct", "");
            },

            checkAnswer(correct, selected) {
                return correct === selected;
            },

            displaySection(sectionName, renderCallback) {
                console.log(`Switching to ${sectionName} section at ${new Date().toISOString()}`);
                Object.keys(this.containers).forEach(name => {
                    this.containers[name].style.display = name === sectionName ? "block" : "none";
                });
                if (renderCallback) renderCallback();
            },

            startTimer(eventScheduledAt, duration) {
                const scheduledAt = new Date(eventScheduledAt);
                const now = new Date();
                const elapsed = Math.floor((now - scheduledAt) / 1000);
                let timeLeft = Math.max(0, duration - elapsed);

                clearInterval(this.countdown);
                this.updateTimerDisplay(timeLeft, duration);

                this.countdown = setInterval(() => {
                    timeLeft--;
                    this.updateTimerDisplay(timeLeft, duration);
                    if (timeLeft <= 0) {
                        clearInterval(this.countdown);
                        console.log(`Timer finished at ${new Date().toISOString()}`);
                    }
                }, 1000);
            },

            updateTimerDisplay(timeLeft, totalDuration) {
                const percentage = (timeLeft / totalDuration) * 100;
                this.timerText.textContent = `⏱️ ${timeLeft}s`;

                // Add warning styling when time is running out
                if (percentage <= 20) {
                    this.timerText.className = 'text-2xl font-semibold text-red-400 bg-black bg-opacity-30 rounded-full px-6 py-2 inline-block backdrop-blur-sm border border-red-400 border-opacity-50 animate-pulse';
                } else if (percentage <= 50) {
                    this.timerText.className = 'text-2xl font-semibold text-yellow-400 bg-black bg-opacity-30 rounded-full px-6 py-2 inline-block backdrop-blur-sm border border-yellow-400 border-opacity-50';
                } else {
                    this.timerText.className = 'text-2xl font-semibold text-white bg-black bg-opacity-30 rounded-full px-6 py-2 inline-block backdrop-blur-sm border border-white border-opacity-20';
                }
            },

            handleStandingsEvent(event) {
                const now = new Date();
                const standingsTime = new Date(event.standingsAt);
                const standingsDelay = Math.max(0, standingsTime - now);

                setTimeout(() => {
                    this.startTimer(event.standingsAt, 10);
                    this.displaySection("standings", () => {
                        if (event.isLast == false) {
                            this.renderStandings(event.players);
                        } else {
                            this.displaySection("result", () => {
                                this.renderFinalResults(event.players, event.category, event.difficulty);
                            });
                        }
                    });
                }, standingsDelay);
            },

            renderStandings(players) {
                const standingsList = document.getElementById('standings-list');
                const colors = ['bg-gradient-to-r from-yellow-400 to-yellow-500', 'bg-gradient-to-r from-gray-400 to-gray-500', 'bg-gradient-to-r from-orange-400 to-orange-500'];

                players.sort((a, b) => b.point - a.point);

                standingsList.innerHTML = players.map((player, index) => {
                    const bgColor = colors[index] || 'bg-gradient-to-r from-indigo-100 to-indigo-200';
                    const textColor = index < 3 ? 'text-white' : 'text-gray-800';
                    const medal = index === 0 ? '🥇' : index === 1 ? '🥈' : index === 2 ? '🥉' : `#${index + 1}`;

                    return `
                        <div class="flex items-center justify-between p-4 ${bgColor} rounded-xl shadow-md transform transition-all duration-300 hover:scale-105">
                            <div class="flex items-center space-x-4">
                                <span class="text-2xl font-bold ${textColor}">${medal}</span>
                                <div>
                                    <p class="font-semibold ${textColor}">${player.username}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold ${textColor}">${player.point ? player.point : '0'}</p>
                                <p class="text-sm ${textColor} opacity-75">points</p>
                            </div>
                        </div>
                    `;
                }).join('');
            },

            renderFinalResults(players, category, difficulty) {
                @this.call('endQuiz');
                players.sort((a, b) => b.point - a.point);
                const winner = players[0];
                this.containers.result.innerHTML = `
                    <div class="text-center space-y-8">
                        <div class="animate-bounce">
                            <div class="text-8xl mb-4">🎉</div>
                            <h2 class="text-4xl font-bold text-gray-800 mb-2">Quiz Complete!</h2>
                        </div>
                        
                        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 p-8 rounded-2xl shadow-xl transform hover:scale-105 transition-all duration-300">
                            <h3 class="text-2xl font-bold text-white mb-4">🏆 Winner</h3>
                            <p class="text-3xl font-bold text-white mb-2">${winner.username}</p>
                            <p class="text-4xl font-bold text-yellow-900">${winner.point} points</p>
                        </div>
                        
                        <div class="bg-gray-100 p-6 rounded-xl">
                            <div class="grid grid-cols-2 gap-4 text-gray-700">
                                <div>
                                    <p class="font-semibold">Category</p>
                                    <p>${category}</p>
                                </div>
                                <div>
                                    <p class="font-semibold">Difficulty</p>
                                    <p class="capitalize">${difficulty}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        };

        quiz.init();
    </script>
    @endscript