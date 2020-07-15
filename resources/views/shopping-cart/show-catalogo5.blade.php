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
      .card-body {
          -ms-flex: 1 1 auto;
          flex: 1 1 auto;
          padding: 0.25rem;
          padding-bottom: 30px;
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
            <div id="fixed1" class="page-header pt-3">
               <h1 class="d-inline-block align-middle">Catálogo</h1> 
              <small class="d-block ">Explore nossa Coleção de Produtos</small>
            </div>
          </div>
        </div>
      </div>
  </div>
  <div class="container products">
      <span id="status"></span>
      <div class="row">
          @foreach($products as $product) 
              <div class="col-xs-18 col-sm-6 col-md-3">
                  <div class="thumbnail">
                      <div class="img-hover-zoom">
                        <a data-fancybox="gallery" href="{{$product->url}}" title="{{ $product->name.' - '.$product->price.'€'}}" data-caption="{{ $product->name.' - '.$product->price.'€ / '.$product->unity}}">
                            <img  class="card-img" alt="{{$product->name}}" src="{{$product->url}}"  width="500" height="300">
                        </a>
                      </div>
                      <div class="caption">
                          <h5 style="height: 80px;">{{ $product->name }}</h5>
                          <p><strong>Preço: </strong> <span class="text-info"><strong>@isset($product->price) {{ $product->price.'€ / '.$product->unity }} @endisset</strong></span></p>
                          <div class="card-body">
                            <span class="float-left" style="font-size: .8rem;">
                              @php
                                    switch ($product->type) 
                                    {
                                      case 'Congelado':
                                          $products_grid = strtoupper($product->type);
                                          break;
                                      case 'Ambiente':
                                          $products_grid = strtoupper($product->type);
                                          break;
                                      case 'Refrigerado':
                                          $products_grid = strtoupper($product->type);
                                          break;
                                    }

                                    echo $products_grid;

                              @endphp
                            </span>
                            <span class="float-right" title="{{ $product->name }}" style="font-size: .8rem;">{{ $product->number }}</span>
                          </div>
                          <p class="btn-holder"><a href="javascript:void(0);" data-id="{{ $product->id }}" class="btn btn-warning btn-block text-center add-to-cart" role="button">Adicionar</a>
                              <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                          </p>
                      </div>
                  </div>
              </div>
          @endforeach
      </div><!-- End row -->
  </div>
@endsection
@section('footer_scripts')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    @include('scripts.price-consult-modal-script')

    <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            ele.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-id"),
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });
    </script>
@stop

