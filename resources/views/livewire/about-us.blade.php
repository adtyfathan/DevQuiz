<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 space-y-6">

            <!-- Welcome Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h3 class="text-2xl font-bold text-blue-600 mb-4">Welcome to DevQuiz</h3>
                    <p class="text-gray-700 text-lg leading-relaxed mb-4">
                        DevQuiz is a web-based digital quiz platform designed to provide an interactive and enjoyable learning experience. We
                        offer features for creating quizzes, managing questions, and automatic grading that can be tailored to the needs of
                        individuals, educational institutions, and training companies.
                    </p>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        With a clean, responsive, and user-friendly interface, DevQuiz supports teaching and learning activities, personal
                        development, and even employee recruitment. Whether you are a student, lecturer, trainer, or HR professional, this
                        platform can help enhance the effectiveness of quiz-based evaluations anytime and anywhere.
                    </p>
                </div>
            </div>
            
            <!-- Technology Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h3 class="text-2xl font-bold text-blue-600 mb-4">Our Technology</h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Powered by <span class="font-medium text-gray-900">Laravel, Livewire,</span> and <span
                            class="font-medium text-gray-900">TailwindCSS</span>,
                        our platform is fast, intuitive, and built for the future of learning.
                    </p>
                </div>
            </div>
            
            <!-- Teams Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h3 class="text-2xl font-bold text-blue-600 mb-4">Our Teams</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                        <!-- Team Member 1 -->
                        <div>
                            <img src="{{ asset('images/fathan.jpg') }}" alt="Fathan"
                                class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                            <p class="mt-2 text-lg font-medium text-gray-900">Aditya Fathan Naufaldi</p>
                        </div>
            
                        <!-- Team Member 2 -->
                        <div>
                            <img src="{{ asset('images/fikri.jpg') }}" alt="Fikri"
                                class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                            <p class="mt-2 text-lg font-medium text-gray-900">Muhammad Fikri Firmansyah</p>
                        </div>
            
                        <!-- Team Member 3 -->
                        <div>
                            <img src="{{ asset('images/zaky.jpg') }}" alt="Zaky"
                                class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                            <p class="mt-2 text-lg font-medium text-gray-900">Ahmad Zaky</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h3 class="text-2xl font-bold text-blue-600 mb-4">Get in Touch</h3>
                    <p class="text-gray-700 text-lg mb-4">
                        We'd love to hear from you. Have suggestions, questions, or just want to say hello?
                    </p>
                    <div class="space-y-2">
                        <p class="text-gray-700 text-lg">
                            📧 Email: <span class="text-blue-600 hover:underline">devquiz@gmail.com</span>
                        </p>
                        <p class="text-gray-700 text-lg">
                            📞 Phone: <span class="text-gray-900 font-medium">+6289522852832</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>