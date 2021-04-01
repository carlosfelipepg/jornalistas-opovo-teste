<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Noticia;
use Faker\Generator as Faker;

$factory->define(Noticia::class, function (Faker $faker) {
    return [
        'titulo' => 'EMP' . $faker->randomNumber(5, true),
        'descricao' => 'EMP' . $faker->randomNumber(5, true),
        'corpo' => 'EMP' . $faker->randomNumber(5, true),
        'imagem' => 'EMP' . $faker->randomNumber(5, true),
        'jornalista_id' => 15,
    ];
});
