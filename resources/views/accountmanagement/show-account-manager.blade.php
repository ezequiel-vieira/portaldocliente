@extends('layouts.index')

@section('template_title')
    Conta Corrente
@endsection

@section('template_linked_css') 
<style type="text/css">
	
</style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Conta Corrente</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="container">
	<div class="page-header"><h1>{{$cliente->name}}</h1><small class="text-muted">Conta Corrente</small></div>
	<div class="jumbotron jumbotron-cc">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg">
				<div class="square-item">
					<div class="tile-icon-cc text-center">
                        <!--i class="fas fa-euro-sign fa-3x" style="color:#00a9e0;"></i-->
                        <img src="/images/icons/Icon_Preco_Azul.png" width="50">
                        <h2 class="tile-title-cc">Conta Corrente</h2>
                    </div>
				</div>  
			</div>
			<div class="col-sm-12 col-md-12 col-lg">
				<div class="square-item">
					<h6>Total em dívida</h6>
					<h4 class="text-dark">€ {{number_format($saldo_total, 2, ',', '.')}}</h4>
					<small class="text-muted">O Cliente deve € {{number_format($saldo_total, 2, ',', '.')}}</small>  
				</div>  
			</div>
			<div class="col-sm-12 col-md-12 col-lg">
				<div class="square-item">
					<h6>Dentro do Prazo</h6>
					<h4 class="text-success">€ {{number_format($saldo_prazo, 2, ',', '.')}}</h4>
					<!--small class="text-muted">O Cliente deverá pagar € {{number_format($saldo_prazo, 2, ',', '.')}}</small-->
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg">
				<div class="square-item no-border">
					<h6>Vencido</h6>
					<h4 class="text-danger">€ {{number_format($saldo_vencido, 2, ',', '.')}}</h4> 
				</div>		  
			</div>
		</div>
	</div>
	<div class="jumbotron jumbotron-cc">
		<div class="table-wrapper-cc">
			<div class="row">
				<div class="col-sm">
					<div class="table-responsive-md">
						<table class="table table-striped table-hover">
						    <thead>
								<tr>
									<th>#</th>
									<th class="d-none d-sm-none d-md-table-cell">Tipo</th>
									<th>Número</th>
									<th><span title="Data Documento">Data Doc.</span></th>
									<th><span title="Data Pagamento">Data Pag.</span></th>
									<th class="text-right">Valor</th>
								</tr>
						    </thead>
						    <tbody>
						    	@foreach($docs as $doc)
									<tr class="{{$doc->row_class}}">
										<td>{{$loop->iteration}}</td>
										<td><span class="badge {{$doc->badge_class}}" title="{{$doc->doc_type}}">{{$doc->doc_tag}}</span></td>
										<td>{{$doc->doc_number}}</td>
										<td>{{$doc->doc_date}}</td>
										<td>{{$doc->payment_date}}</td>
										<td class="text-right">{{number_format($doc->doc_value, 2, ',', '.')}}€</td> 
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

@endsection

@section('footer_scripts')

@endsection
