<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Mensagem;
use App\Models\Tarefa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarefas = Tarefa::orderBy('id_tarefa')->paginate(15);
        return view('tarefas.index', compact('tarefas'));
    }

    public function busca(Request $request)
    {
        $status = $request->status;
        $term = $request->term;
        $empresa = Empresa::get()->first();
        $mensagem = Mensagem::get()->first();
        if (!empty($empresa['empresa']) && !empty($mensagem['recebimento_recibo'])) :
            $link_blank = true;
        else :
            $link_blank = false;
        endif;
        if (!empty($term)) :
            $term = Carbon::createFromFormat("d/m/Y", $term)->format("Y-m-d");
            $tarefas = Tarefa::where('data_inicio', $term)->paginate(15);
        endif;
        if (!empty($status)) :
            $tarefas = Tarefa::orderby('id_tarefa', 'DESC')->where('status', $status)->paginate(15);
        endif;
        return view('tarefas.index', compact('tarefas', 'term', 'link_blank'));
    }

    public function aberta(Request $request)
    {

        $tarefas = Tarefa::where('status', $request->tarefa)->paginate(15);
        $busca = true;
        return view('tarefas.index', compact('tarefas', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tarefa $tarefa)
    {
        $data = $request->all();
        $rules = [
            'data_inicio' => 'required',
            'hora_inicio' => 'required',
            'data_previsao' => 'required',
            'hora_previsao' => 'required',
            'descritivo' => 'required',
            'descricao' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_tarefa'] = Tarefa::idtarefa();
        $data['data_inicio'] = Carbon::createFromFormat('d/m/Y', $request->data_inicio)->format('Y-m-d');
        $data['data_previsao'] = Carbon::createFromFormat('d/m/Y', $request->data_previsao)->format('Y-m-d');
        $data['status'] = 1;
        $tarefa->create($data);
        flash('<i class="fa fa-check"></i> Tarefa salva com sucesso!')->success();
        return redirect()->route('tarefas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        $users = User::where('funcao', 3)->get();
        return view('tarefas.edit', compact('tarefa', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        return redirect()->route('tarefas.show', ['tarefa' => $tarefa->id_tarefa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $data = $request->all();
        $rules = [
            'data_inicio' => 'required',
            'hora_inicio' => 'required',
            'data_previsao' => 'required',
            'hora_previsao' => 'required',
            'descritivo' => 'required',
            'descricao' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        $data['data_inicio'] = Carbon::createFromFormat('d/m/Y', $request->data_inicio)->format('Y-m-d');
        $data['data_previsao'] = Carbon::createFromFormat('d/m/Y', $request->data_previsao)->format('Y-m-d');
        if($request->status == 3){
            $data['data_termino'] = date("Y-m-d", strtotime(Carbon::now()));
            $data['hora_termino'] = date("H:i:s", strtotime(Carbon::now()));
        }
        $tarefa->update($data);
        flash('<i class="fa fa-check"></i> Tarefa salva com sucesso!')->success();
        return redirect()->route('tarefas.show', ['tarefa' => $tarefa->id_tarefa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();
        return redirect()->route('tarefas.index')->with('success', 'Tarefa deletada com sucesso!');
    }
}
