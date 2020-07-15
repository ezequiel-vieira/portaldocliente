@extends('layouts.auth2')

@section('template_title')
    Verificar
@endsection

@section('content')
<!--section class="album py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verifique sua caixa de Correio Electronico') }}</div>
                    <div class="card-body" style="background: #eee;color: #67666e !important;">
                        {{ __('Por favor verificar sua caixa de correio se recebeu um email a confirmar a ativação de sua conta.') }}
                        {{ __('Antes de proceder, por favor verificar sua caixa de correio pelo link de verificação.') }}
                        {{ __('Se não recebeu o email') }}, <a href="{{ route('verification.resend') }}">{{ __('clicar aqui para enviarmos um novo email') }}</a>..
                    </div>
                      <div class="card-footer text-muted">
                        <a href="/logout">{{ __('Ir para a Página Inicial') }}</a>
                      </div>
                </div>
            </div>
        </div>
    </div>
</section-->
<section class="album py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verifique sua caixa de Correio Electronico') }}</div>

                    <div class="card-body" style="background: #eee">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Um link de verificação foi enviado para o seu endereço de correio electronico.') }}
                            </div>
                        @endif

                        {{ __('Antes de proceder, por favor verificar sua caixa de correio pelo link de verificação.') }}
                        {{ __('Se não recebeu o email') }}, <a href="{{ route('verification.resend') }}">{{ __('clicar aqui para enviarmos um novo email') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
