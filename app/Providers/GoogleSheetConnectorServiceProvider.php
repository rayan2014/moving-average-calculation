<?php

namespace App\Providers;

use App\Contracts\GoogleSheet\ReadFromGoogleSheetInterface;
use App\Contracts\GoogleSheet\WriteToGoogleSheetInterface;
use App\Infrasturcure\Gateway\GoogleSheet\Connector;
use App\Infrasturcure\Repository\GoogleSheet\ReadingRepository;
use App\Infrasturcure\Repository\GoogleSheet\WritingRepository;
use Illuminate\Support\ServiceProvider;

class GoogleSheetConnectorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Connector::class, fn() => new Connector());

        $this->app->bind(ReadFromGoogleSheetInterface::class,ReadingRepository::class);
        $this->app->bind(WriteToGoogleSheetInterface::class,WritingRepository::class);
    }
}
