<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Jornalista;
use Faker\Generator as Faker;

$factory->define(Jornalista::class, function (Faker $faker) {
    return [
        'nome' => 'EMP' . $faker->randomNumber(5, true),
        'sobrenome' => 'EMP' . $faker->randomNumber(5, true),
        'email' => 'EMP' . $faker->randomNumber(5, true),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
    ];
});
