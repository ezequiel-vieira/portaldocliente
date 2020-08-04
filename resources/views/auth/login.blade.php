@extends('layouts.auth')

@section('template_title')
    Entrar
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!--div class="form-group row">
            <div class="col-md-12">
                <input id="email" type="hidden" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Email" value="guest.portaldocliente@gmail.com" autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div-->
        <div class="form-group row">
            <div class="col-md-12">
                <input id="login" type="hidden" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="login" value="guest" autofocus>
                @if ($errors->has('username'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <input id="password" type="hidden" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" value="guest2020">
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-block" style="background: #93ba1f; color: #FFF;">
                    {{ __('ENTRAR NA LOJA') }}
                </button>
            </div>
        </div>
    </form>
@endsection
