<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * @var User
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $term = '';
        $usuarios = $this->user->orderBy('id', 'DESC')->paginate(15);
        return view('usuarios.index', compact('usuarios', 'term'));
    }

    /**
     * Busca de usuarios
     */
    public function busca(Request $request)
    {
        $term = $request->input('term');
        $usuarios = $this->user->where('nome', $term)->paginate(15);
        return view('usuarios.index', compact('users', 'term'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
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
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email',
            'funcao' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!',
            'confirmed' => 'As senhas devem ser iguais!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id'] = User::iduser();
        $data['password'] = Hash::make($request->password);
        $this->user->create($data);
        flash('<i class="fa fa-check"></i> Usuário salvo com sucesso!')->success();
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return redirect()->route('usuarios.show', ['usuario' => $usuario->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {

        $data = $request->all();
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'funcao' => 'required',
            'password' => 'confirmed',
            'password_confirmation' => '',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!',
            'confirmed' => 'As senhas devem ser iguais!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        if (empty($request->password)) :
            $data['password'] = $request->bdpassword;
        else :
            $data['password'] = Hash::make($request->password);
        endif;
        $usuario->update($data);
        flash('<i class="fa fa-check"></i> Usuário salvo com sucesso!')->success();
        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        flash('<i class="fa fa-check"></i> Usuário deletado com sucesso!')->success();
        return redirect()->route('usuarios.index');
    }

    /**
     * Autocomplete campo usuario
     */
    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        if ($term == '') :
            $usuarios = $this->user->orderby('name', 'ASC')->select('id', 'name')->limit(5)->get();
        else :
            $usuarios = $this->user->orderby('name', 'ASC')->select('id', 'name')->where('name', 'LIKE', $term . '%')->get();
        endif;

        foreach ($usuarios as $usuario) {
            $response[] = ['value' => $usuario->id, 'label' => $usuario->name];
        }
        return response()->json($response);
    }
}
