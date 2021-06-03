<?php

use App\Models\Empresa;

// Retorna campos pelos models
function showModelTables($model, $field)
{
    $models = $model::all();
    foreach($models as $m):
    return $m->$field;
    endforeach;
}

// Formatação de data e hora
function formatDateTime($value, $format = 'd/m/Y')
{

    return Carbon\Carbon::parse($value)->format($format);
}
