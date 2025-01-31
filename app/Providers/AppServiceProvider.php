<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('sage', function () {
            return Http::withHeaders([
                'Authorization' => 'Basic '.base64_encode(config('services.sageone.username').':'.config('services.sageone.password')),
            ])
                ->baseUrl(config('services.sageone.base_url').'/api/'.config('services.sageone.version'))
                ->withOptions([
                    'query' => [
                        'companyId' => config('services.sageone.company_id'),
                        'apiKey' => config('services.sageone.api_key'),
                    ],
                ]);
        });
    }
}
