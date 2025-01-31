<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

    <div class="divide-y divide-white/5 w-full ">
        <div class="grid max-w-7xl grid-cols-1 gap-x-8 gap-y-8 px-4 py-16 sm:px-6 md:grid-cols-3 lg:px-8">
            <div>
                <p class="mt-1 text-sm/6 text-gray-400">Use the following banking details to make monthly payments to us.</p>
            </div>
            <div class="md:col-span-2">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:max-w-xl sm:grid-cols-6">

                    <div class="col-span-full">
                        <flux:input label="Payment Reference" description="Always use this reference when making a payment" copyable readonly value="{{ $reference }}" />
                    </div>

                    <div class="col-span-full">
                        <flux:textarea label="Banking Details" rows="auto" readonly resize="none">
                            {{ $paymentInfo }}
                        </flux:textarea>
                    </div>

                </div>

                <div class="mt-8 flex justify-end">
                    <flux:button icon="arrow-down-tray">
                        {{ __('Download Proof of Account') }}
                    </flux:button>
                </div>
            </div>

        </div>
    </div>
</div>