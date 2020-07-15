@extends('layouts.index')

@section('template_title')
    Novidades
@endsection

@section('template_linked_css') 
    <style type="text/css">
        .overlay-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 60%;
            background: rgba(0, 0, 0, 0);
            transition: background 0.5s ease;
        }

        .hovereffect:hover .overlay-image {
            display: block;
            background: rgba(0, 0, 0, .1);
        }
        .button-price {
            position: absolute;
            width: 100%;
            left:0;
            top: 100px;
            text-align: center;
            opacity: 0;
            transition: opacity .35s ease;
        }

        .button-price .btn-request-price{
            width: 200px;
            padding: 12px 48px;
            text-align: center;
            color: white;
            border: solid 2px white;
            z-index: 1;
        }

        .hovereffect:hover .button-price {
            opacity: 1;
        }


        .hovereffect 
        {
            box-shadow: 5px 5px 20px 0 rgba(0,0,0,.1);
        }
        .card-body{
            padding: 1rem 2.3rem 1rem;
        }
        .btn-filter
        {
            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            transition: all 1s ease;
        }
        .btn-filter:hover
        {
            background: #FFF;
            color:#93ba1f;
            border: 0px dotted #eee;
        }
        .btn.is-checked 
        {
    	  background-color: #93ba1f;
    	  color: white;
    	}
    	.product-wrapper
        {
    		-webkit-transition: all 1s ease;
    		-moz-transition: all 1s ease;
    		transition: all 1s ease;
    	}
    	.product-wrapper:hover, .product-wrapper:hover .card-body
        {
    		background: #E8E8E8;
    	}
    	.product-wrapper, .card-body
        {
    		-webkit-transition: all 1s ease;
    		-moz-transition: all 1s ease;
    		transition: all 1s ease;
    	}
    	.img-hover-zoom 
        {
            height: 300px;
            overflow: hidden; 
    	}
    	.img-hover-zoom .card-img 
        {
    	   transition: transform .5s ease;
    	}
    	.btn 
        {
            background-color: #ddd;
            color: #212529;
            text-decoration: none;
    	}
        .product-wrapper .card-title
        {
            font-size: 1.25rem;
        }
        .element-item .card-title 
        {
            font-size: 1.25rem;
        }
        .hovereffect 
        {
            width: 100%;
            height: 100%;
            float: left;
            overflow: hidden;
            position: relative;
            text-align: left;
            cursor: default;
        }
        .hovereffect .overlay
        {
            width: 100%;
            height: 100%;
            position: absolute;
            overflow: hidden;
            top: 0;
            left: 0;
            padding: 50px 20px;
        }
        .hovereffect .card-img 
        {
            display: block;
            position: relative;
            max-width: none;
            width: calc(100% + 20px);
            -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
            transition: opacity 0.35s, transform 0.35s;
            -webkit-transform: translate3d(-10px,0,0);
            transform: translate3d(-10px,0,0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }
        .hovereffect a, .hovereffect p {
            color: #000;
            opacity: 0;
            filter: alpha(opacity=0);
            webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
            transition: opacity 0.35s, transform 0.35s;
        }
        /*.hovereffect:hover a, .hovereffect:hover p {
          opacity: 1;
          filter: alpha(opacity=100);
        }
        #news_grid:hover .element-item{
          opacity:0.5;
        }
        #news_grid .element-item:hover{
          opacity:1;
        }*/
    </style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Novidades</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="container">
	<div class="page-header">
	   	<h1 class="text-h1">Novidades</h1><small class="text-muted">Explore as nossas últimas novidades</small>
	</div>
</div>
<!-- Control buttons -->
<div class="container">
	<div class="row">
		<div class="col-md-12 mb-3">
            <div class="button-group filter-button-group">
                <button class="btn btn-filter rounded-0 is-checked" data-filter="*">Mostrar Todos</button>
                <button class="btn btn-filter rounded-0" data-filter=".ambiente"><i class="fas fa-temperature-low text-primary"></i> Ambiente</button>
                <button class="btn btn-filter rounded-0" data-filter=".congelados"><i class="fas fa-snowflake text-primary"></i> Congelados</button>
                <button class="btn btn-filter rounded-0" data-filter=".refrigerados"><i class="fas fa-tint text-primary"></i> Refrigerados</button>
            </div>
		</div>
	</div>
</div>
<div class="container mt-3">
	<div class="row">
		<!-- Start of Card Deck Layout -->
		<div class="col-md-12">
            <div class="grid" id="news_grid">
            	@foreach($news as $new)
            		@if($new->type === 'Congelado')
            			@php ($new->category = 'congelados')
            		@endif
            		@if($new->type === 'Ambiente')
            			@php ($new->category = 'ambiente')
            		@endif
            		@if($new->type === 'Refrigerado')
            			@php ($new->category = 'refrigerados')
            		@endif
                    <div class="element-item color-shape col col-sm-12 col-md-6 col-lg-4 {{$new->category}}">
            			<div class="card mb-4 hovereffect">
            				<div class="img-hover-zoom">
                                <img  class="card-img" alt="{{$new->name}}" src="{{$new->url}}">
                                <div class="overlay-image"></div>
                                @if( $user->type <> 'admin' && $user->type <> 'guest')
                                    <div class="button-price">
                                        <button type="button" class="btn btn-info btn-request-price" data-toggle="modal" data-target="#confirmPriceConsult" data-title="{{$new->name}}" data-image="{{$new->url}}" data-codigo="{{$new->codigo}}" data-vendedor="{{$company['vendedor_nome']}}" data-vend_mail="{{$company['vendedor_email']}}">Consultar Preço</button>
                                    </div>
                                @endif
            				</div>
            				<div class="card-body">
            					<h4 class="card-title" style="height: 75px">{{$new->name}}</h4>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        @if($new->type === 'Congelado')
                                            <i class="far fa-snowflake" title="Conservação" style="color:#93ba1f;width: 20px; height:20px;"></i> {{$new->type}}
                                        @endif
                                        @if($new->type === 'Ambiente')
                                            <i class="fas fa-bacon" title="Conservação" style="color:#93ba1f;width: 20px; height:20px;"></i> {{$new->type}}
                                        @endif
                                        @if($new->type === 'Refrigerado')
                                            <i class="fas fa-temperature-low" title="Conservação" style="color:#93ba1f;width: 20px; height:20px;"></i> {{$new->type}}
                                        @endif  
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-barcode" title="Código de Produto" style="color:#93ba1f;width: 20px; height:20px;"></i> {{$new->codigo}}
                                    </li>
                                </ul>
            				</div>
            			</div>
            		</div>
            	@endforeach
            </div>
		</div>
	</div>
</div>
    @include('modals.modal-price-consult')
@endsection

@section('footer_scripts')
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function() 
        {
            // init Isotope
            var $grid = $('.grid').isotope({
              // options
            });
            // filter items on button click
            $('.filter-button-group').on( 'click', 'button', function() {
              var filterValue = $(this).attr('data-filter');
              $grid.isotope({ filter: filterValue });
            }); 

            // change is-checked class on buttons
            $('.button-group').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', '.btn', function() {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                });
            });
        });
    </script>
    @include('scripts.price-consult-modal-script')
@endsection
