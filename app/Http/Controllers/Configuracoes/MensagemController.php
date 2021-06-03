<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MensagemController extends Controller
{
    /**
     * @var Mensagem
     */
    protected $mensagem;

    public function __construct(Mensagem $mensagem)
    {
        $this->mensagem = $mensagem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $mensagens = Mensagem::first();
        if ($mensagens) :
            return redirect()->route('mensagens.show', ['mensagem' => $mensagens->id_mensagem]);
        else :
            return redirect()->route('mensagens.create');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mensagens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Mensagem $mensagem)
    {
        $data = $request->all();
        $rules = [
            'recebimento_recibo' => 'required',
            'entrega_recibo' => 'required',
            'mensagem_agendamento' => 'required',
            'mensagem_servico_concluido' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_mensagem'] = Mensagem::idmensagem();
        $mensagem->create($data);
        flash('<i class="fa fa-check"></i> Mensagens registradas com sucesso!')->success();
        return redirect()->route('mensagens.show', ['mensagem' => Mensagem::idmensagem() - 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensagem  $mensagem
     * @return \Illuminate\Http\Response
     */
    public function show(Mensagem $mensagem)
    {
        return view('mensagens.edit', compact('mensagem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensagem  $mensagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensagem $mensagem)
    {
        return redirect()->route('mensagens.show', ['mensagem' => $mensagem->id_mensagem]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensagem  $mensagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mensagem $mensagem)
    {
        $data = $request->all();
        $rules = [
            'recebimento_recibo' => 'required',
            'entrega_recibo' => 'required',
            'mensagem_agendamento' => 'required',
            'mensagem_servico_concluido' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $mensagem->update($data);
        flash('<i class="fa fa-check"></i> Mensagens alteradas com sucesso!')->success();
        return redirect()->route('mensagens.show', ['mensagem' => $mensagem->id_mensagem]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensagem  $mensagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensagem $mensagem)
    {
        //
    }
}
