<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <flux:input id="current_password" name="current_password" label="{{ __('Current Password') }}" type="password"
                wire:model="state.current_password" autocomplete="current-password" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <flux:input id="password" name="password" label="{{ __('New Password') }}" type="password"
                wire:model="state.password" autocomplete="new-password" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <flux:input id="password_confirmation" name="password_confirmation" label="{{ __('Confirm Password') }}"
                type="password" wire:model="state.password_confirmation" autocomplete="new-password" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button type="submit">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
