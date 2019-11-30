<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Contornando erro de dados primitivos do DB para Doctrine/Laravel funcionar de forma correto
         * Caso continuar com erros, fazer de forma manual no arquivo Migration
         */
        $plataform = \Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
        $plataform->registerDoctrineTypeMapping('enum', 'string');
        $plataform->registerDoctrineTypeMapping('char', 'string');

    }
}
