<div>
    <x-form-section submit="saveChanges">
        <x-slot name="title">
            {{ __('Complete Your Profile') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Please complete your profile setup to access all features.') }}
        </x-slot>

        <x-slot name="form">
            @csrf

            <div class="col-span-6 sm:col-span-4">
                <flux:input label="{{ __('Company Name') }}" name="companyName" id="company_name"
                            description="{{ __('This should match the name of your company as registered with CIPC.') }}"
                            wire:model="companyName"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <flux:input label="{{ __('VAT Number') }}" name="vatNumber" id="vat_number"
                            description="{{ __('We may contact you to verify this number.') }}"
                            wire:model="vatNumber" mask="9999999999"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <flux:field>
                    <flux:label>Invoice Email Addresses</flux:label>

                    <flux:description>
                        Add upto 5 email addresses that should receive invoices.
                    </flux:description>

                    <flux:input.group>
                        <flux:card
                                class="px-2 py-1 rounded-none rounded-b-sm rounded-t-sm rounded-tr-none rounded-br-none mx-auto min-h-10 w-full">
                            @foreach($emails as $email)
                                <flux:badge size="sm" class="my-0.5 mx-auto">
                                    {{ $email }}
                                    <flux:badge.close wire:click="removeEmail('{{ $email }}')"/>
                                </flux:badge>
                            @endforeach

                        </flux:card>
                        <flux:modal.trigger name="add-invoice-email">
                            <flux:button icon="plus" class="border-l-0 flex-grow h-auto"
                                         :disabled="!$allowMoreEmails"/>
                        </flux:modal.trigger>
                    </flux:input.group>
                    <flux:error name="emails"/>
                </flux:field>
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-button type="submit">
                {{ __('Create') }}
            </x-button>
        </x-slot>
    </x-form-section>
    <flux:modal name="add-invoice-email" class="md:w-96 space-y-6">
        <div>
            <flux:heading size="lg">
                Add Invoice Email
            </flux:heading>
            <flux:subheading>
                Add an email address that should receive invoices.
            </flux:subheading>
        </div>
        <form wire:submit="addEmail" class="space-y-6">

            <flux:input label="Email Address" wire:model="newEmail"/>
            <div class="flex">
                <flux:spacer/>

                <flux:button variant="primary" type="submit">Add</flux:button>
            </div>
        </form>

    </flux:modal>
</div>