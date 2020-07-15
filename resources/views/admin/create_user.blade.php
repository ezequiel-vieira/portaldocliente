@extends('layouts.admin')

@section('template_title')
    Admin - User
@endsection

@section('template_linked_css') 
<style type="text/css">
	.page-header{
		font-size: 34px;
	    font-weight: 900;
	    padding-bottom: 9px;
    	margin: 40px 0 40px;
    	border-bottom: 1px solid #eee;
	}

</style>
@endsection

@section('content')
<div class="container">
	<div class="page-header">
	   	<h1>Novo</h1>
	   	<small class="text-muted">Criar novo perfil de utilizador</small>
	</div>
</div>

<div class="container mt-3">
	<div class="row">
		<div class="col-md-6">
			<!-- Start of Card Deck Layout -->
			<div class="">
	            <form class="wrapper-wide form-horizontal" class="form-inline" role="form" method="POST" action="/admin/users/novo">
	            	{{ csrf_field() }}
	            	{{ method_field('POST') }}
	            	<div class="form-group">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="userType" id="userTypeGuest" value="optionGuest" checked>
							<label class="form-check-label" for="userType">
							Guest
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="userType" id="userTypeVendedor" value="optionVendedor">
							<label class="form-check-label" for="userType">
							Vendedor
							</label>
						</div>
					</div>
            	  	<div class="form-group">
						<label for="InputGuestName">Nome</label>
						<input type="text" class="form-control" id="InputGuestName" name="InputGuestName" aria-describedby="nomeHelp" placeholder="Inserir Nome" required>
					</div>
					<div class="form-group">
						<label for="InputGuestEmail">Email address</label>
						<input type="email" class="form-control" id="InputGuestEmail" name="InputGuestEmail" aria-describedby="emailHelp" placeholder="Inserir Email" required>
					</div>
					<div class="form-group">
					    <label for="InputGuestPassword">Password</label>
					    <input type="password" class="form-control" id="InputGuestPassword" name="InputGuestPassword" placeholder="Password" required>
					</div> 
                    <div class="form-group">
                        <label for="GuestPassword-confirm">{{ __('Confirme Password') }}</label>
                        <input id="GuestPassword-confirm" type="password" class="form-control" name="InputGuestPassword_confirmation" required>
                    </div> 
	                <div class="form-group row">
	                    <button type="submit" class="btn btn-info btn-block"> Criar  </button>
	                </div>                                                                 
	            </form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer_scripts')

@endsection
