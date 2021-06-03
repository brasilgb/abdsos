<?php

namespace App\Http\Controllers;

use App\Models\AbrasilCl;
use App\Models\AbrasilLc;
use App\Models\User;
use Illuminate\Http\Request;

class AbrasilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = AbrasilCl::where('chave', '<>', null)->where('email', '<>', null)->first();
        $licencas = AbrasilLc::where('email', $users->email)->where('chave', $users->chave)->first();

        return view('licencas.index', compact('licencas'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $brasil)
    {
        AbrasilLc::where('chave', $brasil)->update(['email' => $request->email]);
        AbrasilCl::where('chave', $brasil)->update(['email' => $request->email]);
        flash('<i class="fa fa-check"></i> O e-mail da licença foi alterado com sucesso!')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
