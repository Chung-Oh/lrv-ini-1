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
    return [
        'name'      => $faker->name,
        'email'     => $faker->email,
        'phone'     => $faker->phoneNumber,
        'defaulter' => rand(0, 1)
    ];
});

$factory->state(Client::class, Client::TYPE_INDIVIDUAL, function (Faker $faker) {
    $cpfs = cpfs();
    return [
        'document_number'     => $cpfs[array_rand(cpfs(), 1)], // array_rand função PHP
        'date_birth'          => $faker->date(),
        'sex'                 => rand(1, 10) % 2 == 0 ? 'm' : 'f',
        'marital_status'      => rand(1, 3),
        'physical_desability' => rand(1, 10) % 2 == 0 ? true : false,
        'client_type'         => Client::TYPE_INDIVIDUAL
    ];
});

$factory->state(Client::class, Client::TYPE_LEGAL, function (Faker $faker) {
    $cnpjs = cnpjs();
    return [
        'document_number' => $cnpjs[array_rand(cnpjs(), 1)],
        'company_name'    => $faker->company,
        'client_type'     => Client::TYPE_LEGAL
    ];
});
