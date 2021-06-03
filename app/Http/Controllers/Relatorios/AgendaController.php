<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Empresa;
use App\Models\Mensagem;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::get();
        return view('relatorios.agendas.index', compact('agendas'));
    }

}
