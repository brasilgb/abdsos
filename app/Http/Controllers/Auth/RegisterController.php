<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AbrasilLc;
use App\Models\AbrasilCl;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = array(
            'required' => 'O campo :attribute deve ser preenchido!',
            'email' => 'O campo :attribute não é válido!',
            'unique' => 'O campo :attribute já está em uso, digite outro!',
            'min' => 'A :attribute deve ter no mínimo 40 caracteres!',
            'exists' => 'A :attribute adicionada é inválida!'
        );
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string','email', 'unique:mysql2.sos_clientes'],
            'chave' => ['required', 'string',  'min:40','unique:mysql2.sos_clientes','exists:mysql2.sos_licencas'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], $message);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Abrasilcl::create(['name' => $data['name'], 'email' => $data['email'], 'chave' => $data['chave'], 'ativo' => 1]);
        Abrasillc::where('chave', $data['chave'])->update(['email' => $data['email']]);
        return User::create([
            'id' => User::iduser(),
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'chave' => $data['chave'],
            'funcao' => 0,
            'password' => Hash::make($data['password'])
        ]);

    }
}
