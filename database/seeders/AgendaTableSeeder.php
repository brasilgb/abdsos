<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Cliente;
use Illuminate\Database\Seeder;

class AgendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agenda::factory()->count(40)->create();
    }
}
