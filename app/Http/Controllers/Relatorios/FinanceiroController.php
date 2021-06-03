<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Ordem;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{

    public function index(){
        $ordens = Ordem::get();
        return view('relatorios.financeiro.index', compact('ordens'));
    }
}
