<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Abrasil;
use App\Models\Ferramenta;
use App\Models\Ordem;
use App\Models\Empresa;
use PDF;
use Illuminate\Http\Request;

class FerramentaController extends Controller
{

    /**
     * @var Ordem
     */
    protected $ordem;

    public function __construct(Ordem $ordem, Empresa $empresa)
    {
        $this->ordem = $ordem;
        $this->empresa = $empresa;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etiquetainicial = $this->ordem->orderby('id_ordem', 'DESC')->first();
        $empresa = $this->empresa->first();
        return view('ferramentas.index', compact('etiquetainicial', 'empresa'));
    }

    public function gretiquetas(Request $request){

        $data = [
            'inicial' => $request->valinicial,
            'final' => $request->valfinal,
            'empresa' => $this->empresa->first()
        ];

      $pdf = PDF::loadView('ferramentas.etiquetas', $data);

      // download PDF file with download method
      return $pdf->stream('etiquetas.pdf');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ferramenta  $ferramenta
     * @return \Illuminate\Http\Response
     */
    public function show(Ferramenta $ferramenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ferramenta  $ferramenta
     * @return \Illuminate\Http\Response
     */
    public function edit(Ferramenta $ferramenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ferramenta  $ferramenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ferramenta $ferramenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ferramenta  $ferramenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ferramenta $ferramenta)
    {
        //
    }

}
