<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
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
        // $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="d-flex justify-content-center">

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form wire:submit="login">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email"  class="form-label">Email address</label>
            <input type="email" class="form-control" wire:model="form.email" id="email"  autocomplete="username">
            @error('form.email') <span class="is-invalid text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input wire:model="form.password" id="password" type="password" class="form-control"  >
            @error('form.password') <span class="is-invalid text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check">
            <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <label class="form-check-label" for="remember">
                <span class="ms-2 ">{{ __('Remember me') }}</span>
            </label>
        </div>


        <div class="flex mt-4">
            @if (Route::has('password.request'))
                <a class="text-sm " href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in Fucker') }}
            </x-primary-button>
        </div>
    </form>
</div>
