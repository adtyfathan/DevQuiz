<div>
    <h1>Ini Multiplayer Quiz</h1>
    
    <h1 id="timer"></h1>
    
    <div id="opening-container" class="opening-container">
    
    </div>
    
    <div id="quiz-container" class="quiz-container">
        
    </div>
    
    <div id="meme-container" class="meme-container">
    
    </div>
    
    <div id="result-container" class="result-container">
    
    </div>
    
    <div id="standings-container" class="standings-container">
        <table id="standings-table">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
    
            </tbody>
        </table>
    
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Echo.private('quiz.{{ $quiz->id }}')
                .listen('QuestionBroadcasted', event => {
                    console.log("Event masuk: ", event)
                    handleQuestionEvent(event)
                })
                .listen('StandingsUpdated', event => {
                    console.log("Event masuk: ", event)
                    if (event.isLast) {
                        // getUserAnswers
                        // blm di bikin
                        // completeQuiz(event);
                    } else {
                        handleStandingsEvent(event);
                    }
                });
        });

        let countdown;
        let hasAnswered;
        let questionCounter = 0;
        let questions = [];

        const containers = {
            opening: document.getElementById("opening-container"),
            quiz: document.getElementById("quiz-container"),
            meme: document.getElementById("meme-container"),
            standings: document.getElementById("standings-container"),
            result: document.getElementById("result-container")
        };

        const timerText = document.getElementById("timer");

        function handleQuestionEvent(event) {
            questionCounter++;
            hasAnswered = false;

            const now = new Date();

            const openingTime = new Date(event.openingAt);
            const questionTime = new Date(event.questionAt);
            const memeTime = new Date(event.memeAt);

            const openingDelay = Math.max(0, openingTime - now);
            const questionDelay = Math.max(0, questionTime - now);
            const memeDelay = Math.max(0, memeTime - now);

            setTimeout(() => {
                startTimer(event.openingAt, 5);
                displaySection("opening", () => {
                    containers.opening.innerHTML = `<h1>Question Number ${questionCounter}</h1>`;
                });
            }, openingDelay);

            setTimeout(() => {
                questions.push(event.question);
                // 
                const timeoutDuration = 15000;
                // 
                startTimer(event.questionAt, 15);
                displaySection("quiz", () => renderQuestion(event.question));
                setTimeout(() => {
                    if (!hasAnswered){
                        @this.call('handlePlayerAnswer', 0, null, false);
                    } 
                }, timeoutDuration);
            }, questionDelay);

            setTimeout(() => {
                startTimer(event.memeAt, 5);
                displaySection("meme", () => {
                    containers.meme.innerHTML = `<p>Ini mim</p>`;
                });
            }, memeDelay);
        }

        function renderQuestion(question) {
            const answersHTML = Object.entries(question.answers)
                .map(([key, text]) => text ? `
                    <li>
                        <input type="radio" name="question" value="${key}" class="answer-option"> ${text}
                    </li>` : '')
                .join('');

            containers.quiz.innerHTML = `
                <h3>${question.question}</h3>
                <ul id="answers">${answersHTML}</ul>
            `;

            document.querySelectorAll(".answer-option").forEach(option => {
                option.addEventListener("change", () => {
                    hasAnswered = true;
                    const userAnswer = option.value;
                    const correctAnswer = getCorrectAnswer(question.correct_answers);

                    document.querySelectorAll(".answer-option").forEach(input => input.disabled = true);
                    const isTrue = checkAnswer(correctAnswer, userAnswer);

                    const correctPoint = 100;

                    @this.call('handlePlayerAnswer', 0, null, false);
                });
            });
        }

        function getCorrectAnswer(correctAnswers) {
            return Object.entries(correctAnswers)
                .find(([_, value]) => value === "true")?.[0].replace("_correct", "");
        }

        function checkAnswer(correct, selected) {
            if(correct === selected){
                console.log("Benar");
                // edit DOM
                return true;
            } else {
                console.log(`Salah, jawaban benar ${correct}`);
                // edit DOM
                return false;
            }
        }

        function displaySection(sectionName, renderCallback) {
            Object.keys(containers).forEach(name => {
                containers[name].style.display = name === sectionName ? "block" : "none";
            });
            renderCallback();
        }

        function startTimer(eventScheduledAt, duration) {
            const scheduledAt = new Date(eventScheduledAt);
            const now = new Date();
            const elapsed = Math.floor((now - scheduledAt) / 1000);
            let timeLeft = Math.max(0, duration - elapsed);

            clearInterval(countdown);
            timerText.textContent = `Timer: ${timeLeft}`;

            countdown = setInterval(() => {
                timeLeft--;
                timerText.textContent = `Timer: ${timeLeft}`;
                if (timeLeft <= 0) clearInterval(countdown);
            }, 1000);
        }

        function handleStandingsEvent(event) {
            const now = new Date();
            const standingsTime = new Date(event.standingsAt);
            const standingsDelay = Math.max(0, standingsTime - now);

            setTimeout(() => {
                startTimer(event.standingsAt, 10);
                displaySection("standings", () => renderStandings(event.players));
            }, standingsDelay);
        }

        function renderStandings(players) {
            const tableBody = document.querySelector('#standings-table tbody');
            tableBody.innerHTML = players.map((player, i) => `
                <tr>
                    <td>${i + 1}</td>
                    <td>${player.username}</td>
                    <td>${player.point}</td>
                </tr>
            `).join('');
        }
    </script>
</div>
