<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    // protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $incrementing = false;

    protected $fillable = [
        'id_cliente',
        'cliente',
        'nascimento',
        'email',
        'telefone',
        'celular',
        'logradouro',
        'numero',
        'complemento',
        'bairro',
        'estado',
        'cidade',
        'cep',
        'cpf',
        'rg',
        'contato',
        'telefone_contato',
        'celular_contato'
    ];

    public function scopeIdcliente()
    {
        $clientes = Cliente::orderBy('id_cliente', 'DESC')->first();
        if ($clientes) {
            return $clientes->id_cliente + 1;
        } else {
            return 1;
        }
    }

    public function ordens()
    {
        return $this->hasMany(Ordem::class, 'cliente_id', 'id_cliente');
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'cliente_id', 'id_cliente');
    }
}
