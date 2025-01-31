<?php

namespace App\Services;

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
}
