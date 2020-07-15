@extends('layouts.index')

@section('template_title')
    Catálogo
@endsection

@section('template_linked_css') 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <style type="text/css">
        html 
        {
            scroll-behavior: smooth;
        }
        .color-shape{
            transform:translate3d(0,0,0);
            -webkit-transform:translate3d(0,0,0);
            -moz-transform:translate3d(0,0,0);
        }
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
            padding: 0 5px;
            vertical-align: top;
            background-color: #f1f1f1;
        }
        .btn {
            background-color: #ddd;
            color: #212529;
            text-decoration: none;
        }
        .button {
            width: 100% !important;
            display: inline-block;
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
        /*******/
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
        /**desktop sidebar**/
        .fa-barcode {
            margin-left: 0rem;
        }
        .btn-group, .btn-group-vertical 
        {
            display: block;
        }
      .material-link 
      {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            font-weight: 300;
            line-height: 1.4em;
            color: #999;
      }
      /* SIDEBAR STYLE---------------------------------- */
      .wrapper {
          display: flex;
          align-items: stretch;
      }
      #sidebar {
          min-width: 180px;
          max-width: 180px;
          background: #7386D5;
          color: #fff;
          transition: all 0.3s;
      }
      #sidebar.active {
          min-width: 109px;
          max-width: 109px;
          text-align: center;
      }
      #sidebar.active .sidebar-header h3,
      #sidebar.active .CTAs {
          display: none;
      }
      #sidebar.active .sidebar-header strong {
          display: block;
      }
      #sidebar ul li a {
          text-align: center;
      }
      #sidebar.active ul li a {
          padding: 5px;
          text-align: center;
          font-size: 0.75em;
      }
      #sidebar.active ul li a i {
          margin-right: 0;
          display: block;
          margin-bottom: 5px;
      }
      #sidebar.active ul ul a {
          padding: 10px !important;
      }
      #sidebar.active .dropdown-toggle::after {
          top: auto;
          bottom: 10px;
          right: 50%;
          -webkit-transform: translateX(50%);
          -ms-transform: translateX(50%);
          transform: translateX(50%);
      }
      #sidebar .sidebar-header {
          padding: 20px;
          background: white;
          border: 1px solid #93ba1f;
      }
      #sidebar .sidebar-header strong {
          display: none;
          font-size: 1.8em;
      }
      #sidebar ul.components {
          padding: 20px 0;
          border-bottom: 1px solid #47748b;
      }
      #sidebar ul li .material-link {
          padding: 10px;
          margin: 0;
          font-size: 0.9em;
          display: block;
      }
      #sidebar ul li a:hover {
          color: #93ba1f;
          background: #fff;
      }
      #sidebar ul li a.is-checked:hover {
          color: white;
          background: #93ba1f;
          text-decoration: underline;
      }
      #sidebar ul li a i {
          margin-right: 10px;
      }
      /**Mobile sidebar**/
      /* ---------------------------------------------------
          SIDEBAR STYLE
      ----------------------------------------------------- */
        #mobsidebar {
            width: 200px;
            position: fixed;
            top: 0;
            left: -200px;
            height: 100vh;
            z-index: 999;
            background:#343a40;
            color: #fff;
            transition: all 0.3s;
            overflow-y: scroll;
            box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
        }
        #mobsidebar.active {
            left: 0;
        }
        #dismiss {
            width: 100%;
            height: 35px;
            line-height: 35px;
            text-align: center;
            background: white;
            position: absolute;
            top: 76px;
            right: 10px;
            cursor: pointer;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            color:#333;
        }
        #dismiss:hover {
            background: #fff;
            color: #93ba1f;
        }
        .overlay2 {
            display: none;
            top: 0;
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            z-index: 998;
            opacity: 0;
            transition: all 0.5s ease-in-out;
        }
        .btn-sidebar{
            transition: 0.5s;
            border:1px solid #b2b2b2;
        }
        .sidebar-button{
            display: none;
            transition: 0.5s;

        }
        .btn-sidebar:hover .sidebar-button{
            display: inline-block;
            transition: 0.5s;
            padding-left: 10px;
        }
        .overlay2.active {
            display: block;
            opacity: 1;
        }
        #mobsidebar .sidebar-header {
            padding: 10px;
            background: #eee;
            background-image: linear-gradient( to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.2) );
        }
        #mobsidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }
        #mobsidebar ul p {
            color: #fff;
            padding: 10px;
        }
        #mobsidebar ul li a {
            padding: 10px;
            font-size: 1.1em;
            display: block;
        }
        #mobsidebar ul li a:hover {
            color: #7386D5;
            background: #fff;
        }

        @media screen and (max-width: 991px) 
        {
            #fixed {
                position:fixed;
                width:inherit;
                max-width:inherit;
                background:white;
                padding-top: 100px;
                z-index: 995;
            }
            .page-header {
                margin: 0px;
            }
            .col-top{
               margin-top: 150px;
            }
        }
        /**LOADING**/
        .sk-fading-circle {
          margin: 100px auto;
          width: 40px;
          height: 40px;
          position: relative;
        }

        .sk-fading-circle .sk-circle {
          width: 100%;
          height: 100%;
          position: absolute;
          left: 0;
          top: 0;
        }

        .sk-fading-circle .sk-circle:before {
          content: '';
          display: block;
          margin: 0 auto;
          width: 15%;
          height: 15%;
          background-color: #333;
          border-radius: 100%;
          -webkit-animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
                  animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
        }
        .sk-fading-circle .sk-circle2 {
          -webkit-transform: rotate(30deg);
              -ms-transform: rotate(30deg);
                  transform: rotate(30deg);
        }
        .sk-fading-circle .sk-circle3 {
          -webkit-transform: rotate(60deg);
              -ms-transform: rotate(60deg);
                  transform: rotate(60deg);
        }
        .sk-fading-circle .sk-circle4 {
          -webkit-transform: rotate(90deg);
              -ms-transform: rotate(90deg);
                  transform: rotate(90deg);
        }
        .sk-fading-circle .sk-circle5 {
          -webkit-transform: rotate(120deg);
              -ms-transform: rotate(120deg);
                  transform: rotate(120deg);
        }
        .sk-fading-circle .sk-circle6 {
          -webkit-transform: rotate(150deg);
              -ms-transform: rotate(150deg);
                  transform: rotate(150deg);
        }
        .sk-fading-circle .sk-circle7 {
          -webkit-transform: rotate(180deg);
              -ms-transform: rotate(180deg);
                  transform: rotate(180deg);
        }
        .sk-fading-circle .sk-circle8 {
          -webkit-transform: rotate(210deg);
              -ms-transform: rotate(210deg);
                  transform: rotate(210deg);
        }
        .sk-fading-circle .sk-circle9 {
          -webkit-transform: rotate(240deg);
              -ms-transform: rotate(240deg);
                  transform: rotate(240deg);
        }
        .sk-fading-circle .sk-circle10 {
          -webkit-transform: rotate(270deg);
              -ms-transform: rotate(270deg);
                  transform: rotate(270deg);
        }
        .sk-fading-circle .sk-circle11 {
          -webkit-transform: rotate(300deg);
              -ms-transform: rotate(300deg);
                  transform: rotate(300deg); 
        }
        .sk-fading-circle .sk-circle12 {
          -webkit-transform: rotate(330deg);
              -ms-transform: rotate(330deg);
                  transform: rotate(330deg); 
        }
        .sk-fading-circle .sk-circle2:before {
          -webkit-animation-delay: -1.1s;
                  animation-delay: -1.1s; 
        }
        .sk-fading-circle .sk-circle3:before {
          -webkit-animation-delay: -1s;
                  animation-delay: -1s; 
        }
        .sk-fading-circle .sk-circle4:before {
          -webkit-animation-delay: -0.9s;
                  animation-delay: -0.9s; 
        }
        .sk-fading-circle .sk-circle5:before {
          -webkit-animation-delay: -0.8s;
                  animation-delay: -0.8s; 
        }
        .sk-fading-circle .sk-circle6:before {
          -webkit-animation-delay: -0.7s;
                  animation-delay: -0.7s; 
        }
        .sk-fading-circle .sk-circle7:before {
          -webkit-animation-delay: -0.6s;
                  animation-delay: -0.6s; 
        }
        .sk-fading-circle .sk-circle8:before {
          -webkit-animation-delay: -0.5s;
                  animation-delay: -0.5s; 
        }
        .sk-fading-circle .sk-circle9:before {
          -webkit-animation-delay: -0.4s;
                  animation-delay: -0.4s;
        }
        .sk-fading-circle .sk-circle10:before {
          -webkit-animation-delay: -0.3s;
                  animation-delay: -0.3s;
        }
        .sk-fading-circle .sk-circle11:before {
          -webkit-animation-delay: -0.2s;
                  animation-delay: -0.2s;
        }
        .sk-fading-circle .sk-circle12:before {
          -webkit-animation-delay: -0.1s;
                  animation-delay: -0.1s;
        }

        @-webkit-keyframes sk-circleFadeDelay {
          0%, 39%, 100% { opacity: 0; }
          40% { opacity: 1; }
        }

        @keyframes sk-circleFadeDelay {
          0%, 39%, 100% { opacity: 0; }
          40% { opacity: 1; } 
        }
        .hovereffect 
        {
          width: 100%;
          height: 100%;
          float: left;
          overflow: hidden;
          position: relative;
          /*text-align: center;*/
          cursor: default;
        }

        .hovereffect .overlay {
          width: 100%;
          height: 100%;
          position: absolute;
          overflow: hidden;
          top: 0;
          left: 0;
          padding: 50px 20px;
        }

        .hovereffect img {
          display: block;
          position: relative;
        /*  max-width: none;
          width: calc(100% + 20px);
          -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
          transition: opacity 0.35s, transform 0.35s;
          -webkit-transform: translate3d(-10px,0,0);
          transform: translate3d(-10px,0,0); */
          -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
        }

        /*.hovereffect:hover img {
          opacity: 0.4;
          filter: alpha(opacity=40);
        }*/

        .hovereffect a, .hovereffect p {
          color: #000;
          opacity: 0;
          filter: alpha(opacity=0);
          webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
          transition: opacity 0.35s, transform 0.35s;
        }

        .hovereffect:hover a, .hovereffect:hover p {
          opacity: 1;
          filter: alpha(opacity=100);
        }
        .loading_input {    
            background-color: #ffffff;
            background-image: url("http://loadinggif.com/images/image-selection/3.gif");
            background-size: 20px 20px;
            background-position:right center;
            background-repeat: no-repeat;
        }

        .card-img {
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
            height: 100%;
        }
        .img-hover-zoom {
            height: 100%;
            overflow: hidden;
        }
        .product-item-link {
            font-size: 1rem;
            line-height: 25px;
            color: #4a4a4a;
            margin: 0;
            font-weight: 500;
        }
        #catalogo_grid:hover .element-item{
          opacity:0.5;
        }
        #catalogo_grid .element-item:hover{
          opacity:1;
        }

    </style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Catálogo</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="fixed" class="page-header pt-3">
            <button type="button" id="sidebarCollapse" class="btn d-inline-block d-lg-none btn-sidebar"><i class="fas fa-align-left"></i><span class="sidebar-button"> Abrir Menu</span></button>
            <h1 class="d-inline-block align-middle">Catálogo</h1> 
            <small class="d-block ">Explore nossa Coleção de Produtos</small>      
          </div>
        </div>
      </div>
    </div>
</div>
<div class="wrapper container filters">
    <!-- Mobile Sidebar  -->
    <nav id="mobsidebar" class="subfamily-sidebar filters">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
            <span>Fechar</span>
        </div>
        <div class="sidebar-header" style="position:relative;margin-top: 120px;">
            <input class="form-control input-sm mb-1 quicksearch1 rounded-0" type="text" placeholder="Filtrar Produtos">
        </div>
        <div class="flex-md-column flex-row justify-content-between" id="sidemenu">
            <div class="btn-group-vertical button-group js-radio-button-group" role="group" data-filter-group="color" style="width: 200px;">
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
    </nav>
    <!-- desktop sidebar  -->
    <nav id="sidebar" class="subfamily-sidebar active pb-3 d-none d-sm-none d-lg-block">
        <div class="sticky-top">
          <div class="btn-group-vertical button-group js-radio-button-group" role="group" data-filter-group="color">
            <input class="form-control input-sm mb-1 quicksearch2 rounded-0" type="text" placeholder="Filtrar">
            <ul class="list-unstyled" style="margin: 0">
              <li><a class="btn button material-link btn-label label-btn" role="button" aria-disabled="true" style="text-align: center;">CONSERVAÇÃO</a> </li>
              <li><a class="btn button material-link  is-checked" role="button" data-filter="">TODOS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".ambiente">AMBIENTE</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".congelados">CONGELADO</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".refrigerados">REFRIGERADO</a></li>
            </ul>
          </div>
          <div class="btn-group-vertical button-group js-radio-button-group" role="group" data-filter-group="shape">
            <ul class="family-list list-unstyled" style="text-align: center;margin: 0">
              <li><a class="btn button material-link btn-label label-btn" role="button" aria-disabled="true" style="text-align: center;">FAMILIA</a> </li>
              <li><a class="btn button material-link  is-checked" role="button" data-filter="">TODAS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".aves">AVES</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".bovinos">BOVINOS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".caprinos">CAPRINOS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".charcutaria">CHARCUTARIA</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".geral">GERAL</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".gorduras-vegetais">GORDURAS VEGETAIS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".lacticinios">LACTICINIOS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".mar">MAR</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".ovoprodutos">OVOPRODUTOS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".padaria">PADARIA</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".pre-cozinhados">PRE-COZINHADOS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".preparados-de-carne">PREPARADOS DE CARNE</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".suinos">SUINOS</a></li>
              <li><a class="btn button material-link " role="button" data-filter=".vegetais">VEGETAIS</a></li>
            </ul>
          </div>
        </div>
    </nav>
    <!-- Page Content  -->
    <div id="content" class="col col-top" style="background-color: #f1f1f1; padding-top: 10px;">
      <div id="loading">
        <div class="sk-fading-circle">
          <div class="sk-circle1 sk-circle"></div>
          <div class="sk-circle2 sk-circle"></div>
          <div class="sk-circle3 sk-circle"></div>
          <div class="sk-circle4 sk-circle"></div>
          <div class="sk-circle5 sk-circle"></div>
          <div class="sk-circle6 sk-circle"></div>
          <div class="sk-circle7 sk-circle"></div>
          <div class="sk-circle8 sk-circle"></div>
          <div class="sk-circle9 sk-circle"></div>
          <div class="sk-circle10 sk-circle"></div>
          <div class="sk-circle11 sk-circle"></div>
          <div class="sk-circle12 sk-circle"></div>
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
    </div>
</div>
  @include('modals.modal-price-consult')
@endsection
@section('footer_scripts')
    <!--script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script-->
    <script src="https://unpkg.com/isotope-layout@2/dist/isotope.pkgd.min.js"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
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
              filter: function() {
                var $this = $(this);
                var searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
                var buttonResult = buttonFilter ? $this.is( buttonFilter ) : true;
                return searchResult && buttonResult;
              },
            });

            $('.filters').on( 'click', '.button', function(e) 
            {
                e.preventDefault();
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
            var $quicksearch = $('.quicksearch1').keyup( debounce( function() 
            {
                var clean_val = RemoveAccents($quicksearch.val());

                qsRegex = new RegExp( clean_val,'gi');

                $grid.isotope();
            }) );

            var $quicksearch2 = $('.quicksearch2').keyup( debounce( function() 
            {
                var clean_val = RemoveAccents($quicksearch2.val());

                qsRegex = new RegExp( clean_val,'gi');

                $( "input.quicksearch2" ).addClass( "loading_input");

                $grid.isotope();

                $grid.on( 'arrangeComplete', function( event, filteredItems ) {
                  console.log( filteredItems.length );
                  $( "input.quicksearch2" ).removeClass( "loading_input");
                });
            }));

            var button_group = $('.button-group');

            var button_element = button_group.length;

            for (var i=0; i<button_element; i++) 
            {
                button_group.on( 'click', '.button', function() {
                    button_group.find('.is-checked').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                });
            }
            // change is-checked class on buttons
            /*$('.button-group').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', '.button', function() {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                });
            });*/
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

        function RemoveAccents(str) {
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

            $("#mobsidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay2').on('click', function () {
                $('#mobsidebar').removeClass('active');
                $('.overlay2').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#mobsidebar').addClass('active');
                $('.overlay2').addClass('active');
            });            

            $("#mobsidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay2').on('click', function () {
                $('#mobsidebar').removeClass('active');
                $('.overlay2').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#mobsidebar').addClass('active');
                $('.overlay2').addClass('active');
            });
        });
    </script>
    @include('scripts.price-consult-modal-script')
    <script type="text/javascript" src="/js/mousetip.js"></script>
    <script type="text/javascript">
      let mouseTip = new MouseTip();
      mouseTip.start();
    </script>
@endsection

