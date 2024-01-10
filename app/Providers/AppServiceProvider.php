<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TokenService;
use App\Repository\Customer\CustomerRepository;
use App\Repository\Customer\ICustomerRepository;
use App\Repository\Region\IRegionRepository;
use App\Repository\Region\RegionRepository;
use App\Repository\Commune\ICommuneRepository;
use App\Repository\Commune\CommuneRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TokenService::class, function ($app) {
            $key = config('app.key');
            return new TokenService($key);
        });

        $this->app->bind(ICustomerRepository::class, CustomerRepository::class);
        $this->app->bind(IRegionRepository::class, RegionRepository::class);
        $this->app->bind(ICommuneRepository::class, CommuneRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
