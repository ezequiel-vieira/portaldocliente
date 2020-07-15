@extends('layouts.auth2')

@section('content')
    <section class="album py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-12 text-center mt-3 mb-3">
                    <a href="/" class="btn btn-success btn-pantone" role="button"><i class="fas fa-home"></i> Página Principal</a>
                </div>
                <div class="col-12 col-lg-12">
                    <div class="card login-card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Entrar') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-check" style="padding-left: 2.25rem;">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label remember-label" for="remember">
                                                {{ __('Lembrar-me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                <i class="fas fa-key"></i> {{ __(' Esqueceu sua Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <!--div class="form-group row mt-5 mb-5">
                                    <div class="col-md-12 col-lg-12">
                                        <p> Não tem Conta ainda? Registe-se <a href="/registar">aqui</a>.
                                    </div>
                                </div-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
