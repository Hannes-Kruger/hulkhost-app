<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <flux:heading size="lg">{{ __('Reset your password') }}</flux:heading>
            <flux:subheading>
                {{ __('Use the form below to set a new password.') }}
            </flux:subheading>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <flux:input id="email" label="{{ __('Email') }}" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <flux:input id="password" label="{{ __('Password') }}" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <flux:input id="password_confirmation" label="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <flux:button type="submit" variant="primary">
                    {{ __('Reset Password') }}
                </flux:button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
