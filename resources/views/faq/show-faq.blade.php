@extends('layouts.index')

@section('template_title')
    Faq
@endsection

@section('template_linked_css') 
  <style type="text/css">
    .card-header{
      padding-left: 0px;
    }
    .accordion .btn-link{
      font-size: 1rem;
      text-align: left;
      font-weight: 400;
      color: #333;
      text-decoration: none;
    }
    .btn-link:hover {
      color: #93ba1f;
      text-decoration: underline;
    }
    .accordion .btn-link:not(.collapsed){
      color: #93ba1f;
      text-decoration: underline;
    }
    .list-group-item {
      background-color: #FFF;
    }
    .madeira-image-map{
        width: 650px;
        height: 406px;
      } 
    @media (max-width: 991.98px){
      .madeira-image-map{
        width: 550px;
         height: 406px;
      }           
    }
    @media (max-width: 767.98px){
      .madeira-image-map{
        width: 450px;
         height: 306px;
      }           
    }

    @media (max-width: 539.98px){
      .madeira-image-map{
        width: 350px;
        height: 206px;
      }           
    }
  
  </style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
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
            <h1 class="d-inline-block align-middle">Apoio ao Cliente</h1> 
            <small class="d-block ">Perguntas Frequentes</small>      
          </div>
        </div>
      </div>
    </div>
</div>
<div class="container">
  <!-- Page Content  -->
  <div class="row">
    <div class="col-md-12">
      <div class="accordion mb-5" id="accordionFaq">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-block btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <span class="collapse-btn-title">Instruções de Compra</span>
              </button>
            </h2>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionFaq">
            <div class="card-body">
              Os produtos são apresentados em Kg, Unidade ou Caixa, aos quais acresce o valor do IVA indicado em cada produto. Os produtos apresentados têm na sua grande maioria peso variável, excepto os artigos que apresentam a designação de peso fixo ou vendido à unidade. Para aferir o valor de cada produto, é necessário pesar aquando da preparação da sua encomenda, sendo o preço calculado por KG pela quantidade total de cada produto. O valor total de cada encomenda só poderá ser calculado após a pesagem de toda a mercadoria. 
            </div>
          </div>
        </div>
        <hr>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
              <button class="btn btn-block btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <span class="collapse-btn-title">Pagamento</span>
              </button>
            </h2>
          </div>
          @if ($user->type === 'default' )
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionFaq">
              <div class="card-body">
                Após concluir a sua encomenda verifique com atenção o que encomendou e as respectivas quantidades, sejam elas em KG ou em unidades. 
              </div>
            </div>
          @else
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionFaq">
              <div class="card-body">
                Após concluir a sua encomenda verifique com atenção o que encomendou e as respectivas quantidades, sejam elas em KG ou em unidades. Confirme a sua encomenda e receberá no seu email a confirmação. Logo de seguida iremos dar inicio à preparação da sua encomenda. Após estar pesada e aferida a quantidade total de cada artigo, receberá um email com a informação do valor total da encomenda e a respectiva factura com o total a pagar. O pagamento no acto de entrega apenas por MBWay ou Multibanco, não será aceite numerário.
              </div>
            </div>
          @endif

        </div>
        <hr>
        <div class="card">
          <div class="card-header" id="headingThree">
            <h2 class="mb-0">
              <button class="btn btn-block btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <span class="collapse-btn-title">Dias de Entrega por Concelho</span>
              </button>
            </h2>
          </div>
          <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionFaq">
            <div class="card-body">
              Receberá a sua encomenda na morada indicada de acordo com o dia de entrega por concelho. A sua encomenda deverá ser efectuada até às 16:00 do dia anterior. As encomendas estão sempre sujeitas à confirmação de disponibilidade de stock. No caso de ruptura será contacto pela Nóbrega.
              <div class="text-center">
                  <figure class="figure">
                      <img alt="img" data-bg_fill="rgba(147,186,31,0.5)" class="madeira-image-map" src="/images/images-map/vector-madeira-map.jpg" usemap="#madeira-image-map" style="display: block;" />
                      <figcaption class="figure-caption">
                          <i class="fa fa-info-circle text-primary" aria-hidden="true"></i> 
                          Clique na imagem para obter informação sobre a área de entrega.
                      </figcaption>
                  </figure>
                  <map name="madeira-image-map">
                    <area shape="poly" class="harea tooltip" data-part-id="cut-machico" data-title="MACHICO" data-days="TERÇA E QUINTA-FEIRA" alt="MACHICO" title="MACHICO" coords="443,147, 443,152, 444,159, 444,166, 443,173, 438,179, 436,186, 437,192, 436,197, 433,200, 431,208, 431,217, 432,222, 435,221, 443,219, 452,218, 464,218, 472,222, 475,226, 479,229, 490,231, 501,232, 506,234, 509,236, 513,238, 514,241, 514,242, 517,239, 521,236, 521,232,519,227, 521,225,526,225, 528,221, 532,213, 537,208, 543,207, 547,206, 549,202, 550,201, 557,201, 564,200, 570,201, 572,202, 575,202, 579,197, 582,194, 588,196, 589,198, 592,201, 594,202, 593,197, 591,194, 588,190, 586,189, 584,190, 580,192, 576,192, 570,189, 566,191, 565,193, 560,193, 555,191, 553,190, 553,188, 550,190, 546,192, 540,188,535,185, 532,185, 528,186, 521,185,517,184,516,181,515,179,513,181,509,181, 506,180, 503,181, 501,177, 499,173, 496,173, 491,175, 486,174, 479,171, 473,169, 470,170, 464,168, 460,164, 456,156, 452,150, 446,148, 443,147">
                    
                    <area shape="poly" class="harea tooltip" data-part-id="cut-santana" data-title="SANTANA" data-days="TERÇA E QUINTA-FEIRA" alt="SANTANA" title="SANTANA" coords="444,157, 445,167, 440,178, 436,184, 436,189, 437,194, 434,200, 431,205, 431,212, 432,218, 432,222, 431,223, 425,224, 412,225, 410,223, 402,217, 389,211, 380,206, 374,204, 365,203, 360,202, 360,201, 359,196, 355,187, 354,185, 351,177, 346,165, 343,158, 339,153, 335,148,
                    335,143, 335,134,
                    337,121, 336,108, 339,108, 344,106, 347,103, 352,103, 356,104, 360,105, 362,106, 366,104, 373,102, 378,102, 387,99, 390,99, 391,95, 393,94, 394,96, 395,101, 399,105, 406,106, 410,108, 409,110, 410,114, 414,119, 418,124, 422,126, 431,127, 434,128, 433,131, 432,133, 431,136, 435,141, 439,142, 442,144, 443,150, 444,157, 444,158,
                    443,156, 444,157">
                    
                    <area shape="poly" class="harea tooltip" data-part-id="cut-santa_cruz" data-title="SANTA CRUZ" data-days="SEGUNDA A QUINTA-FEIRA" alt="SANTA CRUZ" title="SANTA CRUZ" coords="429,308, 431,310, 438,311, 446,310, 452,310, 459,307, 465,301, 472,295, 480,286, 483,277, 484,270, 488,264, 493,259, 501,256, 509,253, 512,249, 513,243, 514,239, 510,236, 506,234, 500,232, 488,231, 479,228, 474,224, 470,220, 462,218, 444,219, 431,222, 421,225, 412,225,
                    411,229, 409,236,
                    409,242, 413,248, 415,254, 414,258, 416,261, 418,267, 417,277, 416,279, 418,283, 424,290, 429,297, 431,300, 429,308">
                    
                    <area shape="poly" class="harea tooltip" data-part-id="cut-funchal" data-title="FUNCHAL" data-days="SEGUNDA A QUINTA-FEIRA" alt="FUNCHAL" title="FUNCHAL" coords="360,202, 365,203, 374,204, 384,208, 395,214, 407,220, 412,225, 411,230, 409,237, 410,244, 413,249, 415,251, 414,258, 417,262, 419,271, 417,277, 416,280, 419,285, 428,294, 431,302, 429,308, 425,307, 417,304, 406,301, 397,300, 387,300, 381,302, 373,309, 360,313, 358,315,
                    353,316, 347,312,
                    341,307, 337,307, 334,307, 331,306, 330,301, 334,292, 339,280, 344,269, 350,257, 356,242, 360,227, 361,215, 361,206, 360,202">
                    
                    <area shape="poly" class="harea tooltip" data-part-id="cut-camara_lobos" data-title="CÂMARA DE LOBOS" data-days="TERÇA E QUINTA-FEIRA" alt="CÂMARA DE LOBOS" title="CÂMARA DE LOBOS" coords="355,187, 358,192, 360,204, 360,215, 360,229, 355,246, 343,270, 337,285, 332,296, 330,305, 325,302, 316,298, 306,293, 298,291, 290,294, 285,294, 286,293, 285,288, 284,286, 288,282, 293,275, 294,264, 295,254, 296,241, 298,232, 301,225, 306,220, 307,219, 308,214, 309,210,
                    313,208, 319,202,
                    322,193, 326,193, 335,192, 343,191, 349,188, 355,187">
                    
                    <area shape="poly" class="harea tooltip" data-part-id="cut-ribeira_brava" data-title="RIBEIRA BRAVA" data-days="TERÇA E QUINTA-FEIRA" alt="RIBEIRA BRAVA" title="RIBEIRA BRAVA" coords="322,193, 322,196, 319,202, 313,208, 309,212, 308,217, 306,220, 300,227, 297,238, 295,252, 294,269, 291,280, 286,284, 284,286, 286,291, 284,295, 278,291, 267,285, 254,281, 243,280, 241,276, 236,271, 229,268, 225,266, 224,265, 225,261, 229,253, 235,241, 243,226, 250,211,
                    255,202, 257,193,
                    258,186, 258,183, 263,183, 272,184, 281,186, 293,191, 309,193, 318,193, 322,193, 322,193">

                    <area shape="poly" class="harea tooltip" data-part-id="cut-ribeira_brava" data-title="PONTA DE SOL" data-days="TERÇA E QUINTA-FEIRA" alt="PONTA DE SOL" title="PONTA DE SOL" coords="257,183, 252,183, 243,183, 239,182, 234,183, 229,186, 221,189, 213,188, 212,184, 212,182, 208,184, 199,188, 191,188, 188,191, 186,197, 183,202, 179,206, 179,213, 179,221, 177,226, 173,228, 170,240, 177,241, 181,242, 183,244, 188,249, 193,252, 194,253, 195,256, 197,258,
                    200,258, 204,263,
                    206,269, 210,267, 215,266, 219,267, 221,268, 226,267, 225,266, 225,262, 229,253, 236,238, 244,224, 249,213, 254,204, 257,194, 258,186, 257,183">

                    <area shape="poly" class="harea tooltip" data-part-id="cut-sao_vicente" data-title="SÃO VICENTE" data-days="QUARTA E SEXTA-FEIRA" alt="SÃO VICENTE" title="SÃO VICENTE" coords="241,123, 241,126, 241,133, 237,144, 229,156, 226,159, 223,166, 220,175, 212,182, 212,184, 213,188, 221,189, 229,186, 234,183, 239,182, 248,183, 262,183, 276,185, 286,188, 293,191, 303,193, 317,193, 334,192, 345,190, 353,188, 355,185, 352,180, 348,171, 344,161, 341,155,
                    337,150, 335,143,
                    336,133, 337,120, 336,108, 335,108, 329,105, 327,104, 319,105, 317,105, 313,104, 307,110, 304,113, 301,113, 298,114, 291,119, 290,120, 284,120, 278,120, 273,122, 269,123, 266,123, 264,125, 260,128, 257,129, 249,127, 241,123">
                    
                    <area shape="poly" class="harea tooltip" data-part-id="cut-calheta" data-title="CALHETA" data-days="QUARTA E SEXTA-FEIRA" alt="CALHETA" title="CALHETA" coords="170,240, 165,236, 156,228, 147,223, 141,222, 133,220, 127,217, 120,211, 113,206, 109,203, 110,201, 108,198, 103,192, 100,189, 99,188, 97,186, 94,181, 91,174, 87,169, 82,167, 80,162, 81,155, 81,151, 80,147, 78,140, 75,135, 71,131, 68,128, 65,127, 65,125, 63,123, 62,121,
                    67,118, 72,114, 76,110,
                    80,105, 83,100, 89,97, 91,96, 95,99, 102,103, 109,106, 114,110, 117,116, 122,126, 126,135, 132,143, 138,150, 141,153, 146,157, 156,165, 167,174, 181,183, 191,188, 188,191, 186,197, 183,202, 179,206, 179,213, 179,221, 177,226, 173,228, 170,240, 171,240, 170,240">
                    
                    <area shape="poly" class="harea tooltip" data-part-id="cut-porto_moniz" data-title="PORTO MONIZ" data-days="QUARTA E SEXTA-FEIRA" alt="PORTO MONIZ" title="PORTO MONIZ" coords="91,96, 96,87, 99,84, 103,83, 108,80, 114,76, 116,72, 120,67, 125,60, 129,59, 132,61, 136,64, 142,64, 148,62, 150,61, 152,61, 154,63, 155,66, 157,70, 161,73, 166,78, 167,83, 170,87, 176,89, 177,92, 178,97, 182,101, 189,104, 191,106, 197,106, 205,106, 208,105, 211,106,
                    212,110, 212,114, 214,115,
                    215,118, 215,120, 218,121, 223,119, 226,118, 229,119, 228,119, 238,122, 241,123, 239,141, 231,154, 225,162, 224,163, 221,174, 215,179, 204,185, 192,189, 183,185, 171,177, 160,168, 151,161, 139,150, 128,139, 123,130, 119,120, 115,112, 113,109, 108,106, 100,102, 94,98, 91,96, 91,96">

                  </map>
              </div>
              <ul class="list-group list-group-flush mt-5">
                <li class="list-group-item"><strong>Funchal</strong> - de Segunda a Sexta-feira</li>
                <li class="list-group-item"><strong>Santa Cruz</strong> - de Segunda a Sexta-feira</li>
                <li class="list-group-item"><strong>Machico e Santana</strong> - Terça e Quinta Feira</li>
                <li class="list-group-item"><strong>Câmara de Lobos, Ribeira Brava e Ponta de Sol</strong> - Terça e Quinta-feira</li>
                <li class="list-group-item"><strong>Porto Moniz e São Vicente</strong> - Quarta e Sexta-feira</li>
                <li class="list-group-item"><strong>Calheta</strong> - Quarta e Sexta-feira</li>
                <li class="list-group-item"><strong>Porto Santo</strong> - Será informado do dia da entrega</li>
              </ul>
            </div>
          </div>
        </div>
        <hr>
        <div class="card">
          <div class="card-header" id="headingFour">
            <h2 class="mb-0">
              <button class="btn btn-block btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              <span class="collapse-btn-title">Valor mínimo de Entrega</span>
              </button>
            </h2>
          </div>
          <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionFaq">
            <div class="card-body">
              O valor mínimo de encomenda é de 45,00€. Encomendas abaixo deste valor será cobrada uma taxa de entrega de 10,00€.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- MADEIRA IMAGE MAP MODALS -->
@include('modals.madeira-cuts.modal-calheta-cut')
@include('modals.madeira-cuts.modal-camara_lobos-cut')
@include('modals.madeira-cuts.modal-funchal-cut')
@include('modals.madeira-cuts.modal-machico-cut')
@include('modals.madeira-cuts.modal-porto_moniz-cut')
@include('modals.madeira-cuts.modal-ribeira_brava-cut')
@include('modals.madeira-cuts.modal-santa_cruz-cut')
@include('modals.madeira-cuts.modal-santana-cut')
@include('modals.madeira-cuts.modal-sao_vicente-cut')
@endsection
@section('footer_scripts')
    <script src="{{ asset('js/mapoid.min.js') }}"></script>  
    <script src="{{ asset('js/jquery.rwdImageMaps.min.js') }}"></script>
    <script>

          var madeiratitle, madeiraid, madeiradays;
          //$('img[usemap]').rwdImageMaps();
          $("map[name=madeira-image-map]").mapoid({
              strokeColor:'#93ba1f',
              fillColor:'#93ba1f',
              fillOpacity: 0.5,
              click: function(e)
              {
                  madeiratitle = $(e.target).data('title'); 

                  madeiradays = $(e.target).data('days');

                  madeiraid = $(e.target).data('part-id');

                  if (madeiraid === 'cut-calheta') 
                  {
                      $('#modal-calheta-cut').modal('show');
                  }
                  if (madeiraid === 'cut-camara_lobos') 
                  {
                      $('#modal-camara_lobos-cut').modal('show');
                  }
                  if (madeiraid === 'cut-funchal') 
                  {
                      $('#modal-funchal-cut').modal('show');
                  }
                  if (madeiraid === 'cut-machico') 
                  {
                      $('#modal-machico-cut').modal('show');
                  }
                  if (madeiraid === 'cut-porto_moniz') 
                  {
                      $('#modal-porto_moniz-cut').modal('show');
                  }
                  if (madeiraid === 'cut-ribeira_brava') 
                  {
                      $('#modal-ribeira_brava-cut').modal('show');
                  }
                  if (madeiraid === 'cut-santa_cruz') 
                  {
                      $('#modal-santa_cruz-cut').modal('show');
                  }
                  if (madeiraid === 'cut-santana') 
                  {
                      $('#modal-santana-cut').modal('show');
                  }
                  if (madeiraid === 'cut-sao_vicente') 
                  {
                      $('#modal-sao_vicente-cut').modal('show');
                  }
              }
          });
          $('#modal-calheta-cut, #modal-camara_lobos-cut, #modal-funchal-cut,#modal-machico-cut, #modal-porto_moniz-cut, #modal-ribeira_brava-cut,#modal-santa_cruz-cut, #modal-santana-cut, #modal-sao_vicente-cut').on('show.bs.modal', function (e) 
          {
              current_modal = $(this);
              $(this).find('.modal-title').text(madeiratitle); 
              $(this).find('.modal-days').text(madeiradays);
          });
          //alert('The collapsible content is now fully shown.');
          $('img[usemap]').rwdImageMaps();
        

        $("#collapseThree").on('show.bs.collapse', function () 
        {
          console.log('open');
          var madeiratitle, madeiraid, madeiradays;
          //$('img[usemap]').rwdImageMaps();
          $("map[name=madeira-image-map]").mapoid({
              strokeColor:'#93ba1f',
              fillColor:'#93ba1f',
              fillOpacity: 0.5,
              click: function(e)
              {
                  madeiratitle = $(e.target).data('title'); 

                  madeiradays = $(e.target).data('days');

                  madeiraid = $(e.target).data('part-id');

                  if (madeiraid === 'cut-calheta') 
                  {
                      $('#modal-calheta-cut').modal('show');
                  }
                  if (madeiraid === 'cut-camara_lobos') 
                  {
                      $('#modal-camara_lobos-cut').modal('show');
                  }
                  if (madeiraid === 'cut-funchal') 
                  {
                      $('#modal-funchal-cut').modal('show');
                  }
                  if (madeiraid === 'cut-machico') 
                  {
                      $('#modal-machico-cut').modal('show');
                  }
                  if (madeiraid === 'cut-porto_moniz') 
                  {
                      $('#modal-porto_moniz-cut').modal('show');
                  }
                  if (madeiraid === 'cut-ribeira_brava') 
                  {
                      $('#modal-ribeira_brava-cut').modal('show');
                  }
                  if (madeiraid === 'cut-santa_cruz') 
                  {
                      $('#modal-santa_cruz-cut').modal('show');
                  }
                  if (madeiraid === 'cut-santana') 
                  {
                      $('#modal-santana-cut').modal('show');
                  }
                  if (madeiraid === 'cut-sao_vicente') 
                  {
                      $('#modal-sao_vicente-cut').modal('show');
                  }
              }
          });
          $('#modal-calheta-cut, #modal-camara_lobos-cut, #modal-funchal-cut,#modal-machico-cut, #modal-porto_moniz-cut, #modal-ribeira_brava-cut,#modal-santa_cruz-cut, #modal-santana-cut, #modal-sao_vicente-cut').on('show.bs.modal', function (e) 
          {
              current_modal = $(this);
              $(this).find('.modal-title').text(madeiratitle); 
              $(this).find('.modal-days').text(madeiradays);
          });
          //alert('The collapsible content is now fully shown.');
          $('img[usemap]').rwdImageMaps();
        });

        $("#collapseThree").on('shown.bs.collapse', function () 
        {
          var madeiratitle, madeiraid, madeiradays;
          //$('img[usemap]').rwdImageMaps();
          $("map[name=madeira-image-map]").mapoid({
              strokeColor:'#93ba1f',
              fillColor:'#93ba1f',
              fillOpacity: 0.5,
              click: function(e)
              {
                  madeiratitle = $(e.target).data('title'); 

                  madeiradays = $(e.target).data('days');

                  madeiraid = $(e.target).data('part-id');

                  if (madeiraid === 'cut-calheta') 
                  {
                      $('#modal-calheta-cut').modal('show');
                  }
                  if (madeiraid === 'cut-camara_lobos') 
                  {
                      $('#modal-camara_lobos-cut').modal('show');
                  }
                  if (madeiraid === 'cut-funchal') 
                  {
                      $('#modal-funchal-cut').modal('show');
                  }
                  if (madeiraid === 'cut-machico') 
                  {
                      $('#modal-machico-cut').modal('show');
                  }
                  if (madeiraid === 'cut-porto_moniz') 
                  {
                      $('#modal-porto_moniz-cut').modal('show');
                  }
                  if (madeiraid === 'cut-ribeira_brava') 
                  {
                      $('#modal-ribeira_brava-cut').modal('show');
                  }
                  if (madeiraid === 'cut-santa_cruz') 
                  {
                      $('#modal-santa_cruz-cut').modal('show');
                  }
                  if (madeiraid === 'cut-santana') 
                  {
                      $('#modal-santana-cut').modal('show');
                  }
                  if (madeiraid === 'cut-sao_vicente') 
                  {
                      $('#modal-sao_vicente-cut').modal('show');
                  }
              }
          });
          $('#modal-calheta-cut, #modal-camara_lobos-cut, #modal-funchal-cut,#modal-machico-cut, #modal-porto_moniz-cut, #modal-ribeira_brava-cut,#modal-santa_cruz-cut, #modal-santana-cut, #modal-sao_vicente-cut').on('show.bs.modal', function (e) 
          {
              current_modal = $(this);
              $(this).find('.modal-title').text(madeiratitle); 
              $(this).find('.modal-days').text(madeiradays);
          });
            //alert('The collapsible content is now fully shown.');
            $('img[usemap]').rwdImageMaps();
        });
        
        /*window.onresize = function(event) {
          $('img[usemap]').rwdImageMaps();
        };*/
        
        /*$('.navbar-cuts .nav-item').on('click', function (e) 
        {
          title = $(this).data('title');
          modal = $(current_modal).find('.modal-title');
          $(modal).text(title);
        });*/
    </script> 
@endsection

