<?php

namespace App\Providers;

use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

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
        $this->registerApiResponseMacro();
        $this->configFilamentLanguageSwitch();
    }

    /**
     * Registers a custom response macro for standardized API responses.
     *
     * This macro extends the response factory to include an `api` method, allowing
     * for a consistent structure for JSON API responses. It can be used throughout
     * the application to return standardized responses with a success status, message,
     * and optional data payload.
     *
     * Usage:
     * response()->api($data, 'Operation successful', 200);
     *
     * @return void
     */
    protected static function registerApiResponseMacro(): void
    {
        Response::macro('api', function ($data = null, $message = '', $status = HttpResponse::HTTP_OK, $headers = []) {
            return Response::json([
                'success' => $status >= 200 && $status < 300,
                'message' => $message,
                'data' => $data,
            ], $status, $headers);
        });
    }

    protected static function configFilamentLanguageSwitch(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['ar', 'en']);
        });
    }
}
