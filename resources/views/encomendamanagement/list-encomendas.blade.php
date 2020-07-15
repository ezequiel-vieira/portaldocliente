@extends('layouts.index')

@section('template_title')
    Encomendas
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
        .btn-danger{
            color: #fff;
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-danger:hover{
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css" rel="stylesheet">
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Encomendas</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
	<div class="container">
		<div class="page-header">
            <h1>{{$cliente->name}}</h1>
            <small class="text-muted">Encomendas ( {{$total}} )</small>
        </div>
        <div class="jumbotron jumbotron-cc">
			<div class="table-wrapper-cc">
				<div class="row">
					<div class="col-sm">
						<div class="table-responsive-md">
                            <table class="table table-striped table-hover table-encomendas" data-toggle="table" data-pagination="true" data-search="true" data-locale="pt-PT" data-toolbar="#toolbar">
							    <thead>
									<tr>
										<th data-sortable="true" data-field="row">#</th>
										<th data-sortable="true" data-field="VBELN">Documento</th>
										<th data-sortable="true" data-field="ERDAT"><span title="Data Documento">Data Doc.</span></th>
										<th data-sortable="true" data-field="NETWR">Valor</th>
										<th>Ver +</th>
									</tr>
							    </thead>
                                <tbody>
                                    @if(!empty($encomendas))
                                        @foreach($encomendas as $encomenda)
                                            <tr class="">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ltrim($encomenda['VBELN'],'0')}}</td>
                                                <td>{{$encomenda['ERDAT']}}</td>
                                                <td>€ {{$encomenda['NETWR']}}</td>
                                                <td><a href="/cliente/{{$cliente->alias}}/encomenda/{{ $encomenda['VBELN'] }}">Ver Artigos</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
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
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.15.5/locale/bootstrap-table-pt-PT.min.js"></script>
    <script type="text/javascript">
        $('.table-encomendas').bootstrapTable({
            
            /*formatSearch: function () {
                return 'Filtrar...'
            },
            formatShowingRows: function () {
                pageFrom = true; 
                pageTo = true; 
                totalRows = true;
                return 'Mostrando %s até %s de %s rows'
            }*/
        });
    </script>
@endsection
