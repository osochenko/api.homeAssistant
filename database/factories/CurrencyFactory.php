<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Currency::class, function () {
    return [
        'name' => 'Dollar',
        'code' => 'USD',
    ];
});

$factory->define(App\Models\Currency::class, function () {
    return [
        'name' => 'Ukrainian Hryvnia',
        'code' => 'UAH',
    ];
});
