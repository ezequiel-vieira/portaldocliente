@extends('layouts.index')

@section('template_title')
    Devolução
@endsection

@section('head')
@endsection

@section('template_linked_css') 
	<link rel="stylesheet" href="{{ URL::asset('css/jquery.steps.css') }}">
	<style type="text/css">
		.square-item {
		    height: 230px; 
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
		.wizard, .tabcontrol {
		    overflow: auto;
		}
		.wizard > .steps .current a, .wizard > .steps .current a:hover, .wizard > .steps .current a:active {
		    background: #94bb1e;
		    color: #fff;
		    cursor: default;
		}

		.wizard > .steps .disabled a, .wizard > .steps .disabled a:hover, .wizard > .steps .disabled a:active {
		    color: #2c3f4c;
	    	background-color: #edeff0;
	    	border-color: #edeff0;
		    cursor: default;
		}

		.wizard > .steps > ul > li::after {
		    z-index: 1;
		    -webkit-transform: translateX(4px);
		    -moz-transform: translateX(4px);
		    -ms-transform: translateX(4px);
		    -o-transform: translateX(4px);
		    transform: translateX(4px);
		    border-left-color: #fff;
		    margin: 0;
		}
		.wizard > .content {
		    background: #FFF; 
		}
	</style>
	<style type="text/css">
        .comment {
            float: left;
            width: 100%;
            height: auto;
        }
        .comment-text-area {
            float: left;
            width: 100%;
            height: auto;
        }
        .textinput {
            float: left;
            width: 100%;
            min-height: 75px;
            outline: none;
            resize: none;
            border: 1px solid grey;
        }
        .tr-note .td-note  {
		    border-top: 0px solid #dee2e6;
		}
	</style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item"><a href="/cliente/{{$cliente->alias}}/devolucoes"><span>Devoluções</span></a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$document->ft_number}}</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
	<div class="container">
		<div class="page-header">
			<h1>{{$cliente->name}}</h1>
			<small class="text-muted"> Devolução -</small>
			<small class="text-muted">Documento: {{$document->ft_number}}</small>
		</div>
		<div class="jumbotron jumbotron-cc">
			<div class="table-wrapper-cc">
				<div class="row">
					<div class="col-sm">
						<h2 class="mb-3">Escolha o(s) Artigo(s) para Devolução:</h2>
						<hr>
						<div class="table-responsive-md">
							<table class="table table-hover refund-table">
							    <thead class="thead-dark">
									<tr>
										<th>#</th>
										<th>Código</th>
										<th>Material</th>
										<th>Lote</th>
										<th>Quantidade</th>
										<th>Unidade</th>
										<th>Devolver</th>
							          	<th>Unidade</th>										
									</tr>
							    </thead>
							    <tbody id="list-wrapper">
							    	<form class="form-refund wrapper-wide form-horizontal" method="POST" action="{{ url('/cliente/'.$cliente->alias.'/devolucao/'.$devolucao_id) }}">
								    	{{csrf_field()}}
								    	@foreach($mats as $mat)
											<tr class="">
												<td>{{$loop->iteration}}</td>
												<td>{{$mat->number}}</td>
												<td>{{$mat->name}}</td>
												<td>{{$mat->lote}}</td>
												<td>{{$mat->quantidade}}</td>
												<td>{{$mat->unidade}}</td>
												<td>
													<div class="form-group input-group">
														<input class="form-control" type="text" name="material[{{$mat->number.'_'.$mat->lote.'_'.$mat->quantidade.'_'.$mat->unidade}}]" title="{{$mat->number}}" value="0">
												    </div>
												</td>
												<td>{{$mat->unidade}}</td>																									
											</tr>
											<tr class="tr-note">
												<td colspan="8" class="td-note">
													<div class="comment">
											            <textarea class="textinput" placeholder="Adicione uma nota à linha" name="noteinput[{{$mat->number}}]"></textarea>
											        </div>
											    </td>																									
											</tr>
										@endforeach
										<tfoot>
											<tr>
												<td colspan="11">
													<div class="form-group">
														<!--button type="submit" class="btn btn-block btn-info">Confirmar</button-->
														<button type="button" class="btn btn-block btn-info" data-toggle='modal' data-target='#confirmSendRefund' data-title="{{$document->ft_number}}">Confirmar</button>
                                                        <a class="btn btn-block btn-warning" href="/cliente/{{$cliente->alias}}/devolucoes" role="button">Voltar Atrás</a>
													</div>
												</td>
											</tr>
										</tfoot> 
										<input type="hidden" name="ft_number" value="{{$document->ft_number}}">
										<input type="hidden" name="doc_number" value="{{$devolucao_id}}">
									</form>
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
