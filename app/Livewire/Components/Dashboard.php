<?php

namespace App\Livewire\Components;

use App\Services\Pump;
use App\Traits\HasDatePresets;
use App\Traits\HasIntervals;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Dashboard extends Component
{
    use HasDatePresets;
    use HasIntervals;

    #[Url('start_date')]
    public string $startDate;

    #[Url('end_date')]
    public string $endDate;

    #[Url]
    public string $interval = 'daily';

    public float $actualCosts = 0;

    public float $originalCosts = 0;

    public float $savings = 0;

    public float $pastSavings = 0;

    public array $summary = [];

    public function mount()
    {

        $this->startDate = Carbon::now()->subMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->subDay()->format('Y-m-d');
        $this->dispatch('data-refresh');
    }

    public function render()
    {
        return view('components.dashboard');
    }

    #[Computed]
    public function displayStartDate()
    {
        return Carbon::parse($this->startDate)->format('d M, Y');
    }

    #[Computed]
    public function displayEndDate()
    {
        return Carbon::parse($this->endDate)->format('d M, Y');
    }

    #[On('data-refresh')]
    public function fetchDashboardData()
    {
        $pump = new Pump;

        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);

        $report = $pump->getCostReport($startDate, $endDate);

        $this->originalCosts = Arr::get($report, 'originalCosts', 0);
        $this->savings = Arr::get($report, 'savings', 0);
        $this->actualCosts = Arr::get($report, 'actualCosts', 0);
        $this->pastSavings = Arr::get($report, 'pastSavings', 0);

        $this->setSummary(Arr::get($report, 'costSummary', []));
    }

    public function setSummary($summary)
    {
        $summary = collect($summary)->filter(function ($item) {
            return Arr::get($item, 'account') === '-1';

        })->values();

        $this->summary = $summary->toArray();
    }

    public function setDate()
    {
        $this->dispatch('data-refresh');
    }
}
