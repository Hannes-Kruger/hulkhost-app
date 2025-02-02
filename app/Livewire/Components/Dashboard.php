<?php

namespace App\Livewire\Components;

use Illuminate\Support\Carbon;
use Livewire\Component;

class Dashboard extends Component
{

    public Carbon $startDate;
    public Carbon $endDate;


    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth();
        $this->endDate = Carbon::now()->endOfMonth();
    }

    public function render()
    {
        return view('components.dashboard');
    }
}
