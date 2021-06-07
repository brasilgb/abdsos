<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Ordem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ordem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_ordem' => Ordem::idordem(),
            'cliente_id' => $this->faker->randomElement(Cliente::pluck('id_cliente', 'id_cliente')->toArray()),
            'equipamento' => 'qualquer',
            'modelo' => 'melhorzinho',
            'senha' => '203040',
            'defeito' => 'todos',
            'estado' => 'bom',
            'acessorios' => 'todos',
            'observacoes' => 'tudo pronto',
            'previsao' => '2020-12-15',
            'orcamento' => 'descricao orcamento',
            'valorcamento' => 152,
            'servico' => 'troca de sd',
            'valservico' => 584,
            'valtotal' => 1005,
            'status' => 1,
            'dt_entrega' => '2020-12-20 20:00:00',
            'tecnico' => 2,
        ];
    }
}
