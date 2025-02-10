<?php

namespace App\Traits;

use Livewire\Attributes\Computed;

trait HasIntervals
{
    #[Computed]
    public function isDaily(): ?string
    {
        return $this->interval === 'daily' ? 'primary' : null;
    }

    #[Computed]
    public function isWeekly(): ?string
    {
        return $this->interval === 'weekly' ? 'primary' : null;
    }

    #[Computed]
    public function isMonthly(): ?string
    {
        return $this->interval === 'monthly' ? 'primary' : null;
    }

    public function setDaily()
    {
        $this->interval = 'daily';
        $this->dispatch('data-refresh');
    }

    public function setWeekly()
    {
        $this->interval = 'weekly';
        $this->dispatch('data-refresh');
    }

    public function setMonthly()
    {
        $this->interval = 'monthly';
        $this->dispatch('data-refresh');
    }
}
