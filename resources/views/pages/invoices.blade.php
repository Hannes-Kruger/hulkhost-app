<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <div class="flex mx-auto">
        <div>
            <flux:heading size="xl" level="1">{{ __('Invoices') }}</flux:heading>
            @if (data_get($this->invoices->first(), 'Customer.Balance'))
                <flux:subheading size="lg" class="mb-6">
                    {{ __('Your current account balance is') }}
                    <flux:badge color="sky">
                        R {{ number_format(data_get($this->invoices->first(), 'Customer.Balance'), 2) }}</flux:badge>
                </flux:subheading>
            @else
                <flux:subheading size="lg" class="mb-6">{{ __('You have no outstanding invoices.') }}
                </flux:subheading>
            @endif
        </div>

        <flux:spacer />

        <flux:button variant="primary" href="{{ route('payment-details') }}" wire:navigate>
            {{ __('Payment Instructions') }}</flux:button>
    </div>
    <flux:separator variant="subtle" />
    <flux:table>
        <flux:columns>
            <flux:column sortable :sorted="$sortBy === 'DocumentNumber'" :direction="$sortDirection"
                wire:click="sort('DocumentNumber')">{{ __('ID') }}
            </flux:column>
            <flux:column sortable :sorted="$sortBy === 'Created'" :direction="$sortDirection"
                wire:click="sort('Created')">
                {{ __('Created') }}
            </flux:column>
            <flux:column sortable :sorted="$sortBy === 'DueDate'" :direction="$sortDirection"
                wire:click="sort('DueDate')">
                {{ __('Due Date') }}
            </flux:column>
            <flux:column sortable :sorted="$sortBy === 'Status'" :direction="$sortDirection"
                wire:click="sort('Status')">{{ __('Status') }}
            </flux:column>
            <flux:column sortable :sorted="$sortBy === 'Total'" :direction="$sortDirection"
                wire:click="sort('Total')">{{ __('Amount') }}
            </flux:column>
            <flux:column></flux:column>
        </flux:columns>

        <flux:rows>

            @foreach ($this->invoices as $invoice)
                <flux:row class="hover:dark:bg-black/20 hover:bg-gray-200">
                    <flux:cell class="font-semibold">{{ data_get($invoice, 'DocumentNumber') }}</flux:cell>
                    <flux:cell>{{ data_get($invoice, 'Created')->format('d M Y') }}</flux:cell>
                    <flux:cell>{{ data_get($invoice, 'DueDate')->format('d M Y') }}</flux:cell>
                    <flux:cell>
                        <flux:badge color="{{ data_get($invoice, 'BadgeColor') }}" size="sm" inset="top bottom">
                            {{ data_get($invoice, 'Status') }}</flux:badge>
                    </flux:cell>
                    <flux:cell variant="strong">R {{ number_format(data_get($invoice, 'Total'), 2) }}</flux:cell>
                    <flux:cell class="text-right">
                        <flux:button icon="arrow-down-tray" size="sm"
                            wire:click="downloadInvoice('{{ data_get($invoice, 'ID') }}')" />
                    </flux:cell>
                </flux:row>
            @endforeach

            @if ($this->invoices->isEmpty())
                <flux:row>
                    <flux:cell colspan="6" class="text-center">{{ __('This account has no invoices yet.') }}
                    </flux:cell>
                </flux:row>
            @endif
        </flux:rows>
    </flux:table>

</div>
