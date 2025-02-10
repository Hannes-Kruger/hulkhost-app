<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;

trait HasDatePresets
{
    #[Computed]
    public function is1m(): bool
    {
        return Carbon::parse($this->startDate)->isSameDay(Carbon::now()->subMonth()) && Carbon::parse($this->endDate)->isSameDay(Carbon::now()->subDay());
    }

    #[Computed]
    public function is3m(): bool
    {
        return Carbon::parse($this->startDate)->isSameDay(Carbon::now()->subMonths(3)) && Carbon::parse($this->endDate)->isSameDay(Carbon::now()->subDay());
    }

    #[Computed]
    public function is6m(): bool
    {
        return Carbon::parse($this->startDate)->isSameDay(Carbon::now()->subMonths(6)) && Carbon::parse($this->endDate)->isSameDay(Carbon::now()->subDay());
    }

    #[Computed]
    public function is1y(): bool
    {
        return Carbon::parse($this->startDate)->isSameDay(Carbon::now()->subYear()) && Carbon::parse($this->endDate)->isSameDay(Carbon::now()->subDay());
    }

    public function returnDatePreset($preset)
    {
        return match ($preset) {
            '1m' => $this->is1m() ? 'primary' : null,
            '3m' => $this->is3m() ? 'primary' : null,
            '6m' => $this->is6m() ? 'primary' : null,
            '1y' => $this->is1y() ? 'primary' : null,
            default => null,
        };
    }

    public function selectDateFromPreset($preset)
    {
        $this->startDate = match ($preset) {
            '1m' => Carbon::now()->subMonth()->startOfDay()->format('Y-m-d'),
            '3m' => Carbon::now()->subMonths(3)->startOfDay()->format('Y-m-d'),
            '6m' => Carbon::now()->subMonths(6)->startOfDay()->format('Y-m-d'),
            '1y' => Carbon::now()->subYear()->startOfDay()->format('Y-m-d'),
            default => Carbon::now()->subMonth()->startOfDay()->format('Y-m-d'),
        };

        $this->endDate = Carbon::now()->subDay()->endOfDay()->format('Y-m-d');

        $this->dispatch('data-refresh');
    }
}
