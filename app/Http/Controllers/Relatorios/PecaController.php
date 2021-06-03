<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Peca;
use Illuminate\Http\Request;

class PecaController extends Controller
{
    public function index()
    {
        $pecas =  Peca::get();
        return view('relatorios.pecas.index', compact('pecas'));
    }
}
