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
	   	<h1>{{ $user->name }} </h1>
	   	<small class="text-muted">Verificação do perfil {{ $user->name }}</small>
	</div>
</div>

<div class="container mt-3">
	<div class="row">
	    <div class="form-group col-md-4">
	    	<a href="{{ url('/gestao') }}" class="btn btn-warning"><i class="fas fa-angle-left"></i> Voltar Atrás</a>
	    </div>		
	</div>
	<!-- Start of Card Deck Layout -->
    <form class="wrapper-wide form-horizontal" class="form-inline" role="form" method="POST" action="/gerir/user/{{$user->id}}/update">
    	{{ csrf_field() }}
    	{{ method_field('PUT') }}
    	@if ($user->type === 'default')
    	<div class="form-row">
    		<h6>CLIENTE PROFISSIONAL</h6>
    	</div>
    	<div class="form-row">
            <div class="form-group col-md-12">
            	<label for="">Confirme os dados do cliente</label>
            	<button type="submit" class="btn btn-info btn-block"> Confirmar </button>
            	<input type="hidden" name="form_type" value="default">
            </div>
	    </div>
    	@elseif ($user->type === 'clionline')
    	<div class="form-row">
			<h6>CLIENTE ONLINE</h6>
    	</div>
		<div class="form-row">
		    <div class="form-group col-md-8">
              <label for="InputCodSap">Código SAP</label>
              <input type="text" class="form-control" id="InputCodSap" name="InputCodSap" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Por favor, preencha este campo.</div>
            </div>
            <div class="form-group col-md-4">
            	<label for="">Confirme os dados do cliente</label>
            	<button type="submit" class="btn btn-info btn-block"> Confirmar </button>
            	<input type="hidden" name="form_type" value="clionline">
            </div>
		</div>
    	@endif                                                                
    </form>
</div>

@endsection

@section('footer_scripts')

@endsection
