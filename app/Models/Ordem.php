<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ordem extends Model
{
    use HasFactory;
    protected $table = 'ordens';
    protected $primaryKey = 'id_ordem';
    public $incrementing = false;

    protected $fillable = [
        'id_ordem',
        'cliente_id',
        'equipamento',
        'modelo',
        'senha',
        'defeito',
        'estado',
        'acessorios',
        'observacoes',
        'previsao',
        'orcamento',
        'valorcamento',
        'servico',
        'valservico',
        'valtotal',
        'status',//orcamento,comunicado, entregue
        'pagamento', // 1 - Aberto, 2 - Somente peças, 3 - Somente serviços, 4 - Totalotal
        'dt_entrega',
        'hr_entrega',
        'tecnico'

    ];

    public function scopeIdordem()
    {
        $ordens = Ordem::orderBy('id_ordem', 'DESC')->first();
        if ($ordens) {
            return $ordens->id_ordem + 1;
        } else {
            return 1;
        }
    }

    public function clientes(){
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id_cliente');
    }

    public function pecas(){
        return $this->hasMany(Peca::class, 'ordem_peca', 'id_peca', 'id_peca');
    }

    public function users(){
        return $this->belongsTo(User::class, 'tecnico', 'id');
    }
}
