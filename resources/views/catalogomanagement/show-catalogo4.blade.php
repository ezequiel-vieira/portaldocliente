@extends('layouts.index')

@section('template_title')
    Catálogo
@endsection

@section('template_linked_css') 
<style type="text/css">
    .subfamily-sidebar
    {
        color: #000!important;
        background-color: #f1f1f1!important;
    }
    .catalogo-menu-item{
        position: relative;
        height: 200px;
    }
    .subfamily-sidebar .btn.active {
      background-color: #94bb1e;
      color: white !important;
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
      height: 300px;
      overflow: hidden; 
    }

    .element-item .card-body 
    {
      padding-top: 0;
      padding-bottom: 0;
      padding-left: 1.25rem;
      padding-right: 1.25rem;
    }
    /*.img-hover-zoom img {
      transition: transform .5s ease;
    }
    .img-hover-zoom:hover img {
      transform: scale(1.5);
    }*/
    .btn {
        background-color: #ddd;
        color: #212529;
        text-decoration: none;
    }
    .button {
        width: 160px !important;
        display: inline-block;
        padding: 0.5em 1.0em;
        background: #EEE;
        border: none;
        border-radius: 7px;
        background-image: linear-gradient( to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.2) );
        color: #222;
        font-size: 16px;
        cursor: pointer;
    }
    .btn-label{
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: underline;
    }
    .button:hover {
      background-color: #8CF;
      text-shadow: 0 1px hsla(0, 0%, 100%, 0.5);
      color: #222;
    }

    .subfamily-sidebar .button:active,
    .subfamily-sidebar .button.is-checked {
      background-color: #94bb1e;
    }
    .subfamily-sidebar .button.is-checked {
      color: white;
      text-shadow: 0 -1px hsla(0, 0%, 0%, 0.8);
    }
    .subfamily-sidebar .button:active {
      box-shadow: inset 0 1px 10px hsla(0, 0%, 0%, 0.8);
    }
    .subfamily-sidebar .button-group:after {
      content: '';
      display: block;
      clear: both;
    }
    .subfamily-sidebar .button-group .button {
      float: left;
      border-radius: 0;
      margin-left: 0;
      margin-right: 1px;
    }
    .subfamily-sidebar .label-btn {
      pointer-events: none;
      background: #b2b2b2;
    }
    .subfamily-sidebar .sticky-top {
        position: -webkit-sticky;
        position: sticky;
        top: 75px;
        z-index: 1020;
    }
    #loading {
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 100;
      width: 100%;
      height: 100vh;
      background: rgba(255, 255, 255, 1);
    }
    .loading-center {
        position: absolute;
        top: 3%;
        left: 45%;
    }
    .subfamily-sidebar .dropdown-item {
        padding: .25rem 0rem;
    }
    .element-item .card-title{
      font-size: 1.25rem;
    } 
</style>
<style>
  .subfamily-sidebar .sidenav a, .subfamily-sidebar .dropdown-btn {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    font-size: 20px;
    color: #818181;
    display: block;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    outline: none;
  }
  .subfamily-sidebar .sidenav a:hover, .subfamily-sidebar .dropdown-btn:hover {
    color: #000;
  }
  .subfamily-sidebar .dropdown-container {
    width: 160px;
    display: none;
    background-color: #FFF;
    padding-left: 0px;
    text-align: center;
    overflow-x: visible;
  }
  .subfamily-sidebar .dropdown-container:hover {
    overflow: visible;
  }
  .subfamily-sidebar .fa-caret-down {
    float: right;
    padding-right: 8px;
  }
  .subfamily-sidebar .dropdown-item:focus, .subfamily-sidebar .dropdown-item:hover {
      color: #16181b;
      text-decoration: none;
      background-color: #b2b2b2;
  }

  @media screen and (max-height: 450px) 
  {
    .subfamily-sidebar .sidenav {padding-top: 15px;}
    .subfamily-sidebar .sidenav a {font-size: 18px;}
  }
</style>
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="text-h1">Catálogo</h1>
        <small class="text-muted">Explore nossa Coleção de Produtos</small>
    </div>
</div>
<div class="container h-10" id="content">
    <div class="row h-100 filters">
        <aside class="col-md-2 subfamily-sidebar py-3">
            <div class="flex-md-column flex-row justify-content-between sticky-top" id="sidemenu">
                <input class="form-control input-sm mb-1 quicksearch rounded-0" type="text" placeholder="Filtrar Produtos">
                <div class="btn-group-vertical button-group js-radio-button-group" role="group" data-filter-group="color">
                    <button type="button" class="btn btn-link button btn-label label-btn" aria-disabled="true" >CONSERVAÇÃO</button>
                    <button type="button" class="btn btn-link button is-checked" data-filter="">TODOS</button>
                    <button type="button" class="btn btn-link button" data-filter=".ambiente">AMBIENTE</button>
                    <button type="button" class="btn btn-link button" data-filter=".congelados">CONGELADO</button>
                    <button type="button" class="btn btn-link button" data-filter=".refrigerados">REFRIGERADO</button>
                </div>
                <div class="btn-group-vertical button-group js-radio-button-group" role="group" data-filter-group="shape">
                    <button type="button" class="btn btn-info button btn-label label-btn" aria-disabled="true" >FAMILIA</button>
                    <button type="button" class="btn btn-link button is-checked checked" data-filter="">TODAS</button>
                    <button id="aves_button" type="button" class="btn btn-link button" data-filter=".aves">AVES</button>
                    <button type="button" class="btn btn-link button " data-filter=".bovinos">BOVINOS</button>
                    <button type="button" class="btn btn-link button " data-filter=".caprinos">CAPRINOS</button>
                    <button type="button" class="btn btn-link button " data-filter=".charcutaria">CHARCUTARIA</button>
                    <button type="button" class="btn btn-link button " data-filter=".geral">GERAL</button>
                    <button type="button" class="btn btn-link button " data-filter=".gorduras-vegetais">GORDURAS VEGETAIS</button>
                    <button type="button" class="btn btn-link button " data-filter=".lacticinios">LACTICINIOS</button>
                    <button type="button" class="btn btn-link button " data-filter=".mar">MAR</button>
                    <button type="button" class="btn btn-link button " data-filter=".ovoprodutos">OVOPRODUTOS</button>
                    <button type="button" class="btn btn-link button " data-filter=".padaria">PADARIA</button>
                    <button type="button" class="btn btn-link button " data-filter=".pre-cozinhados">PRE-COZINHADOS</button>
                    <button type="button" class="btn btn-link button " data-filter=".preparados-de-carne">PREPARADOS DE CARNE</button>
                    <button type="button" class="btn btn-link button " data-filter=".suinos">SUINOS</button>
                    <button type="button" class="btn btn-link button " data-filter=".vegetais">VEGETAIS</button>
                </div>
            </div>
        </aside>
        <main class="col">
            <div id="loading">
                <div class="loading-center">
                    <span>Carregando</span>
                    <div class="text-center">
                        <img src="images/loading_64.gif"/>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-md-12">
                    <div class="grid" id="catalogo_grid" style="opacity: 0">
                      @isset($prod_grid)
                      <?php echo $prod_grid; ?>
                      @endisset
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection

@section('footer_scripts')
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script type="text/javascript">

        $(document).ready( function() 
        {
            // store filter for each group
            var buttonFilters = {};
            var buttonFilter;
            // quick search regex
            var qsRegex;

            // init Isotope
            var $grid = $('.grid').isotope({
              itemSelector: '.color-shape',
              //filter: '.aves',
              filter: function() {
                var $this = $(this);
                var searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
                var buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
                return searchResult && buttonResult;
               
              },
            });

            $('.filters').on( 'click', '.button', function() 
            {
                var $this = $(this);
                // get group key
                var $buttonGroup = $this.parents('.button-group');
                var filterGroup = $buttonGroup.attr('data-filter-group');
                // set filter for group
                buttonFilters[ filterGroup ] = $this.attr('data-filter');
                // combine filters
                buttonFilter = concatValues( buttonFilters );
                // Isotope arrange
                $grid.isotope();
            });

            // use value of search field to filter
            var $quicksearch = $('.quicksearch').keyup( debounce( function() 
            {
                var clean_val = RemoveAccents($quicksearch.val());

                qsRegex = new RegExp( clean_val,'gi');

                $grid.isotope();
            }) );

            // change is-checked class on buttons
            $('.button-group').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', 'button', function() {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                });
            });
        });

        $(window).on('load', function () 
        {
            jQuery('#catalogo_grid').css('opacity', '1');
            jQuery("#loading").hide();
        });

        // flatten object by concatting values
        function concatValues( obj ) 
        {
          var value = '';
          for ( var prop in obj ) 
          {
            value += obj[ prop ];
          }
          return value;
        }

        function RemoveAccents(str) 
        {
          var accents    = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÕÖØòóôõöøÈÉÊËèéêëðÇçÐÌÍÎÏìíîïÙÚÛÜùúûüÑñŠšŸÿýŽž';
          var accentsOut = "AAAAAAaaaaaaOOOOOOOooooooEEEEeeeeeCcDIIIIiiiiUUUUuuuuNnSsYyyZz";
          str = str.split('');
          var strLen = str.length;
          var i, x;
          for (i = 0; i < strLen; i++) {
            if ((x = accents.indexOf(str[i])) != -1) {
              str[i] = accentsOut[x];
            }
          }
          return str.join('');
        }

        /*String.prototype.removeAccents = function()
        {
          return this
          .toLowerCase()
          .replace(/[áàãâä]/gi,"a")
          .replace(/[éèëê]/gi,"e")
          .replace(/[íìïî]/gi,"i")
          .replace(/[óòöôõø]/gi,"o")
          .replace(/[úùüû]/gi, "u")
          .replace(/[ç]/gi, "c")
          .replace(/[ñ]/gi, "n")
          .replace(/[^a-zA-Z0-9]/g," ");
        }*/

        // debounce so filtering doesn't happen every millisecond
        function debounce( fn, threshold ) 
        {
          var timeout;
          threshold = threshold || 100;
          return function debounced() {
            clearTimeout( timeout );
            var args = arguments;
            var _this = this;
            function delayed() 
            {
              fn.apply( _this, args );
            }
            timeout = setTimeout( delayed, threshold );
          };
        }
    </script>
@endsection
