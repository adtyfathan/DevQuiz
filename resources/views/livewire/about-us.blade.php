<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Welcome to DevQuiz</h3>
                    <p class="text-gray-700 text-lg leading-relaxed mb-4">
                        DevQuiz adalah platform kuis digital berbasis web yang dirancang untuk menghadirkan pengalaman belajar yang interaktif dan menyenangkan.
                        Kami menyediakan fitur pembuatan kuis, pengelolaan soal, serta penilaian otomatis yang dapat disesuaikan dengan kebutuhan pengguna baik individu,
                        institusi pendidikan, hingga perusahaan pelatihan.
                    </p>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Dengan tampilan antarmuka yang bersih, responsif, dan mudah digunakan, DevQuiz mendukung kegiatan belajar mengajar, pengembangan diri, hingga perekrutan karyawan.
                        Baik Anda seorang pelajar, dosen, pelatih, atau profesional HR, platform ini dapat membantu meningkatkan efektivitas evaluasi berbasis kuis di mana saja dan kapan saja.
                    </p>
                </div>
            </div>

            <!-- Technology Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Technology</h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Powered by <span class="font-medium text-gray-900">Laravel, Livewire,</span> and <span class="font-medium text-gray-900">TailwindCSS</span>,
                        our platform is fast, intuitive, and built for the future of learning.
                    </p>
                </div>
            </div>

            <!-- Teams Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Teams</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center">
                        <!-- Team Member 1 -->
                        <div>
                            <img src="/images/amba.jpeg" alt="Fathan" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                            <p class="mt-2 text-lg font-medium text-gray-900">Aditya Fathan Naufaldi</p>
                        </div>

                        <!-- Team Member 2 -->
                        <div>
                            <img src="/images/amba.jpeg" alt="Fikri" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                            <p class="mt-2 text-lg font-medium text-gray-900">Muhammad Fikri Firmansyah</p>
                        </div>

                        <!-- Team Member 3 -->
                        <div>
                            <img src="/images/amba.jpeg" alt="Zaky" class="w-32 h-32 mx-auto rounded-full object-cover shadow-md">
                            <p class="mt-2 text-lg font-medium text-gray-900">Ahmad Zaky</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Get in Touch</h3>
                    <p class="text-gray-700 text-lg mb-4">
                        We'd love to hear from you. Have suggestions, questions, or just want to say hello?
                    </p>
                    <div class="space-y-2">
                        <p class="text-gray-700 text-lg">
                            📧 Email: <a href="devquiz@gmail.com" class="text-blue-600 hover:underline">devquiz@gmail.com</a>
                        </p>
                        <p class="text-gray-700 text-lg">
                            📞 Phone: <span class="text-gray-900 font-medium">+62 812 3456 7890</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>