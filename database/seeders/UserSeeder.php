<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create('id_ID');

    	User::create([
			"name" => "admin",
			"email" => "admin@gmail.com",
			"password" => bcrypt("password"),
			"roles" => "ADMIN"
		]);
    }
}
