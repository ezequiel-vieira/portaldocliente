@extends('layouts.index')

@section('template_title')
    Utilizadores
@endsection

@section('template_linked_css') 
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<style type="text/css">
		.users_table th, .users_table td{
			text-align: center;
		}
		.toggle.btn-primary{
			border-color: #28a745;
		}
		.toggle.btn-primary .btn-primary.toggle-on{
			color: #fff;
    		background-color: #28a745;
    		border-color: #28a745;
		}
		.toggle.off .toggle-off{
			color: #fff;
    		background-color: #dc3545;
    		border-color: #dc3545;
		}
	</style>
@endsection
@section('head')	
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Controle de Acessos</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
	<div class="container">
		<div class="page-header">
			<h1>{{$cliente->name}} - Utilizadores</h1> 
		</div>
	</div>
	<div class="container">
		<div class="btn-toolbar float-left">
			<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display:none">
				<strong>Updated!</strong> O acesso à página foi alterado com sucesso.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<div class="btn-toolbar float-right my-3">
		    <button type="button" class="btn btn-light" data-toggle='modal' data-target='#confirmAddUser' data-sap="{{$cliente->id_sap}}" data-title="{{$cliente->name}}" data-parent="{{$cliente->user_id}}"><i class="fas fa-plus-circle text-success"></i> Novo Utilizador</button>
		</div>
		<div class="well mb-5">
			<table class="table table-bordered users_table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nome</th>
						<th scope="col">Catálogo</th>
						<th scope="col">Conta Corrente</th>
						<th scope="col">Devolução</th>
						<th scope="col">Encomendas</th>
						<th scope="col">Novidades</th>
						<th scope="col"><i class="fas fa-cogs"></i></th>
					</tr>
				</thead>
			  	<tbody>
			  	@foreach($childUsers as $user)
					<tr class="">
						<td>{{$loop->iteration}}</td>
						<td>{{$user->name}}</td>
						<td>
							<input type="checkbox" class="changePageRole" name="{{$user->id.'-cat_page-'.$user->cat_page}}" {{ $user->cat_page === 1 ? "checked" : "" }} data-toggle="toggle" data-size="xs">
						</td>
						<td>
							<input type="checkbox" class="changePageRole" name="{{$user->id.'-cco_page-'.$user->cco_page}}" {{ $user->cco_page === 1 ? "checked" : "" }} data-toggle="toggle" data-size="xs">
						</td>
						<td>
							<input type="checkbox" class="changePageRole" name="{{$user->id.'-refunds_page-'.$user->refunds_page}}" {{ $user->refunds_page === 1 ? "checked" : "" }} data-toggle="toggle" data-size="xs">
						</td>
						<td>
							<input type="checkbox" class="changePageRole" name="{{$user->id.'-orders_page-'.$user->orders_page}}" {{ $user->orders_page === 1 ? "checked" : "" }} data-toggle="toggle" data-size="xs">
						</td>
						<td>
							<input type="checkbox" class="changePageRole" name="{{$user->id.'-news_page-'.$user->news_page}}" {{ $user->news_page === 1 ? "checked" : "" }} data-toggle="toggle" data-size="xs">
						</td> 
						<td>
						    <button type="button" class="btn btn-light btn-exchange" data-toggle='modal' data-target='#confirmDeleteUser' data-sap="{{$cliente->id_sap}}" data-title="{{$user->name}}" data-parent="{{$user->id}}">
						    	<i class="far fa-trash-alt text-danger"></i>
						    </button>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@include('modals.modal-adduser')
	@include('modals.modal-deleteUser')
@endsection

@section('footer_scripts')
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/js/bootstrap4-toggle.min.js"></script>
	@include('scripts.save-user-modal-script')
	@include('scripts.delete-user-modal-script')
	<script type="text/javascript">

	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    $('.changePageRole').change(function(e) 
	    {
	    	e.preventDefault();
	    	var checkStatus = $(this).attr('name');
	        $.ajax({
	           type:'POST',
	           url:'/ajaxRequest',
	           data: {
		        "_token": "{{ csrf_token() }}",
		        "element": checkStatus
		        },
				success: function(result)
				{
                    jQuery('#success-alert').show();
                    jQuery("#success-alert").fadeTo( "fast", 100 ).slideUp(100, function() {
						jQuery("#success-alert").slideUp(100);
					});
				}
			});
        });
	</script>
@endsection
