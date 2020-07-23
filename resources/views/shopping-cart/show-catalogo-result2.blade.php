<?php 
//var_dump(session('cart2')); 
?>
<div class="row grid" style="min-height: 600px;" style="position: relative;">
    @foreach($products as $key => $product) 
      @if($product->type === 'Congelado')
        @php ($product->category = 'congelados')
      @endif
      @if($product->type === 'Ambiente')
        @php ($product->category = 'ambiente')
      @endif
      @if($product->type === 'Refrigerado')
        @php ($product->category = 'refrigerados')
      @endif
      <div class="element-item color-shape col-sm-12 col-md-6 col-lg-4 col-xl-4 mb-4 {{$product->category}}">
          <?php 
            $status = '';
            if (!empty(session('cart2'))) 
            {
              foreach (session('cart2') as $k => $v) 
              {
                if ($v['codigo'] === $product->number) {
                  
                  $status = 'activated';
                  break;
                }
              } 
            }
          ?>
          <div class="card mb-4 hovereffect h-100 {{$status}} rounded-0">
            <div class="img-hover-zoom">
                <a data-fancybox="gallery" href="{{$product->url}}" title="{{ $product->name.' - '.$product->preco.'€'}}" data-caption="{{ $product->name.' - '.$product->preco.'€ / KG'}}">
                  <img  class="card-img" loading="lazy" alt="{{$product->name}}" src="{{$product->url}}"  width="200" height="200">
                </a>
              <div class="overlay-image"></div>
            </div>
            <div class="card-body">
              <strong><h4 class="card-title" style="height: 35px; color: #212529"> {{$product->name}} </h4></strong>
              <div class="d-flex justify-content-between">
                <p class="col p-0">
                  <img class="card-icon" title="Código de Produto" alt="Código de Produto" src="/images/icons/icon-codigo-cinza.png" width="15" height="15">
                  @if (!empty($product->number))
                    <span class="li-text">{{mb_strtoupper($product->number)}}</span>
                  @else
                    <span class="li-text">- - -</span>
                  @endif
                </p>
                <p class="col p-0">
                  @if($product->type === 'Congelado')
                      <img class="card-icon" title="Congelado" alt="Congelado" src="/images/icons/icon-congelado-cinza.png" width="15" height="15"> 
                      <span class="li-text">{{mb_strtoupper($product->type)}}</span>
                  @endif
                  @if($product->type === 'Ambiente')
                      <img class="card-icon" title="Ambiente" alt="Ambiente" src="/images/icons/icon-ambiente-cinza.png" width="15" height="15"> 
                      <span class="li-text">{{mb_strtoupper($product->type)}}</span>
                  @endif
                  @if($product->type === 'Refrigerado')
                      <img class="card-icon" title="Refrigerado" alt="Refrigerado" src="/images/icons/icon-refrigerado-cinza.png" width="15" height="15">
                      <span class="li-text">{{mb_strtoupper($product->type)}}</span>
                  @endif 
                </p>
              </div>
              <div class="d-flex justify-content-between">
                <p class="col p-0">
                  <img class="card-icon" title="Marca do Produto" alt="Marca do Produto" src="/images/icons/icon-marca-cinza.png" width="15" height="15">
                  @if (!empty($product->brand))
                    <span class="li-text">{{mb_strtoupper($product->brand)}}</span>
                  @else
                    <span class="li-text">- - -</span>
                  @endif
                </p>
                <p class="col p-0">
                  <img class="card-icon" title="Origem" alt="Origem" src="/images/icons/icon-origem-cinza.png" width="15" height="15">
                  @if (!empty($product->origem))
                    <span class="li-text">{{mb_strtoupper($product->origem)}}</span>
                  @else
                    <span class="li-text">- - -</span>
                  @endif
                </p>
              </div>
              <div class="d-flex justify-content-between">
                <?php 
                  if (!empty($product->peso_un)) {
                ?>
                  <p class="col p-0">
                    <img class="card-icon" title="Peso por Unidade" alt="Peso por Unidade" src="/images/icons/icon-uni-embalagem-cinza.png" width="15" height="15">
                    @if (!empty($product->peso_un) && !is_null($product->peso_un))
                      <span class="li-text">{{$product->peso_un}} KG</span>
                    @else
                      <span class="li-text">- - -</span>
                    @endif
                  </p>                
                <?php
                  }elseif (empty($product->peso_un) && !empty($product->peso_cx)) {
                ?>
                  <p class="col p-0">
                    <img class="card-icon" title="Peso por Caixa" alt="Peso por Caixa" src="/images/icons/icon-uni-caixa-cinza.png" width="15" height="15">
                    @if (!empty($product->peso_cx) && !is_null($product->peso_cx))
                      <span class="li-text">{{$product->peso_cx}} KG</span>
                    @else
                      <span class="li-text">- - -</span>
                    @endif
                  </p>                
                <?php    
                  }
                ?>
                <?php 
                  if (!empty($product->doc_url)) {
                ?>
                  <p class="col p-0">
                    <a href="{{$product->doc_url}}" target="_blank"><i class="far fa-file-pdf" style="color: #ff0000;"><span class="li-text" style="color: #212529;"> <span>FICHA</span> TÉCNICA</span></i></a>
                  </p>
                <?php    
                  }
                ?>
              </div>
              <hr>
              <p><span class="text-info"><strong>@isset($product->preco) € {{ number_format($product->preco, 2) }} @endisset</strong></span>
                <span class="text-unit"><strong>@isset($product->preco) {{ ' /'.$product->unit }} @endisset</strong></span>
              </p>
               <hr>
              <div class="form-row mb-3">
                <div class="col-md-6">
                  <label for="quantity" class="quantity-selector">Quantidade</label>
                  <div class="input-group input-group-sm">
                      <div class="input-group-prepend">
                          <button type="button" class="btn btn-secondary btn-number rounded-0" disabled="disabled" data-type="minus" data-field="quant[1]">
                            <i class="fas fa-minus"></i>
                          </button>
                      </div>
                      <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10" style=" text-align: center; ">
                      <div class="input-group-append">
                          <button type="button" class="btn btn-success btn-number quantity rounded-0" data-type="plus" data-field="quant[1]">
                            <i class="fas fa-plus"></i>
                          </button>
                      </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <!--div class="form-group col-md-3 col-md-3 col-lg-12 col-xl-3">
                  <input inputmode="numeric" pattern="[1-9]*" value="1" min="1" max="99" type="text" maxlength="2" class="form-control numbers quantity"/> 
                </div-->
                <div class="form-group col-md-12 col-md-12 col-lg-12 col-xl-12">
                  <a href="javascript:void(0);" data-id="{{ $product->id }}" class="btn btn-block btn-success add-to-cart rounded-0" role="button">
                    <span>ADICIONAR
                    <?php 
                      if (!empty($product->peso_un)) {
                    ?> 
                      <span>UNIDADE</span>
                    <?php
                      }elseif (empty($product->peso_un) && !empty($product->peso_cx)) {
                    ?>
                      <span>CAIXA</span>
                    <?php    
                      }else{
                    ?>
                        <span>UNIDADE</span>
                    <?php
                      }
                    ?>
                    </span>
                  </a>
                </div>
              </div>
            </div>
        </div>
      </div>  
    @endforeach
</div><!-- End row -->
<div class="d-flex">
  <div class="mx-auto pag-div pagination-sm pagination-lg">
    {{ $products->appends(['conservacao' => $conservacao, 'familia' => $familia, 'sort_by' => $sort_by])->links() }}
  </div>
</div>

@section('footer_scripts')
    <!-- Start of  Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=8c2a3f10-72ad-40bf-ae67-8da6923471cf"> </script>
    <!-- GALLERY LIGHTBOX -->
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <!-- SEARCH -->
    <script type="text/javascript">
      var search_input;
      $(document).on('click', '.btn-search',function(event)
      {
        event.preventDefault();
        search_input = $(this).closest('div.has-search').find('input.quicksearch1');
        var search_query = $(this).closest('div.has-search').find('input.quicksearch1').val();
        if ( search_query.length < 3 ){
          alert('Erro. Tem que inserir no mínimo 3 caracteres.');
        }else{
          $.ajax({
              url: '?_search=' + search_query,
              method: "get",
              data: {_token: '{{ csrf_token() }}'},
              dataType: "html",
              success: function (products) {
                  var clean_uri = location.protocol + "//" + location.host + location.pathname;
                  window.history.replaceState({}, document.title, clean_uri);
                  search_input.value = '';
                  $('.btn-search-clear').fadeIn();
                  $('.conservacao-group, .familia-group, .filter-conservacao-mobile').hide();
                  $("#content" ).empty().html(products);
                  $("#content").fadeIn();
              }
          });
        }
      });

      search_input = document.getElementsByClassName("input-mobile");
      search_input[0].addEventListener("keyup", function(event) 
      {
        if (event.keyCode === 13) {
          event.preventDefault();
          var search_query = $(this).closest('div.has-search').find('input.input-mobile').val();
          console.log(search_query);
          if ( search_query.length < 3 ){
            alert('Erro. Tem que inserir no mínimo 3 caracteres.');
          }
          else{
            $.ajax({
                url: '?_search=' + search_query,
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "html",
                success: function (products) {
                    var clean_uri = location.protocol + "//" + location.host + location.pathname;
                    window.history.replaceState({}, document.title, clean_uri);
                    search_input.value = '';
                    $('.btn-search-clear').fadeIn();
                    $('.conservacao-group, .familia-group, .filter-conservacao-mobile').hide();
                    $("#content" ).empty().html(products);
                    $("#content").fadeIn();
                }
            });
          }
        }
      });

      $(document).on('click', '.btn-search-clear',function(event)
      {
        event.preventDefault();
        $.ajax({
            url: '?conservacao=all&familia=all',
            method: "get",
            data: {_token: '{{ csrf_token() }}'},
            dataType: "html",
            success: function (products) {
                var clean_uri = location.protocol + "//" + location.host + location.pathname;
                window.history.replaceState({}, document.title, clean_uri);
                search_input.value = '';
                $('.btn-search-clear').hide();
                $('.conservacao-group, .familia-group, .filter-conservacao-mobile').show();
                $("#content" ).empty().html(products);
                $("#content").fadeIn();
            }
        });
      });
    </script>
    <!-- ADD TO CART -->
    <script type="text/javascript">
      $(document).on('click', '.add-to-cart',function(event)
      {
        event.preventDefault();
        var ele = $(this);
        var quantity = $(this).closest('div.row').find('input.quantity').val();
        console.log(ele);
        console.log(quantity);
        $.ajax({
            url: '{{ url('add-to-cart') }}' + '/' + ele.attr("data-id") + '/' + quantity,
            method: "get",
            data: {_token: '{{ csrf_token() }}'},
            dataType: "json",
            success: function (response) {
                $("span#status").html('<div class="alert alert-success alert-dismissable fade show" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4><i class="icon fa fa-check fa-fw" aria-hidden="true"></i> Produto adicionado com sucesso.</h4></div>');
                $(ele).closest('div.hovereffect').addClass('activated');
                $("#header-bar").html(response.data);
            }
        });
      });
    </script>
    <!-- NUMERIC NUMBERS ALLOWED -->
    <script>
      $('.numbers').keydown(function () { 
          this.value = this.value.replace(/[^0-9\.]/g,''); 
      });
      $('.numbers').keyup(function () { 
          this.value = this.value.replace(/[^0-9\.]/g,'');
      });
    </script>
    <!-- STICKY MENU -->
    <!--script>
      window.onscroll = function() {myStickyControl()};

      var sticky_control = document.getElementById("sticky-control");
      var sticky = sticky_control.offsetTop;

      function myStickyControl() {
        if (window.pageYOffset >= sticky) {
          sticky_control.classList.add("sticky")
        } else {
          sticky_control.classList.remove("sticky");
        }
      }
    </script-->
    <!-- Quantity button -->
    <script type="text/javascript">
      $('.btn-number').click(function(e)
      {
          e.preventDefault();
          
          fieldName = $(this).attr('data-field');
          type      = $(this).attr('data-type');
          var input = $("input[name='"+fieldName+"']");
          var currentVal = parseInt(input.val());
          if (!isNaN(currentVal)) {
              if(type == 'minus') {
                  
                  if(currentVal > input.attr('min')) {
                      input.val(currentVal - 1).change();
                  } 
                  if(parseInt(input.val()) == input.attr('min')) {
                      $(this).attr('disabled', true);
                  }

              } else if(type == 'plus') {

                  if(currentVal < input.attr('max')) {
                      input.val(currentVal + 1).change();
                  }
                  if(parseInt(input.val()) == input.attr('max')) {
                      $(this).attr('disabled', true);
                  }

              }
          } else {
              input.val(0);
          }
      });
      $('.input-number').focusin(function(){
         $(this).data('oldValue', $(this).val());
      });
      $('.input-number').change(function() {
          
          minValue =  parseInt($(this).attr('min'));
          maxValue =  parseInt($(this).attr('max'));
          valueCurrent = parseInt($(this).val());
          
          name = $(this).attr('name');
          if(valueCurrent >= minValue) {
              $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
          } else {
              alert('Sorry, the minimum value was reached');
              $(this).val($(this).data('oldValue'));
          }
          if(valueCurrent <= maxValue) {
              $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
          } else {
              alert('Sorry, the maximum value was reached');
              $(this).val($(this).data('oldValue'));
          }  
      });
      $(".input-number").keydown(function (e) {
              // Allow: backspace, delete, tab, escape, enter and .
              if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                   // Allow: Ctrl+A
                  (e.keyCode == 65 && e.ctrlKey === true) || 
                   // Allow: home, end, left, right
                  (e.keyCode >= 35 && e.keyCode <= 39)) {
                       // let it happen, don't do anything
                       return;
              }
              // Ensure that it is a number and stop the keypress
              if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                  e.preventDefault();
              }
      });
    </script>
@stop
