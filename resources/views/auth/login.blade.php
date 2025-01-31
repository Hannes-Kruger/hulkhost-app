<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <div>
            <flux:heading size="lg">Log in to your account</flux:heading>
        </div>

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <flux:input id="email" label="{{ __('Email') }}" type="email" name="email"
                            :value="old('email')"  autofocus autocomplete="username"/>
            </div>

            <div class="mt-4">
                <flux:input id="password" label="{{ __('Password') }}" type="password"
                            name="password"  autocomplete="current-password"/>
            </div>

            <div class="block mt-4">
                <flux:checkbox id="remember_me" name="remember" label="{{ __('Remember me') }}"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800"
                       href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <flux:button type="submit" variant="primary" class="ms-4">
                    {{ __('Log in') }}
                </flux:button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
