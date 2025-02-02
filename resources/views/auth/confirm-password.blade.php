<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <flux:heading size="lg">{{ __('Verify your password') }}</flux:heading>
            <flux:subheading>
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </flux:subheading>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <flux:input id="password" label="{{ __('Password') }}" type="password" name="password" required
                    autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <flux:button class="ms-4" variant="primary" type="submit">
                    {{ __('Confirm') }}
                </flux:button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
