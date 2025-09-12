<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen flex justify-center items-center flex-col lg:flex-row">
    <!-- Left side (Image) -->
    <div class="hidden lg:flex lg:w-2/3">
        <img src="{{ asset('images/code.png') }}" alt="Login Illustration" class="w-full h-screen object-cover">
    </div>

    <!-- Right side (Form) -->
    <div class="flex w-full lg:w-1/3 items-center justify-center bg-white p-6 sm:p-10">
        <div class="w-full max-w-md">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="flex items-center justify-center mb-6 gap-2">
                <img src="{{ asset('images/logo.png') }}" class="h-12 w-12" alt="Logo">
                <h2 class="text-2xl font-bold text-gray-900">DevQuiz</h2>
            </div>
            

            <form wire:submit="login" class="space-y-6">
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                        required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <label for="remember" class="ml-2 text-sm text-gray-600">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col items-center gap-6">
                    <x-primary-button class="w-full flex justify-center items-center">
                        {{ __('Log in') }}
                    </x-primary-button>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-600 hover:text-indigo-600" href="{{ route('password.request') }}"
                            wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Register -->
                <p class="text-center text-sm text-gray-600">
                    {{ __("Don't have an account?") }}
                    <a href="{{ route('register', absolute: false) }}"
                        class="text-indigo-600 font-medium hover:underline" wire:navigate>
                        {{ __('Register') }}
                    </a>
                </p>
            </form>
        </div>
    </div>
</div>