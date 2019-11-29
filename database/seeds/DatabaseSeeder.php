<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Abaixo são registrado todos os Seeders, que irão popular o DB
     * Comando: "php artisan db:seed"
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
    }
}
