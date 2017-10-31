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
        'username' => $faker->unique()->userName,
        'email' => $faker->unique()->email,
        'password' => app('hash')->make('password'),
    ];
});

$factory->define(App\Tipo::class, function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->unique()->word
    ];
});

$factory->define(App\Rol::class, function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->unique()->word
    ];
});

$factory->define(App\Requerimiento::class, function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->sentence(10),
        'cantidad' => $faker->randomDigit,
        'fecha_vencimiento' => $faker->date
    ];
});

$factory->define(App\Representante::class, function (Faker\Generator $faker) {
    return [
        'cedula' => $faker->unique()->randomDigitNotNull,
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'numero_contacto_1' => $faker->e164PhoneNumber,
        'numero_contacto_2' => $faker->optional($weight = 0.5, $default = null)->e164PhoneNumber
    ];
});

$factory->define(App\Ninho::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'descripcion_situacion' => $faker->text,
    ];
});

$factory->define(App\Municipio::class, function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->unique()->city
    ];
});

$factory->define(App\Estado::class, function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->unique()->state
    ];
});

$factory->define(App\Cancer::class, function (Faker\Generator $faker) {
    return [
        'nombre' => $faker->unique()->jobTitle
    ];
});

$factory->define(App\Adjunto::class, function (Faker\Generator $faker) {
    return [
        'descripcion' => $faker->sentence,
        'imagen' => $faker->optional($weight = 0.5, $default = null)->imageUrl
    ];
});