<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * @var Email
     */
    protected $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::first();
        if ($emails) :
            return redirect()->route('emails.show', ['email' => $emails->id_email]);
        else :
            return redirect()->route('emails.create');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Email $email)
    {
        $data = $request->all();
        $rules = [
            'servidor' => 'required',
            'porta' => 'required',
            'seguranca' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_email'] = Email::idemail();
        $email->create($data);
        flash('<i class="fa fa-check"></i> Dados do e-mail cadastrados com sucesso!')->success();
        return redirect()->route('emails.show', ['email' => Email::idemail() - 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        return view('emails.edit', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        flash('<i class="fa fa-check"></i> Dados do e-mail editados com sucesso!')->success();
        return redirect()->route('emails.show', ['email' => $email->id_email]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $data = $request->all();
        $rules = [
            'servidor' => 'required',
            'porta' => 'required',
            'seguranca' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $email->update($data);
        flash('<i class="fa fa-check"></i> Dados do e-mail editados com sucesso!')->success();
        return redirect()->route('emails.show', ['email' => $email->id_email]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
