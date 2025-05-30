<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                        onclick="this.parentElement.remove()">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                        </svg>
                    </button>
                </div>
            @endif
    
            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                        onclick="this.parentElement.remove()">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 5.652a1 1 0 00-1.414 0L10 8.586 7.066 5.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 11.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934a1 1 0 000-1.414z" />
                        </svg>
                    </button>
                </div>
            @endif
    
            <!-- Multiplayer Section -->
            <div class="mb-12 flex justify-center">
                <div
                    class="overflow-hidden bg-gradient-to-br from-blue-50 to-purple-50 shadow-xl sm:rounded-2xl border border-blue-100 w-fit">
                    <div class="p-6 sm:p-8 lg:p-10">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                                DevQ
                            </h2>
                        </div>
    
                        <div class="w-96 space-y-6">
                            <!-- Error Message -->
                            <div id="error-message"
                                class="hidden bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                            </div>
    
                            <!-- Username Input -->
                            <div class="space-y-2">
                                <label for="lobby-username" class="block text-sm font-semibold text-gray-700">
                                    Username
                                </label>
                                <div class="relative">
                                    <input type="text" id="lobby-username"
                                        class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-900 placeholder-gray-500"
                                        placeholder="Enter your username" maxlength="20" />
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Lobby ID OTP Input -->
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Lobby Code
                                </label>
                                <div class="flex justify-between space-x-2" id="lobby-otp-container">
                                    <input type="text" maxlength="1"
                                        class="otp-input w-12 h-12 text-center text-lg font-bold bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        data-index="0" />
                                    <input type="text" maxlength="1"
                                        class="otp-input w-12 h-12 text-center text-lg font-bold bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        data-index="1" />
                                    <input type="text" maxlength="1"
                                        class="otp-input w-12 h-12 text-center text-lg font-bold bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        data-index="2" />
                                    <input type="text" maxlength="1"
                                        class="otp-input w-12 h-12 text-center text-lg font-bold bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        data-index="3" />
                                    <input type="text" maxlength="1"
                                        class="otp-input w-12 h-12 text-center text-lg font-bold bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        data-index="4" />
                                    <input type="text" maxlength="1"
                                        class="otp-input w-12 h-12 text-center text-lg font-bold bg-white border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                        data-index="5" />
                                </div>
                            </div>
    
                            <!-- Join Button -->
                            <button id="join-lobby-btn"
                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg focus:ring-4 focus:ring-blue-200 focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                disabled>
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span>Join Lobby</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Quiz Categories Section -->
            <div class="overflow-hidden bg-white shadow-lg sm:rounded-xl">
                <div class="p-4 sm:p-6 lg:p-8">
                    <div class="mb-8">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                            Start a Quiz
                        </h1>
                        <p class="text-gray-600 text-sm sm:text-base">
                            Choose your favorite topic and test your knowledge
                        </p>
                        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mt-4 rounded-full"></div>
                    </div>
    
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">
                        <livewire:quiz.quiz-card category="Code" img="code.jpg" />
                        <livewire:quiz.quiz-card category="VueJS" img="vue.png" />
                        <livewire:quiz.quiz-card category="NodeJS" img="node.png" />
                        <livewire:quiz.quiz-card category="Linux" img="linux.png" />
                        <livewire:quiz.quiz-card category="cPanel" img="cpanel.png" />
                        <livewire:quiz.quiz-card category="Django" img="django.png" />
                        <livewire:quiz.quiz-card category="Postgres" img="postgres.png" />
                        <livewire:quiz.quiz-card category="React" img="react.png" />
                        <livewire:quiz.quiz-card category="Next.js" img="next.png" />
                        <livewire:quiz.quiz-card category="DevOps" img="devops.png" />
                        <livewire:quiz.quiz-card category="SQL" img="sql.png" />
                        <livewire:quiz.quiz-card category="Apache Kafka" img="apache_kafka.png" />
                        <livewire:quiz.quiz-card category="Wordpress" img="wordpress.png" />
                        <livewire:quiz.quiz-card category="Bash" img="bash.png" />
                        <livewire:quiz.quiz-card category="Docker" img="docker.png" />
                        <livewire:quiz.quiz-card category="Laravel" img="laravel.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const otpInputs = document.querySelectorAll('.otp-input');
            const usernameInput = document.getElementById('lobby-username');
            const joinButton = document.getElementById('join-lobby-btn');
            const errorMessage = document.getElementById('error-message');

            // OTP Input Logic
            otpInputs.forEach((input, index) => {
                input.addEventListener('input', function (e) {
                    const value = e.target.value;

                    // Only allow numbers
                    if (!/^\d*$/.test(value)) {
                        e.target.value = '';
                        return;
                    }

                    // Move to next input if value is entered
                    if (value && index < otpInputs.length - 1) {
                        otpInputs[index + 1].focus();
                    }

                    checkFormValid();
                });

                input.addEventListener('keydown', function (e) {
                    // Move to previous input on backspace if current input is empty
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });

                input.addEventListener('paste', function (e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);

                    pastedData.split('').forEach((digit, i) => {
                        if (i < otpInputs.length) {
                            otpInputs[i].value = digit;
                        }
                    });

                    if (pastedData.length > 0) {
                        const lastIndex = Math.min(pastedData.length - 1, otpInputs.length - 1);
                        otpInputs[lastIndex].focus();
                    }

                    checkFormValid();
                });
            });

            // Username input validation
            usernameInput.addEventListener('input', checkFormValid);

            function checkFormValid() {
                const username = usernameInput.value.trim();
                const lobbyId = Array.from(otpInputs).map(input => input.value).join('');

                const isValid = username.length >= 2 && lobbyId.length === 6;
                joinButton.disabled = !isValid;
            }

            // Join button click handler
            joinButton.addEventListener('click', function () {
                const username = usernameInput.value.trim();
                const lobbyId = Array.from(otpInputs).map(input => input.value).join('');

                if (username.length < 2) {
                    showError('Username must be at least 2 characters long');
                    return;
                }

                if (lobbyId.length !== 6) {
                    showError('Please enter a complete 6-digit lobby ID');
                    return;
                }

                hideError();

                console.log('Joining lobby:', { username, lobbyId });

                const url = `quiz/multiplayer/player/lobby/${lobbyId}`;
                Livewire.navigate(url);
            });

            function showError(message) {
                errorMessage.textContent = message;
                errorMessage.classList.remove('hidden');
            }

            function hideError() {
                errorMessage.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>