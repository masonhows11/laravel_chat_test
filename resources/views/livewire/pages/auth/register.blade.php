<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="d-flex justify-content-center">

    <form wire:submit="register">
        <!-- Name -->
        <div>
            <label ffor="name"  class="form-label">Name</label>
            <input twire:model="name" id="name" class="mt-1 form-control" type="text" name="name"  autofocus autocomplete="name">
            @error('name') <span class="is-invalid text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="form-label">Email</label>
            <input wire:model="email" id="email" class="mt-1 form-control" type="email" name="email"  autocomplete="username" />
            @error('email') <span class="is-invalid text-danger">{{ $message }}</span> @enderror

        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="form-label">Password</label>
            <input wire:model="password" id="password" class="form-control"
                            type="password"
                            name="password"
                            autocomplete="new-password" />
            @error('password') <span class="is-invalid text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">Confirm Password</label>

            <input wire:model="password_confirmation" id="password_confirmation" class="form-control mt-1 "
                            type="password"
                            name="password_confirmation" autocomplete="new-password" />
            @error('password_confirmation') <span class="is-invalid text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="d-flex align-items-center justify-items-end mt-4">
            <a class="text-sm " href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
