<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $primaryKey = "id_email";
    public $incrementing = false;

    protected $fillable = [
        'id_email',
        'servidor',
        'porta',
        'seguranca',
        'usuario',
        'senha'
    ];

    public function scopeIdemail()
    {
        $emails = Email::orderBy('id_email', 'DESC')->first();
        if ($emails) {
            return $emails->id_email + 1;
        } else {
            return 1;
        }
    }

}
