@extends('layouts.index')

@section('template_title')
    Catálogo
@endsection

@section('template_linked_css') 
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css"-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
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
        font-size: 1rem;
      }
      .card-body p, .card-body ul{
        margin-bottom: .5rem;
      }
      .text-info{
        font-size: 2rem;
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
          color: #93ba1f;
          background-color: #343a40;
          border-color: #343a40;
      }
      .page-link {
          color: #93ba1f;
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
  <div class="container products filters">
      <span id="status"></span>
      <div class="row">
        <div class="col-md-12">
          <div id="fixed1" class="page-header pt-3">
            <h1 class="d-inline-block align-middle">Catálogo</h1>
            <h6 style="font-size: .8rem;">Os preços apresentados são por KG ou por UN. Os artigos com valor ao KG têm peso variável, só após a sua pesagem poderemos aferir o valor total da sua encomenda.</h6> 
            <h6 style="font-size: .8rem;">Aos preços apresentados acresce a taxa legal em vigor na RAM. Salvo erro tipográfico ou rutura de stock. Se tiver dúvidas ou necessitar de ajuda, <a href="/faq">contacte-nos.</a></h6>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div id="fixed1" class="page-header pt-3" style="margin: 10px 0 10px;">
            <small class="d-block ">Explore nossa Coleção de Produtos:</small>
          </div>
        </div>
      </div>
      <!-- Control buttons -->
      <div class="d-block d-sm-block d-md-block d-lg-none mb-3 mx-auto sticky-top" id="sticky-control">
        <div class="btn-group special filter-button-group mb-2 filter-conservacao filter-mobile">
            <button type="button" class="col-3 btn button btn-filter rounded-0 is-checked" data-filter="all"><span class="d-none d-sm-none">Ver</span> Todos</button>
            <button type="button" class="col-3 btn button btn-filter rounded-0" data-filter="ambiente"><i class="fas fa-temperature-low text-primary d-none d-sm-none"></i> Ambiente</button>
            <button type="button" class="col-3 btn button btn-filter rounded-0" data-filter="congelado"><i class="fas fa-snowflake text-primary d-none d-sm-none"></i> Congelados</button>
            <button type="button" class="col-3 btn button btn-filter rounded-0" data-filter="refrigerado"><i class="fas fa-tint text-primary d-none d-sm-none"></i> Refrigerados</button>
        </div>
        <div class="btn-group button-group js-radio-button-group" role="group" style="width: 100%;">
          <div class="form-group has-search mb-2" style="width: 100%;">
            <input type="text" minlength="3" class="form-control input-sm quicksearch1 input-mobile rounded-0" placeholder="Pesquisar.." style="background-clip: border-box;border: 1px solid #6c757d;background-color: rgba(255,255,255,1);padding-left: 0rem;text-align: center; ">
            <button type="submit" class="btn btn-info btn-block btn-sm rounded-0 btn-search"><i class="fa fa-search"></i> Pesquisar</button>
            <button type="submit" class="btn btn-warning btn-block btn-sm rounded-0 btn-search-clear" style="display:none;">Limpar <i class="fa fa-search"></i></button>
          </div>
        </div>
      </div>
      <div class="wrapper">
        <nav id="sidebar" class="subfamily-sidebar active pb-3 d-none d-sm-none d-md-none d-lg-block">
          <div class="sticky-top" style="top: 80px;">
            <div class="btn-group-vertical button-group js-radio-button-group" role="group">
              <div class="form-group has-search">
                <input type="text" minlength="3" class="form-control input-sm quicksearch1 quicksearch2 rounded-0" placeholder="Pesquisar.." style="background-clip: border-box;border: 1px solid #6c757d;background-color: rgba(255,255,255,1);padding-left: 0rem;text-align: center; ">
                <button type="submit" class="btn btn-info btn-block btn-sm rounded-0 btn-search"><i class="fa fa-search"></i> Pesquisar</button>
                <button type="submit" class="btn btn-warning btn-block btn-sm rounded-0 btn-search-clear" style="display:none;">Limpar <i class="fa fa-search"></i></button>
              </div>
            </div>
            <div class="button-group js-radio-button-group conservacao-group filter-group" role="group" data-code="conservacao" data-filter-group="color">
              <ul class="list-unstyled filter-conservacao" style="text-align: center;margin: 0">
                <li><a class="btn button material-link btn-label label-btn btn-header disabled" role="button" aria-disabled="true" style="text-align: center;">CONSERVAÇÃO</a> </li>
                <li><a class="btn button material-link btn-filter is-checked" role="button" data-filter="all">TODOS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="ambiente">AMBIENTE</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="congelado">CONGELADO</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="refrigerado">REFRIGERADO</a></li>
              </ul>
            </div>
            <div class="btn-group-vertical button-group js-radio-button-group familia-group filter-group" role="group" data-code="familia" data-filter-group="shape">
              <ul class="family-list list-unstyled filter-familia " style="text-align: center;margin: 0">
                <li><a class="btn button material-link btn-label label-btn btn-header disabled" role="button" aria-disabled="true" style="text-align: center;">FAMILIA</a> </li>
                <li><a class="btn button material-link btn-filter is-checked" role="button" data-filter="all">TODAS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="aves">AVES</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="bovinos">BOVINOS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="caprinos">CAPRINOS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="charcutaria">CHARCUTARIA</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="gelados-e-sobremesas">GELADOS E SOBREMESAS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="geral">GERAL</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="gorduras-vegetais">GORDURAS VEGETAIS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="lacticinios">LACTICÍNIOS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="mar">PEIXE E MARISCO</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="ovoprodutos">OVOS LÍQUIDOS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="padaria">PÃO E FOLHADOS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="pre-cozinhados">PRÉ-COZINHADOS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="preparados-de-carne">HAMBURGUERES E SALSICHAS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="suinos">SUÍNOS</a></li>
                <li><a class="btn button material-link btn-filter" role="button" data-filter="vegetais">FRUTAS E VEGETAIS</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div id="content" class="col col-top">
            @include('shopping-cart.show-catalogo-result')
        </div>
      </div>
  </div>
@endsection


