<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <div class="flex mx-auto">
        <div>
            <flux:heading size="xl" level="1">{{ __('Invoices') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Your current account balance is :amount', ['amount' => 3]) }}
            </flux:subheading>
        </div>

        <flux:spacer/>

        <flux:button variant="primary" href="{{ route('payment-details') }}" wire:navigate>{{ __('Payment Instructions') }}</flux:button>

    </div>
    <flux:separator variant="subtle"/>


    <flux:table :paginate="$this->invoices">
        <flux:columns>
            <flux:column>ID</flux:column>
            <flux:column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection" wire:click="sort('name')">
                Date
            </flux:column>
            <flux:column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection"
                         wire:click="sort('status')">Status
            </flux:column>
            <flux:column sortable :sorted="$sortBy === 'amount'" :direction="$sortDirection"
                         wire:click="sort('amount')">Amount
            </flux:column>
        </flux:columns>

        <flux:rows>
            {{--            @foreach ($this->orders as $order)--}}
            {{--                <flux:row :key="$order->id">--}}
            {{--                    <flux:cell class="flex items-center gap-3">--}}
            {{--                        <flux:avatar size="xs" src="{{ $order->customer_avatar }}" />--}}

            {{--                        {{ $order->customer }}--}}
            {{--                    </flux:cell>--}}

            {{--                    <flux:cell class="whitespace-nowrap">{{ $order->date }}</flux:cell>--}}

            {{--                    <flux:cell>--}}
            {{--                        <flux:badge size="sm" :color="$order->status_color" inset="top bottom">{{ $order->status }}</flux:badge>--}}
            {{--                    </flux:cell>--}}

            {{--                    <flux:cell variant="strong">{{ $order->amount }}</flux:cell>--}}

            {{--                    <flux:cell>--}}
            {{--                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>--}}
            {{--                    </flux:cell>--}}
            {{--                </flux:row>--}}
            {{--            @endforeach--}}
        </flux:rows>
    </flux:table>

</div>