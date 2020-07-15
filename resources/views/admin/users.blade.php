@extends('layouts.index')

@section('template_title')
    Utilizadores
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

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Utilizadores</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
	<div class="container">
		<div class="page-header">
		   	<h1>Utilizadores</h1>
		</div>
	</div>

<div class="container">
	<div class="row">
		<div class="col">
			<div class="table-responsive">
				<table class="table table-striped table-hover">
				    <thead>
						<tr>
							<th>#</th>
							<th>Nome</th>
							<th>Email</th>
							<th>SAP ID</th>
							<th>Tipo</th>
							<th>Verificado</th>
							<th>Criado</th>
							<th>Editar</th>
						</tr>
				    </thead>
				    <tbody>
				    	@foreach($usersList as $user)
							<tr>
								<td>{{$loop->iteration}}</td>									
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->id_sap}}</td>
								<td>{{$user->type}}</td>
								<td>
									@if($user->email_verified_at <> '')
										<i class="far fa-check-circle" style="color: green;"></i>
									@else
									    <i class="far fa-times-circle" style="color: red;"></i>
									@endif
								</td>
								<td>{{$user->created_at}}</td>
								<td><a href="/admin/users/{{$user->id}}/edit"><i class="fas fa-user-edit"></i></a></td>  
							</tr>
						@endforeach
				    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection
