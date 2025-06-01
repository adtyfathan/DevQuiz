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
        // let countdown;
        let hasAnswered;
        let questionCounter = 0;
        // let questions = [];

        // const containers = {
        //     opening: document.getElementById("opening-container"),
        //     quiz: document.getElementById("quiz-container"),
        //     meme: document.getElementById("meme-container"),
        //     standings: document.getElementById("standings-container"),
        //     result: document.getElementById("result-container")
        // };

        // const timerText = document.getElementById("timer");

        document.addEventListener('livewire:initialized', () => {
            Echo.private('quiz.{{ $quiz->id }}')
                .listen('QuestionBroadcasted', event => {
                    console.log("Event masuk: ", event)
                    handleQuestionEvent(event);
                })
                .listen('StandingsUpdated', event => {
                    console.log("Event masuk: ", event)
                    // if (event.isLast) {
                    //     completeQuiz(event);
                    // } else {
                    //     handleStandingsEvent(event);
                    // }
                });
        });

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
                const timeoutDuration = 15000;
                startTimer(event.questionAt, 15);
                displaySection("quiz", () => renderQuestion(event.question));
                setTimeout(() => {
                    if (!hasAnswered) handlePlayerAnswer(0, null, false);
                }, timeoutDuration);
            }, questionDelay);

            setTimeout(() => {
                startTimer(event.memeAt, 5);
                displaySection("meme", () => {
                    containers.meme.innerHTML = `<p>Ini mim</p>`;
                });
            }, memeDelay);
        }

        function displaySection(sectionName, renderCallback) {
            Object.keys(containers).forEach(name => {
                containers[name].style.display = name === sectionName ? "block" : "none";
            });
            renderCallback();
        }
    </script>
</div>
