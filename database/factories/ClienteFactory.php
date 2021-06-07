<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return  [
            'id_cliente' => Cliente::idcliente(),
            'cliente' => $this->faker->name,
            'nascimento' => $this->faker->date,
            'email' => $this->faker->email,
            'telefone' => $this->faker->phoneNumber,
            'celular' => $this->faker->phoneNumber . '0',
            'logradouro' => $this->faker->streetAddress,
            'numero' => $this->faker->randomNumber(),
            'complemento' => 'Sala1' . Cliente::idcliente(),
            'bairro' => 'centro',
            'estado' => $this->faker->state,
            'cidade' => $this->faker->city,
            'cep' => $this->faker->postcode,
            'cpf' => 45623568741,
            'rg' => 2593658963,
            'contato' => $this->faker->name,
            'telefone_contato' => $this->faker->phoneNumber,
            'celular_contato' => $this->faker->phoneNumber . '0'
        ];
    }
}
