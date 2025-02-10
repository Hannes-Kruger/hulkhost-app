<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class Pump
{
    protected $client;

    public function __construct()
    {
        $this->client = Http::pump();
    }

    public function getCostReport(Carbon $startDate, Carbon $endDate)
    {

        return $this->client
            ->withOptions([
                'query' => [
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'group_by' => 'PUMP_SAVINGS',
                    'account_id' => '',
                ],
            ])
            ->get('cost_report_v2')->json();
    }
}
