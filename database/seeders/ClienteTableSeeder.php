<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::factory()->count(40)->create();
    }
}
