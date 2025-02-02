<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Pump
{
    protected $client;

    public function __construct()
    {
        $this->client = Http::pump();
    }

    public function getCostReport()
    {

        return $this->client
            ->withOptions([
                'query' => [
                    'start_date' => '2025-01-01',
                    'end_date' => '2025-01-31',
                    'group_by' => 'PUMP_SAVINGS',
                    'account_id' => '',
                ],
            ])
            ->get('cost_report_v2')->json();
    }
}
