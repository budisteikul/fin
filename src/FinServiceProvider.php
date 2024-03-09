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
        $this->app->register('Webklex\PDFMerger\Providers\PDFMergerServiceProvider');
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('PDFMerger', 'Webklex\PDFMerger\Facades\PDFMergerFacade');
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
        

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

    }
}
