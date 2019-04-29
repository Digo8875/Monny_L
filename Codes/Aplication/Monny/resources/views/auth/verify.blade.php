@extends('templates/geral_view')

@section('conteudo')
    <div class='row justify-content-center'>
        <div class='col-lg-6' style='margin-top: 1%;'>
            <div class='card'>
                <div class='card-header'>{{ __('Confirme seu endereço de e-mail') }}</div>

                <div class='card-body'>
                    @if (session('resent'))
                        <div class='alert alert-success' role='alert'>
                            {{ __('Um novo link de validação foi enviado ao seu e-mail.') }}
                        </div>
                    @else
                        {{ __('Para proceder, verifique seu e-mail pelo link de validação.') }}
                        {{ __('Se não recebeu um e-mail com o link') }}, <a href="{{ route('verification.resend') }}">{{ __('clique aqui para reenviar') }}</a> ou entre em contato com o administrador do sistema.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection