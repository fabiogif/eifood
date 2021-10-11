<?php

namespace App\Providers;

use App\Repositories\{
    CategoryRepository,
    ProductRepository,
    TenantRepository,
    TableRepository,
    ClientRepository,
    OrderRepository,
    EvaluantionRepository
};
use App\Repositories\Contracts\{
    CategoryRepositoryInterface,
    ClientRepositoryInterface,
    EvaluationRepositoryInterface,
    OrderRepositoryInterface,
    ProductRepositoryInterface,
    TableRepositoryInterface,
    TenantRepositoryInterface,
};


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TenantRepositoryInterface::class,
            TenantRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        $this->app->bind(
            TableRepositoryInterface::class,
            TableRepository::class
        );
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class
        );
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
        $this->app->bind(
            EvaluationRepositoryInterface::class,
            EvaluantionRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
