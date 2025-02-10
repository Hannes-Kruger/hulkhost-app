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

                <flux:dropdown offset="-15">
                    <flux:button size="sm" class="w-1/2 sm:w-auto">
                        {{ $this->displayStartDate }} -
                        {{ $this->displayEndDate }}</flux:button>

                    <flux:menu class="w-64 space-y-2">
                        <flux:input size="sm" type="date" placeholder="DD-MM-YYYY" wire:model="startDate">
                        </flux:input>
                        <flux:separator text="to" />
                        <flux:input size="sm" type="date" placeholder="DD-MM-YYYY" wire:model="endDate">
                        </flux:input>
                        <div class="flex justify-end">
                            <flux:button size="sm" variant="primary" wire:click="setDate()">Apply</flux:button>
                        </div>
                    </flux:menu>
                </flux:dropdown>
            </div>

            {{--      --}}
            <div class="flex justify-center sm:justify-start space-x-3">
                <flux:button.group>
                    <flux:button size="sm" :variant="$this->returnDatePreset('1m')"
                        wire:click="selectDateFromPreset('1m')">
                        1M
                    </flux:button>
                    <flux:button size="sm" :variant="$this->returnDatePreset('3m')"
                        wire:click="selectDateFromPreset('3m')">
                        3M
                    </flux:button>
                    <flux:button size="sm" :variant="$this->returnDatePreset('6m')"
                        wire:click="selectDateFromPreset('6m')">
                        6M
                    </flux:button>
                    <flux:button size="sm" :variant="$this->returnDatePreset('1y')"
                        wire:click="selectDateFromPreset('1y')">
                        1Y
                    </flux:button>
                </flux:button.group>
                {{--                <flux:button.group> --}}
                {{--                    <flux:button size="sm" :variant="$this->isDaily()" wire:click="setDaily()">D</flux:button> --}}
                {{--                    <flux:button size="sm" :variant="$this->isWeekly()" wire:click="setWeekly()">W</flux:button> --}}
                {{--                    <flux:button size="sm" :variant="$this->isMonthly()" wire:click="setMonthly()">M</flux:button> --}}
                {{--                </flux:button.group> --}}
            </div>
        </div>

        {{--        <div class="flex justify-center sm:justify-end space-x-2"> --}}

        {{--        </div> --}}
    </div>

    <div class="grid gap-6 md:grid-cols-12 mb-6">
        <div class="space-y-6 md:col-span-9">
            <flux:card>
                <flux:table>
                    <flux:columns>
                        <flux:column>Groups</flux:column>
                        <flux:column>Original Costs</flux:column>
                        <flux:column>Cloudsave Savings</flux:column>
                        <flux:column>Actual Costs</flux:column>
                    </flux:columns>

                    <flux:rows>
                        @foreach ($this->summary as $row)
                            <flux:row>
                                <flux:cell>{{ data_get($row, 'group') }}</flux:cell>

                                <flux:cell>
                                    $
                                    {{ number_format(abs(data_get($row, 'pump_sp_saving')) + data_get($row, 'cost', 0), 2) }}
                                </flux:cell>

                                <flux:cell
                                    class="font-semibold {{ abs(data_get($row, 'pump_sp_saving')) > 0 ? 'text-green-500 dark:text-lime-600' : '' }}">
                                    $ {{ number_format(data_get($row, 'pump_sp_saving'), 2) }}

                                    @php
                                        $pumpSpSaving = abs(data_get($row, 'pump_sp_saving'));
                                        $cost = data_get($row, 'cost', 0);
                                        $total = $pumpSpSaving + $cost; // Total cost includes both savings and cost

                                        // Correct percentage calculation
                                        $percentage = $total != 0 ? number_format(($pumpSpSaving / $total) * 100, 2) : 0;
                                    @endphp

                                    @if ($pumpSpSaving > 0)
                                        <flux:badge size="sm" color="lime">
                                            {{ $percentage }}%
                                        </flux:badge>
                                    @endif
                                </flux:cell>

                                <flux:cell class="font-semibold">
                                    $ {{ number_format($cost, 2) }}
                                </flux:cell>
                            </flux:row>
                        @endforeach
                    </flux:rows>
                </flux:table>
            </flux:card>
        </div>
        <div class="space-y-6 md:col-span-3">
            <flux:card class="space-y-2">
                <flux:heading size="lg" level="2">Total Savings</flux::heading>
                    <flux:heading size="xl" level="3" class="font-semibold">
                        $ {{ number_format(-abs($this->savings), 2) }}</flux::heading>
            </flux:card>
            <flux:card class="space-y-3 text-sm">
                <div class="flex items-center justify-between">
                    <p>Original Costs</p>
                    <p class="font-semibold">$ {{ number_format($this->originalCosts, 2) }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>Past Savings</p>
                    <p class="font-semibold">$ {{ number_format($this->pastSavings, 2) }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p>CloudSave Savings</p>
                    <p class="text-green-500 dark:text-lime-600 font-semibold">
                        $ {{ number_format(-abs($this->savings), 2) }}</p>
                </div>

                <flux:separator variant="subtle" class="my-1" />
                <div class="flex items-center justify-between">
                    <p>Actual Costs</p>
                    <p class="font-semibold">$ {{ number_format($this->actualCosts, 2) }}</p>
                </div>
            </flux:card>
        </div>
    </div>
</div>
