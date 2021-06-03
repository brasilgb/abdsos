<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $table = 'tarefas';
    protected $primaryKey = 'id_tarefa';
    public $incrementing = false;
    protected $fillable = [
        'id_tarefa',
        'data_inicio',
        'hora_inicio',
        'data_previsao',
        'hora_previsao',
        'descritivo',
        'descricao',
        'data_termino',
        'hora_termino',
        'status',
        'tecnico',
        'observacao'
    ];

    public function scopeIdtarefa() {
        $tarefa = Tarefa::orderBy('id_tarefa', 'desc')->get();

        if ($tarefa->count() > 0):
            foreach ($tarefa as $tarefa):
                return $tarefa->id_tarefa + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
