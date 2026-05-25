<?php

namespace App\Providers;

use App\Repository\Contract\DepositInterface;
use App\Repository\DepositInterfaceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

        $this->app->singleton(DepositInterface::class,DepositInterfaceRepository::class);

    }

    public function boot(): void
    {
        //
    }
}
