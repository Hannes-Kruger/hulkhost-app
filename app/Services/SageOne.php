<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SageOne
{
    protected $client;

    public function __construct()
    {
        $this->client = Http::sage();
    }

    public function createCustomer(array $data)
    {
        return $this->client->post('Customer/Save', $data)->json();
    }

    public function getInvoices()
    {
        $sageId = auth()->user()->currentTeam->sage_id;

        return Cache::remember('invoices:'.$sageId, now()->addHours(2), function () use ($sageId) {

            $response = $this->client
                ->withOptions(['query' => [
                    '$filter' => 'CustomerId eq '.$sageId,
                    'includeCustomerDetails' => 'true',
                ]])
                ->get('TaxInvoice/Get')
                ->json();

            return collect(Arr::get($response, 'Results'));
        });

    }

    public function downloadInvoice($id)
    {
        return $this->client->get('TaxInvoice/Export/'.$id)->body();
    }
}
