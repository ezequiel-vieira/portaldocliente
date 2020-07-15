@extends('layouts.index')

@section('template_title')
    Devolução
@endsection

@section('template_linked_css') 
	<style type="text/css">
		.square-item {
		    /*height: 230px; */
		}
		.btn-exchange{
			 background: #FFF; 
			 border-color: #94bb1e;
		}
		.btn-exchange:hover{
			background: #b2b2b2 !important;
		}
		.btn-exchange:hover .fa-exchange-alt{
			color: #dc3545!important;
		}
		.item_no_border {
		    border-right: 0px solid #eee;
		}

	</style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Devoluções</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
	<div class="container">
		<div class="page-header"><h1>{{$cliente->name}}</h1></div>
		<div class="jumbotron jumbotron-cc">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-4">
					<div class="square-item">
						<div class="text-center">
							<i class="fas fa-exchange-alt fa-3x text-success" ></i>
	                        <h2 class="tile-title-cc">Devoluções</h2>
	                    </div>
					</div>  
				</div>
				<div class="col-sm-12 col-md-12 col-lg-8">
					<div class="square-item item_no_border">
						<h5 class="mt-0">Política de Devoluções</h5>
						<div class="media mr-3">
							<a class="mr-3" href="/devolucao_regulamento.pdf" target="_blank"><i class="far fa-file-pdf fa-3x text-danger"></i></a>
							<div class="media-body">
								No documento( PDF ) apresentado, poderá consultar o nosso Procedimento de Aceitação de Devoluções dos Géneros Alimentícios.
							</div>
						</div>
						<p>Qualquer dúvida, contacte nosso <a href="mailto:qualidade@gruponobrega.pt" class="text-success">  Departamento de Qualidade <i class="far fa-envelope fa-xs"></i></a></p>						 
					</div>  
				</div>
			</div>
		</div>
		<div class="jumbotron jumbotron-cc">
			<div class="table-wrapper-cc">
				<div class="row">
					<div class="col-sm">
						<div class="table-responsive-md">
							<p style="text-decoration: underline;"> <i class="fas fa-info-circle text-info"></i> Os Documentos abaixo apresentados foram emitidos nos últimos 5 dias.</p>
							<p> 
								<i class="fas fa-exclamation-triangle text-warning"></i> 
								Caso queira devolver um artigo não presente na seguinte lista, preencha o seguinte <a class="" data-toggle="collapse" href="#devolucaoCollapse" role="button" aria-expanded="false" aria-controls="collapseExample">formulário.</a> 
							</p>
							<div class="collapse" id="devolucaoCollapse">
								<div class="card card-body">
						            <form class="wrapper-wide form-horizontal" class="form-inline" role="form" method="POST" action="/cliente/{{$cliente->name}}/custom/devolucao">
	            						{{ csrf_field() }}
	            						{{ method_field('POST') }}
	            						<hr>
										<div class="form-group">
											<label for="InputDocumento">Nrº Fatura</label>
											<input type="text" class="form-control" name="InputDocumento" id="InputDocumento" aria-describedby="documentoHelp" placeholder="Insira o número da Fatura">
										</div>
										<div class="form-group">
										    <label for="devoluçãoTextarea">Notas sobre a devolução</label>
										    <textarea class="form-control" name="InputNotas" id="devoluçãoTextarea" rows="5" style="height:100%;"></textarea>
										    <small id="notasHelp" class="form-text text-muted">Enumere os produtos e quantidades associadas que deseja devolver, e os motivos para tal.</small>
										</div>
										<input type="hidden" name="current_user_id" value="{{$current_user->id}}">
										<input type="hidden" name="current_user_name" value="{{$current_user->name}}">
										<input type="hidden" name="current_company" value="{{$cliente->name}}">
										<input type="hidden" name="current_sap_id" value="{{$cliente->id_sap}}">
										<input type="hidden" name="current_email" value="{{$cliente->email1}}">
										<button type="submit" class="btn btn-block btn-success">Enviar</button>
										<hr>
									</form>
								</div>
							</div>
							<table class="table table-striped table-hover">
							    <thead>
									<tr>
										<th>#</th>
										<th>Documento</th>
										<th>Data</th>
										<th>Valor</th>
										<th>Devolver</th>
									</tr>
							    </thead>
							    <tbody>
							    	@foreach($docs as $doc)
										<tr class="">
											<td>{{$loop->iteration}}</td>
											<td>{{$doc->ft_number}}</td>
											<td>{{$doc->doc_date}}</td>
											<td>€ {{$doc->doc_value}}</td>
											<td>
												<a class="btn btn-light btn-exchange" href="/cliente/{{$cliente->alias}}/devolucao/{{$doc->id}}" role="button">
													<i class="fas fa-exchange-alt text-success" ></i>
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('modals.modal-devolucao')
@endsection

@section('footer_scripts')
	@include('scripts.save-devolucao-modal-script')
@endsection
