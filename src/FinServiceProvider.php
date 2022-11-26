<?php

namespace budisteikul\fin;

use Illuminate\Support\ServiceProvider;

class FinServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'fin');
        
        $this->loadMigrationsFrom(__DIR__.'/migrations/2019_09_30_125253_create_fin_categories_table.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations/2019_09_30_132534_create_fin_transactions_table.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations/2022_11_26_101955_create_fin_temps_table.php');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

    }
}
