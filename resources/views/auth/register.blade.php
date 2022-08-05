@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<div class="container h-100">
    <div class="d-flex justify-content-center">
        <div class="user_card shadown border border-white bg-gray-200 rounded">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    @if (!empty($empresa->logo))
                    <img src="{{ asset('thumbnail/' . $empresa->logo) }}" class="brand_logo" alt="Logo">
                    @else
                    <img src="{{ asset('images/logo_padrao.jpg') }}" class="brand_logo" alt="Logo">
                    @endif

                </div>
            </div>

            <div class="d-flex justify-content-center form_container">
                <form id="register" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="name" class="form-control input_user @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Digite o seu nome" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control input_user @error('username') is-invalid @enderror" value="administrador"
                            autocomplete="username" autofocus readonly>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-at"></i></span>
                        </div>
                        <input type="text" name="email" class="form-control input_user @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            placeholder="Digite o E-mail" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>

                        <input id="password" type="password" name="password"
                            class="form-control input_pass @error('password') is-invalid @enderror"
                            value="{{ old('password') }}" placeholder="Digite uma Senha" autocomplete="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control input_pass @error('password_confirmation') is-invalid @enderror"
                            value="{{ old('password_confirmation') }}" placeholder="Repita a Senha"
                            autocomplete="password_confirmation">
                    </div>

                    <div class="input-group mb-3 shadow-sm">
                        <button type="submit"
                            class="btn btn-primary form-control border border-white border-right-0 rounded-left"
                            style="border-top-right-radius: 0!important;border-bottom-right-radius: 0!important;">
                            {{ __('Registrar') }}
                        </button>
                        <button type="submit"
                            style="border-top-left-radius: 0!important;border-bottom-left-radius: 0!important;"
                            class="input-group-text bg-primary text-white border border-white border-left-0 rounded-right"
                            id="btnGroupAddon"><i class="fas fa-user"></i></button>
                    </div>
            </div>


            </form>
        </div>
    </div>
</div>
{{-- <script>
    $("#register").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },
            messages: {
                name: {
                    required: 'Digite um nome!',
                },
                email: {
                    required: 'Digite um e-mail!',
                    email: 'Digite um e-mail válido!'
                },
                password: {
                    required: 'Digite a senha!',
                    minlength: 'Mínimo 6 caracteres!'
                },
                password_confirmation: {
                    required: 'Redigite a senha!',
                    minlength: 'Mínimo 6 caracteres!',
                    equalTo: "As senhas devem ser iguais!"
                }
            }
        });

</script> --}}
@endsection
