<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * @var Cliente
     */
    protected $cliente;
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = $this->cliente->orderby('id_cliente', 'DESC')->paginate(9);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Busca de clientes
     */
    public function busca(Request $request)
    {
        $clientes = $this->cliente->where('cliente', $request->term)->paginate(15);
        $busca = true;
        return view('clientes.index', compact('clientes', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = $this->estados();
        return view('clientes.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'cliente' => 'required',
            'email' => 'required',
            'celular' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'cep' => 'required',
            'cpf' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_cliente'] = Cliente::idcliente();
        $data['nascimento'] = Carbon::createFromFormat("d/m/Y", $request->nascimento)->format("Y-m-d");
        $this->cliente->create($data);
        flash('<i class="fa fa-check"></i> Cliente salvo com sucesso!')->success();
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $estados = $this->estados();
        return view('clientes.edit', compact('cliente', 'estados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return redirect()->route('clientes.show', ['cliente' => $cliente->id_cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $data = $request->all();
        $rules = [
            'cliente' => 'required',
            'email' => 'required',
            'celular' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'cep' => 'required',
            'cpf' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        try {
            $data['nascimento'] = Carbon::createFromFormat("d/m/Y", $request->nascimento)->format("Y-m-d");
            $cliente->update($data);
            // flash('<i class="fa fa-check"></i> Cliente salvo com sucesso!')->success();
            return redirect()->route('clientes.show', ['cliente' => $cliente->id_cliente])->with('success','Cliente salvo com sucesso!');;
        } catch (\Exception $e) {
            $message = 'Erro ao inserir cliente!';
            if (env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
            flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        flash('<i class="fa fa-check"></i> Cliente removido com sucesso!')->success();
        return redirect()->route('clientes.index');
    }

    /**
     * Autocomplete campo cliente
     */
    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        if ($term == '') :
            $clientes = $this->cliente->orderby('cliente', 'ASC')->select('id_cliente', 'cliente')->limit(5)->get();
        else :
            $clientes = $this->cliente->orderby('cliente', 'ASC')->select('id_cliente', 'cliente')->where('cliente', 'LIKE', $term . '%')->get();
        endif;

        foreach ($clientes as $cliente) {
            $response[] = ['value' => $cliente->id_cliente, 'label' => $cliente->cliente];
        }
        return response()->json($response);
    }

    /**
     * Estados
     */
    public function estados(){
        return [
            'AC' => 'AC - Acre',
            'AL' => 'AL - Alagoas',
            'AP' => 'AP - Amapá',
            'AM' => 'AM - Amazonas',
            'BA' => 'BA - Bahia',
            'CE' => 'CE - Ceará',
            'DF' => 'DF - Distrito Federal',
            'ES' => 'ES - Espírito Santo',
            'GO' => 'GO - Goiás',
            'MA' => 'MA - Maranhão',
            'MT' => 'MT - Mato Grosso',
            'MS' => 'MS - Mato Grosso do Sul',
            'MG' => 'MG - Minas Gerais',
            'PA' => 'PA - Pará',
            'PB' => 'PB - Paraíba',
            'PR' => 'PR - Paraná',
            'PE' => 'PE - Pernambuco',
            'PI' => 'PI - Piauí',
            'RJ' => 'RJ - Rio de Janeiro',
            'RN' => 'RN - Rio Grande do Norte',
            'RS' => 'RS - Rio Grande do Sul',
            'RO' => 'RO - Rondônia',
            'RR' => 'RR - Roraima',
            'SC' => 'SC - Santa Catarina',
            'SP' => 'SP - São Paulo',
            'SE' => 'SE - Sergipe',
            'TO' => 'TO - Tocantins',
            ];
    }
}
