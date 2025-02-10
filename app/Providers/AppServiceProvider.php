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

        Http::macro('pump', function () {

            $token = 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6Im1xN2IzTjdfRDhkVGVCRTliVklQWCJ9.eyJodHRwczovL3B1bXAuY28vZW1haWwiOiJoYW5uZXNAYnVsa2hvc3QuY28uemEiLCJodHRwczovL3B1bXAuY28vbmFtZSI6Imhhbm5lc0BidWxraG9zdC5jby56YSIsImh0dHBzOi8vcHVtcC5jby9uaWNrbmFtZSI6Imhhbm5lcyIsImh0dHBzOi8vcHVtcC5jby9waWN0dXJlIjoiaHR0cHM6Ly9zLmdyYXZhdGFyLmNvbS9hdmF0YXIvOWQyYTRmOGQwZDM4YzYzNDE1Y2ViZjdiNTc3Y2ZkZTY_cz00ODAmcj1wZyZkPWh0dHBzJTNBJTJGJTJGY2RuLmF1dGgwLmNvbSUyRmF2YXRhcnMlMkZoYS5wbmciLCJodHRwczovL3B1bXAuY28vZW1haWxfdmVyaWZpZWQiOnRydWUsImlzcyI6Imh0dHBzOi8vYXV0aC5wdW1wLmNvLyIsInN1YiI6ImF1dGgwfDY3OTljM2JmYjhiMTRkYzY3YTY5YTQxNiIsImF1ZCI6WyJwdW1wIiwiaHR0cHM6Ly9kZXYtam4xcTUxamZrbzZmYnh1aS51cy5hdXRoMC5jb20vdXNlcmluZm8iXSwiaWF0IjoxNzM4NDU2NjMyLCJleHAiOjE3Mzg1NDMwMzIsInNjb3BlIjoib3BlbmlkIHByb2ZpbGUgZW1haWwgb2ZmbGluZV9hY2Nlc3MiLCJhenAiOiJsOU1hendpSTVSWDU2Y05rOFNEaFBnUGI1dHN6Q0JGWCIsInBlcm1pc3Npb25zIjpbXX0.yoqffqn0spRAygpkR_KaTgSFiZuMEQLcKKW01D5cukF_08vNBTDTdb1yRDkTUxNryMu2wFtB8G-lx3wnL7F6fTzEu5ITa3y0o-lphwB0cgRvJPB0iMGGRAq96_uqSpbt99EaB_o9k_-rYKTJKVJYfg2dciTdZ4BH15QnH9cwjc-NVJhMQw-RwGMkCs4_EDXMIWojd7rWNwAngwSUdEpLSRObchTYzwf9BjWHiy-BENq9XblInhd6hLsFHWegooDU7kAbFbvtMExfFl59a44E0ZbGPZLDDN1GrVPIOWG7kM8dJAGP7Y_tPVB6MEQGTp3K7C8Bh6ebo1Z7Y56JgUW1oQ';

            return Http::withToken($token)
                ->baseUrl(config('services.pump.base_url'))
                ->withOptions([
                    'query' => [
                        'company_id' => config('services.pump.company_id'),
                    ],
                ])
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ]);
        });
    }
}
