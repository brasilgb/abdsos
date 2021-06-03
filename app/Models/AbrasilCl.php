<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbrasilCl extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'sos_clientes';

    protected $fillable = [
        'name',
        'email',
        'chave',
        'ativo'
    ];
}
