<?php

namespace App\Http\Controllers\Relatorios;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Mensagem;
use App\Models\Ordem;
use Illuminate\Http\Request;

class OrdemController extends Controller
{
    /**
     * @var Ordem
     */
    protected $ordem;
    public function __construct(Ordem $ordem)
    {
        $this->ordem = $ordem;
    }

    public function index()
    {
        $ordens = $this->ordem->get();
        return view('relatorios.ordens.index', compact('ordens'));
    }
}
