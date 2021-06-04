<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_empresa';
    public $incrementing = false;

    protected $fillable = [
        'id_empresa',
        'empresa',
        'razao',
        'cnpj',
        'logo',
        'endereco',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'telefone',
        'celular',
        'site',
        'email'
    ];

    public function scopeIdempresa()
    {
        $empresas = Empresa::orderBy('id_empresa', 'DESC')->first();
        if ($empresas) {
            return $empresas->id_empresa + 1;
        } else {
            return 1;
        }
    }

}
