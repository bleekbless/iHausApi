<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

/**
 * Factory definition for model App\Usuario.
 */
$factory->define(App\Usuario::class, function ($faker) {
    return [
        // Fields here
    ];
});

/**
 * Factory definition for model App\TipoTelefone.
 */
$factory->define(App\TipoTelefone::class, function ($faker) {
    return [
        // Fields here
    ];
});

/**
 * Factory definition for model App\Telefone.
 */
$factory->define(App\Telefone::class, function ($faker) {
    return [
        // Fields here
    ];
});

/**
 * Factory definition for model App\Estado.
 */
$factory->define(App\Estado::class, function ($faker) {
    return [
        // Fields here
    ];
});

/**
 * Factory definition for model App\Cidade.
 */
$factory->define(App\Cidade::class, function ($faker) {
    return [
        'estado_id' => $faker->key,
    ];
});

/**
 * Factory definition for model App\Bairro.
 */
$factory->define(App\Bairro::class, function ($faker) {
    return [
        'cidade_id' => $faker->key,
    ];
});

/**
 * Factory definition for model App\Endereco.
 */
$factory->define(App\Endereco::class, function ($faker) {
    return [
        'bairro_id' => $faker->key,
    ];
});

/**
 * Factory definition for model App\Universidade.
 */
$factory->define(App\Universidade::class, function ($faker) {
    return [
        'endereco_id' => $faker->key,
    ];
});
