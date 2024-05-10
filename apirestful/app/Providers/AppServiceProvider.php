<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CaseService;
use App\Services\CheckService;
use App\Services\ClaimService;
use App\Services\InsuranceCompanyService;
use App\Services\PortfolioService;
use App\Services\ProviderService;
use App\Services\Impl\CaseServiceImpl;
use App\Services\Impl\CheckServiceImpl;
use App\Services\Impl\ClaimServiceImpl;
use App\Services\Impl\InsuranceCompanyServiceImpl;
use App\Services\Impl\PortfolioServiceImpl;
use App\Services\Impl\ProviderServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CaseService::class, CaseServiceImpl::class);
        $this->app->bind(CheckService::class, CheckServiceImpl::class);
        $this->app->bind(ClaimService::class, ClaimServiceImpl::class);
        $this->app->bind(InsuranceCompanyService::class, InsuranceCompanyServiceImpl::class);
        $this->app->bind(PortfolioService::class, PortfolioServiceImpl::class);
        $this->app->bind(ProviderService::class, ProviderServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
