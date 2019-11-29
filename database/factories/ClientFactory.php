<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

// Importando arquivo com cpf e cnpj
require_once __DIR__ . '/../faker_data/document_number.php';

/**
 * Comando Artisan: "php artisan make:factory ClientFactory --model=App\Client"
 * Convenção sufixo Factory e relacionar ao Model(--model=[Model Class])
 */
$factory->define(Client::class, function (Faker $faker) {
    $cpfs = cpfs();

    return [
        'name' => $faker->name,
        'document_number' => $cpfs[array_rand(cpfs(), 1)], // array_rand função PHP
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'defaulter' => rand(0, 1),
        'date_birth' => $faker->date(),
        'sex' => rand(1, 10) % 2 == 0 ? 'm' : 'f',
        'marital_status' => rand(1, 3),
        'physical_desability' => rand(1, 10) % 2 == 0 ? $faker->word : null
    ];
});
