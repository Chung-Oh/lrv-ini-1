<?php

use Illuminate\Database\Seeder;

/**
 * Comando Artisan: "php artisan make:seeder ClientsTableSeeder"
 * Importante, para funcionar o Seed precisa registrar no DatabaseSeeder.php
 * Para rodar, tem que executar no terminal: "php artisan db:seed"
 * Caso queira recriar um novo DB já populado executar: "php artisan migrate:refresh --seed"
 */
class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Client::class, 20)->create();
    }
}
