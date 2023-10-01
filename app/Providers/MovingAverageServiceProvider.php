<?php

namespace App\Providers;

use App\Contracts\Services\MovingAverageServiceInterface;
use App\Contracts\Services\ReadDataServiceInterface;
use App\Contracts\Services\WriteDataServiceInterface;
use App\Services\MovingAverageService;
use App\Services\ReadDataService;
use App\Services\WriteDataService;
use Illuminate\Support\ServiceProvider;

class MovingAverageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MovingAverageServiceInterface::class,MovingAverageService::class);
        $this->app->bind(ReadDataServiceInterface::class,ReadDataService::class);
        $this->app->bind(WriteDataServiceInterface::class,WriteDataService::class);
    }

}
