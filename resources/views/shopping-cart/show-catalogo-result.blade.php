<div class="d-none d-sm-none d-lg-flex d-lg-block">
    <div class="mx-auto pag-div pagination-sm pagination-lg">
      {{ $products->appends(['conservacao' => $conservacao, 'familia' => $familia])->links() }}
    </div>
</div>
@if($products->hasMorePages())
  <hr>
@endif
<?php 

//var_dump(session('cart2')); 

?>
<div class="row grid" style="min-height: 600px;" style="position: relative;">
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
                <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                <a data-fancybox="gallery" href="{{$product->url}}" title="{{ $product->name.' - '.$product->preco.'€'}}" data-caption="{{ $product->name.' - '.$product->preco.'€ / KG'}}">
                  <img  class="card-img" loading="lazy" alt="{{$product->name}}" src="{{$product->url}}"  width="200" height="200">
                </a>
              <div class="overlay-image"></div>
            </div>
            <div class="card-body">
              <strong><h4 class="card-title" style="height: 35px; color: #212529">{{$product->name}}</h4></strong>
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
                    <img class="card-icon" title="Peso mínimo de encomenda" alt="Peso por Unidade" src="/images/icons/icon-uni-embalagem-cinza.png" width="15" height="15">
                    @if (!empty($product->peso_un) && !is_null($product->peso_un))
                      <!--span class="li-text"><abbr title="Peso Mínimo de Encomenda" class="initialism">{{$product->peso_un}} KG</abbr></span-->
                      <span class="li-text" data-toggle="tooltip" data-placement="top" title="Peso Mínimo de Encomenda"><abbr title="" class="initialism">{{$product->peso_un}} KG</abbr></span>                      
                    @else
                      <span class="li-text">- - -</span>
                    @endif
                  </p>                
                <?php
                  }elseif (empty($product->peso_un) && !empty($product->peso_cx)) {
                ?>
                  <p class="col p-0">
                    <img class="card-icon" title="Peso mínimo de encomenda" alt="Peso por Caixa" src="/images/icons/icon-uni-caixa-cinza.png" width="15" height="15">
                    @if (!empty($product->peso_cx) && !is_null($product->peso_cx))
                      <span class="li-text"><abbr title="Peso Mínimo de Encomenda" class="initialism">{{$product->peso_cx}} KG</abbr></span>
                    @else
                      <span class="li-text">- - -</span>
                    @endif
                  </p>                
                <?php    
                  }
                ?>
              </div>
              <hr>
              <p>
                <span class="text-info">
                  @if ($user->type === 'default' )
                    <strong>@isset($product->preco_uni) € {{ number_format($product->preco_uni, 2) }} @endisset</strong>
                  @else
                    <strong>@isset($product->preco) € {{ number_format($product->preco, 2) }} @endisset</strong>
                  @endif
                </span>
              </p>
              <div class="form-row">
                <div class="form-group col-md-3 col-md-3 col-lg-12 col-xl-3">
                  <input inputmode="numeric" pattern="[1-9]*" value="1" min="1" max="99" type="text" maxlength="2" class="form-control numbers quantity"/> 
                </div>
                <div class="form-group col-md-9 col-md-3 col-lg-12 col-xl-9">
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
      {{ $products->appends(['conservacao' => $conservacao, 'familia' => $familia])->links() }}
    </div>
</div>

@section('footer_scripts')
    <!-- Start of  Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=8c2a3f10-72ad-40bf-ae67-8da6923471cf"> </script>
    <!-- GALLERY LIGHTBOX -->
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <!-- DESKTOP SIDEBAR MENU -->
    <script type="text/javascript">
        var checked_values = [];
        var conservacao;
        var familia;
        var itemConservacao;
        var itemFamilia;

        $(document).ready(function()
        {
          let url = window.location.href;

          if(url.includes('?'))
          {
            var split_url = url.split("?");
            var sURLVariables = split_url[1].split('&');
            conservacao = sURLVariables[0];
            if (conservacao) {
              var split1 = conservacao.split("=");
              itemConservacao = split1[1].toLowerCase();
            }
            familia     = sURLVariables[1];
            if (familia) {
              var split2 = familia.split("=");
              itemFamilia = split2[1].toLowerCase();
            }

            $('.filter-group').each( function( i, buttonGroup ) {
              var $buttonGroup = $( buttonGroup );
              $buttonGroup.find('.is-checked').removeClass('is-checked');
              $buttonGroup.find('.filter-conservacao a[data-filter=' + itemConservacao + ']').addClass("is-checked");
              $buttonGroup.find('.filter-familia a[data-filter=' + itemFamilia + ']').addClass("is-checked");
            }); 
          }
        });

        $('.filter-group').each( function( i, buttonGroup ) {
          var $buttonGroup = $( buttonGroup );
          $buttonGroup.on( 'click', '.button', function( event ) {
            if ( $(this).hasClass("is-checked") ) {
              return;
            }
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            var $button = $( event.currentTarget );
            $button.addClass('is-checked');

            ///////////////////////////////////////////////
            $( '.filter-group' ).each(function( ic, buttonGroup2 ) {
              var $buttonGroup2 = $( buttonGroup2 );
              var $checked2 = $buttonGroup2.find('.is-checked');
              var $checkedGroup2 = $buttonGroup2.data("code");
              var $checkedElem2  = $checked2.data("filter");
              var $all_ele = $checkedGroup2 + '=' +$checkedElem2;
              checked_values.push($all_ele);
            });
            var conservacao_part = checked_values[0];
            var familia_part     = checked_values[1];

            //console.log(conservacao_part + '--' + familia_part);
            //return;
            getElements(conservacao_part, familia_part);
            checked_values.length = 0;
            //sValues = 0;
            conservacao_part = 0;
            familia_part = 0;
          });

          var $checked = $buttonGroup.find('.is-checked');
          var $checkedGroup = $buttonGroup.data("code");
          var $checkedElem  = $checked.data("filter");
        });

        function getElements( conservacao_part, familia_part ) 
        {
          console.log(conservacao_part + '-' + familia_part);
          $.ajax({
            url: '?' + conservacao_part + '&' + familia_part,
            method: "get",
            datatype: "html",
            data: {_token: '{{ csrf_token() }}'},
            success: function (products) {
                var clean_uri = location.protocol + "//" + location.host + location.pathname;
                window.history.replaceState({}, document.title, clean_uri);
                $("#content" ).empty().html(products);
                $("#content").fadeIn();
                $('[data-toggle="tooltip"]').tooltip();
            }
          });
        }
    </script>
    <!-- DESKTOP SEARCH INPUT -->
    <script type="text/javascript">
      search_input = document.getElementsByClassName("quicksearch2");
      search_input[0].addEventListener("keyup", function(event) 
      {
        if (event.keyCode === 13) {
          event.preventDefault();
          //document.getElementById("myBtn").click();
          var search_query = $(this).closest('div.has-search').find('input.quicksearch2').val();
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
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
          }
        }
      });
    </script>
    <!-- RESIZE WINDOW -->
    <script type="text/javascript">
      jQuery(window).resize(function () {
         var winwidth = jQuery(window).width();
         var docwidth = jQuery(document).width();
         if (winwidth < 975 || docwidth < 975) 
         {
            $('.filter-mobile').on( 'click', 'button', function(e) {
              e.preventDefault();
              var filterValue = $(this).attr('data-filter');
              conservacao_part  = ('conservacao='+filterValue);
              familia_part      = ('familia=all');
              //console.log(conservacao_part + '-' + familia_part);
              getElements(conservacao_part, familia_part);
            }); 
            // change is-checked class on buttons
            $('.filter-mobile').each( function( i, buttonGroup ) {
                var $buttonGroup = $( buttonGroup );
                $buttonGroup.on( 'click', '.btn', function() {
                  if ( $(this).hasClass("is-checked") ) {
                    return;
                  }
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $( this ).addClass('is-checked');
                });
            });
         }
      }).resize();
    </script>
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
                      $('[data-toggle="tooltip"]').tooltip();
                  }
              });
            }
          });

          //var input = document.getElementById("myInput");
          search_input = document.getElementsByClassName("input-mobile");
          search_input[0].addEventListener("keyup", function(event) 
          {
            if (event.keyCode === 13) {
              event.preventDefault();
              //document.getElementById("myBtn").click();
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
                        $('[data-toggle="tooltip"]').tooltip();
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
                    $('[data-toggle="tooltip"]').tooltip();
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
                    //console.log(ele);
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
    <!-- SEARCH FILTER -->
    <!--script>
      function searchFilter() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementsByClassName('quicksearch1');
        filter = input[0].value.toUpperCase();
        ul = document.getElementsByClassName("grid");
        li = ul[0].getElementsByClassName('element-item');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByClassName("card-body")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
      }
    </script-->
    <!-- CLICK PAGINATION -->
    <script type="text/javascript">
      $(function() {
          $('body').on('click', '.pagination a', function(e) {
              e.preventDefault();
              var url = $(this).attr('href');
              getArticles(url);
              window.history.pushState("", "", url);
          });
      });
      function getArticles(url) {
          $.ajax({
              url : url,
              beforeSend: function() {
              },   
          }).done(function (products) {
              $( "#content" ).empty().html(products); 
              $('[data-toggle="tooltip"]').tooltip(); 
          }).fail(function () {
              alert('Ocorreu um erro. Não foi possivel carregar os produtos!');
              $('[data-toggle="tooltip"]').tooltip();
          });
      }
    </script>
    <!-- STICKY MENU -->
    <script>
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
    </script>
@stop
