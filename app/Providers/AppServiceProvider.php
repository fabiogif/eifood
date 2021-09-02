<?php

namespace App\Providers;

use App\Models\{Category, Client, Plan, Product, Table, Tenant};
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Observers\{PlanObserver, ProductObserver, TableObserver, TenantObserver, CategoryObserver, ClientObserver};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Plan::observe(PlanObserver::class);
        Tenant::observe(TenantObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Client::observe(ClientObserver::class);
        Table::observe(TableObserver::class);
    }
}
