<?php

namespace App\Providers;

use App\Models\Customer;
use App\Policies\CustomerPolicy;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    Customer::class => CustomerPolicy::class,
];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
