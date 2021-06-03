<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_peca';
    public $incrementing = false;

    protected $fillable = [
        'id_peca',
        'peca',
        'descricao',
        'fabricante',
        'quantidade',
        'valor',
        'situacao',
        'observacoes'
    ];

    public function scopeIdpeca()
    {
        $pecas = Peca::orderBy('id_peca', 'DESC')->first();
        if ($pecas) {
            return $pecas->id_peca + 1;
        } else {
            return 1;
        }
    }

    public function ordens(){
        return $this->belongsToMany(Ordem::class, 'ordem_peca', 'id_ordem', 'id_ordem');
    }
}
