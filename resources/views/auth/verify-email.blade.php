<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <div>
            <flux:heading size="lg">{{ __('Verify your email') }}</flux:heading>
            <flux:subheading>{{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</flux:subheading>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <flux:button type="submit" type="submit" variant="primary">
                        {{ __('Resend Verification Email') }}
                    </flux:button>
                </div>
            </form>

            <div>

                <flux:button wire:navigate variant="ghost"
                             href="{{ route('profile.show') }}">{{ __('Edit Profile') }}</flux:button>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <flux:button variant="ghost" type="submit">
                        {{ __('Log Out') }}
                    </flux:button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
