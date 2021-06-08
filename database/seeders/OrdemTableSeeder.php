<?php

namespace Database\Seeders;

use App\Models\Ordem;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrdemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ordem::factory()->count(40)->create();
    }
}
