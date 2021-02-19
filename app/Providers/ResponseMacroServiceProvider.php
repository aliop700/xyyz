<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function ($data, $status = 200) {
            return Response::json([
                'success' => true,
                'data' => $data
            ], $status);
        });

        Response::macro('fail', function ($message, $status = 400, $payload = true) {
            return Response::json([
                'success' => false,
                'message' => $message,
                'payload' => $payload ? request()->all() : null
            ], $status);
        });
    }
}