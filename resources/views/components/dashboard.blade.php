<div>

    <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 gap-2">
            <div class="flex w-full sm:w-auto space-x-4">
                <flux:select variant="listbox" size="sm" placeholder="Choose AWS Account" class="w-1/2 sm:w-auto">
                    <flux:option>Photography</flux:option>
                    <flux:option>Design services</flux:option>
                    <flux:option>Web development</flux:option>
                    <flux:option>Accounting</flux:option>
                    <flux:option>Legal services</flux:option>
                    <flux:option>Consulting</flux:option>
                    <flux:option>Other</flux:option>
                </flux:select>

                <flux:button size="sm" class="w-1/2 sm:w-auto">{{ $this->startDate->format('M d, Y') }} - {{ $this->endDate->format('M d, Y') }}</flux:button>
            </div>

            <!-- Button Group D/W/M -->
            <div class="flex justify-center sm:justify-start space-x-3">
                <flux:button.group>
                    <flux:button size="sm">D</flux:button>
                    <flux:button size="sm">W</flux:button>
                    <flux:button size="sm">M</flux:button>
                </flux:button.group>
            </div>
        </div>

        <!-- Button Group 1M/3M/6M/1Y -->
        <div class="flex justify-center sm:justify-end space-x-2">
            <flux:button.group>
                <flux:button size="sm">1M</flux:button>
                <flux:button size="sm">3M</flux:button>
                <flux:button size="sm">6M</flux:button>
                <flux:button size="sm">1Y</flux:button>
            </flux:button.group>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-12 mb-6">
        <div class="space-y-6 md:col-span-8">
            <flux:card>
                // Graph
            </flux:card>
        </div>
        <div class="space-y-6 md:col-span-4">
            <flux:card class="space-y-2">
                <flux:heading size="lg" level="2">Savings Achieved</flux::heading>
                <flux:heading size="xl" level="3">$ 0.00</flux::heading>
            </flux:card>
            <flux:card class="space-y-3 text-sm">
                <div class="flex items-center justify-between">
                    <p>Original Costs</p>
                    <p>$ 0.00</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>Past Savings</p>
                    <p>$ 0.00</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>CloudSave Savings</p>
                    <p>$ 0.00</p>
                </div>

                <flux:separator variant="subtle" class="my-1" />
                <div class="flex items-center justify-between">
                    <p>Actual Costs</p>
                    <p>$ 0.00</p>
                </div>
            </flux:card>
        </div>
    </div>
    <flux:card>
        // Savings Table
    </flux:card>

</div>
