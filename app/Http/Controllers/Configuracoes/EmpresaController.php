<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class EmpresaController extends Controller
{
    /**
     * @var Empresa
     */
    protected $empresa;

    public function __construct(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::first();
        if ($empresas):
            return redirect()->route('empresas.show', ['empresa' => $empresas->id_empresa]);
        else :
            return redirect()->route('empresas.create');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = $this->estados();
        return view('empresas.create', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Empresa $empresa)
    {
        $data = $request->all();
        $rules = [
            'empresa' => 'required',
            'razao' => 'required',
            'cnpj' => 'required',
            'logo' => 'mimes:jpeg,jpg,png',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'cep' => 'required',
            'celular' => 'required',
            'site' => 'nullable',
            'email' => 'required|email'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!',
            'url' => 'Este :attribute não é válido!',
            'email' => 'Este :attribute não é válido!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
            if($request->file('logo')){
                if (!is_dir(public_path('storage'. DIRECTORY_SEPARATOR .'thumbnail'))):
                    mkdir(public_path('storage'. DIRECTORY_SEPARATOR .'thumbnail'), '0777', true);
                endif;
                $image = $request->file('logo');
                $nomeimagem = time() . '.' . $image->extension();
                $destinationPath = public_path('storage'. DIRECTORY_SEPARATOR .'thumbnail');
                $img = Image::make($image->path());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . DIRECTORY_SEPARATOR . $nomeimagem);
                $destinationPath = public_path('/storage'. DIRECTORY_SEPARATOR .'images');
                $image->move($destinationPath, $nomeimagem);
                unlink(public_path('storage'. DIRECTORY_SEPARATOR .'images/' . $nomeimagem));
                $data['logo'] = $nomeimagem;
            }
            $data['id_empresa'] = Empresa::idempresa();
            $empresa->create($data);
            flash('<i class="fa fa-check"></i> Empresa cadastrada com sucesso!')->success();
            return redirect()->route('empresas.show', ['empresa' => Empresa::idempresa() - 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        $estados = $this->estados();
        return view('empresas.edit', compact('empresa', 'estados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return redirect()->route('empresas.show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {

        $data = $request->all();
        $rules = [
            'empresa' => 'required',
            'razao' => 'required',
            'cnpj' => 'required',
            'logo' => 'mimes:jpeg,jpg,png',
            'endereco' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'cep' => 'required',
            'celular' => 'required',
            'site' => 'nullable',
            'email' => 'required|email'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!',
            'url' => 'Este :attribute não é válido!',
            'email' => 'Este :attribute não é válido!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
            if($request->file('logo')){
                if (!is_dir(public_path('storage'. DIRECTORY_SEPARATOR .'thumbnail')) && !is_dir(public_path('storage'. DIRECTORY_SEPARATOR .'images'))):
                    mkdir(public_path('storage'. DIRECTORY_SEPARATOR .'thumbnail'), '0777', true);
                    mkdir(public_path('storage'. DIRECTORY_SEPARATOR .'images'), '0777', true);
                endif;
                $image = $request->file('logo');
                $nomeimagem = time() . '.' . $image->extension();
                $destinationPath = public_path('storage'. DIRECTORY_SEPARATOR .'thumbnail');
                $img = Image::make($image->path());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . DIRECTORY_SEPARATOR . $nomeimagem);
                $destinationPath = public_path('/storage'. DIRECTORY_SEPARATOR .'images');
                $image->move($destinationPath, $nomeimagem);
                unlink(public_path('storage'. DIRECTORY_SEPARATOR .'images/' . $nomeimagem));
                $data['logo'] = $nomeimagem;
            }
            $empresa->update($data);
            flash('<i class="fa fa-check"></i> Empresa editada com sucesso!')->success();
            return redirect()->route('empresas.show', ['empresa' => $empresa->id_empresa]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        //
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
