<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interface\TransactionRepositoryInterface;
use App\Repositories\TransactionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //Bind tra Interfaccia e Repository
        $this->app->bind(TransactionRepositoryInterface::class,TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
