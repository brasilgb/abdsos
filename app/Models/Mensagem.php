<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use HasFactory;
    protected $table = 'mensagens';
    protected $primaryKey = 'id_mensagem';
    public $incrementing = false;

    protected $fillable = [
        'id_mensagem',
        'recebimento_recibo',
        'entrega_recibo',
        'mensagem_agendamento',
        'mensagem_servico_concluido'
    ];

    public function scopeIdmensagem()
    {
        $mensagens = Mensagem::orderBy('id_mensagem', 'DESC')->first();
        if ($mensagens) {
            return $mensagens->id_mensagem + 1;
        } else {
            return 1;
        }
    }

}
