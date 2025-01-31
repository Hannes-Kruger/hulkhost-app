<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <div>
            <flux:heading size="lg">{{ __('Reset your password') }}</flux:heading>
            <flux:subheading>
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </flux:subheading>
        </div>

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <flux:input id="email" label="{{ __('Email') }}" type="email" name="email"
                            :value="old('email')" autofocus autocomplete="username"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <flux:button type="submit" variant="primary">
                    {{ __('Email Password Reset Link') }}
                </flux:button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
