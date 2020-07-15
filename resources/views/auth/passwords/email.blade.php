@extends('layouts.auth2')

@section('content')
<section class="album py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12 text-center mt-3 mb-3">
                <a href="/" class="btn btn-success btn-pantone" role="button"><i class="fas fa-home"></i> Página Principal</a>
            </div>
            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Enviar email de recuperação de Password') }}
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <a class="btn btn-link btn-link-login float-lg-right text-dark" href="/login-empresarial">
                                        <i class="fas fa-user-lock"></i> {{ __(' Efetuar login') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr style="color:#EBECF1">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
