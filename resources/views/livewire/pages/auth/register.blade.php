<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen flex justify-center items-center flex-col lg:flex-row">
    <!-- Left side (Image) -->
    <div class="hidden lg:flex lg:w-2/3">
        <img src="{{ asset('images/code.png') }}" alt="Register Illustration" class="w-full h-screen object-cover">
    </div>

    <!-- Right side (Form) -->
    <div class="flex w-full lg:w-1/3 items-center justify-center bg-white p-6 sm:p-10">
        <div class="w-full max-w-md">
            <div class="flex items-center justify-center mb-6 gap-2">
                <img src="{{ asset('images/logo.png') }}" class="h-12 w-12" alt="Logo">
                <h2 class="text-2xl font-bold text-gray-900">DevQuiz</h2>
            </div>

            <form wire:submit="register" class="space-y-6">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                        autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                        required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password"
                        name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input wire:model="password_confirmation" id="password_confirmation"
                        class="block mt-1 w-full" type="password" name="password_confirmation" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Buttons -->
                <div class="flex flex-col items-center gap-6">
                    <x-primary-button class="w-full flex justify-center items-center">
                        {{ __('Register') }}
                    </x-primary-button>

                    <p class="text-center text-sm text-gray-600">
                        {{ __('Already registered?') }}
                        <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline"
                            wire:navigate>
                            {{ __('Log in') }}
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>