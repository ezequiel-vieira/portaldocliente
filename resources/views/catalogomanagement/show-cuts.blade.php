@extends('layouts.index')

@section('template_title')
    Cortes
@endsection

@section('template_linked_css') 
    <style type="">
        .modal-header {
            padding: 0.5rem 0.5rem;
        }
        .modal-content{
            border-radius: 1rem;
            border: 0px solid rgba(0,0,0,.2);
        }
        .modal-header{
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .modal-backdrop {
          background: rgba(255,255,255,.8);
        }
        span.tabs-meat-father {
            background: #93ba1f;
            border-radius: 3em;
            -moz-border-radius: 3em;
            -webkit-border-radius: 3em;
            color: #fff;
            display: inline-block;
            font-weight: bold;
            line-height: 3em;
            text-align: center;
            width: 3em; 
            border: 1px solid #93ba1f;
        }
        span.tabs-meat-father:hover {
            color: #333 !important;
            border: 1px solid #85898C; 
        }
        span.tabs-meat:hover {
            color: #1b1e21;
            background-color: #d6d8d9;
            border: 1px solid #85898C;
        }
        .nav-tabs .nav-link.active span.tabs-meat{
            color: #383d41;
            background-color: #e2e3e5;
            border: 1px solid #d6d8db;
        }
        .nav-tabs .nav-link.active span.tabs-meat-father{
            color: #333 !important;
            border: 1px solid #85898C; 
        }
        .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover {
            border-bottom: 0px solid rgb(148,187,30);
        }
        span.tabs-meat {
            background: #FFF;
            border-radius: 3em;
            -moz-border-radius: 3em;
            -webkit-border-radius: 3em;
            color: #93ba1f;
            display: inline-block;
            font-weight: bold;
            line-height: 3em;
            text-align: center;
            width: 3em; 
            border: 1px solid #93ba1f;
        }
        .list-unstyled li{
            padding-bottom: 5px;
        }
        .btn-floating {
            box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
            position: relative;
            z-index: 1;
            vertical-align: middle;
            display: inline-block;
            overflow: hidden;
            transition: all .2s ease-in-out;
            border-radius: 50%;
            padding: 0;
            cursor: pointer;
        }
        .heading-1 {
            font-family: 'Roboto Slab', serif;
            font-size: 1.5em;
            letter-spacing: 0.08em;
            font-weight: 300;
            color: #A72E38;
            text-shadow: 0 1px 1px #FFFFFF;
            text-transform: uppercase;
        }

        .divider-1 {
            border-bottom: 1px solid #DADADA;
            background-color: #DADADA;
            height: 1px;
            margin: 0.5em 0px 1.5em;
        }
        .divider-1 span {
            display: block;
            width: 100%;
            height: 1px;
            background-color: #A72E38;
        }
        .links > a, .nav-link {
            padding: 0 20px;
        }
        .nav-tabs .nav-link , .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            border: 1px solid transparent;
        }
        body.modal-open {
            overflow: hidden;
        }
        .nav-tabs {
            border-bottom: 0px solid #dee2e6;
        }
        .h2-responsive.product-name{
            margin-left:25px;
        }
        .modal-header .close {
            padding: 1rem 1rem;
            margin-right: 0rem;
        }
        .modal {
            /*-webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
            -moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
            box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
            -webkit-background-clip: padding-box;
            -moz-background-clip: padding-box;
            background-clip: padding-box;*/
        }
        .links > a, .nav-link {
            padding: 2px;
        }
        .icon-cook{
            width: 35px;
            height: 35px;
        }
        .close{
            color:#FFF;
        }
        .modal-footer {
            border-top: 0px solid #dee2e6; 
            padding: 0rem;
        }
        .modal-body {
            padding-bottom: 0rem;
        }
        .navbar {
            padding: .5rem;
        }
        .close:hover {
            color: #FFF;
            text-decoration: none;
        }
    </style>
    <style type="text/css">
        .md-tabs {
            box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
            border: 0;
            padding: .7rem;
            margin-left: 1rem;
            margin-right: 1rem;
            margin-bottom: -20px;
            background: linear-gradient(219deg, rgba(246, 246, 246, 0.02) 0%, rgba(246, 246, 246, 0.02) 20%,rgba(225, 225, 225, 0.02) 20%, rgba(225, 225, 225, 0.02) 40%,rgba(136, 136, 136, 0.02) 40%, rgba(136, 136, 136, 0.02) 60%,rgba(216, 216, 216, 0.02) 60%, rgba(216, 216, 216, 0.02) 80%,rgba(35, 35, 35, 0.02) 80%, rgba(35, 35, 35, 0.02) 100%),linear-gradient(299deg, rgba(213, 213, 213, 0.02) 0%, rgba(213, 213, 213, 0.02) 20%,rgba(150, 150, 150, 0.02) 20%, rgba(150, 150, 150, 0.02) 40%,rgba(161, 161, 161, 0.02) 40%, rgba(161, 161, 161, 0.02) 60%,rgba(186, 186, 186, 0.02) 60%, rgba(186, 186, 186, 0.02) 80%,rgba(28, 28, 28, 0.02) 80%, rgba(28, 28, 28, 0.02) 100%),linear-gradient(50deg, rgba(157, 157, 157, 0.02) 0%, rgba(157, 157, 157, 0.02) 16.667%,rgba(147, 147, 147, 0.02) 16.667%, rgba(147, 147, 147, 0.02) 33.334%,rgba(42, 42, 42, 0.02) 33.334%, rgba(42, 42, 42, 0.02) 50.001000000000005%,rgba(214, 214, 214, 0.02) 50.001%, rgba(214, 214, 214, 0.02) 66.668%,rgba(34, 34, 34, 0.02) 66.668%, rgba(34, 34, 34, 0.02) 83.33500000000001%,rgba(211, 211, 211, 0.02) 83.335%, rgba(211, 211, 211, 0.02) 100.002%),linear-gradient(278deg, rgba(79, 79, 79, 0.03) 0%, rgba(79, 79, 79, 0.03) 20%,rgba(217, 217, 217, 0.03) 20%, rgba(217, 217, 217, 0.03) 40%,rgba(5, 5, 5, 0.03) 40%, rgba(5, 5, 5, 0.03) 60%,rgba(200, 200, 200, 0.03) 60%, rgba(200, 200, 200, 0.03) 80%,rgba(125, 125, 125, 0.03) 80%, rgba(125, 125, 125, 0.03) 100%),linear-gradient(274deg, rgba(235, 235, 235, 0.03) 0%, rgba(235, 235, 235, 0.03) 12.5%,rgba(100, 100, 100, 0.03) 12.5%, rgba(100, 100, 100, 0.03) 25%,rgba(44, 44, 44, 0.03) 25%, rgba(44, 44, 44, 0.03) 37.5%,rgba(228, 228, 228, 0.03) 37.5%, rgba(228, 228, 228, 0.03) 50%,rgba(36, 36, 36, 0.03) 50%, rgba(36, 36, 36, 0.03) 62.5%,rgba(72, 72, 72, 0.03) 62.5%, rgba(72, 72, 72, 0.03) 75%,rgba(30, 30, 30, 0.03) 75%, rgba(30, 30, 30, 0.03) 87.5%,rgba(109, 109, 109, 0.03) 87.5%, rgba(109, 109, 109, 0.03) 100%),linear-gradient(90deg, hsl(28,0%,14%),hsl(28,0%,14%));
            z-index: 1;
            position: relative;
            border-radius: .25rem;
        }
        .nav-tabs .nav-item {
            margin-bottom: -1px;
        }
        .nav li {
            list-style: none;
        }
        .waves-effect {
            position: relative;
            cursor: pointer;
            overflow: hidden;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }
        .md-tabs .nav-item.open .nav-link, .md-tabs .nav-link.active {
            background-color: rgba(0,0,0,.2);
            color: #fff;
            transition: all 1s;
            border-radius: .25rem;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: transparent;
        }
        .md-tabs .nav-link {
            transition: all .4s;
            border: 0;
            color: #fff;
        }
        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
        }
        .nav-link {
            display: block;
            padding: .5rem 1rem;
        }
        .md-tabs .nav-item+.nav-item {
            margin-left: 0;
        }
        .nav-tabs .nav-item {
            margin-bottom: -1px;
        }
        .nav li {
            list-style: none;
        }
        .tab-content {
            padding: 1rem;
            padding-top: 2rem;
        }
        .card {
            font-weight: 400;
            border: 0;
            box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
        }
        .pt-5, .py-5 {
            padding-top: 3rem!important;
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }
        .md-tabs .nav-link {
            display: block;
            padding: .5rem 1rem !important;
        }
        .md-tabs .nav-item.open .nav-link, .md-tabs .nav-link.active {
            background-color: rgba(0,0,0,.2);
            color: #fff;
            transition: all 1s;
            border-radius: .25rem;
        }
        .md-tabs .nav-link h6{
            margin: 0;
        }
        .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover {
            border-bottom: 1px solid transparent;
        }
        .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
            border-color: #333 #333 #333;
        } 
        .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
            border-bottom: 1px solid #FFF;
        } 
        .navbar-cuts .nav-tabs .nav-link.active:focus, .navbar-cuts .nav-tabs .nav-link.active:hover {
            border-bottom: 1px solid transparent;
        } 
        .navbar-cuts .nav-tabs .nav-link:focus, .navbar-cuts .nav-tabs .nav-link:hover {
            border-color: transparent;
        }
        .navbar-cuts .nav-link {
            display: block;
            padding: 0;
        }
        .modal-cuts .tab-content {
            padding: 0rem;
            padding-top: 0rem;
        }

        .circle{
            width: 200px;
            height: 200px;
            margin-right: 2%;
            background: #A72E37;
            border-radius: 1.5em;
            -moz-border-radius: 1.5em;
            -webkit-border-radius: 1.5em;
            color: #fff;
            display: inline-block;
            font-weight: bold;
            line-height: 1.5em;
            text-align: center;
            width: 1.5em; 
            height: 1.5em;
            font-size: 0.8rem;
        }
        .circle-child{
            background: #FFF;
            color: #A72E37;
            width: 2em; 
            height: 1.5em;
            line-height:  1.5em;
            border-radius: 2em;
            -moz-border-radius: 2em;
            -webkit-border-radius: 2em;
        }
        .circle-parent{
            border: 1px solid #A72E37;
             border-radius: 2em;
            -moz-border-radius: 2em;
            -webkit-border-radius: 2em;
            line-height: 2em;
            width: 2em; 
            height: 2em;
        }
        .father-item{
            font-size: 0.8rem;
        }
    </style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Cortes</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h1 class="text-h1">Cortes</h1>
            <small class="text-muted">
                Explore nossos Cortes e suas aplicações.
            </small>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="lead text-left">
                  A maciez é o principal atributo da qualidade da carne e está relacionada com vários fatores, nomeadamente o posicionamento do músculo e a sua solicitação. Daí a importância extraordinária de um conhecimento profundo da técnica de corte.
                </p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3 mb-5">
                <ul class="nav nav-tabs md-tabs" id="myCutTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active  text-center" id="corte-vaca-tab" data-toggle="tab" href="#corte-vaca-wrapper" role="tab" aria-controls="corte-vaca-wrapper" aria-selected="true">
                            <h6>BOVINO</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" id="corte-porco-tab" data-toggle="tab" href="#corte-porco-wrapper" role="tab" aria-controls="corte-porco-wrapper" aria-selected="false">
                            <h6>PORCO</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center" id="corte-frango-tab" data-toggle="tab" href="#corte-frango-wrapper" role="tab" aria-controls="corte-frango-wrapper" aria-selected="false">
                            <h6>FRANGO</h6>
                        </a>
                    </li>
                </ul>
                <div class="tab-content card pt-5" id="myCutTabContent">
                    <div class="tab-pane fade show active" id="corte-vaca-wrapper" role="tabpanel" aria-labelledby="corte-vaca-tab">
                        <div class="container cow-wrapper">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <figure class="figure">
                                        <img alt="img" data-bg_fill="rgba(147,186,31,0.5)" class="cow-image-map" src="/images/images-map/bovino.jpg" usemap="#cow-image-map" style="display: block;" />
                                        <figcaption class="figure-caption">
                                            <i class="fa fa-info-circle text-primary" aria-hidden="true"></i> 
                                            Clique na imagem para obter informação dos nossos cortes. 
                                        </figcaption>
                                    </figure>
                                    <map name="cow-image-map">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-1" data-title="CACHAÇO" alt="CACHAÇO" title="CACHAÇO" coords="113,172, 130,145, 140,116, 144,89, 144,66, 142,50, 141,44, 171,38, 191,36, 204,36, 210,37, 212,38, 212,43, 213,57, 212,78, 209,104, 203,130, 193,157, 178,179, 158,196, 156,194, 148,188, 138,183, 125,177, 113,172">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-2" data-title="PEITO" alt="PEITO" title="PEITO" coords="192,159, 194,164, 201,176, 208,194, 214,216, 215,239, 210,261, 195,282, 194,278, 188,273, 183,271, 178,262, 173,246, 167,231, 165,225, 162,212, 160,201, 158,196, 161,194, 170,188, 181,177, 192,159">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-3" data-title="PÁ" alt="PÁ" title="PÁ" coords="210,99, 215,98, 228,99, 246,101, 265,106, 284,116, 294,127, 302,141, 304,159, 301,182, 292,210, 274,243, 248,283, 195,282, 199,279, 207,268, 214,250, 215,223, 209,197, 201,177, 195,164, 192,159, 194,155, 199,142, 205,123, 210,99">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-4" data-title="ACÉM" alt="ACÉM" title="ACÉM" coords="304,162, 353,162, 354,157, 355,143, 357,123, 357,102, 354,81, 346,65, 342,65, 331,64, 312,63, 296,62, 287,60, 277,58, 269,56, 257,53, 246,49, 235,44, 221,40, 212,38, 212,44, 213,59, 212,79, 210,99, 215,98, 227,99, 245,100, 264,105, 281,114, 285,117, 293,125, 301,140, 304,162">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-5" data-title="MENDINHA DIANTEIRA" alt="MENDINHA DIANTEIRA" title="MENDINHA DIANTEIRA" coords="353,162, 352,167, 351,181, 348,201, 345,223, 341,247, 335,269, 333,269, 328,270, 318,270, 306,271, 292,272, 284,272, 275,274, 261,277, 248,283, 252,277, 262,263, 276,241, 289,216, 300,188, 304,162, 353,162, 353,162">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-6" data-title="LOMBO" alt="LOMBO" title="LOMBO" coords="523,58, 512,162, 432,162, 353,162, 354,157, 355,144, 357,125, 357,103, 354,83, 346,65, 352,65, 369,66, 395,66, 429,64, 470,60, 499,59, 517,58, 523,58">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-7" data-title="ALCATRA" alt="ALCATRA" title="ALCATRA" coords="514,144, 520,143, 535,142, 556,140, 580,139, 602,138, 620,138, 630,139, 630,133, 627,117, 622,98, 613,80, 611,76, 603,68, 586,61, 567,58, 546,58, 530,58, 523,58, 514,144">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-8" data-title="MENDINHA TRAZEIRA" alt="MENDINHA TRAZEIRA" title="MENDINHA TRAZEIRA" coords="512,162, 510,200, 428,210, 346,219, 346,214, 348,202, 350,186, 352,172, 353,162, 432,162, 512,162">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-9" data-title="FRALDA" alt="FRALDA" title="FRALDA" coords="346,219, 345,223, 343,235, 340,248, 338,261, 335,269, 339,268, 349,264, 365,262, 379,265, 389,271, 395,274, 399,275, 406,273, 419,267, 431,262, 439,257, 449,253, 459,250, 463,248, 468,246, 476,243, 490,236, 495,234, 505,231, 514,234, 510,200, 428,210, 346,219, 346,219">
                                        
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-10" data-title="RABADILHA" alt="RABADILHA" title="RABADILHA" coords="545,141, 546,147, 547,162, 548,183, 546,207, 542,207, 533,206, 521,204, 510,200, 511,195, 511,182, 512,166, 513,152, 514,144, 545,141">

                                        <!--area shape="poly" class="harea tooltip" data-part-id="cut-cow-12" data-title="CHÃ DE DENTRO" alt="CHÃ DE DENTRO" title="CHÃ DE DENTRO" coords="585,139, 582,140, 576,145, 571,153, 570,167, 576,178, 587,182, 597,179, 601,170, 600,158, 595,147, 585,139">

                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-11" data-title="CHÃ DE FORA" alt="CHÃ DE FORA" title="CHÃ DE FORA" coords="546,207, 552,208, 565,209, 582,210, 599,210, 610,208, 611,207, 614,200, 616,187, 618,166, 618,162, 618,155, 618,148, 619,142, 620,138, 614,138, 596,138, 572,139, 545,141, 546,147, 547,163, 548,184, 546,207"-->

                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-12" data-title="CHÃ DE FORA" alt="CHÃ DE FORA" title="CHÃ DE FORA" coords="545,141, 546,147, 547,163, 548,184, 546,207, 552,208, 565,209, 582,210, 599,210, 610,208, 611,207, 614,200, 616,187, 618,166, 618,163, 618,154, 618,144, 620,138, 615,138, 604,138, 592,138, 585,139, 588,141, 594,147, 600,161, 600,174, 594,180, 585,182, 583,182, 578,179, 573,174, 569,162, 570,158, 573,148, 584,139, 545,141">

                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-11" data-title="CHÃ DE DENTRO" alt="CHÃ DE DENTRO" title="CHÃ DE DENTRO" coords="585,139, 582,140, 576,145, 571,153, 570,167, 576,178, 587,182, 597,179, 601,170, 600,158, 595,147, 585,139" href="chã dentro">


                                        <area shape="poly" class="harea tooltip" data-part-id="cut-cow-13" data-title="CHAMBÃO" alt="CHAMBÃO" title="CHAMBÃO" coords="601,273, 598,273, 588,273, 574,275, 557,282, 538,294, 538,290, 537,281, 537,273, 537,264, 534,257, 526,248, 514,234, 510,200, 514,202, 526,205, 546,207, 563,209, 583,210, 601,210, 610,208, 610,212, 606,221, 599,235, 594,244, 593,246, 594,253, 597,261, 600,269, 601,273">
                                      </map> 
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle"><span class="father-item">1</span></div> CACHAÇO </li>
                                        <li><div class="circle"><span class="father-item">2</span></div> PEITO </li>
                                        <li><div class="circle"><span class="father-item">3</span></div> PÁ</li>
                                        <li><div class="circle"><span class="father-item">4</span></div> ACÉM</li>
                                        <li><div class="circle circle-child"><span class="father-item">4A</span></div> TOMAHAWK</li>
                                        <li><div class="circle circle-child"><span class="father-item">4B</span></div> COSTELETA DO ACÉM</li>
                                        <li><div class="circle"><span class="father-item">5</span></div> MENDINHA D.</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle"><span class="father-item">6</span></div> LOMBO&FILETE</li>
                                        <li><div class="circle circle-child"><span class="father-item">6A</span></div> LOMBO C/OSSO</li>
                                        <li><div class="circle circle-child"><span class="father-item">6B</span></div> LOMBO S/OSSO</li>
                                        <li><div class="circle circle-child"><span class="father-item">6C</span></div> FILETE</li>
                                        <li><div class="circle circle-child"><span class="father-item">6D</span></div> T-BONE</li>
                                        <li><div class="circle circle-child"><span class="father-item">6E</span></div> COSTELETAS DO LOMBO</li>
                                    </ul>
                                </div>       
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle"><span class="father-item">7</span></div>  ALCATRA</li>
                                        <li><div class="circle circle-child"><span class="father-item">7A</span></div> MAMINHA</li>
                                        <li><div class="circle circle-child"><span class="father-item">7B</span></div> CORAÇÃO DE ALCATRA</li>
                                        <li><div class="circle circle-child"><span class="father-item">7C</span></div> PICANHA</li>
                                        <li><div class="circle"><span class="father-item">8</span></div> MENDINHA T.</li>
                                        <li><div class="circle"><span class="father-item">9</span></div>&nbsp;FRALDA</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle"><span class="father-item">10</span></div> RABADILHA</li>
                                        <li><div class="circle"><span class="father-item">11</span></div> CHÃ DE DENTRO</li>
                                        <li><div class="circle"><span class="father-item">12</span></div> CHÃ DE FORA</li>
                                        <li><div class="circle"><span class="father-item">13</span></div> CHAMBÃO</li>
                                        <li><div class="circle circle-child"><span class="father-item">13A</span></div> NERVO DE GANSO</li>
                                        <li><div class="circle circle-child"><span class="father-item">13B</span></div> OSSO BUCO</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="corte-porco-wrapper" role="tabpanel" aria-labelledby="corte-porco-tab">
                        <div class="container pig-wrapper">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <figure class="figure">
                                        <img alt="img" data-bg_fill="rgba(147,186,31,0.5)" class="pig-image-map" src="/images/images-map/pig.jpg" usemap="#pig-image-map" style="display: block;" />
                                        <figcaption class="figure-caption">
                                            <i class="fa fa-info-circle text-primary" aria-hidden="true"></i> 
                                            Clique na imagem para obter informação dos nossos cortes.
                                        </figcaption>
                                    </figure>
                                    <map name="pig-image-map">
                                        <!-- CABEÇA -->
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-pig-1" data-title="CABEÇA" alt="CABEÇA" title="CABEÇA" coords="143,138, 146,142, 153,154, 165,174, 181,203, 199,241, 218,288, 212,289, 199,290, 186,291, 178,292, 170,293, 157,294, 145,294, 133,290, 123,290, 111,291, 95,287, 77,279, 57,269, 40,260, 31,250, 28,239, 28,228, 32,220, 40,215, 45,216, 49,218, 55,219, 67,215, 80,210, 91,203, 86,201, 74,197, 60,189, 49,182, 41,178, 34,173, 28,165, 25,157, 26,150, 32,148, 33,148, 40,151, 54,152, 73,149, 87,146, 104,146, 127,147, 143,138">
                                        <!--Cachaço 2-->
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-pig-2" data-title="CACHAÇO" alt="CACHAÇO" title="CACHAÇO" coords="291,160, 253,72, 143,139, 147,144, 157,159, 170,183, 186,213, 202,247, 200,243, 197,230, 194,213, 195,194, 200,175, 212,160, 234,151, 240,150, 254,149, 273,152, 291,160">
                                        <!-- VÃO 4-->
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-pig-4" data-title="LOMBO" alt="LOMBO" title="LOMBO" coords="254,75, 291,160, 293,159, 300,153, 313,146, 334,136, 362,126, 400,116, 449,106, 509,98, 513,96, 523,91, 539,87, 557,86, 579,92, 600,107, 599,103, 592,95, 581,83, 563,70, 539,57, 534,54, 518,49, 493,43, 458,39, 413,39, 377,42, 350,45, 327,49, 306,55, 283,63, 254,75" >
                                        <!-- RABO 7-->
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-pig-7" data-title="RABO" alt="RABO" title="RABO" coords="583,85, 585,83, 590,81, 597,81, 605,87, 607,89, 608,95, 605,103, 609,103, 615,104, 620,108, 619,115, 617,119, 620,121, 624,126, 623,134, 620,138, 619,145, 622,150, 620,152, 617,151, 614,146, 613,138, 610,125, 601,107, 583,85">
                                        <!-- PÁ 3-->
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-pig-3" data-title="PÁ" alt="PÁ" title="PÁ" coords="291,160, 287,158, 274,152, 254,149, 227,152, 210,161, 200,175, 196,190, 194,205, 195,216, 195,220, 196,224, 198,235, 202,247, 206,259, 212,273, 218,286, 220,294, 223,305, 227,327, 227,358, 206,378, 204,380, 206,385, 248,385, 253,374, 255,373, 258,368, 257,358, 258,342, 263,324, 265,320,267,311, 270,307, 276,295, 283,281, 288,266, 293,252, 298,232, 301,209, 300,185, 291,160">
                                        <!-- ENTREMEADA 5-->
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-pig-5" data-title="ENTREMEADA" alt="ENTREMEADA" title="ENTREMEADA" coords="291,160, 293,163, 297,172, 300,187, 301,210, 296,240, 284,278, 290,278, 304,279, 325,280, 347,281, 369,281, 387,280, 405,278, 419,276, 434,272, 454,267, 457,265, 465,262, 478,260, 491,259, 502,259, 507,259, 504,255, 499,245, 492,229, 485,209, 480,187, 478,163, 481,140, 491,118, 509,98,502,99, 482,101, 454,106, 419,112, 383,120, 347,131, 315,144, 291,160">
                                        <!-- PERNA 6-->
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-pig-6" data-title="PERNA" alt="PERNA" title="PERNA" coords="511,97, 515,95, 525,91, 540,86, 558,86, 579,92, 601,108, 603,111, 609,122, 614,141, 616,171, 616,176, 613,189, 608,203, 601,215, 592,230, 584,244, 579,254, 577,265, 580,275, 584,287, 580,298, 577,303, 574,307, 572,314, 568,329, 564,348, 564,358, 564,363, 563,368,561,369, 562,380, 522,385,520,385, 515,383, 515,376, 533,355, 534,350, 535,339, 536,324, 537,312, 537,306, 532,298, 526,289, 522,281, 517,273, 515,270, 514,268, 509,263, 502,251, 493,232, 486,213, 480,190, 478,165, 482,139, 492,116, 511,97, 511,97">
                                    </map> 
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle"><span class="father-item">1</span></div> CABEÇA </li>
                                        <li><div class="circle circle-child"><span class="father-item">1A</span></div> FOCINHO </li>
                                        <li><div class="circle circle-child"><span class="father-item">1B</span></div> ORELHA</li>
                                        <li><div class="circle circle-child"><span class="father-item">1C</span></div> FACEIRA</li>
                                        <li><div class="circle circle-child"><span class="father-item">1D</span></div> PAPADA</li>
                                        <li><div class="circle"><span class="father-item">2</span></div> CACHAÇO</li>
                                        <li><div class="circle circle-child"><span class="father-item">2A</span></div> COSTELETA DO CACHAÇO</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">                                       
                                        <li><div class="circle circle-child"><span class="father-item">2B</span></div> CACHAÇO C/OSSO</li>
                                        <li><div class="circle circle-child"><span class="father-item">2C</span></div> CACHAÇO S/OSSO</li>
                                        <li><div class="circle"><span class="father-item">3</span></div> PÁ</li>
                                        <li><div class="circle circle-child"><span class="father-item">3A</span></div> PÁ C/OSSO</li>
                                        <li><div class="circle circle-child"><span class="father-item">3B</span></div> PÁ S/OSSO</li>
                                        <li><div class="circle circle-child circle-parent"><span class="father-item">3C</span></div> CHISPE D.</li>
                                        <li><div class="circle circle-child"><span class="father-item">3C1</span></div> JOELHEIRA</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle circle-child"><span class="father-item">3C2</span></div> PATA D.</li>
                                        <li><div class="circle"><span class="father-item">4</span></div>  LOMBO</li>
                                        <li><div class="circle circle-child"><span class="father-item">4A</span></div> COSTELETA DO LOMBO</li>
                                        <li><div class="circle circle-child"><span class="father-item">4B</span></div> LOMBO C/OSSO</li>
                                        <li><div class="circle circle-child"><span class="father-item">4C</span></div> LOMBO S/OSSO</li>
                                        <li><div class="circle circle-child"><span class="father-item">4D</span></div> FILETE</li>
                                        <li><div class="circle"><span class="father-item">5</span></div> ENTREMEADA</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle"><span class="father-item">6</span></div>  PERNA</li>
                                        <li><div class="circle circle-child"><span class="father-item">6A</span></div> PERNA C/OSSO</li>
                                        <li><div class="circle circle-child"><span class="father-item">6B</span></div> PERNA S/OSSO</li>
                                        <li><div class="circle circle-child circle-parent"><span class="father-item">6C</span></div> CHISPE T.</li>
                                        <li><div class="circle circle-child"><span class="father-item">6C1</span></div> JOELHEIRA T.</li>
                                        <li><div class="circle circle-child"><span class="father-item">6C2</span></div>  PATA T.</li>
                                        <li><div class="circle"><span class="father-item">7</span></div> RABO</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="corte-frango-wrapper" role="tabpanel" aria-labelledby="corte-frango-tab">
                        <div class="container chicken-wrapper">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <figure class="figure">
                                        <img alt="img" data-bg_fill="rgba(147,186,31,0.5)" class="chicken-image-map" src="/images/images-map/chicken.jpg" usemap="#chicken-image-map" style="display: block;" />
                                        <figcaption class="figure-caption">
                                            <i class="fa fa-info-circle text-primary" aria-hidden="true"></i> 
                                            Clique na imagem para obter informação dos nossos cortes.
                                        </figcaption>
                                    </figure>
                                    <map name="chicken-image-map">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-chicken-1" data-title="PEITO" alt="PEITO" title="PEITO" coords="400,205, 397,195, 397,178, 399,167, 399,153, 395,141, 384,123, 377,108, 375,91, 382,74, 393,63, 399,58, 387,47, 373,38, 367,36, 367,37, 360,55, 350,64, 336,67, 329,67, 329,67, 328,67, 328,67, 327,67, 316,63, 307,56, 298,38, 297,37, 281,46, 267,59, 278,68, 289,83, 291,101, 282,121, 274,134, 268,146, 267,160, 268,179, 268,185, 268,195, 265,205, 277,221, 289,233, 303,244, 315,251, 329,255, 330,256, 330,256, 336,256, 337,256, 344,254, 364,244, 381,230, 400,207, 400,205" href="Peito">
                                        <area shape="poly" data-part-id="cut-chicken-3" data-title="QUARTO TRAZEIRO" alt="QUARTO TRAZEIRO" title="QUARTO TRAZEIRO" coords="333,260, 330,264, 323,276, 308,291, 284,306, 249,320, 247,318, 244,313, 243,307, 241,305, 237,314, 236,325, 236,335, 237,345, 238,358, 236,371, 230,381, 217,385, 207,383, 201,380, 199,377, 201,370, 207,360, 210,350, 212,341, 212,324, 207,299, 198,271, 190,251, 188,233, 189,222, 192,212, 199,201, 213,188, 216,185, 223,178, 228,171, 231,163, 233,161, 234,165, 237,170, 241,176, 246,186, 250,195, 252,205, 252,211, 253,213, 258,212, 261,209, 262,207, 265,211, 269,219, 275,225, 286,236, 305,250, 322,258, 330,260, 333,260" href="Quarto Trazeiro">
                                        <area shape="poly" data-part-id="cut-chicken-3" data-title="QUARTO TRAZEIRO" alt="QUARTO TRAZEIRO" title="QUARTO TRAZEIRO" coords="333,260, 336,264, 344,276, 359,291, 383,307, 418,320, 420,318, 423,312, 424,307, 426,305, 429,314, 430,325, 430,335, 429,345, 428,358, 430,371, 436,381, 449,385, 459,383, 465,380, 467,377, 465,370, 459,360, 456,350, 454,341, 454,324, 459,299, 469,272, 477,250, 479,232, 477,222, 474,213, 467,202, 453,188, 450,185, 443,178, 438,171, 434,163, 433,160, 431,165, 429,170, 426,177, 420,188, 416,197, 414,206, 414,211, 413,213, 410,213, 405,210, 403,208, 400,211, 397,219, 391,225, 380,236, 361,250, 344,258, 336,260, 333,260" href="Quarto Trazeiro">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-chicken-2" data-title="ASA" alt="ASA" title="ASA" coords="426,116, 428,121, 431,130, 432,153, 426,169, 416,191, 413,198, 411,206, 411,209, 409,210, 409,209, 401,200, 400,190, 401,181, 402,160, 402,150, 399,140, 391,128, 380,109, 378,94, 382,81, 390,69, 402,61, 404,60, 421,63, 434,71, 444,80, 455,86, 475,93, 487,99, 497,112, 502,125, 501,139, 500,140, 487,143, 469,138, 441,123, 426,116" href="Asa">
                                        <area shape="poly" class="harea tooltip" data-part-id="cut-chicken-2" data-title="ASA" alt="ASA" title="ASA" coords="241,116, 238,121, 235,130, 234,153, 240,168, 253,190, 255,205, 256,207, 257,208, 258,207, 264,197, 265,181, 264,160, 264,150, 267,140, 275,128, 286,109, 288,94, 284,81, 276,69, 263,61, 262,60, 245,63, 232,71, 222,80, 211,86, 191,93, 179,99, 168,112, 164,125, 165,139, 166,140, 179,143, 197,138, 225,123, 241,116" href="Asa">
                                        

                                        <!--area shape="poly" class="harea tooltip" data-part-id="cut-chicken-1" data-title="PEITO" alt="PEITO" title="PEITO" coords="400,205, 397,195, 397,178, 399,167, 399,153, 395,141, 384,123, 377,108, 375,91, 382,74, 393,63, 399,58, 387,47, 373,38, 367,36, 367,37, 360,55, 350,64, 336,67, 329,67, 329,67, 328,67, 328,67, 327,67, 316,63, 307,56, 298,38, 297,37, 281,46, 267,59, 278,68, 289,83, 291,101, 282,121, 274,134, 268,146, 267,160, 268,179, 268,185, 268,195, 265,205, 277,221, 289,233, 303,244, 315,251, 329,255, 330,256, 330,256, 336,256, 337,256, 344,254, 364,244, 381,230, 400,207, 400,205">

                                        <area shape="poly" data-part-id="cut-chicken-3" data-title="QUARTO TRAZEIRO" alt="QUARTO TRAZEIRO" title="QUARTO TRAZEIRO" coords="332,260, 330,264, 322,275, 307,291, 283,306, 249,320, 247,317, 244,312, 243,307, 241,305, 237,315, 235,325, 235,335, 236,345, 237,358, 235,371, 229,381, 217,385, 206,383, 201,380, 198,377, 200,370, 206,360, 210,350, 211,341, 212,324, 206,299, 197,271, 190,249, 188,231, 189,221, 191,212, 198,202, 212,188, 215,185, 222,178, 227,171, 231,163, 232,161, 234,165, 237,170, 241,176, 247,186, 251,195, 253,204, 253,209, 253,211, 254,213, 258,212, 261,209, 262,207, 265,211, 270,218, 275,225, 286,236, 305,249, 322,257, 330,260, 332,260">

                                        <area shape="poly" data-part-id="cut-chicken-3" data-title="QUARTO TRAZEIRO" alt="QUARTO TRAZEIRO" title="QUARTO TRAZEIRO" coords="333,260, 336,264, 344,276, 359,291, 383,307, 418,320, 420,318, 423,312, 424,307, 426,305, 429,314, 430,325, 430,335, 429,345, 428,358, 430,371, 436,381, 449,385, 459,383, 465,380, 467,377, 465,370, 459,360, 456,350, 454,341, 454,324, 459,299, 469,272, 477,250, 479,232, 477,222, 474,213, 467,202, 453,188, 450,185, 443,178, 438,171, 434,163, 433,160, 431,165, 429,170, 426,177, 420,188, 416,197, 414,206, 414,211, 413,213, 410,213, 405,210, 403,208, 400,211, 397,219, 391,225, 380,236, 361,250, 344,258, 336,260, 333,260">

                                        <area shape="poly" class="harea tooltip" data-part-id="cut-chicken-2" data-title="ASA" alt="ASA" title="ASA" coords="426,116, 428,123, 431,132, 432,155, 425,170, 414,194, 412,200, 411,206, 411,209, 410,209, 409,209, 405,205, 402,199, 401,184, 402,162, 402,151, 399,142, 391,129, 380,110, 378,95, 382,81, 390,69, 402,61, 404,60, 421,63, 434,72, 444,80, 455,86, 476,92, 488,99, 497,113, 502,125, 501,139, 500,140, 487,143, 470,138, 442,123, 426,116">

                                        <area shape="poly" class="harea tooltip" data-part-id="cut-chicken-2" data-title="ASA" alt="ASA" title="ASA" coords="241,116, 238,121, 235,130, 234,153, 240,168, 253,190, 255,205, 256,207, 257,208, 258,207, 264,197, 265,181, 264,160, 264,150, 267,140, 275,128, 286,109, 288,94, 284,81, 276,69, 263,61, 262,60, 245,63, 232,71, 222,80, 211,86, 191,93, 179,99, 168,112, 164,125, 165,139, 166,140, 179,143, 197,138, 225,123, 241,116"-->
                                    </map> 
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle"><span class="father-item">1</span></div> PEITO </li>
                                        <li><div class="circle"><span class="father-item">2</span></div> ASA</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle circle-child"><span class="father-item">2A</span></div>ASA C/PONTA</li>
                                        <li><div class="circle circle-child"><span class="father-item">2B</span></div>ASA S/PONTA</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle"><span class="father-item">3</span></div>  QUARTO TRAZEIRO</li>
                                        <li><div class="circle circle-child"><span class="father-item">3A</span></div>  COTO</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 text-left">
                                    <ul class="list-unstyled">
                                        <li><div class="circle circle-child"><span class="father-item">3B</span></div>  COXA</li>
                                        <li><div class="circle circle-child"><span class="father-item">3C</span></div>  PERNA</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- COW MODALS -->
    @include('modals.cow-cuts.modal-cow-cut-1')
    @include('modals.cow-cuts.modal-cow-cut-2')
    @include('modals.cow-cuts.modal-cow-cut-3')
    @include('modals.cow-cuts.modal-cow-cut-4')
    @include('modals.cow-cuts.modal-cow-cut-5')
    @include('modals.cow-cuts.modal-cow-cut-6')
    @include('modals.cow-cuts.modal-cow-cut-7')
    @include('modals.cow-cuts.modal-cow-cut-8')
    @include('modals.cow-cuts.modal-cow-cut-9')
    @include('modals.cow-cuts.modal-cow-cut-10')
    @include('modals.cow-cuts.modal-cow-cut-11')
    @include('modals.cow-cuts.modal-cow-cut-12')
    @include('modals.cow-cuts.modal-cow-cut-13')
    <!-- PIG MODALS -->
    @include('modals.pig-cuts.modal-pig-cut-1')
    @include('modals.pig-cuts.modal-pig-cut-2')
    @include('modals.pig-cuts.modal-pig-cut-3')
    @include('modals.pig-cuts.modal-pig-cut-4')
    @include('modals.pig-cuts.modal-pig-cut-5')
    @include('modals.pig-cuts.modal-pig-cut-6')
    @include('modals.pig-cuts.modal-pig-cut-7')
    <!-- CHICKEN MODALS -->
    @include('modals.chicken-cuts.modal-chicken-cut-1')
    @include('modals.chicken-cuts.modal-chicken-cut-2')
    @include('modals.chicken-cuts.modal-chicken-cut-3')
@endsection
@section('footer_scripts')
    <script src="{{ asset('js/mapoid.min.js') }}"></script>
    <script>
        var cowtitle, cowid, img, current_modal;

        $("map[name=cow-image-map]").mapoid({
            strokeColor:'#93ba1f',
            fillColor:'#93ba1f',
            fillOpacity: 0.5,
            click: function(e)
            {
                cowtitle = $(e.target).data('title');
                cowid = $(e.target).data('part-id');

                if (cowid === 'cut-cow-1') 
                {
                    $('#modal-cow-cut-1').modal('show');
                }
                if (cowid === 'cut-cow-2') 
                {
                    $('#modal-cow-cut-2').modal('show');
                }
                if (cowid === 'cut-cow-3') 
                {
                    $('#modal-cow-cut-3').modal('show');
                }
                if (cowid === 'cut-cow-4') 
                {
                    $('#modal-cow-cut-4').modal('show');
                }
                if (cowid === 'cut-cow-5') 
                {
                    $('#modal-cow-cut-5').modal('show');
                }
                if (cowid === 'cut-cow-6') 
                {
                    $('#modal-cow-cut-6').modal('show');
                }
                if (cowid === 'cut-cow-7') 
                {
                    $('#modal-cow-cut-7').modal('show');
                }
                if (cowid === 'cut-cow-8') 
                {
                    $('#modal-cow-cut-8').modal('show');
                }
                if (cowid === 'cut-cow-9') 
                {
                    $('#modal-cow-cut-9').modal('show');
                }
                if (cowid === 'cut-cow-10') 
                {
                    $('#modal-cow-cut-10').modal('show');
                }
                if (cowid === 'cut-cow-11') 
                {
                    $('#modal-cow-cut-11').modal('show');
                }
                if (cowid === 'cut-cow-12') 
                {
                    $('#modal-cow-cut-12').modal('show');
                }
                if (cowid === 'cut-cow-13') 
                {
                    $('#modal-cow-cut-13').modal('show');
                }
            }
        });

        $('#modal-cow-cut-1, #modal-cow-cut-2, #modal-cow-cut-3, #modal-cow-cut-4, #modal-cow-cut-5, #modal-cow-cut-6, #modal-cow-cut-7,#modal-cow-cut-8, #modal-cow-cut-9, #modal-cow-cut-10, #modal-cow-cut-11, #modal-cow-cut-12, #modal-cow-cut-13, #modal-cow-cut-14').on('show.bs.modal', function (e) 
        {
            current_modal = $(this);
            console.log(cowtitle);
            $(this).find('.modal-title').text(cowtitle);
        });

        $('.navbar-cuts .nav-item').on('click', function (e) 
        {
          title = $(this).data('title');
          modal = $(current_modal).find('.modal-title');
          $(modal).text(title);
        });
    </script>
    <script>
        var pigtitle, pigid, pigimg;

        $("map[name=pig-image-map]").mapoid({
            strokeColor:'#93ba1f',
            fillColor:'#93ba1f',
            fillOpacity: 0.5,
            click: function(e)
            {
                pigtitle = $(e.target).data('title');

                pigid = $(e.target).data('part-id');

                if (pigid === 'cut-pig-1') 
                {
                    $('#modal-pig-cut-1').modal('show');
                }
                if (pigid === 'cut-pig-2') 
                {
                    $('#modal-pig-cut-2').modal('show');
                }
                if (pigid === 'cut-pig-3') 
                {
                    $('#modal-pig-cut-3').modal('show');
                }
                if (pigid === 'cut-pig-4') 
                {
                    $('#modal-pig-cut-4').modal('show');
                }
                if (pigid === 'cut-pig-5') 
                {
                    $('#modal-pig-cut-5').modal('show');
                }
                if (pigid === 'cut-pig-6') 
                {
                    $('#modal-pig-cut-6').modal('show');
                }
                if (pigid === 'cut-pig-7') 
                {
                    $('#modal-pig-cut-7').modal('show');
                }
            }
        });

        $('#modal-pig-cut-1, #modal-pig-cut-2, #modal-pig-cut-3, #modal-pig-cut-4, #modal-pig-cut-5, #modal-pig-cut-6, #modal-pig-cut-7').on('show.bs.modal', function (e) 
        {
            current_modal = $(this);
            $(this).find('.modal-title').text(pigtitle);
        });

        $('.navbar-cuts .nav-item').on('click', function (e) 
        {
          title = $(this).data('title');
          modal = $(current_modal).find('.modal-title');
          $(modal).text(title);
        });
    </script>  
    <script>
        var chickentitle, chickenid, chickenimg;

        $("map[name=chicken-image-map]").mapoid({
            strokeColor:'#93ba1f',
            fillColor:'#93ba1f',
            fillOpacity: 0.5,
            click: function(e)
            {
                chickentitle = $(e.target).data('title');

                chickenid = $(e.target).data('part-id');

                if (chickenid === 'cut-chicken-1') 
                {
                    $('#modal-chicken-cut-1').modal('show');
                }
                if (chickenid === 'cut-chicken-2') 
                {
                    $('#modal-chicken-cut-2').modal('show');
                }
                if (chickenid === 'cut-chicken-3') 
                {
                    $('#modal-chicken-cut-3').modal('show');
                }
            }
        });
        $('#modal-chicken-cut-1, #modal-chicken-cut-2, #modal-chicken-cut-3').on('show.bs.modal', function (e) 
        {
            current_modal = $(this);
            $(this).find('.modal-title').text(chickentitle);
        });
        $('.navbar-cuts .nav-item').on('click', function (e) 
        {
          title = $(this).data('title');
          modal = $(current_modal).find('.modal-title');
          $(modal).text(title);
        });
    </script> 
@endsection


