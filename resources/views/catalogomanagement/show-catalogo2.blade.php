@extends('layouts.index')

@section('template_title')
    Catálogo
@endsection

@section('template_linked_css') 
<style type="text/css">
    .subfamily-sidebar{
        color: #000!important;
        background-color: #f1f1f1!important;
    }
    .catalogo-menu-item{
        position: relative;
        height: 200px;
    }
	.filterable {
		display: none; /* Hidden by default */
	}

	/* The "show" class is added to the filtered elements */
	.show {
	  display: block;
	}
	/* Add a light grey background on mouse-over */
	.btn:hover {
	  background-color: #ddd;
	}

	/* Add a dark background to the active button */
	.btn.active {
	  background-color: #94bb1e;
	  color: white;
	}

	.product-wrapper{
		-webkit-transition: all 1s ease;
		-moz-transition: all 1s ease;
		transition: all 1s ease;
	}
	.product-wrapper:hover, .product-wrapper:hover .card-body{
		background: #E8E8E8;
	}
	.product-wrapper, .card-body{
		-webkit-transition: all 1s ease;
		-moz-transition: all 1s ease;
		transition: all 1s ease;
	}
	.img-hover-zoom {
	  height: 330px;
	  overflow: hidden; 
	}
	.img-hover-zoom img {
	  transition: transform .5s ease;
	}
	.img-hover-zoom:hover img {
	  transform: scale(1.5);
	}
	.btn {
	    background-color: #ddd;
	    color: #212529;
	    text-decoration: none;
	}
</style>
@endsection

@section('content')
<div class="container">
	<div class="page-header">
	   	<h1 class="text-h1">Catálogo</h1><small class="text-muted">Explore nossa Coleção completa de Produtos</small>
	</div>
</div>
<!-- Control buttons -->
<div class="container">
	<div class="row">
		<div class="col-md-12 mb-3">
			<div id="filterContainer">
				<button class="btn btn-filter active" onclick="filterSelection('all')"> Mostrar todos</button>
				<button class="btn btn-filter" onclick="filterSelection('congelados')"><i class="far fa-snowflake text-primary"></i> Congelados</button>
				<button class="btn btn-filter" onclick="filterSelection('refrigerados')"><i class="fas fa-temperature-low text-primary"></i> Refrigerados</button>
				<button class="btn btn-filter" onclick="filterSelection('ambiente')"><i class="fas fa-bacon text-primary"></i> Ambiente</button>
			</div>
		</div>
	</div>
</div>



<!--div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div id="filterContainer">
                <button class="btn btn-filter active" onclick="filterSelection('all')"> Mostrar todos</button>
                <button class="btn btn-filter" onclick="filterSelection('congelados')"><i class="far fa-snowflake text-primary"></i> Congelados</button>
                <button class="btn btn-filter" onclick="filterSelection('refrigerados')"><i class="fas fa-temperature-low text-primary"></i> Refrigerados</button>
                <button class="btn btn-filter" onclick="filterSelection('ambiente')"><i class="fas fa-bacon text-primary"></i> Ambiente</button>
            </div>
        </div>
    </div>
</div-->
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="filters button-group js-radio-button-group">
                <button class="button is-checked" data-filter="*">show all</button>
                <button class="button" data-filter=".metal">metal</button>
                <button class="button" data-filter=".transition">transition</button>
                <button class="button" data-filter="ium">–ium</button>
            </div>
        </div>
    </div>
</div>

<div class="container h-10" id="content">
    <div class="row h-100 mt-5">
        <aside class="col-md-2 subfamily-sidebar">
            <div class="mb-3" id="sidemenu">
                <ul class="nav flex-md-column flex-row justify-content-between">
                    <li class="nav-item py-1"><a href="#sec1" class="nav-link active pl-0">Aves</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Bovinos</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Caprinos</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Charcutaria</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Geral</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Gorduras Vegetais</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Lacticinios</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Mar</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">OvoProdutos</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Padaria</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Pré-Cozinhados</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Preparados de Carne</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Suinos</a></li>
                    <li class="nav-item py-1"><a href="#sec2" class="nav-link pl-0">Vegetais</a></li>
                </ul>
            </div>
        </aside>
        <main class="col py-5">
            <div class="row">
                <div class="col">
                    <div class="card-deck">
                        @foreach($products as $product)
                            @if($product->type === 'Congelado')
                                @php ($product->category = 'congelados')
                            @endif
                            @if($product->type === 'Ambiente')
                                @php ($product->category = 'ambiente')
                            @endif
                            @if($product->type === 'Refrigerado')
                                @php ($product->category = 'refrigerados')
                            @endif
                            <div class="fade col-sm-12 col-md-6 col-lg-4 product-wrapper filterable {{$product->category}}">
                                <div class="card mb-4">
                                    <div class="img-hover-zoom">
                                        <a data-fancybox="gallery" href="{{$product->url}}" title="{{$product->name}}" data-caption="{{$product->name}}">
                                            <img  class="card-img" alt="{{$product->name}}" src="{{$product->url}}">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title" style="height: 85px">{{$product->name}}</h4>
                                        <small class="text-muted cat">
                                            <span>
                                                @if($product->type === 'Congelado')
                                                    <i class="far fa-snowflake text-primary"></i> {{$product->type}}
                                                @endif
                                                @if($product->type === 'Ambiente')
                                                    <i class="fas fa-bacon text-primary"></i> {{$product->type}}
                                                @endif
                                                @if($product->type === 'Refrigerado')
                                                    <i class="fas fa-temperature-low text-primary"></i> {{$product->type}}
                                                @endif   
                                            </span>
                                            <span class="float-right"><i class="fas fa-barcode text-primary"></i> {{$product->number}}</span>
                                        </small>
                                        <div class="views text-muted float-left"><i class="far fa-clone text-info"></i> {{$product->subtype}}</div>
                                        <div class="views text-muted float-right"><i class="far fa-clock text-info"></i> {{$product->updated_at}}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection

@section('footer_scripts')
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script>
        //FILTER ELEMENTS
        $('.card-deck').isotope({
          // options
          itemSelector: '.filterable',
          layoutMode: 'fitRows'
        });
    </script>
@endsection
