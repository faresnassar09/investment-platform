<?php

namespace App\Providers;

use App\Repository\Contract\DepositInterface;
use App\Repository\Contract\InvestmentInterface;
use App\Repository\Contract\PlanInterface;
use App\Repository\Contract\UserWalletInterface;
use App\Repository\DepositInterfaceRepository;
use App\Repository\InvestmentInterfaceRepository;
use App\Repository\PlanInterfaceRepository;
use App\Repository\UserWalletInterfaceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

        $this->app->singleton(DepositInterface::class,DepositInterfaceRepository::class);
        $this->app->singleton(InvestmentInterface::class,InvestmentInterfaceRepository::class);
        $this->app->singleton(PlanInterface::class,PlanInterfaceRepository::class);
        $this->app->singleton(UserWalletInterface::class,UserWalletInterfaceRepository::class);

    }

    public function boot(): void
    {
        //
    }
}
