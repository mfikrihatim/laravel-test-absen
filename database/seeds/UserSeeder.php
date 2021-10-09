<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create('id_ID');

     	for ($i=0; $i < 5 ; $i++) { 
     		
     		DB::table('users')->insert([
    			// 'id_users' => Str::uuid(),
    			'username' => $faker->name,
    			'email' => $faker->email,
    			'password' => Hash::make('12345')
    		]);
     	}
    }
}
