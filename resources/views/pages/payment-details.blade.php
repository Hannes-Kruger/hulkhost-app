<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <x-form-section submit="saveChanges">
        <x-slot name="title">
            {{ __('Complete Your Profile') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Please complete your profile setup to access all features.') }}
        </x-slot>

        <x-slot name="form">


        </x-slot>

        <x-slot name="actions">
            <x-button type="submit">
                {{ __('Create') }}
            </x-button>
        </x-slot>
    </x-form-section>

</div>
