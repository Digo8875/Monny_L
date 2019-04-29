@extends('templates/geral_view')

@section('conteudo')
    <div class='row justify-content-center'>
        <div class='col-lg-6' style='margin-top: 1%;'>
            <div class='card'>
                <div class='card-header'>{{ __('Registrar Novo Usuário') }}</div>

                <div class='card-body'>
                    <form method='POST' action="{{ route('register') }}">
                        @csrf

                        <div class='form-group row'>
                            <label for='nome_pessoal' class='col-md-4 col-form-label text-md-right'>{{ __('Nome Pessoal') }}</label>

                            <div class='col-md-6'>
                                <input id='nome_pessoal' type='text' class="form-control{{ $errors->has('nome_pessoal') ? ' is-invalid' : '' }}" name='nome_pessoal' value="{{ old('nome_pessoal') }}" required autofocus>

                                @if ($errors->has('nome_pessoal'))
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $errors->first('nome_pessoal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label for='nome_usuario' class='col-md-4 col-form-label text-md-right'>{{ __('Nome Usuario') }}</label>

                            <div class='col-md-6'>
                                <input id='nome_usuario' type='text' class="form-control{{ $errors->has('nome_usuario') ? ' is-invalid' : '' }}" name='nome_usuario' value="{{ old('nome_usuario') }}" required autofocus>

                                @if ($errors->has('nome_usuario'))
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $errors->first('nome_usuario') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label for='email' class='col-md-4 col-form-label text-md-right'>{{ __('E-Mail') }}</label>

                            <div class='col-md-6'>
                                <input id='email' type='email' class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name='email' value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label for='senha' class='col-md-4 col-form-label text-md-right'>{{ __('Senha') }}</label>

                            <div class='col-md-6'>
                                <input id='senha' type='password' class="form-control{{ $errors->has('senha') ? ' is-invalid' : '' }}" name='senha' required>

                                @if ($errors->has('senha'))
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $errors->first('senha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class='form-group row'>
                            <label for='senha-confirm' class='col-md-4 col-form-label text-md-right'>{{ __('Confirmar Senha') }}</label>

                            <div class='col-md-6'>
                                <input id='senha-confirm' type='password' class='form-control' name='senha_confirmation' required>
                            </div>
                        </div>

                        <div class='form-group row mb-0'>
                            <div class='col-md-6 offset-md-4'>
                                <button type='submit' class='btn btn-digo'>
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection