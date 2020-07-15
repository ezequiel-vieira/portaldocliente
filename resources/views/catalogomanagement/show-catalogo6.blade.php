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
            /*height: 300px;*/
            overflow: hidden; 
        }
        .element-item .card-body 
        {
            padding-top: 0;
            padding-bottom: 0;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
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
            text-align: center;
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
            max-width: none;
            width: calc(100% + 20px);
            -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
            transition: opacity 0.35s, transform 0.35s;
            -webkit-transform: translate3d(-10px,0,0);
            transform: translate3d(-10px,0,0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
          }

          .hovereffect:hover img {
            opacity: 0.4;
            filter: alpha(opacity=40);
          }

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
    </style>
    <style type="text/css">
        /* Controls
        ---------------------------------------------------------------------- */

        .controls {
            padding: 1rem;
            background: #333;
            font-size: 0.1px;
        }

        .control-group {
            display: inline-block;
            margin-left: .75rem;
            vertical-align: top;
        }

        .control {
            position: relative;
            display: inline-block;
            width: 2.7rem;
            height: 2.7rem;
            background: #444;
            cursor: pointer;
            font-size: 0.1px;
            color: white;
            transition: background 150ms;
        }

        .control-text {
            width: auto;
            font-size: .9rem;
            padding: 0 1rem;
            font-family: 'helvetica-neue', arial, sans-serif;
            font-weight: 700;
        }

        .control:not(.mixitup-control-active):hover {
            background: #3f3f3f;
        }

        .control-sort:after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            border-top: 2px solid;
            border-left: 2px solid;
            top: calc(50% - 6px);
            left: calc(50% - 6px);
            transform:  translateY(2px) rotate(45deg);
        }

        .control-sort[data-sort*=":desc"]:after {
            transform:  translateY(-3px) rotate(-135deg);
        }

        .mixitup-control-active {
            background: #393939;
        }

        .control:first-of-type {
            border-radius: 3px 0 0 3px;
        }

        .control:last-of-type {
            border-radius: 0 3px 3px 0;
        }

        .select-wrapper {
            display: inline-block;
            padding: .5rem;
            background: #2a2a2a;
            margin-left: .75rem;
            vertical-align: top;
        }
      /* Target Elements
      ---------------------------------------------------------------------- */
      .mix,
      .gap {
          display: inline-block;
          vertical-align: top;
      }
      .mix {
          background: #fff;
          border-top: .5rem solid currentColor;
          border-radius: 2px;
          margin-bottom: 1rem;
          position: relative;
          margin-right: 10px;
      }
      .mix .card-title {
        font-size: 1.25rem;
        color: #333;
      }
      .card-title {
          margin-bottom: 0.3rem;
          overflow: hidden;
          -webkit-transition: all 1s ease;
          -moz-transition: all 1s ease;
          transition: all 1s ease;
      }
      .mix:before {
          content: '';
          display: inline-block;
          /*padding-top: 56.25%;*/
      }

      .mix.ambiente {
          color: #91e6c7;
      }

      .mix.refrigerados {
          color: #d595aa;
      }

      .mix.congelados {
          color: #5ecdde;
      }

      /* Grid Breakpoints
      ---------------------------------------------------------------------- */

      /* 2 Columns */

      .mix,
      .gap {
          width: calc(100%/2 - (((2 - 1) * 1rem) / 2));
      }

      /* 3 Columns */

      @media screen and (min-width: 541px) {
          .mix,
          .gap {
              width: calc(100%/3 - (((3 - 1) * 1rem) / 3));
          }
      }

      /* 4 Columns */

      @media screen and (min-width: 961px) {
          .mix,
          .gap {
              width: calc(100%/4 - (((4 - 1) * 1rem) / 4));
          }
      }

      /* 5 Columns */

     /* @media screen and (min-width: 1281px) {
          .mix,
          .gap {
              width: calc(100%/5 - (((5 - 1) * 1rem) / 5));
          }
      }*/
      #catalogo_grid {
        padding: 1rem;
        text-align: justify;
        font-size: 0.1px;
      }

      #catalogo_grid:after {
        content: ''; 
        display: inline-block; 
        width: 100%; 
      }
      .card-img {
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        height: auto;
      }
    </style>
@endsection

@section('content')
<div class="">
    <div class="container">
      <div id="fixed" class="page-header pt-3">
        <button type="button" id="sidebarCollapse" class="btn d-inline-block d-lg-none btn-sidebar"><i class="fas fa-align-left"></i><span class="sidebar-button"> Abrir Menu</span></button>
        <h1 class="d-inline-block align-middle">Catálogo</h1> 
        <small class="d-block ">Explore nossa Coleção de Produtos</small>      
      </div>
    </div>
</div>
<div class="wrapper container filters">
    <!-- desktop sidebar  -->
    <nav id="sidebar" class="subfamily-sidebar active pb-3 d-none d-sm-none d-lg-block">
        <div class="sticky-top">
          <div class="btn-group-vertical button-group js-radio-button-group" role="group" data-filter-group="color">
            <input class="form-control input-sm mb-1 quicksearch2 rounded-0" type="text" placeholder="Filtrar">
            <ul class="list-unstyled" style="margin: 0">
              <li>
                <a class="btn button material-link btn-label label-btn" role="button" aria-disabled="true" style="text-align: center;">CONSERVAÇÃO</a>
              </li>

              <li><a class="btn btn-primary button material-link" role="button" aria-pressed="false" autocomplete="off" data-toggle=".ambiente">AMBIENTE</a></li>
              <li><a class="btn btn-primary button material-link" role="button" aria-pressed="false" autocomplete="off" data-toggle=".congelados">CONGELADO</a></li>
              <li><a class="btn btn-primary button material-link" role="button" aria-pressed="false" autocomplete="off" data-toggle=".refrigerados">REFRIGERADO</a></li>
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
    <div id="content" class="col col-top">
      <!--div class="row">
        <div class="col-md-12">
          <form class="controls">
            <fieldset data-filter-group="color" class="select-wrapper">
              <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off" data-toggle=".ambiente">Ambiente</button>
              <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off" data-toggle=".congelados">Congelado</button>
              <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off" data-toggle=".refrigerados">Refrigerado</button>
            </fieldset>

            <fieldset data-filter-group="size" class="select-wrapper">
                    <button data-toggle=".aves">Aves</button>
                    <button data-toggle=".bovinos">Bovinos</button>
                    <button data-toggle=".caprinos">Caprinos</button>
            </fieldset>
          </form>
        </div>
      </div-->

      <div class="row">
          <div class="col-md-12">
              <div class="grid mix-grid" id="catalogo_grid" style="text-align: justify;">
                @isset($prod_grid)
                <?php echo $prod_grid; ?>
                <div class="gap"></div>
                <div class="gap"></div>
                <div class="gap"></div>
                <div class="gap"></div>
                @endisset
              </div>
          </div>
      </div>
    </div>
</div>

@endsection
@section('footer_scripts')
  <script src="../js/mixitup.min.js"></script>
  <script src="../js/mixitup-multifilter.js"></script>
  <script>
          
      var containerEl = document.querySelector('.mix-grid');

      var mixer = mixitup(containerEl, {
          multifilter: {
              enable: true
          },
          animation: {
              effects: 'fade translateZ(-100px)'
          }
      });

      // Add a delegated click event handler to the container

      containerEl.addEventListener('click', handleContainerClick);

      function handleContainerClick(e) {
          var color, size, shape;
          var target = e.target;

          // If the clicked element is not a target, do not handle

          if (!target.matches('.mix')) return;

          // Build up a selector for each group using the data attributes present on the target

          color = '.' + target.getAttribute('data-color');
          size  = '.' + target.getAttribute('data-size');
          shape = '.' + target.getAttribute('data-shape');

          // Set the active filter

          mixer.setFilterGroupSelectors('color', color);
          mixer.setFilterGroupSelectors('size', size);
          mixer.setFilterGroupSelectors('shape', shape);

          // Now that each group has been udpated, parse the filter groups and filter the container

          mixer.parseFilterGroups();
      }
  </script>
@endsection

