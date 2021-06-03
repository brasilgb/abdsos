<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordempeca extends Model
{
    use HasFactory;
    protected $table = 'ordem_peca';

    protected $fillable = [
        'id_peca',
        'id_ordem',
        'quantidade'
    ];

}
