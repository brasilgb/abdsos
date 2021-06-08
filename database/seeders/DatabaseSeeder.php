<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ClienteTableSeeder::class);
        $this->call(OrdemTableSeeder::class);
        $this->call(AgendaTableSeeder::class);
        $this->call(PecaTableSeeder::class);
    }
}
