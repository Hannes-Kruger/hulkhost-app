<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }">
            <flux:heading>{{ __('Two Factor Challenge') }}</flux:heading>

            <flux:subheading x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </flux:subheading>
            <flux:subheading x-cloak x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </flux:subheading>

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <flux:input id="code" label="{{ __('Code') }}" type="text" inputmode="numeric"
                        name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-cloak x-show="recovery">
                    <flux:input id="recovery_code" label="{{ __('Recovery Code') }}" class="block mt-1 w-full"
                        type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <flux:button variant="ghost" x-show="! recovery"
                        x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                    </flux:button>

                    <flux:button variant="ghost" x-cloak x-show="recovery"
                        x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </flux:button>

                    <flux:button variant="primary" type="submit" class="ms-4">
                        {{ __('Log in') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
