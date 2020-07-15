@extends('layouts.index')

@section('template_title')
    Catálogo
@endsection

@section('template_linked_css') 
<style type="text/css">
    .card-title{
        color: #444444;
        text-shadow: 1px 0px 1px #CCCCCC, 0px 1px 1px #EEEEEE, 2px 1px 1px #CCCCCC, 1px 2px 1px #EEEEEE, 3px 2px 1px #CCCCCC, 2px 3px 1px #EEEEEE, 4px 3px 1px #CCCCCC, 3px 4px 1px #EEEEEE, 5px 4px 1px #CCCCCC, 4px 5px 1px #EEEEEE, 6px 5px 1px #CCCCCC, 5px 6px 1px #EEEEEE, 7px 6px 1px #CCCCCC;
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
    .card-img{
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<div class="container">
	<div class="page-header">
	   	<h1 class="text-h1">Catálogo</h1><small class="text-muted">Explore nossa Coleção completa de Produtos</small>
	</div>
</div>
<div class="container">
    <div class="row">
        <div class="card-deck">
            <div class="card bg-dark text-white catalogo-menu-item mt-3 mb-3">
              <img class="card-img" src="images/carne-ambiente.jpeg" alt="Card image">
              <div class="card-img-overlay">
                <h5 class="card-title">AMBIENTE</h5>
              </div>
            </div>
            <div class="card bg-dark text-white catalogo-menu-item mt-3 mb-3">
              <img class="card-img" src="images/carne-congelada.jpg" alt="Card image">
              <div class="card-img-overlay">
                <h5 class="card-title">CONGELADOS</h5>
              </div>
            </div>
            <div class="card bg-dark text-white catalogo-menu-item mt-3 mb-3">
              <img class="card-img" src="images/carne-refrigerada.jpg" alt="Card image">
              <div class="card-img-overlay">
                <h5 class="card-title">REFRIGERADOS</h5>
              </div>
            </div>
        </div>
    </div>
</div>

@endsection

