<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agenda::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_agenda' => Agenda::idagenda(),
            'cliente_id' => $this->faker->randomElement(Cliente::pluck('id_cliente')->toArray()),
            'tecnico_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'data' => $this->faker->date(),
            'hora' => $this->faker->time(),
            'servico' => 'defeito fonte',
            'detalhes' => 'Fonte aquecendo',
            'status' => '1'
        ];
    }
}
