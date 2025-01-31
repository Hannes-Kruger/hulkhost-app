<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <x-form-section submit="saveChanges">
        <x-slot name="title">
            {{ __('Payment Instructions') }}
        </x-slot>

        <x-slot name="description">
            {{ __('We currently only accept EFT payments. Please ensure you use the payment reference provided for all payments.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <flux:input label="{{ __('Payment Reference') }}"
                            description="{{ __('Always use this reference when making a payment') }}" copyable readonly
                            value="{{ $reference }}"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <flux:textarea label="Banking Details" rows="auto" readonly resize="none">
                    {{ $paymentInfo }}
                </flux:textarea>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-button>
                {{ __('Download Proof of Account') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
