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
	   	<h1>USER </h1>
	   	<small class="text-muted">Editando o perfil de {{ $user->name }}</small>
	</div>
</div>

<div class="container mt-3">
	<div class="row">
		<div class="col-md-6">
			<!-- Start of Card Deck Layout -->
			<div class="">
	            <form class="wrapper-wide form-horizontal" class="form-inline" role="form" method="POST" action="/admin/users/{{$user->id}}/update">
	            	{{ csrf_field() }}
	            	{{ method_field('PUT') }}
	                <div class="form-group input-group row">
	                    <div class="input-group-prepend">
	                        <span class="input-group-text"> <i class="fa fa-envelope" title="Nome"></i> </span>
	                    </div>
	                    <input name="email" class="form-control" value="{{ $user->email }}" type="text" title="email">
	                </div>   
	                <div class="form-group row">
	                    <button type="submit" class="btn btn-info btn-block"> Enviar alterações  </button>
	                </div>                                                                 
	            </form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer_scripts')

@endsection
