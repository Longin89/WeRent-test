<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DebugInfoService;

class DebugInfoServiceProvider extends ServiceProvider
{
    //  Провайдер для службы вычисления используемого времени и ОЗУ для проведения операций

    public function boot()
    {
        $this->app->bind(DebugInfoService::class, function ($app) {
            return new DebugInfoService();
        });
    }
}
