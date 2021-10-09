<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Facades\Hash;
use App\Model;
use App\Models\{Users,Absen};
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Absen::class, function (Faker $faker) {
    return [
        // 'id_absen'  	=> Str::uuid(),
        // 'fk_id_users'	=> 1,
        'nama_user' 	=> $faker->name,
        'izin' 			=> 1,
        'keterangan'  	=> 'Izin',
        'masuk'  		=> 0,
        'tanggal_izin'  => "[\"2021-09-12\",\"2021-09-11\",\"2021-09-13\"]",
    ];
});

