<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class PaymentDetails extends Component
{
    public string $paymentInfo = '';

    public string $reference = '';

    public function mount()
    {
        $this->getPaymentInfo();
    }

    public function render()
    {
        return view('pages.payment-details');
    }

    public function getPaymentInfo()
    {
        $docType = 2;

        $message = Cache::remember('payment-info', 60, function () use ($docType) {
            return collect(Http::sage()
                ->get('DocumentMessage/Get')
                ->throw()
                ->collect()
                ->get('Results'))
                ->firstWhere('DocumentTypeId', $docType);
        });

        $this->paymentInfo = Arr::get($message, 'Message');

        $this->reference = auth()->user()->id;

    }
}
