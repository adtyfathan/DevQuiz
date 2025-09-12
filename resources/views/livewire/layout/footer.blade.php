<div class="bg-gray-900 text-white">
    <!-- Main Footer -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            <!-- Logo & Company Info -->
            <div class="flex flex-col justify-between">
                <div>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 mr-3">
                        <h3 class="text-xl font-bold">DevQuiz</h3>
                    </div>
                    <p class="text-gray-300 text-sm mb-4">
                        Your Playground for Knowledge Battles.
                    </p>
                </div>
                <div>
                    <p class="text-gray-400 text-xs mt-4">
                        © {{ date('Y') }} DevQuiz. All rights reserved.
                    </p>
                </div>
            </div>

            <!-- Navigation -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Navigation</h4>
                <div class="grid grid-cols-2 gap-x-6 gap-y-3">
                    <a class="text-gray-300 text-sm hover:text-white transition-colors" href="{{ route('home') }}" wire:navigate>Home</a>
                    <a class="text-gray-300 text-sm hover:text-white transition-colors" href="{{ route('history') }}" wire:navigate>History</a>
                    <a class="text-gray-300 text-sm hover:text-white transition-colors" href="{{ route('tutorial') }}" wire:navigate>Tutorial</a>
                    <a class="text-gray-300 text-sm hover:text-white transition-colors" href="{{ route('about') }}" wire:navigate>About Us</a>
                    <a class="text-gray-300 text-sm hover:text-white transition-colors" href="{{ route('profile') }}" wire:navigate>Profile</a>
                </div>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact</h4>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 text-gray-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-gray-300 text-sm">Purbalingga, Jawa Tengah, Indonesia</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <p class="text-gray-300 text-sm hover:text-white transition-colors">+6289522852832</p>
                    </div>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-gray-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-300 text-sm hover:text-white transition-colors">devquiz@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>