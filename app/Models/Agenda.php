<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_agenda';
    public $incrementing = false;

    protected $fillable = [
        'id_agenda',
        'cliente_id',
        'tecnico_id',
        'data',
        'hora',
        'servico',
        'detalhes',
        'tecnico',
        'status',
        'observacoes'
    ];


    public function scopeIdagenda()
    {
        $agendas = Agenda::orderBy('id_agenda', 'DESC')->first();
        if ($agendas) {
            return $agendas->id_agenda + 1;
        } else {
            return 1;
        }
    }


    public function clientes()
    {
        return $this->hasOne(Cliente::class, 'id_cliente', 'cliente_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'tecnico_id');
    }
}
