<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_backup';
    public $incrementing = false;
    protected $fillable = [
        'id_backup',
        'local',
        'agendamento'
    ];

    public function scopeIdbackup()
    {
        $backups = Backup::orderBy('id_backup', 'DESC')->first();
        if ($backups) {
            return $backups->id_backup + 1;
        } else {
            return 1;
        }
    }

}
