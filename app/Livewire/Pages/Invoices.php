<?php

namespace App\Livewire\Pages;

use App\Services\SageOne;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Invoices extends Component
{
    use WithPagination;

    #[Url]
    public $sortBy = 'DocumentNumber';

    #[Url]
    public $sortDirection = 'asc';

    public string $total = '';

    #[Computed]
    public function invoices()
    {
        $sage = new SageOne;

        $invoices = $sage->getInvoices();

        $invoices->transform(function ($invoice) {
            $invoice['DueDate'] = Carbon::parse($invoice['DueDate']);
            $invoice['Created'] = Carbon::parse($invoice['Created']);

            $invoice['BadgeColor'] = $invoice['Status'] === 'Paid' ? 'green' : ($invoice['Status'] === 'Overdue' ? 'red' : 'yellow');

            return $invoice;
        });

        $balance = Arr::get($invoices->first(), 'Customer.Balance');

        if ($balance) {
            $this->total = number_format($balance, 2);
        }

        return $invoices->sortBy($this->sortBy, SORT_REGULAR, $this->sortDirection === 'desc');

    }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function downloadInvoice($id)
    {
        $sage = new SageOne;

        $pdf = $sage->downloadInvoice($id);

        $documentNumber = $this->invoices->firstWhere('ID', $id)['DocumentNumber'];

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, 'Invoice-'.$documentNumber.'.pdf');
    }

    public function render()
    {
        return view('pages.invoices');
    }
}
