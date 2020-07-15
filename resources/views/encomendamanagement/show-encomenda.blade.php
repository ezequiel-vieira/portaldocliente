@extends('layouts.index')

@section('template_title')
    Encomendas
@endsection

@section('head')
    
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
        <li class="breadcrumb-item"><a href="/cliente/{{$cliente->alias}}/encomendas"><span>Encomendas</span></a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$encomenda_id}}</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
	<div class="container">
		<div class="page-header">
			<h1>{{$cliente->name}}</h1>
			<small class="text-muted">Encomenda - {{$encomenda_id}}</small>
		</div>
        <div class="jumbotron jumbotron-cc">
            <div class="table-wrapper-cc">
                <div class="row">
                    <div class="col-sm">
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
                                    </tr>
                                </thead>
                                <tbody id="list-wrapper">
                                        @foreach($mats as $mat)
                                            <tr class="">
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$mat['MATNR']}}</td>
                                                <td>{{$mat['ARKTX']}}</td>
                                                <td>{{$mat['CHARG']}}</td>
                                                <td>{{$mat['LFIMG']}}</td>
                                                <td>{{$mat['MEINS']}}</td>                                                                                              
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
