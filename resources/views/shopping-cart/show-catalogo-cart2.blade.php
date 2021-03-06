@extends('layouts.index')

@section('template_title')
    Catálogo
@endsection

@section('template_linked_css') 
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css"-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
      html 
      {
          scroll-behavior: smooth;
      }

      .hovereffect 
      {
          box-shadow: 5px 5px 20px 0 rgba(0,0,0,.1);
          width: 100%;
          float: left;
          overflow: hidden;
          position: relative;
          text-align: left;
          cursor: default;
          padding: 10px;
          -webkit-transition: all 1s ease;
          -moz-transition: all 1s ease;
          transition: all 1s ease;
          border: 2px solid transparent;
      }
      .hovereffect.activated{
        border: solid 2px #93ba1f;
      }
      .hovereffect:hover 
      {
          box-shadow: 5px 5px 20px 0 rgba(0,0,0,.4);
      }
      .card-body {
          -ms-flex: 1 1 auto;
          flex: 1 1 auto;
          padding: 0.25rem;
      }
      .card-body h5,.card-body h4{
        font-size: .9rem;
      }
      .btn.is-checked 
      {
        background-color: #93ba1f;
        color: white;
      }
      .card-img {
          border-bottom-left-radius: 0px;
          border-bottom-right-radius: 0px;
          height: 100%;
      }
      #loading {
          display: block;
          position: absolute;
          top: 0;
          left: 0;
          z-index: 9999;
          width: 100%;
          height: 100vh;
          background: rgba(255, 255, 255, 0.8);
      }
      .loading-center {
          position: absolute;
          top: 3%;
          left: 45%;
      }
      .list-inline-item:not(:last-child) {
          margin-right: 0rem;
      }
      .add-to-cart{
        background-color: #94BB1E;
        transition: all 1s ease;
        border-color:#759419;
      }
      .add-to-cart:hover {
        color: #fff;
        background-color: #759419;
        border-color: #759419;
      }
      .has-search .form-control {
        padding-left: 1.8rem;
      }
      .has-search .form-control-feedback {
        position: absolute;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
      }
      .form-group .form-control {
        height: auto;
      }
      .li-text{
        font-size: .8rem;
      }
      .card-body p, .card-body ul{
        margin-bottom: .5rem;
      }
      .text-info{
        font-size: 1.5rem;
        color:#212529 !important;
      }
      .text-unit{
        font-size: 1.4rem;
        color:#212529 !important;
      }
      .card-icon{
        width: 15px;
        height: 15px;
      }
      /* SIDEBAR STYLE---------------------------------- */
      .wrapper {
          display: flex;
          align-items: stretch;
      }
      #sidebar {
          min-width: 180px;
          max-width: 180px;
          background: #343a40;
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
      #sidebar ul{
        width: 100%;
      }
      #sidebar ul li a {
          text-align: center;
          border-bottom: 1px solid rgba(0,0,0,.6);
          cursor: pointer;
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
          border-radius: 0;
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
      /*********************************/
      .page-item.active .page-link {
          z-index: 1;
          color: #ffffff;
          background-color: #93ba1f;
          border-color: #93ba1f;
      }
      .page-link {
          color: #343a40;
          background-color: #fff;
          border: 1px solid #dee2e6;
      }
      .page-link:hover {
          color: #343a40;
          text-decoration: none;
          background-color: #e9ecef;
          border-color: #dee2e6;
      }
      .btn-group.special {
        display: flex;
      }

      .special .btn {
        flex: 1
      }
    </style>
    <style type="text/css">
      #sidebar .btn-header.disabled {
          color: #333 !important;
          background-color: #FFF;
          border-color: #343a40;
          opacity: 1;
      }
      #sticky-control{
        background: #FFF;
        left: 0;
      }
      .filter-conservacao .btn:not(.is-checked){
        border: 1px solid #333;
      }
      @media (max-width: 991.98px){
        .btn-filter {
          font-size: .8rem;
          width: 24%;
          padding: .375rem 0rem;
        }
        .sticky{
          left: 0;
        } 
        #sticky-control{
          top: 76px;
          box-shadow: 0 4px 2px -2px gray;
          margin-right: -15px !important;
          margin-left: -15px !important;
        }             
      }
      @media (max-width: 767.98px){
          #sticky-control{
            top: 58.81px;
            box-shadow: 0 4px 2px -2px gray;
            margin-right: -15px !important;
            margin-left: -15px !important;
          }  
      }
    </style>
    <style type="text/css">
      .md-form .search-input{
        -webkit-box-sizing: content-box;
        box-sizing: content-box;
        background-color: transparent;
        border: 0;
        border-bottom: 1px solid #ced4da;
        border-radius: 0;
        outline: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
        -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
        transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
      }
      .pag-div {
          justify-content: center!important;
      }
    </style>
    <!-- Latest compiled and minified CSS -->
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"-->
    <style type="text/css">
      .sidebar-menu a:hover {
          color: #93ba1F;
          text-decoration: underline;
      }
      .panel {
          /*background-color: #343a40;*/
          background-color: #FFF;
          border: 1px solid rgba(0,0,0,.07);
          border-radius: .25rem;
          -webkit-box-shadow: 0 1px 5px rgba(0,0,0,.1);
          box-shadow: 0 1px 5px rgba(0,0,0,.1);
      }
      .panel-heading {
        padding: .5rem;
        margin: 0;
      }
      .panel-heading h3 {
          font-family: 'FSMe-Bold';
          font-size: .9167rem;
          -moz-font-feature-settings: "kern" 20;
          -webkit-font-feature-settings: "kern" 20;
          font-feature-settings: "kern" 20;
          font-kerning: normal;
          color: #FFF;
      }
      .panel-heading h3 {
          margin-top: 5px;
      }
      .heading h1:after, .panel-heading h1:after, .heading h2:after, .panel-heading h2:after, .heading h3:after, .panel-heading h3:after, .heading h4:after, .panel-heading h4:after, .heading h5:after, .panel-heading h5:after, .heading h6:after, .panel-heading h6:after {
          content: " ";
          display: block;
          width: 100%;
          height: 2px;
          margin-top: .6rem;
          background: #93ba1f;
      }
      .heading h1:before, .panel-heading h1:before, .heading h2:before, .panel-heading h2:before, .heading h3:before, .panel-heading h3:before, .heading h4:before, .panel-heading h4:before, .heading h5:before, .panel-heading h5:before, .heading h6:before, .panel-heading h6:before {
          content: " ";
          display: block;
          width: 100%;
          height: 2px;
          margin: .6rem 0rem;
          background: #93ba1f;
      }
      .panel-body {
          /*padding: 0 1.25rem 1.25rem 1.25rem;*/
          padding: .5rem;
      }
      .topmenu.nav-pills > a 
      {
        background-color: #93BA1F;
        color: #FFF;
      }
      .nav-pills .show>.nav-link {
          color: #fff !important;
          background-color: #444242 !important;
      }
      .topmenu .nav-link.active {
        background: #93ba1f !important;
        color: #FFFFFF !important;
      }
      .topmenu .nav-link.active:hover {
          color: #fff;
          background-color: #759419 !important;
          border-color: #759419;
      }
      .topmenu .nav-link {
        background: transparent !important;
        color: #444242 !important;
        webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
        box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
        -webkit-transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out,background-color .15s ease-in-out, border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out,background-color .15s ease-in-out, border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        transition: color .15s ease-in-out,background-color .15s ease-in-out, border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
        background: linear-gradient(40deg,#d3d3d3,#eee) !important;
      }
      .topmenu > .nav-link:not(.active):hover {
          color: #93BA1F !important;
          text-decoration: underline;
          background: linear-gradient(40deg,#eee,#fff) !important;
      }
      .nav-link.sub-link.active {
          color: #93ba1f !important;
          background-color: #fff;
          font-weight: 400;
          text-decoration: underline;
      }
      .category-menu a.nav-link {
          /*font-weight: 800 !important;
          font-size: .8333rem;*/
          font-family: 'FSMe-Bold';
          -moz-font-feature-settings: "kern" 20;
          -webkit-font-feature-settings: "kern" 20;
          font-feature-settings: "kern" 20;
          font-kerning: normal;
      }
      .category-menu a.nav-link {
          text-transform: uppercase;
          letter-spacing: .1em;
          font-weight: 700;
      }
      .nav-pills .nav-link {
          border-radius: 0;
      }
      .nav-link {
          padding: .5rem 1rem;
      }
      .category-menu a.sub-link {
          font-weight: 500 !important;
          font-size: .75rem;
          -moz-font-feature-settings: "kern" 10;
          -webkit-font-feature-settings: "kern" 10;
          font-feature-settings: "kern" 10;
          font-kerning: normal;
      }
      .family-menu .nav-link{
        color: #444242;
        border-bottom: 1px solid #93ba1f;
        padding: 10px 0px;
      }
      .products-number-display .btn-outline-secondary {
          color: #444242;
          border: 1px solid transparent;
          border-right: 1px solid #444242;
          border-radius: 0;
      }
      .products-number-display .btn-success.disabled, .products-number-display .btn-success:disabled {
          /*color: #fff;
          background-color: #93ba1f;
          border-color: #93ba1f;*/
          color: #93ba1f;
          text-decoration: underline;
          background-color: transparent;
          border-color: transparent;
      }
      .select2-container--classic .select2-selection--single .select2-selection__arrow {
        border-left: 0px solid #aaa;
        background-color: transparent;
        background-image: none;
      }
    </style>
    <style type="text/css">
        .center{
            width: 150px;
            margin: 40px auto; 
        }
        .active-cyan-2 input[type="text"]:not(.browser-default) {
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            background-color: transparent;
            border: 0;
            border-bottom: 1px solid #ced4da;
            border-radius: 0;
            outline: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
        }
        .active-cyan-2 input.form-control[type=text]:focus:not([readonly]) {
            border-bottom: 1px solid #93ba1f;
            box-shadow: 0 1px 0 0 #93BA1F;
        }
        .select2-container--classic .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #eee;
            color: #fff;
        }
        .select2-container--classic .select2-results__option--highlighted.select2-results__option--selectable[aria-selected="true"] {
            background-color: #93ba1f;
            color: #fff;
        }
        .topmenu .btn:hover, .topmenu .btn:focus, .topmenu .btn:active
        {
          outline: 0;
          -webkit-box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18), 0 4px 15px 0 rgba(0,0,0,0.15);
          box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18), 0 4px 15px 0 rgba(0,0,0,0.15);
        }
        .btn-outline-secondary:hover {
          color: #93ba1f;
          background-color: #f8f9fa;
        }
    </style>
    <!-- Custom CSS -->
    <style>
        /* collapsed sidebar styles */
        /*
         * Off Canvas
         * --------------------------------------------------
         */
        @media screen and (max-width: 991px) 
        {
          .row-offcanvas {
            position: relative;
            -webkit-transition: all 0.4s ease-out;
            -moz-transition: all 0.4s ease-out;
            transition: all 0.4s ease-out;
          }
          .row-offcanvas-left #sidebarLeft {
            left: -40%;
            display: none;
          }
          .row-offcanvas-left.active {
            left: 40%;
          }
          .sidebar-offcanvas {
            position: absolute;
            top: 0;
            width: 40%;
            margin-left: 10px;
          }
          .row-offcanvas-left.active #sidebarLeft{
            display: block !important;
          }
        }
        @media screen and (max-width: 400px) 
        {
          .category-menu a.sub-link {
            font-size: .5rem;
          }
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
  <div class="container products filters font-pantone">
    <span id="status"></span>
    <div class="row">
      <div class="col-md-12">
        <div id="fixed1" class="page-header">
          <h1 class="d-inline-block align-middle">CATÁLOGO</h1>
          <h6 style="font-size: .8rem;">Os preços apresentados são por KG ou por UN. Os artigos com valor ao KG têm peso variável, só após a sua pesagem poderemos aferir o valor total da sua encomenda.</h6> 
          <h6 style="font-size: .8rem;">Aos preços apresentados acresce a taxa legal em vigor na RAM. Salvo erro tipográfico ou rutura de stock. Se tiver dúvidas ou necessitar de ajuda, <a href="/faq">contacte-nos.</a></h6>
        </div>
      </div>
    </div>
    <div class="sticky-top">
      <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-lg-2 order-1 order-md-0 sidebar-offcanvas d-md-none d-lg-block" id="sidebarLeft" role="navigation">
            <!-- MENUS AND FILTERS-->
            <div class="panel panel-default sidebar-menu rounded-0 text-center">
              <div class="panel-heading" style="background: #343A40; border-bottom: 1px solid #eee">
                @if(isset($search_title))
                  <h3 class="h4 panel-title"> {{$search_title}}</h3>
                @else
                  <h3 class="h4 panel-title"> FAMÍLIAS</h3>
                @endif
              </div>
              <div class="panel-body">
                <?php echo $sidebar; ?>
              </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-10 order-0 order-md-1" id="main">
          <!-- Search form -->
          <form class="form-inline mb-3" role="search" method="get" action="/catalogo-cart/pesquisa">
            {{ csrf_field() }}
            <div class="col-1 col-md-1 px-0">
              <button class="btn btn-primary btn-xs d-md-block d-lg-none data-toggle rounded-0" type="button" style="background-color: #343a40; border-color: #343a40;">
                <i class="fas fa-bars" style="color:#93ba1f;"></i>
              </button>
            </div>
            <div class="input-group md-form form-sm form-1 pl-lg-0 active-cyan-2 col-11 col-md-11 col-lg-12" style="width: 100%;">
              <div class="input-group-prepend">
                <span class="input-group-text purple lighten-3 border-0" id="basic-text1" style="background-color: transparent;">
                  <i class="fas fa-search text-secondary" aria-hidden="true"></i>
                </span>
              </div>
              <input name="_search" class="form-control input-search" type="text" placeholder="Pesquisar..." aria-label="Pesquisar..." style="padding: 1px 1px;">
            </div>
          </form>
          <nav class="nav nav-pills nav-fill mb-3 topmenu">
            <?php echo $topbar; ?>
          </nav>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <nav class="navbar navbar-light bg-light mb-3" >
                <div class="col-6 col-xs-4 col-md-4 col-md-4 col-lg-4 col-xl-4 float-left">
                  <b>{{ $products->lastItem() }}</b>&nbsp; de &nbsp;<b>{{ $products->total() }}</b>&nbsp; <span class="d-md-inline-block d-lg-inline-block d-xl-inline-block">produtos</span>
                </div>
                <div class="col-6 col-xs-4 col-md-4 col-lg-4 col-xl-4 float-sm-right"><?php echo $display_menu; ?></div>
                <div class="col-12 col-xs-4 col-md-4 col-lg-4 col-xl-4">
                  <div class="form-row">
                      <label for="staticSort" class="col-6 col-sm-4 col-form-label d-md-none d-lg-none d-xl-inline-block float-right float-md-none" style="line-height: 1;font-size: 14px;">Ordenar por:</label>
                      <div class="col-6 col-sm-8">
                        <select class="form-control-sm catalogoSortBy" id="catalogoSortBy" name="sort_by" onchange="location = this.value;"><?php echo $select; ?></select>
                      </div>
                    </div>
                  </div>
              </nav>
            </div>
          </div>

          @include('shopping-cart.show-catalogo-result2')
        </div>
      </div>       
    </div>
  </div>
@endsection

@section('footer_scripts')

@stop


