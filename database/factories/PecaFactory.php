<?php

namespace Database\Factories;

use App\Models\Peca;
use Illuminate\Database\Eloquent\Factories\Factory;

class PecaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Peca::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_peca' => Peca::idpeca(),
            'peca' => 'Adaptador WI-FI',
            'descricao' => 'Adaptadores',
            'fabricante' => 'Fabricante genérico',
            'quantidade' => '20',
            'valor' => '189',
            'situacao' => 2,
            'observacoes' => ''
        ];
    }
}
