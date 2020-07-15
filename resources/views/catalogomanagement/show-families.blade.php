@extends('layouts.index')

@section('template_title')
    Catálogo
@endsection

@section('template_linked_css') 

<style type="text/css">
    ul, #myFamilyTree {
      list-style-type: none;
      padding: 0;
    }
    #myFamilyTree {
      margin: 0;
      padding: 0;
    }
    #myFamilyTree .caret {
      cursor: pointer;
      -webkit-user-select: none; /* Safari 3.1+ */
      -moz-user-select: none; /* Firefox 2+ */
      -ms-user-select: none; /* IE 10+ */
      user-select: none;
    }
    #myFamilyTree .caret::before {
      content: "\25B6";
      color: black;
      display: inline-block;
      margin-right: 6px;
    }
    #myFamilyTree .caret-down::before {
      -ms-transform: rotate(90deg); /* IE 9 */
      -webkit-transform: rotate(90deg); /* Safari */'
      transform: rotate(90deg);  
    }
    #myFamilyTree .nested {
      display: none;
    }
    #myFamilyTree .active {
      display: block;
    }
    .nested li{

    }
    #v-pills-tab .links > a, #v-pills-tab .nav-link {
        color: #333;
        padding: 0;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        border: 1px solid #333;
        margin-bottom: 5px;
        border-radius: 0;
    }
    #v-pills-tab .nav-link.active, #v-pills-tab .show>.nav-link, .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #FFF;
    }
    .v-pills-tab .links > a, .v-pills-tab .nav-link {
        color: #333;
        padding: 0;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        border: 1px solid #333;
        margin-bottom: 5px;
        border-radius: 0;
    }
    .v-pills-tab .nav-link.active, #v-pills-tab .show>.nav-link {
        color: #fff;
        background-color: #FFF;
    }
    .cons-letter, .subfamily-letter{
        width: 10px; border-right: 1px solid #333;padding: 0px 5px;
    }
    .cons-title, .subfamily-title{
        padding-left: 5px;
    }
    .nested li{
        font-size: 13px;
        border: 1px solid #333;
        margin-bottom: 5px; 
    }
    .cons-title-static{
        background: #4d004d;
        color: #FFF;
        width: 100%;
        display: inherit;
    }
</style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Hierarquias</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="container">
	<div class="page-header">
	   	<h1 class="text-h1"> HIERARQUIAS </h1>
        <small class="text-muted">COMPOSIÇÃO DOS CÓDIGOS DE PRODUTOS</small>
	</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                    <span class="cons-title-static">CONSERVAÇÃO</span>
                </a>
                <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-ambiente" role="tab" aria-controls="v-pills-home" aria-selected="true">
                    <span class="cons-letter">A</span>
                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A">AMBIENTE</span>
                </a>
                <a class="nav-link" id="v-pills-refrigerado-tab" data-toggle="pill" href="#v-pills-refrigerado" role="tab" aria-controls="v-pills-refrigerado" aria-selected="false">
                    <span class="cons-letter">R</span>
                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R">REFRIGERADO</span>
                </a>
                <a class="nav-link" id="v-pills-congelado-tab" data-toggle="pill" href="#v-pills-congelado" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                    <span class="cons-letter">C</span>
                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C">CONGELADO</span>
                </a>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content" id="v-pills-tabContent1">
                <div class="tab-pane fade" id="v-pills-ambiente" role="tabpanel" aria-labelledby="v-pills-ambiente-tab">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <span class="cons-title-static">TIPOLOGIA</span>
                                </a>
                                <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <span class="cons-letter">01</span>
                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A01">MERCADORIAS</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent2">
                              <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                <span class="cons-title-static">FAMILIA</span>
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-geral-tab" data-toggle="pill" href="#v-pills-a01-geral" role="tab" aria-controls="v-pills-a01-geral" aria-selected="true">
                                                <span class="cons-letter">00</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0100">Geral</span>                                           
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-bovinos-tab" data-toggle="pill" href="#v-pills-a01-bovinos" role="tab" aria-controls="v-pills-a01-bovinos" aria-selected="false">
                                                <span class="cons-letter">01</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0101">Bovinos</span>                                             
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-suinos-tab" data-toggle="pill" href="#v-pills-a01-suinos" role="tab" aria-controls="v-pills-a01-suinos" aria-selected="false">
                                                <span class="cons-letter">02</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0102">Suinos</span> 
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-aves-tab" data-toggle="pill" href="#v-pills-a01-aves" role="tab" aria-controls="v-pills-a01-aves" aria-selected="false">
                                                <span class="cons-letter">03</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0103">Aves</span>                                                                            
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-caprinos-ovinos-tab" data-toggle="pill" href="#v-pills-a01-caprinos-ovinos" role="tab" aria-controls="v-pills-a01-caprinos-ovinos" aria-selected="true">
                                                <span class="cons-letter">04</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0104">Caprinos/Ovinos</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-produtos-mar-tab" data-toggle="pill" href="#v-pills-a01-produtos-mar" role="tab" aria-controls="v-pills-a01-produtos-mar" aria-selected="false">
                                                <span class="cons-letter">05</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0105">Produtos do Mar</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-vegetais-tab" data-toggle="pill" href="#v-pills-a01-vegetais" role="tab" aria-controls="v-pills-a01-vegetais" aria-selected="false">
                                                <span class="cons-letter">06</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0106">Vegetais</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-lacticinios-tab" data-toggle="pill" href="#v-pills-a01-lacticinios" role="tab" aria-controls="v-pills-a01-lacticinios" aria-selected="false">
                                                <span class="cons-letter">07</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0107">Lacticinios</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-padaria-pastelaria-tab" data-toggle="pill" href="#v-pills-a01-padaria-pastelaria" role="tab" aria-controls="v-pills-a01-padaria-pastelaria" aria-selected="true">
                                                <span class="cons-letter">08</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0108">Padaria e Pastelaria</span>                                                 
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-charcutaria-tab" data-toggle="pill" href="#v-pills-a01-charcutaria" role="tab" aria-controls="v-pills-a01-charcutaria" aria-selected="false">
                                                <span class="cons-letter">09</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0109">Charcutaria</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-pre-cozinhados-tab" data-toggle="pill" href="#v-pills-a01-precozinhados" role="tab" aria-controls="v-pills-a01-pre-cozinhados" aria-selected="false">
                                                <span class="cons-letter">10</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0110">Pré-Cozinhados</span>                                                                                       
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-ovoprodutos-tab" data-toggle="pill" href="#v-pills-a01-ovoprodutos" role="tab" aria-controls="v-pills-a01-ovoprodutos" aria-selected="false">
                                                <span class="cons-letter">11</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0111">Ovoprodutos</span>                                             
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-preparados-carne-tab" data-toggle="pill" href="#v-pills-a01-preparados-carne" role="tab" aria-controls="v-pills-a01-preparados-carne" aria-selected="false">
                                                <span class="cons-letter">12</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0112">Preparados de Carne</span>                                                                                        
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-embalagens-tab" data-toggle="pill" href="#v-pills-a01-embalagens" role="tab" aria-controls="v-pills-a01-embalagens" aria-selected="false">
                                                <span class="cons-letter">20</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0120">EMBALAGENS</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-cartao-tab" data-toggle="pill" href="#v-pills-a01-cartao" role="tab" aria-controls="v-pills-a01-cartao" aria-selected="false">
                                                <span class="cons-letter">50</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0150">CARTÃO</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-plastico-tab" data-toggle="pill" href="#v-pills-a01-plastico" role="tab" aria-controls="v-pills-a01-plastico" aria-selected="false">
                                                <span class="cons-letter">51</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0151">PLÁSTICO</span>                                                                                        
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-organico-tab" data-toggle="pill" href="#v-pills-a01-organico" role="tab" aria-controls="v-pills-a01-organico" aria-selected="false">
                                                <span class="cons-letter">52</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0152">ORGANICO</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-consumiveis-tab" data-toggle="pill" href="#v-pills-a01-consumiveis" role="tab" aria-controls="v-pills-a01-consumiveis" aria-selected="false">
                                                <span class="cons-letter">60</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0160">CONSUMIVEIS</span>                                                                                         
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-gorduras-vegetais-tab" data-toggle="pill" href="#v-pills-a01-gorduras-vegetais" role="tab" aria-controls="v-pills-a01-gorduras-vegetais" aria-selected="false">
                                                <span class="cons-letter">71</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0171">GORDURAS VEGETAIS</span>                                             
                                            </a>
                                            <a class="nav-link" id="v-pills-a01-molhos-temperos-tab" data-toggle="pill" href="#v-pills-a01-molhos-temperos" role="tab" aria-controls="v-pills-a01-molhos-temperos" aria-selected="false">
                                                <span class="cons-letter">72</span>
                                                <span class="cons-title" data-toggle="tooltip" data-placement="top" title="A0172">MOLHOS E TEMPEROS</span>                                             
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="tab-content" id="v-pills-tabContent3">
                                            <div class="tab-pane fade" id="v-pills-a01-geral" role="tabpanel" aria-labelledby="v-pills-a01-geral-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010000">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">Geral</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010091">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010092">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010093">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010094">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010095">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010096">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-bovinos" role="tabpanel" aria-labelledby="v-pills-a01-bovinos-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010100">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010101">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010102">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010103">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010104">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010105">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010110">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010111">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010112">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010113">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010114">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010115">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010134">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010191">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010192">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010193">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010194">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010195">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010196">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-suinos" role="tabpanel" aria-labelledby="v-pills-a01-suinos-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010200">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010201">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010202">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010203">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010204">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010205">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010210">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010211">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010212">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010213">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010214">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010215">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010234">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010291">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010292">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010293">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010294">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010295">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010296">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-aves" role="tabpanel" aria-labelledby="v-pills-a01-aves-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010300">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010301">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010302">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010303">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010304">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010305">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010310">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010311">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010312">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010313">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010314">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010315">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010334">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010391">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010392">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010393">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010394">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010395">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010396">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-caprinos-ovinos" role="tabpanel" aria-labelledby="v-pills-a01-caprinos-ovinos-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010400">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010401">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010402">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010403">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010404">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010405">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010410">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010411">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010412">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010413">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010414">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010415">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010434">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010435">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010492">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010493">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010494">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010495">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010496">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-produtos-mar" role="tabpanel" aria-labelledby="v-pills-a01-produtos-mar-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010500">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010550">
                                                        <span class="subfamily-letter">50</span>
                                                        <span class="subfamily-title">PEIXE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010551">
                                                        <span class="subfamily-letter">51</span>
                                                        <span class="subfamily-title">MARISCO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010591">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010592">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010593">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010594">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010595">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010596">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-vegetais" role="tabpanel" aria-labelledby="v-pills-a01-vegetais-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010600">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010660">
                                                        <span class="subfamily-letter">60</span>
                                                        <span class="subfamily-title">LEGUMES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010661">
                                                        <span class="subfamily-letter">61</span>
                                                        <span class="subfamily-title">BATATAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010662">
                                                        <span class="subfamily-letter">62</span>
                                                        <span class="subfamily-title">FRUTA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010663">
                                                        <span class="subfamily-letter">63</span>
                                                        <span class="subfamily-title">LEGUMES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010691">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010692">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010693">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010694">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010695">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010696">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-lacticinios" role="tabpanel" aria-labelledby="v-pills-a01-lacticinios-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010700">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010770">
                                                        <span class="subfamily-letter">70</span>
                                                        <span class="subfamily-title">QUEIJOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010771">
                                                        <span class="subfamily-letter">71</span>
                                                        <span class="subfamily-title">MANTEIGAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010772">
                                                        <span class="subfamily-letter">72</span>
                                                        <span class="subfamily-title">YOGURTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010791">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010792">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010793">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010794">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010795">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010796">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-padaria-pastelaria" role="tabpanel" aria-labelledby="v-pills-a01-padaria-pastelaria-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010800">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010880">
                                                        <span class="subfamily-letter">80</span>
                                                        <span class="subfamily-title">PADARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010881">
                                                        <span class="subfamily-letter">81</span>
                                                        <span class="subfamily-title">PASTELARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010891">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010892">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010893">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010894">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010895">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010896">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-charcutaria" role="tabpanel" aria-labelledby="v-pills-a01-charcutaria-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010900">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010901">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010902">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010903">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010904">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010905">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010910">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010911">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010912">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010913">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010914">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010915">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010930">
                                                        <span class="subfamily-letter">30</span>
                                                        <span class="subfamily-title">FRANGO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010931">
                                                        <span class="subfamily-letter">31</span>
                                                        <span class="subfamily-title">PERU</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010932">
                                                        <span class="subfamily-letter">32</span>
                                                        <span class="subfamily-title">PATO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010933">
                                                        <span class="subfamily-letter">33</span>
                                                        <span class="subfamily-title">GALINHAS/PATOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010934">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010950">
                                                        <span class="subfamily-letter">50</span>
                                                        <span class="subfamily-title">PEIXE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010951">
                                                        <span class="subfamily-letter">51</span>
                                                        <span class="subfamily-title">MARISCO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010991">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010992">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010993">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010994">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010995">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A010996">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-precozinhados" role="tabpanel" aria-labelledby="v-pills-a01-precozinhados-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011000">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011001">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011002">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011003">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011004">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011005">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011010">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011011">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011012">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011013">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011014">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011015">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011030">
                                                        <span class="subfamily-letter">30</span>
                                                        <span class="subfamily-title">FRANGO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011031">
                                                        <span class="subfamily-letter">31</span>
                                                        <span class="subfamily-title">PERU</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011032">
                                                        <span class="subfamily-letter">32</span>
                                                        <span class="subfamily-title">PATO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011033">
                                                        <span class="subfamily-letter">33</span>
                                                        <span class="subfamily-title">GALINHAS/PATOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011034">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011050">
                                                        <span class="subfamily-letter">50</span>
                                                        <span class="subfamily-title">PEIXE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011051">
                                                        <span class="subfamily-letter">51</span>
                                                        <span class="subfamily-title">MARISCO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011060">
                                                        <span class="subfamily-letter">60</span>
                                                        <span class="subfamily-title">LEGUMES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011061">
                                                        <span class="subfamily-letter">61</span>
                                                        <span class="subfamily-title">BATATAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011062">
                                                        <span class="subfamily-letter">62</span>
                                                        <span class="subfamily-title">FRUTA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011070">
                                                        <span class="subfamily-letter">70</span>
                                                        <span class="subfamily-title">QUEIJOS</span>
                                                    </li>                                                    
                                                    <li data-toggle="tooltip" data-placement="top" title="A011071">
                                                        <span class="subfamily-letter">71</span>
                                                        <span class="subfamily-title">MANTEIGAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011072">
                                                        <span class="subfamily-letter">72</span>
                                                        <span class="subfamily-title">YOGURTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011080">
                                                        <span class="subfamily-letter">80</span>
                                                        <span class="subfamily-title">PADARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011081">
                                                        <span class="subfamily-letter">81</span>
                                                        <span class="subfamily-title">PASTELARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011091">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011092">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011093">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011094">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011095">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011096">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-ovoprodutos" role="tabpanel" aria-labelledby="v-pills-a01-ovoprodutos-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011100">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011170">
                                                        <span class="subfamily-letter">70</span>
                                                        <span class="subfamily-title">QUEIJOS</span>
                                                    </li>                                                    
                                                    <li data-toggle="tooltip" data-placement="top" title="A011171">
                                                        <span class="subfamily-letter">71</span>
                                                        <span class="subfamily-title">MANTEIGAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011172">
                                                        <span class="subfamily-letter">72</span>
                                                        <span class="subfamily-title">YOGURTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011180">
                                                        <span class="subfamily-letter">80</span>
                                                        <span class="subfamily-title">PADARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011181">
                                                        <span class="subfamily-letter">81</span>
                                                        <span class="subfamily-title">PASTELARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011191">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011192">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011193">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011194">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011195">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011196">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-preparados-carne" role="tabpanel" aria-labelledby="v-pills-a01-preparados-carne-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011200">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011201">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011202">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011203">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011204">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011205">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011210">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011211">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011212">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011213">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011214">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011215">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011230">
                                                        <span class="subfamily-letter">30</span>
                                                        <span class="subfamily-title">FRANGO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011231">
                                                        <span class="subfamily-letter">31</span>
                                                        <span class="subfamily-title">PERU</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011232">
                                                        <span class="subfamily-letter">32</span>
                                                        <span class="subfamily-title">PATO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011233">
                                                        <span class="subfamily-letter">33</span>
                                                        <span class="subfamily-title">GALINHAS/PATOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011234">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011250">
                                                        <span class="subfamily-letter">50</span>
                                                        <span class="subfamily-title">PEIXE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011251">
                                                        <span class="subfamily-letter">51</span>
                                                        <span class="subfamily-title">MARISCO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011260">
                                                        <span class="subfamily-letter">60</span>
                                                        <span class="subfamily-title">LEGUMES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011261">
                                                        <span class="subfamily-letter">61</span>
                                                        <span class="subfamily-title">BATATAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011262">
                                                        <span class="subfamily-letter">62</span>
                                                        <span class="subfamily-title">FRUTA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011270">
                                                        <span class="subfamily-letter">70</span>
                                                        <span class="subfamily-title">QUEIJOS</span>
                                                    </li>                                                    
                                                    <li data-toggle="tooltip" data-placement="top" title="A011271">
                                                        <span class="subfamily-letter">71</span>
                                                        <span class="subfamily-title">MANTEIGAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011272">
                                                        <span class="subfamily-letter">72</span>
                                                        <span class="subfamily-title">YOGURTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011280">
                                                        <span class="subfamily-letter">80</span>
                                                        <span class="subfamily-title">PADARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011281">
                                                        <span class="subfamily-letter">81</span>
                                                        <span class="subfamily-title">PASTELARIA</span>
                                                    </li>

                                                    <li data-toggle="tooltip" data-placement="top" title="A011291">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011292">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011293">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011294">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011295">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A011296">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-embalagens" role="tabpanel" aria-labelledby="v-pills-a01-embalagens-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012000">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012001">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012002">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012003">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012004">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012005">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012010">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012011">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012012">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012013">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012014">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012015">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012034">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012050">
                                                        <span class="subfamily-letter">50</span>
                                                        <span class="subfamily-title">PEIXE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012051">
                                                        <span class="subfamily-letter">51</span>
                                                        <span class="subfamily-title">MARISCO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012060">
                                                        <span class="subfamily-letter">60</span>
                                                        <span class="subfamily-title">LEGUMES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012000">
                                                        <span class="subfamily-letter">61</span>
                                                        <span class="subfamily-title">BATATAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012062">
                                                        <span class="subfamily-letter">62</span>
                                                        <span class="subfamily-title">FRUTA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012070">
                                                        <span class="subfamily-letter">70</span>
                                                        <span class="subfamily-title">QUEIJOS</span>
                                                    </li>                                                    
                                                    <li data-toggle="tooltip" data-placement="top" title="A012071">
                                                        <span class="subfamily-letter">71</span>
                                                        <span class="subfamily-title">MANTEIGAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012072">
                                                        <span class="subfamily-letter">72</span>
                                                        <span class="subfamily-title">YOGURTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012080">
                                                        <span class="subfamily-letter">80</span>
                                                        <span class="subfamily-title">PADARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012081">
                                                        <span class="subfamily-letter">81</span>
                                                        <span class="subfamily-title">PASTELARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012091">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012092">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012093">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012094">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012095">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A012096">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-cartao" role="tabpanel" aria-labelledby="v-pills-a01-cartao-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015000">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015091">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015092">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015093">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015094">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015095">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015096">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>                                                
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-plastico" role="tabpanel" aria-labelledby="v-pills-a01-plastico-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015100">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015191">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015192">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015193">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015194">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015195">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015196">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>                                                
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-organico" role="tabpanel" aria-labelledby="v-pills-a01-organico-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015200">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015201">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">CARCAÇAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015202">
                                                        <span class="subfamily-letter">02</span>
                                                        <span class="subfamily-title">CORTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015203">
                                                        <span class="subfamily-letter">03</span>
                                                        <span class="subfamily-title">MIUDEZAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015204">
                                                        <span class="subfamily-letter">04</span>
                                                        <span class="subfamily-title">OSSOS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015205">
                                                        <span class="subfamily-letter">05</span>
                                                        <span class="subfamily-title">PELES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015210">
                                                        <span class="subfamily-letter">10</span>
                                                        <span class="subfamily-title">FILETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015211">
                                                        <span class="subfamily-letter">11</span>
                                                        <span class="subfamily-title">VAZIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015212">
                                                        <span class="subfamily-letter">12</span>
                                                        <span class="subfamily-title">ACÉM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015213">
                                                        <span class="subfamily-letter">13</span>
                                                        <span class="subfamily-title">ALCATRA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015214">
                                                        <span class="subfamily-letter">14</span>
                                                        <span class="subfamily-title">RABADILHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015215">
                                                        <span class="subfamily-letter">15</span>
                                                        <span class="subfamily-title">PICANHA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015234">
                                                        <span class="subfamily-letter">34</span>
                                                        <span class="subfamily-title">CAÇA/OUTROS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015250">
                                                        <span class="subfamily-letter">50</span>
                                                        <span class="subfamily-title">PEIXE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015251">
                                                        <span class="subfamily-letter">51</span>
                                                        <span class="subfamily-title">MARISCO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015260">
                                                        <span class="subfamily-letter">60</span>
                                                        <span class="subfamily-title">LEGUMES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015261">
                                                        <span class="subfamily-letter">61</span>
                                                        <span class="subfamily-title">BATATAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015262">
                                                        <span class="subfamily-letter">62</span>
                                                        <span class="subfamily-title">FRUTA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015270">
                                                        <span class="subfamily-letter">70</span>
                                                        <span class="subfamily-title">QUEIJOS</span>
                                                    </li>                                                    
                                                    <li data-toggle="tooltip" data-placement="top" title="A015271">
                                                        <span class="subfamily-letter">71</span>
                                                        <span class="subfamily-title">MANTEIGAS</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015272">
                                                        <span class="subfamily-letter">72</span>
                                                        <span class="subfamily-title">YOGURTES</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015280">
                                                        <span class="subfamily-letter">80</span>
                                                        <span class="subfamily-title">PADARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015281">
                                                        <span class="subfamily-letter">81</span>
                                                        <span class="subfamily-title">PASTELARIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015291">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015292">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015293">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015294">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015295">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A015296">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>                                               
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-consumiveis" role="tabpanel" aria-labelledby="v-pills-a01-consumiveis-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A016000">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A016091">
                                                        <span class="subfamily-letter">91</span>
                                                        <span class="subfamily-title">ATM</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A016092">
                                                        <span class="subfamily-letter">92</span>
                                                        <span class="subfamily-title">COVETE</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A016093">
                                                        <span class="subfamily-letter">93</span>
                                                        <span class="subfamily-title">VÁCUO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A016094">
                                                        <span class="subfamily-letter">94</span>
                                                        <span class="subfamily-title">SACO</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A016095">
                                                        <span class="subfamily-letter">95</span>
                                                        <span class="subfamily-title">SKIN</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A016096">
                                                        <span class="subfamily-letter">96</span>
                                                        <span class="subfamily-title">AVULSO</span>
                                                    </li>
                                                </ul>  
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-gorduras-vegetais" role="tabpanel" aria-labelledby="v-pills-a01-gorduras-vegetais-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A017100">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">OLEOS</span>
                                                    </li>
                                                </ul> 
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-a01-molhos-temperos" role="tabpanel" aria-labelledby="v-pills-a01-molhos-temperos-tab">
                                                <ul class="nested">
                                                    <li class="disabled text-center">
                                                        <span class="cons-title-static">SUB-FAMILIA</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A017200">
                                                        <span class="subfamily-letter">00</span>
                                                        <span class="subfamily-title">GERAL</span>
                                                    </li>
                                                    <li data-toggle="tooltip" data-placement="top" title="A017201">
                                                        <span class="subfamily-letter">01</span>
                                                        <span class="subfamily-title">MARGARINAS</span>
                                                    </li>
                                                </ul> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-refrigerado" role="tabpanel" aria-labelledby="v-pills-refrigerado-tab">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills v-pills-tab" id="v-pills-refrigerado-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <span class="cons-title-static">TIPOLOGIA</span>
                                </a>
                                <a class="nav-link" id="v-pills-rmercadorias-tab" data-toggle="pill" href="#v-pills-rmercadorias" role="tab" aria-controls="v-pills-rmercadorias" aria-selected="true">
                                    <span class="cons-letter">01</span>
                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R01">MERCADORIAS</span>
                                </a>
                                <a class="nav-link" id="v-pills-rtransformados-tab" data-toggle="pill" href="#v-pills-rtransformados" role="tab" aria-controls="v-pills-rtransformados" aria-selected="true">
                                    <span class="cons-letter">03</span>
                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R03">TRANSFORMADOS</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent4">
                                <div class="tab-pane fade" id="v-pills-rmercadorias" role="tabpanel" aria-labelledby="v-pills-rmercadorias-tab">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                    <span class="cons-title-static">FAMILIA</span>
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-geral-tab" data-toggle="pill" href="#v-pills-r01-geral" role="tab" aria-controls="v-pills-r01-geral" aria-selected="true">
                                                    <span class="cons-letter">00</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0100">Geral</span>                                           
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-bovinos-tab" data-toggle="pill" href="#v-pills-r01-bovinos" role="tab" aria-controls="v-pills-r01-bovinos" aria-selected="false">
                                                    <span class="cons-letter">01</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0101">Bovinos</span>                                             
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-suinos-tab" data-toggle="pill" href="#v-pills-r01-suinos" role="tab" aria-controls="v-pills-r01-suinos" aria-selected="false">
                                                    <span class="cons-letter">02</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0102">Suinos</span> 
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-aves-tab" data-toggle="pill" href="#v-pills-r01-aves" role="tab" aria-controls="v-pills-r01-aves" aria-selected="false">
                                                    <span class="cons-letter">03</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0103">Aves</span>                                                                            
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-caprinos-ovinos-tab" data-toggle="pill" href="#v-pills-r01-caprinos-ovinos" role="tab" aria-controls="v-pills-r01-caprinos-ovinos" aria-selected="true">
                                                    <span class="cons-letter">04</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0104">Caprinos/Ovinos</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-produtos-do-mar-tab" data-toggle="pill" href="#v-pills-r01-produtos-do-mar" role="tab" aria-controls="v-pills-r01-produtos-do-mar" aria-selected="false">
                                                    <span class="cons-letter">05</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0105">Produtos do Mar</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-vegetais-tab" data-toggle="pill" href="#v-pills-r01-vegetais" role="tab" aria-controls="v-pills-r01-vegetais" aria-selected="false">
                                                    <span class="cons-letter">06</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0106">Vegetais</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-lacticinios-tab" data-toggle="pill" href="#v-pills-r01-lacticinios" role="tab" aria-controls="v-pills-r01-lacticinios" aria-selected="false">
                                                    <span class="cons-letter">07</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0107">Lacticinios</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-padaria-pastelaria-tab" data-toggle="pill" href="#v-pills-r01-padaria-pastelaria" role="tab" aria-controls="v-pills-r01-padaria-pastelaria" aria-selected="true">
                                                    <span class="cons-letter">08</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0108">Padaria e Pastelaria</span>                                                 
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-charcutaria-tab" data-toggle="pill" href="#v-pills-r01-charcutaria" role="tab" aria-controls="v-pills-r01-charcutaria" aria-selected="false">
                                                    <span class="cons-letter">09</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0109">Charcutaria</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-precozinhados-tab" data-toggle="pill" href="#v-pills-r01-precozinhados" role="tab" aria-controls="v-pills-r01-precozinhados" aria-selected="false">
                                                    <span class="cons-letter">10</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0110">Pré-Cozinhados</span>                                                                                       
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-ovoprodutos-tab" data-toggle="pill" href="#v-pills-r01-ovoprodutos" role="tab" aria-controls="v-pills-r01-ovoprodutos" aria-selected="false">
                                                    <span class="cons-letter">11</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0111">Ovoprodutos</span>                                             
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-preparados-carne-tab" data-toggle="pill" href="#v-pills-r01-preparados-carne" role="tab" aria-controls="v-pills-r01-preparados-carne" aria-selected="false">
                                                    <span class="cons-letter">12</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0112">Preparados de Carne</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-embalagens-tab" data-toggle="pill" href="#v-pills-r01-embalagens" role="tab" aria-controls="v-pills-r01-embalagens" aria-selected="false">
                                                    <span class="cons-letter">20</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0120">EMBALAGENS</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-cartao-tab" data-toggle="pill" href="#v-pills-r01-cartao" role="tab" aria-controls="v-pills-r01-cartao" aria-selected="false">
                                                    <span class="cons-letter">50</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0150">CARTÃO</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-plastico-tab" data-toggle="pill" href="#v-pills-r01-plastico" role="tab" aria-controls="v-pills-r01-plastico" aria-selected="false">
                                                    <span class="cons-letter">51</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0151">PLÁSTICO</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-organico-tab" data-toggle="pill" href="#v-pills-r01-organico" role="tab" aria-controls="v-pills-r01-organico" aria-selected="false">
                                                    <span class="cons-letter">52</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0152">ORGANICO</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-consumiveis-tab" data-toggle="pill" href="#v-pills-r01-consumiveis" role="tab" aria-controls="v-pills-r01-consumiveis" aria-selected="false">
                                                    <span class="cons-letter">60</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0160">CONSUMIVEIS</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r01-mbrancas-tab" data-toggle="pill" href="#v-pills-r01-mbrancas" role="tab" aria-controls="v-pills-r01-mbrancas" aria-selected="false">
                                                    <span class="cons-letter">80</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0180">MARCAS BRANCAS</span>                                             
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="tab-content" id="v-pills-tabContent5">
                                                <div class="tab-pane fade" id="v-pills-r01-geral" role="tabpanel" aria-labelledby="v-pills-r01-geral-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-bovinos" role="tabpanel" aria-labelledby="v-pills-r01-bovinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010101">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010102">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010103">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010104">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010105">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010110">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010111">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010112">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010113">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010114">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010115">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010134">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-suinos" role="tabpanel" aria-labelledby="v-pills-r01-suinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-aves" role="tabpanel" aria-labelledby="v-pills-r01-aves-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010300">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010301">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010302">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010303">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010304">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010305">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010310">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010311">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010312">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010313">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010314">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010315">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010330">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010331">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010332">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010333">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010334">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010391">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010392">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010393">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010394">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010395">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010396">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-caprinos-ovinos" role="tabpanel" aria-labelledby="v-pills-r01-caprinos-ovinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010400">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010401">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010402">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010403">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010404">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010405">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010410">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010411">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010412">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010413">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010414">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010415">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010434">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010491">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010492">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010493">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010494">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010495">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010496">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-produtos-do-mar" role="tabpanel" aria-labelledby="v-pills-r01-produtos-do-mar-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010500">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010550">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010551">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010591">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010592">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010593">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010594">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010595">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010596">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-vegetais" role="tabpanel" aria-labelledby="v-pills-r01-vegetais-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010600">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010660">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010661">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010662">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010691">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010692">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010693">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010694">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010695">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010696">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-lacticinios" role="tabpanel" aria-labelledby="v-pills-r01-lacticinios-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010700">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010770">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R010771">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010772">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010791">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010792">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010793">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010794">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010795">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010796">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-padaria-pastelaria" role="tabpanel" aria-labelledby="v-pills-r01-padaria-pastelaria-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010800">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010880">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010881">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010891">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010892">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010893">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010894">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010895">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010896">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-charcutaria" role="tabpanel" aria-labelledby="v-pills-r01-charcutaria-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010900">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010901">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010902">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010903">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010900">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010900">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">TERRINA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010900">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010911">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010912">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010913">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010914">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010915">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010930">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010931">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010932">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010933">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010934">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010950">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010951">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010991">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010992">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010993">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010994">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010995">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R010996">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-precozinhados" role="tabpanel" aria-labelledby="v-pills-r01-precozinhados-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011001">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011002">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011003">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011004">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011005">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011010">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011011">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011012">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011013">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011014">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011015">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011030">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011031">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011050">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011051">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011060">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011061">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011062">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011070">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R011071">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011072">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011080">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011081">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-ovoprodutos" role="tabpanel" aria-labelledby="v-pills-r01-ovoprodutos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011170">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R011171">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011172">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011180">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011181">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-preparados-carne" role="tabpanel" aria-labelledby="v-pills-r01-preparados-carne-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011230">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011231">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011232">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011233">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011250">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011251">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011260">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011261">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011262">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011270">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R011271">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011272">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011280">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011281">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R011296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-embalagens" role="tabpanel" aria-labelledby="v-pills-r01-embalagens-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012001">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012002">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012003">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012004">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012005">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012010">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012011">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012012">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012013">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012014">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012015">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012030">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012031">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012050">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012051">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012060">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012061">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012062">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012070">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R012071">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012072">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012080">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012081">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R012096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-cartao" role="tabpanel" aria-labelledby="v-pills-r01-cartao-tab">
                                                    <ul class="nested">                                                       
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-plastico" role="tabpanel" aria-labelledby="v-pills-r01-plastico-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-organico" role="tabpanel" aria-labelledby="v-pills-r01-organico-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015230">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015231">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015232">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015233">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015250">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015251">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015260">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015261">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015262">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015270">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R015271">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015272">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015280">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015281">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R015296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-consumiveis" role="tabpanel" aria-labelledby="v-pills-r01-consumiveis-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R016000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R016091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R016092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R016093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R016094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R016095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R016096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r01-mbrancas" role="tabpanel" aria-labelledby="v-pills-r01-mbrancas-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R018000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-rtransformados" role="tabpanel" aria-labelledby="v-pills-rtransformados-tab">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                    <span class="cons-title-static">FAMILIA</span>
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-geral-tab" data-toggle="pill" href="#v-pills-r03-geral" role="tab" aria-controls="v-pills-r03-geral" aria-selected="true">
                                                    <span class="cons-letter">00</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0300">Geral</span>                                           
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-bovinos-tab" data-toggle="pill" href="#v-pills-r03-bovinos" role="tab" aria-controls="v-pills-r03-bovinos" aria-selected="false">
                                                    <span class="cons-letter">01</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0301">Bovinos</span>                                             
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-suinos-tab" data-toggle="pill" href="#v-pills-r03-suinos" role="tab" aria-controls="v-pills-r03-suinos" aria-selected="false">
                                                    <span class="cons-letter">02</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0302">Suinos</span> 
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-aves-tab" data-toggle="pill" href="#v-pills-r03-aves" role="tab" aria-controls="v-pills-r03-aves" aria-selected="false">
                                                    <span class="cons-letter">03</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0303">Aves</span>                                                                            
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-caprinos-ovinos-tab" data-toggle="pill" href="#v-pills-r03-caprinos-ovinos" role="tab" aria-controls="v-pills-r03-caprinos-ovinos" aria-selected="true">
                                                    <span class="cons-letter">04</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0304">Caprinos/Ovinos</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-produtos-mar-tab" data-toggle="pill" href="#v-pills-r03-produtos-mar" role="tab" aria-controls="v-pills-r03-produtos-mar" aria-selected="false">
                                                    <span class="cons-letter">05</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0305">Produtos do Mar</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-vegetais-tab" data-toggle="pill" href="#v-pills-r03-vegetais" role="tab" aria-controls="v-pills-r03-vegetais" aria-selected="false">
                                                    <span class="cons-letter">06</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0306">Vegetais</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-lacticinios-tab" data-toggle="pill" href="#v-pills-r03-lacticinios" role="tab" aria-controls="v-pills-r03-lacticinios" aria-selected="false">
                                                    <span class="cons-letter">07</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0307">Lacticinios</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-padaria-pastelaria-tab" data-toggle="pill" href="#v-pills-r03-padaria-pastelaria" role="tab" aria-controls="v-pills-r03-padaria-pastelaria" aria-selected="true">
                                                    <span class="cons-letter">08</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0308">Padaria e Pastelaria</span>                                                 
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-charcutaria-tab" data-toggle="pill" href="#v-pills-r03-charcutaria" role="tab" aria-controls="v-pills-r03-charcutaria" aria-selected="false">
                                                    <span class="cons-letter">09</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0309">Charcutaria</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-precozinhados-tab" data-toggle="pill" href="#v-pills-r03-precozinhados" role="tab" aria-controls="v-pills-r03-precozinhados" aria-selected="false">
                                                    <span class="cons-letter">10</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0310">Pré-Cozinhados</span>                                                                                       
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-ovoprodutos-tab" data-toggle="pill" href="#v-pills-r03-ovoprodutos" role="tab" aria-controls="v-pills-r03-ovoprodutos" aria-selected="false">
                                                    <span class="cons-letter">11</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0311">Ovoprodutos</span>                                             
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-preparados-carne-tab" data-toggle="pill" href="#v-pills-r03-preparados-carne" role="tab" aria-controls="v-pills-r03-preparados-carne" aria-selected="false">
                                                    <span class="cons-letter">12</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0312">Preparados de Carne</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-embalagens-tab" data-toggle="pill" href="#v-pills-r03-embalagens" role="tab" aria-controls="v-pills-r03-embalagens" aria-selected="false">
                                                    <span class="cons-letter">20</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0320">EMBALAGENS</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-cartao-tab" data-toggle="pill" href="#v-pills-r03-cartao" role="tab" aria-controls="v-pills-r03-cartao" aria-selected="false">
                                                    <span class="cons-letter">50</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0350">CARTÃO</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-plastico-tab" data-toggle="pill" href="#v-pills-r03-plastico" role="tab" aria-controls="v-pills-r03-plastico" aria-selected="false">
                                                    <span class="cons-letter">51</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0351">PLÁSTICO</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-organico-tab" data-toggle="pill" href="#v-pills-r03-organico" role="tab" aria-controls="v-pills-r03-organico" aria-selected="false">
                                                    <span class="cons-letter">52</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0352">ORGANICO</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-consumiveis-tab" data-toggle="pill" href="#v-pills-r03-consumiveis" role="tab" aria-controls="v-pills-r03-consumiveis" aria-selected="false">
                                                    <span class="cons-letter">60</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0360">CONSUMIVEIS</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-r03-mbrancas-tab" data-toggle="pill" href="#v-pills-r03-mbrancas" role="tab" aria-controls="v-pills-r03-mbrancas" aria-selected="false">
                                                    <span class="cons-letter">80</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="R0380">MARCAS BRANCAS</span>                                             
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="tab-content" id="v-pills-tabContent6">
                                                <div class="tab-pane fade" id="v-pills-r03-geral" role="tabpanel" aria-labelledby="v-pills-r03-geral-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-bovinos" role="tabpanel" aria-labelledby="v-pills-r03-bovinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030101">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030102">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030103">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030104">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030105">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030110">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030111">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030112">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030113">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030114">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030115">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030134">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R0300193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-suinos" role="tabpanel" aria-labelledby="v-pills-r03-suinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-aves" role="tabpanel" aria-labelledby="v-pills-r03-aves-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030230">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030231">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030232">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030233">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-caprinos-ovinos" role="tabpanel" aria-labelledby="v-pills-r03-caprinos-ovinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030400">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030401">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030402">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030403">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030404">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030405">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030410">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030411">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030412">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030413">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030414">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030415">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030434">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030491">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030492">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030493">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030494">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030495">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030496">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-produtos-mar" role="tabpanel" aria-labelledby="v-pills-r03-produtos-mar-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030500">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030550">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030551">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030591">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030592">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030593">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030594">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030595">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030596">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-vegetais" role="tabpanel" aria-labelledby="v-pills-r03-vegetais-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030600">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030660">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030661">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030662">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030691">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030692">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030693">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030694">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030695">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030696">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>                                                    
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-lacticinios" role="tabpanel" aria-labelledby="v-pills-r03-lacticinios-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030700">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030770">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R030771">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030772">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030791">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030792">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030793">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030794">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030795">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030796">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-padaria-pastelaria" role="tabpanel" aria-labelledby="v-pills-r03-padaria-pastelaria-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030800">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030880">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030881">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030891">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030892">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030893">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030894">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030895">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030896">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-charcutaria" role="tabpanel" aria-labelledby="v-pills-r03-charcutaria-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030900">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030901">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030902">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030903">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030804">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030905">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030910">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030911">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030812">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030913">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030914">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030915">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030930">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030931">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030932">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030933">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030934">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030950">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030951">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030991">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030992">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030993">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030994">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030995">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R030996">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-precozinhados" role="tabpanel" aria-labelledby="v-pills-r03-precozinhados-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031001">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031002">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031003">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031004">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031005">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031010">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031011">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031012">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031013">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031014">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031015">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031030">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031031">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031050">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031051">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031060">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031061">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031062">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031070">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R031071">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031072">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031080">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031081">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-ovoprodutos" role="tabpanel" aria-labelledby="v-pills-r03-ovoprodutos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031170">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R031171">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031172">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031180">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031181">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-preparados-carne" role="tabpanel" aria-labelledby="v-pills-r03-preparados-carne-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031230">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031231">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031232">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031233">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031250">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031251">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031260">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031261">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031262">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031270">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R031271">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031272">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031280">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031281">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R031296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-embalagens" role="tabpanel" aria-labelledby="v-pills-r03-embalagens-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032001">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032002">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032003">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032004">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032005">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032010">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032011">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032012">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032013">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032014">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032015">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032030">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032031">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032050">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032051">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032060">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032061">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032062">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032070">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R032071">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032072">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032080">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032081">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R032096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-cartao" role="tabpanel" aria-labelledby="v-pills-r03-cartao-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>                                                    
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-plastico" role="tabpanel" aria-labelledby="v-pills-r03-plastico-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul> 
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-organico" role="tabpanel" aria-labelledby="v-pills-r03-organico-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035230">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035231">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035232">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035233">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035250">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035251">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035260">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035261">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035262">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035270">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="R035271">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035272">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035280">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035281">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R035296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>                                                    
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-consumiveis" role="tabpanel" aria-labelledby="v-pills-r03-consumiveis-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R036000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R036091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R036092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R036093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R036094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R036095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R036096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul> 
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-r03-mbrancas" role="tabpanel" aria-labelledby="v-pills-r03-mbrancas-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="R038000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                    </ul>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="tab-pane fade" id="v-pills-congelado" role="tabpanel" aria-labelledby="v-pills-congelado-tab">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills v-pills-tab" id="v-pills-congelado-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <span class="cons-title-static">TIPOLOGIA</span>
                                </a>
                                <a class="nav-link" id="v-pills-cmercadorias-tab" data-toggle="pill" href="#v-pills-cmercadorias" role="tab" aria-controls="v-pills-cmercadorias" aria-selected="true">
                                    <span class="cons-letter">01</span>
                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C01">MERCADORIAS</span>
                                </a>
                                <a class="nav-link" id="v-pills-ctransformados-tab" data-toggle="pill" href="#v-pills-ctransformados" role="tab" aria-controls="v-pills-ctransformados" aria-selected="true">
                                    <span class="cons-letter">03</span>
                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C03">TRANSFORMADOS</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent7">
                                <div class="tab-pane fade" id="v-pills-cmercadorias" role="tabpanel" aria-labelledby="v-pills-cmercadorias-tab">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                    <span class="cons-title-static">FAMILIA</span>
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-geral-tab" data-toggle="pill" href="#v-pills-c01-geral" role="tab" aria-controls="v-pills-c01-geral" aria-selected="true">
                                                    <span class="cons-letter">00</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0100">Geral</span>                                           
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-bovinos-tab" data-toggle="pill" href="#v-pills-c01-bovinos" role="tab" aria-controls="v-pills-c01-bovinos" aria-selected="false">
                                                    <span class="cons-letter">01</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0101">Bovinos</span>                                             
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-suinos-tab" data-toggle="pill" href="#v-pills-c01-suinos" role="tab" aria-controls="v-pills-c01-suinos" aria-selected="false">
                                                    <span class="cons-letter">02</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0102">Suinos</span> 
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-aves-tab" data-toggle="pill" href="#v-pills-c01-aves" role="tab" aria-controls="v-pills-c01-aves" aria-selected="false">
                                                    <span class="cons-letter">03</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0103">Aves</span>                                                                            
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-caprinos-ovinos-tab" data-toggle="pill" href="#v-pills-c01-caprinos-ovinos" role="tab" aria-controls="v-pills-r01-caprinos-ovinos" aria-selected="true">
                                                    <span class="cons-letter">04</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0104">Caprinos/Ovinos</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-peixe-marisco-tab" data-toggle="pill" href="#v-pills-c01-peixe-marisco" role="tab" aria-controls="v-pills-c01-peixe-marisco" aria-selected="false">
                                                    <span class="cons-letter">05</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0105">Peixe&Marisco</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-vegetais-tab" data-toggle="pill" href="#v-pills-c01-vegetais" role="tab" aria-controls="v-pills-c01-vegetais" aria-selected="false">
                                                    <span class="cons-letter">06</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0106">Vegetais</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-lacticinios-tab" data-toggle="pill" href="#v-pills-c01-lacticinios" role="tab" aria-controls="v-pills-c01-lacticinios" aria-selected="false">
                                                    <span class="cons-letter">07</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0107">Lacticinios</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-padaria-pastelaria-tab" data-toggle="pill" href="#v-pills-c01-padaria-pastelaria" role="tab" aria-controls="v-pills-c01-padaria-pastelaria" aria-selected="true">
                                                    <span class="cons-letter">08</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0108">Padaria e Pastelaria</span>                                                 
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-charcutaria-tab" data-toggle="pill" href="#v-pills-c01-charcutaria" role="tab" aria-controls="v-pills-c01-charcutaria" aria-selected="false">
                                                    <span class="cons-letter">09</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0109">Charcutaria</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-precozinhados-tab" data-toggle="pill" href="#v-pills-c01-precozinhados" role="tab" aria-controls="v-pills-c01-precozinhados" aria-selected="false">
                                                    <span class="cons-letter">10</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0110">Pré-Cozinhados</span>                                                                                       
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-ovoprodutos-tab" data-toggle="pill" href="#v-pills-c01-ovoprodutos" role="tab" aria-controls="v-pills-c01-ovoprodutos" aria-selected="false">
                                                    <span class="cons-letter">11</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0111">Ovoprodutos</span>                                             
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-preparados-carne-tab" data-toggle="pill" href="#v-pills-c01-preparados-carne" role="tab" aria-controls="v-pills-c01-preparados-carne" aria-selected="false">
                                                    <span class="cons-letter">12</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0112">Preparados de Carne</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-sushi-tab" data-toggle="pill" href="#v-pills-c01-sushi" role="tab" aria-controls="v-pills-c01-sushi" aria-selected="false">
                                                    <span class="cons-letter">13</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0113">Sushi</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-embalagens-tab" data-toggle="pill" href="#v-pills-c01-embalagens" role="tab" aria-controls="v-pills-c01-embalagens" aria-selected="false">
                                                    <span class="cons-letter">20</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0120">EMBALAGENS</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-cartao-tab" data-toggle="pill" href="#v-pills-c01-cartao" role="tab" aria-controls="v-pills-c01-cartao" aria-selected="false">
                                                    <span class="cons-letter">50</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0150">CARTÃO</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-plastico-tab" data-toggle="pill" href="#v-pills-c01-plastico" role="tab" aria-controls="v-pills-c01-plastico" aria-selected="false">
                                                    <span class="cons-letter">51</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0151">PLÁSTICO</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-organico-tab" data-toggle="pill" href="#v-pills-c01-organico" role="tab" aria-controls="v-pills-c01-organico" aria-selected="false">
                                                    <span class="cons-letter">52</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0152">ORGANICO</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-consumiveis-tab" data-toggle="pill" href="#v-pills-c01-consumiveis" role="tab" aria-controls="v-pills-c01-consumiveis" aria-selected="false">
                                                    <span class="cons-letter">60</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0160">CONSUMIVEIS</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c01-mbrancas-tab" data-toggle="pill" href="#v-pills-c01-mbrancas" role="tab" aria-controls="v-pills-c01-mbrancas" aria-selected="false">
                                                    <span class="cons-letter">80</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0180">MARCAS BRANCAS</span>                                             
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="tab-content" id="v-pills-tabContent8">
                                                <div class="tab-pane fade" id="v-pills-c01-geral" role="tabpanel" aria-labelledby="v-pills-c01-geral-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">FOIE GRAS</span>
                                                        </li>                                                        
                                                        <li data-toggle="tooltip" data-placement="top" title="C010033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">CAÇA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-bovinos" role="tabpanel" aria-labelledby="v-pills-c01-bovinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">BOVINOS OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010101">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">LINGUA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010102">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">FIGADO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010103">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">DOBRADA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010104">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">CHAMBAO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010105">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">CHA DENTRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010106">
                                                            <span class="subfamily-letter">06</span>
                                                            <span class="subfamily-title">MAMINHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010108">
                                                            <span class="subfamily-letter">08</span>
                                                            <span class="subfamily-title">PORCIONADOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010109">
                                                            <span class="subfamily-letter">09</span>
                                                            <span class="subfamily-title">FILETE 3/4 LBS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010110">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE 4/5 & +5 LBS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010111">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA C/CORDAO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010112">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">VAZIA S/CORDAO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010113">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010114">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010115">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010116">
                                                            <span class="subfamily-letter">16</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010120">
                                                            <span class="subfamily-letter">20</span>
                                                            <span class="subfamily-title">VITELA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010130">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">EXCHILLED</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010134">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-suinos" role="tabpanel" aria-labelledby="v-pills-c01-suinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">SUINO OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CACHAÇO C/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CACHAÇO S/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">ENTREMEADA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">JOELHEIRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PERNA S/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010206">
                                                            <span class="subfamily-letter">06</span>
                                                            <span class="subfamily-title">PÁ SUINO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010207">
                                                            <span class="subfamily-letter">07</span>
                                                            <span class="subfamily-title">PATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010208">
                                                            <span class="subfamily-letter">08</span>
                                                            <span class="subfamily-title">ORELHAS SUINO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010209">
                                                            <span class="subfamily-letter">09</span>
                                                            <span class="subfamily-title">RABOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">LOMBO SUINO S/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ENTRECOSTO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PORCO PRETO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010216">
                                                            <span class="subfamily-letter">16</span>
                                                            <span class="subfamily-title">LEITAO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010217">
                                                            <span class="subfamily-letter">17</span>
                                                            <span class="subfamily-title">LEITAO CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-aves" role="tabpanel" aria-labelledby="v-pills-c01-aves-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010300">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010301">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010302">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010303">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010304">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010305">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010310">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010311">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010312">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010313">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010314">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010315">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010330">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO INTEIRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010331">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">FRANGO PEITO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010332">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">FRANGO PERNAS & QUARTOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010333">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">FRANGO COTOS & COXA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010334">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">FRANGO ASAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010335">
                                                            <span class="subfamily-letter">35</span>
                                                            <span class="subfamily-title">FRANGO MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010336">
                                                            <span class="subfamily-letter">36</span>
                                                            <span class="subfamily-title">PERU INTEIRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010337">
                                                            <span class="subfamily-letter">37</span>
                                                            <span class="subfamily-title">PERU CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010338">
                                                            <span class="subfamily-letter">38</span>
                                                            <span class="subfamily-title">PATOS & GALINHAS INTEIRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010339">
                                                            <span class="subfamily-letter">39</span>
                                                            <span class="subfamily-title">PATO CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010391">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010392">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010393">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010394">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010395">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010396">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-caprinos-ovinos" role="tabpanel" aria-labelledby="v-pills-c01-caprinos-ovinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010400">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">CABRITO E BORREGO INTEIRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010401">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">DIANTEIRO & PÁ</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010402">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">PERNA S/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010403">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">PERNA C/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010404">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">LOMBO C/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010405">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">LOMBO S/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010406">
                                                            <span class="subfamily-letter">06</span>
                                                            <span class="subfamily-title">COSTELETAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010407">
                                                            <span class="subfamily-letter">07</span>
                                                            <span class="subfamily-title">JOELHEIRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010408">
                                                            <span class="subfamily-letter">08</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010410">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010411">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010412">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010413">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010414">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010415">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010434">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010491">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010492">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010493">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010494">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010495">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010496">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-peixe-marisco" role="tabpanel" aria-labelledby="v-pills-c01-peixe-marisco-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010500">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010550">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">FILETES E LOMBOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010551">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">PEIXE INTEIRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010552">
                                                            <span class="subfamily-letter">52</span>
                                                            <span class="subfamily-title">POLVO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010553">
                                                            <span class="subfamily-letter">53</span>
                                                            <span class="subfamily-title">LULAS/CHOCOS/POTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010554">
                                                            <span class="subfamily-letter">54</span>
                                                            <span class="subfamily-title">BIVALVES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010555">
                                                            <span class="subfamily-letter">55</span>
                                                            <span class="subfamily-title">ATUM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010556">
                                                            <span class="subfamily-letter">56</span>
                                                            <span class="subfamily-title">BACALHAU E PALOCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010557">
                                                            <span class="subfamily-letter">57</span>
                                                            <span class="subfamily-title">PEIXE FUMADO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010558">
                                                            <span class="subfamily-letter">58</span>
                                                            <span class="subfamily-title">MISTURAS DE MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010559">
                                                            <span class="subfamily-letter">59</span>
                                                            <span class="subfamily-title">LAGOSTA E SIMILARES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010560">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">GAMBAO ARGENTINO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010561">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">CAMARAO BLACK TIGER</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010562">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">CAMARAO MOÇAMBIQUE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010563">
                                                            <span class="subfamily-letter">63</span>
                                                            <span class="subfamily-title">CAMARAO NIGERIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010500">
                                                            <span class="subfamily-letter">64</span>
                                                            <span class="subfamily-title">CAMARAO COZIDO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010565">
                                                            <span class="subfamily-letter">65</span>
                                                            <span class="subfamily-title">CAMARAO TANZANIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010566">
                                                            <span class="subfamily-letter">66</span>
                                                            <span class="subfamily-title">CAMARAO SEM CABECA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010567">
                                                            <span class="subfamily-letter">67</span>
                                                            <span class="subfamily-title">MIOLO CAMARAO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010568">
                                                            <span class="subfamily-letter">68</span>
                                                            <span class="subfamily-title">CARABINERO E CIGALA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010591">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010592">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010593">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010594">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010595">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010596">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-vegetais" role="tabpanel" aria-labelledby="v-pills-c01-vegetais-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010600">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010660">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010661">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010662">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010691">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010692">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010693">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010694">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010695">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010696">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-lacticinios" role="tabpanel" aria-labelledby="v-pills-c01-lacticinios-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010700">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010770">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010771">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010772">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010791">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010792">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010793">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010794">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010795">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010796">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-padaria-pastelaria" role="tabpanel" aria-labelledby="v-pills-c01-padaria-pastelaria-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010800">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010880">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA MINIATURA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010881">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">MINI FOLHADOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010882">
                                                            <span class="subfamily-letter">82</span>
                                                            <span class="subfamily-title">SEM GLUTEN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010883">
                                                            <span class="subfamily-letter">83</span>
                                                            <span class="subfamily-title">PADARIA FATIAR</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010884">
                                                            <span class="subfamily-letter">84</span>
                                                            <span class="subfamily-title">FOLHADOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010885">
                                                            <span class="subfamily-letter">85</span>
                                                            <span class="subfamily-title">DONUTS E MUFFINS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010886">
                                                            <span class="subfamily-letter">86</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010887">
                                                            <span class="subfamily-letter">87</span>
                                                            <span class="subfamily-title">PADARIA MÉDIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010888">
                                                            <span class="subfamily-letter">88</span>
                                                            <span class="subfamily-title">PIZZAS E FOCACCIAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010891">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010892">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010893">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010894">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010895">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010896">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-charcutaria" role="tabpanel" aria-labelledby="v-pills-c01-charcutaria-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010900">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010901">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010902">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010903">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010904">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010905">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">TERRINA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010910">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010911">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010912">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010913">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010914">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010915">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010930">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010931">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010932">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010933">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010934">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010950">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010951">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010991">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010992">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010993">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010994">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010995">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C010996">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-precozinhados" role="tabpanel" aria-labelledby="v-pills-c01-precozinhados-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011001">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011002">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011003">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011004">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011005">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011010">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011011">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011012">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011013">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011014">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011015">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011030">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011031">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011050">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011051">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-ovoprodutos" role="tabpanel" aria-labelledby="v-pills-c01-ovoprodutos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011170">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C011171">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011172">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011180">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011181">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-preparados-carne" role="tabpanel" aria-labelledby="v-pills-c01-preparados-carne-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011230">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011231">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011232">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011233">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011250">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011251">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011260">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011261">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011262">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011270">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C011271">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011272">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011280">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011281">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-sushi" role="tabpanel" aria-labelledby="v-pills-c01-sushi-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C011300">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-embalagens" role="tabpanel" aria-labelledby="v-pills-c01-embalagens-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012001">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012002">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012003">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012004">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012005">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012010">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012011">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012012">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012013">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012014">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012015">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012030">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012031">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012050">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012000">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012051">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012060">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012061">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012062">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012070">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C012071">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012072">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012080">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012081">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C012096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-cartao" role="tabpanel" aria-labelledby="v-pills-c01-cartao-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-plastico" role="tabpanel" aria-labelledby="v-pills-c01-plastico-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-organico" role="tabpanel" aria-labelledby="v-pills-c01-organico-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015230">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015231">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015232">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015233">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015250">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015251">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015260">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015261">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015262">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015270">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C015271">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015272">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015280">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015281">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C015296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-consumiveis" role="tabpanel" aria-labelledby="v-pills-c01-consumiveis-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C016000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C016091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C016092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C016093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C016094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C016095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C016096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c01-mbrancas" role="tabpanel" aria-labelledby="v-pills-c01-mbrancas-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C018000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-ctransformados" role="tabpanel" aria-labelledby="v-pills-ctransformados-tab">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link disabled text-center" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                                    <span class="cons-title-static">FAMILIA</span>
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-geral-tab" data-toggle="pill" href="#v-pills-c03-geral" role="tab" aria-controls="v-pills-c03-geral" aria-selected="true">
                                                    <span class="cons-letter">00</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0300">Geral</span>                                           
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-bovinos-tab" data-toggle="pill" href="#v-pills-c03-bovinos" role="tab" aria-controls="v-pills-c03-bovinos" aria-selected="false">
                                                    <span class="cons-letter">01</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0301">Bovinos</span>                                             
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-suinos-tab" data-toggle="pill" href="#v-pills-c03-suinos" role="tab" aria-controls="v-pills-c03-suinos" aria-selected="false">
                                                    <span class="cons-letter">02</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0302">Suinos</span> 
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-aves-tab" data-toggle="pill" href="#v-pills-c03-aves" role="tab" aria-controls="v-pills-c03-aves" aria-selected="false">
                                                    <span class="cons-letter">03</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0303">Aves</span>                                                                            
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-caprinos-ovinos-tab" data-toggle="pill" href="#v-pills-c03-caprinos-ovinos" role="tab" aria-controls="v-pills-c03-caprinos-ovinos" aria-selected="true">
                                                    <span class="cons-letter">04</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0304">Caprinos/Ovinos</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-produtos-mar-tab" data-toggle="pill" href="#v-pills-c03-produtos-mar" role="tab" aria-controls="v-pills-c03-produtos-mar" aria-selected="false">
                                                    <span class="cons-letter">05</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0305">Produtos do Mar</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-vegetais-tab" data-toggle="pill" href="#v-pills-c03-vegetais" role="tab" aria-controls="v-pills-c03-vegetais" aria-selected="false">
                                                    <span class="cons-letter">06</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0306">Vegetais</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-lacticinios-tab" data-toggle="pill" href="#v-pills-c03-lacticinios" role="tab" aria-controls="v-pills-c03-lacticinios" aria-selected="false">
                                                    <span class="cons-letter">07</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0307">Lacticinios</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-padaria-pastelaria-tab" data-toggle="pill" href="#v-pills-c03-padaria-pastelaria" role="tab" aria-controls="v-pills-c03-padaria-pastelaria" aria-selected="true">
                                                    <span class="cons-letter">08</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0308">Padaria e Pastelaria</span>                                                 
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-charcutaria-tab" data-toggle="pill" href="#v-pills-c03-charcutaria" role="tab" aria-controls="v-pills-c03-charcutaria" aria-selected="false">
                                                    <span class="cons-letter">09</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0309">Charcutaria</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-precozinhados-tab" data-toggle="pill" href="#v-pills-c03-precozinhados" role="tab" aria-controls="v-pills-c03-precozinhados" aria-selected="false">
                                                    <span class="cons-letter">10</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0310">Pré-Cozinhados</span>                                                                                       
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-ovoprodutos-tab" data-toggle="pill" href="#v-pills-c03-ovoprodutos" role="tab" aria-controls="v-pills-c03-ovoprodutos" aria-selected="false">
                                                    <span class="cons-letter">11</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0311">Ovoprodutos</span>                                             
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-preparados-carne-tab" data-toggle="pill" href="#v-pills-c03-preparados-carne" role="tab" aria-controls="v-pills-c03-preparados-carne" aria-selected="false">
                                                    <span class="cons-letter">12</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0312">Preparados de Carne</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-embalagens-tab" data-toggle="pill" href="#v-pills-c03-embalagens" role="tab" aria-controls="v-pills-c03-embalagens" aria-selected="false">
                                                    <span class="cons-letter">20</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0320">EMBALAGENS</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-cartao-tab" data-toggle="pill" href="#v-pills-c03-cartao" role="tab" aria-controls="v-pills-c03-cartao" aria-selected="false">
                                                    <span class="cons-letter">50</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0350">CARTÃO</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-plastico-tab" data-toggle="pill" href="#v-pills-c03-plastico" role="tab" aria-controls="v-pills-c03-plastico" aria-selected="false">
                                                    <span class="cons-letter">51</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0351">PLÁSTICO</span>                                                                                        
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-organico-tab" data-toggle="pill" href="#v-pills-c03-organico" role="tab" aria-controls="v-pills-c03-organico" aria-selected="false">
                                                    <span class="cons-letter">52</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0352">ORGANICO</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-consumiveis-tab" data-toggle="pill" href="#v-pills-c03-consumiveis" role="tab" aria-controls="v-pills-c03-consumiveis" aria-selected="false">
                                                    <span class="cons-letter">60</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0360">CONSUMIVEIS</span>                                                                                         
                                                </a>
                                                <a class="nav-link" id="v-pills-c03-mbrancas-tab" data-toggle="pill" href="#v-pills-c03-mbrancas" role="tab" aria-controls="v-pills-c03-mbrancas" aria-selected="false">
                                                    <span class="cons-letter">80</span>
                                                    <span class="cons-title" data-toggle="tooltip" data-placement="top" title="C0380">MARCAS BRANCAS</span>                                             
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="tab-content" id="v-pills-tabContent9">
                                                <div class="tab-pane fade" id="v-pills-c03-geral" role="tabpanel" aria-labelledby="v-pills-c03-geral-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-bovinos" role="tabpanel" aria-labelledby="v-pills-c03-bovinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030101">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030102">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030103">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030104">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030105">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030110">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030111">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030112">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030113">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030114">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030115">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030134">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-suinos" role="tabpanel" aria-labelledby="v-pills-c03-suinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">SUINO OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CACHAÇO C/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CACHAÇO S/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">ENTREMEADA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">JOELHEIRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PERNA S/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030206">
                                                            <span class="subfamily-letter">06</span>
                                                            <span class="subfamily-title">PÁ SUINO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030207">
                                                            <span class="subfamily-letter">07</span>
                                                            <span class="subfamily-title">PATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030208">
                                                            <span class="subfamily-letter">08</span>
                                                            <span class="subfamily-title">ORELHAS SUINO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030209">
                                                            <span class="subfamily-letter">09</span>
                                                            <span class="subfamily-title">RABOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">LOMBO SUINO S/OSSO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ENTRECOSTO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PORCO PRETO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030216">
                                                            <span class="subfamily-letter">16</span>
                                                            <span class="subfamily-title">LEITAO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030217">
                                                            <span class="subfamily-letter">17</span>
                                                            <span class="subfamily-title">LEITAO CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-aves" role="tabpanel" aria-labelledby="v-pills-c03-aves-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030300">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030301">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030302">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030303">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030304">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030305">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030310">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030311">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030312">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030313">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030314">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030315">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030330">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO INTEIRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030331">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">FRANGO PEITO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030332">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">FRANGO PERNAS & QUARTOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030333">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">FRANGO COTOS & COXA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030334">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">FRANGO ASAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030335">
                                                            <span class="subfamily-letter">35</span>
                                                            <span class="subfamily-title">FRANGO MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030336">
                                                            <span class="subfamily-letter">36</span>
                                                            <span class="subfamily-title">PERU INTEIRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030337">
                                                            <span class="subfamily-letter">37</span>
                                                            <span class="subfamily-title">PERU CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030338">
                                                            <span class="subfamily-letter">38</span>
                                                            <span class="subfamily-title">PATOS & GALINHAS INTEIRO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030339">
                                                            <span class="subfamily-letter">39</span>
                                                            <span class="subfamily-title">PATO CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030391">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030392">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030393">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030394">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030395">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030396">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-caprinos-ovinos" role="tabpanel" aria-labelledby="v-pills-c03-caprinos-ovinos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030400">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030401">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030402">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030403">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030404">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030405">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030410">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030411">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030412">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030413">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030414">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030415">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030434">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030491">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030492">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030493">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030494">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030495">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030496">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-produtos-mar" role="tabpanel" aria-labelledby="v-pills-c03-produtos-mar-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030500">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030550">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030551">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030591">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030592">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030593">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030594">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030595">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030596">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-vegetais" role="tabpanel" aria-labelledby="v-pills-c03-vegetais-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>    
                                                        <li data-toggle="tooltip" data-placement="top" title="C030600">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030660">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030661">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030662">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030691">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030692">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030693">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030694">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030695">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030696">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-lacticinios" role="tabpanel" aria-labelledby="v-pills-c03-lacticinios-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030700">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030770">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C030771">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030772">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030791">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030792">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030793">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030794">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030795">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030796">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-padaria-pastelaria" role="tabpanel" aria-labelledby="v-pills-r01-padaria-pastelaria-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030800">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030880">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030881">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030891">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030892">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030893">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030894">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030895">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030896">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-charcutaria" role="tabpanel" aria-labelledby="v-pills-c03-charcutaria-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030900">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030901">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030902">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030903">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030904">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030905">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030910">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030911">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030912">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030913">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030914">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030915">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030930">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030931">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030932">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030933">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030934">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030950">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030900">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030991">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030992">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030993">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030994">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030995">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C030996">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-precozinhados" role="tabpanel" aria-labelledby="v-pills-c03-precozinhados-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031001">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031002">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031003">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031004">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031005">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031010">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031011">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031012">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031013">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031014">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031015">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031030">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031031">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031050">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031051">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031060">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031061">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031062">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031070">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C031071">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031072">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031080">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031081">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-ovoprodutos" role="tabpanel" aria-labelledby="v-pills-c03-ovoprodutos-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031170">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C031171">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031172">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031180">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031181">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-preparados-carne" role="tabpanel" aria-labelledby="v-pills-c03-preparados-carne-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031200">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C031296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-embalagens" role="tabpanel" aria-labelledby="v-pills-c03-embalagens-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032001">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032002">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032003">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032004">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032005">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032010">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032011">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032012">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032013">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032014">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032015">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032030">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032031">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032032">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032033">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032034">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032050">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032051">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032061">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032000">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032062">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032070">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C032071">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032072">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032080">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032081">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C032096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-cartao" role="tabpanel" aria-labelledby="v-pills-c03-cartao-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-plastico" role="tabpanel" aria-labelledby="v-pills-c03-plastico-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035100">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035191">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035192">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035193">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035194">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035195">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035196">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-organico" role="tabpanel" aria-labelledby="v-pills-c03-organico-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035200">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035201">
                                                            <span class="subfamily-letter">01</span>
                                                            <span class="subfamily-title">CARCAÇAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035202">
                                                            <span class="subfamily-letter">02</span>
                                                            <span class="subfamily-title">CORTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035203">
                                                            <span class="subfamily-letter">03</span>
                                                            <span class="subfamily-title">MIUDEZAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035204">
                                                            <span class="subfamily-letter">04</span>
                                                            <span class="subfamily-title">OSSOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035205">
                                                            <span class="subfamily-letter">05</span>
                                                            <span class="subfamily-title">PELES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035210">
                                                            <span class="subfamily-letter">10</span>
                                                            <span class="subfamily-title">FILETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035211">
                                                            <span class="subfamily-letter">11</span>
                                                            <span class="subfamily-title">VAZIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035212">
                                                            <span class="subfamily-letter">12</span>
                                                            <span class="subfamily-title">ACÉM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035213">
                                                            <span class="subfamily-letter">13</span>
                                                            <span class="subfamily-title">ALCATRA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035214">
                                                            <span class="subfamily-letter">14</span>
                                                            <span class="subfamily-title">RABADILHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035215">
                                                            <span class="subfamily-letter">15</span>
                                                            <span class="subfamily-title">PICANHA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035230">
                                                            <span class="subfamily-letter">30</span>
                                                            <span class="subfamily-title">FRANGO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035231">
                                                            <span class="subfamily-letter">31</span>
                                                            <span class="subfamily-title">PERU</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035232">
                                                            <span class="subfamily-letter">32</span>
                                                            <span class="subfamily-title">PATO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035233">
                                                            <span class="subfamily-letter">33</span>
                                                            <span class="subfamily-title">GALINHAS/PATOS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035234">
                                                            <span class="subfamily-letter">34</span>
                                                            <span class="subfamily-title">CAÇA/OUTROS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035250">
                                                            <span class="subfamily-letter">50</span>
                                                            <span class="subfamily-title">PEIXE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035251">
                                                            <span class="subfamily-letter">51</span>
                                                            <span class="subfamily-title">MARISCO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035260">
                                                            <span class="subfamily-letter">60</span>
                                                            <span class="subfamily-title">LEGUMES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035261">
                                                            <span class="subfamily-letter">61</span>
                                                            <span class="subfamily-title">BATATAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035262">
                                                            <span class="subfamily-letter">62</span>
                                                            <span class="subfamily-title">FRUTA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035270">
                                                            <span class="subfamily-letter">70</span>
                                                            <span class="subfamily-title">QUEIJOS</span>
                                                        </li>                                                    
                                                        <li data-toggle="tooltip" data-placement="top" title="C035271">
                                                            <span class="subfamily-letter">71</span>
                                                            <span class="subfamily-title">MANTEIGAS</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035272">
                                                            <span class="subfamily-letter">72</span>
                                                            <span class="subfamily-title">YOGURTES</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035280">
                                                            <span class="subfamily-letter">80</span>
                                                            <span class="subfamily-title">PADARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035281">
                                                            <span class="subfamily-letter">81</span>
                                                            <span class="subfamily-title">PASTELARIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035291">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035292">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035293">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035294">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035295">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C035296">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-consumiveis" role="tabpanel" aria-labelledby="v-pills-c03-consumiveis-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C036000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C036091">
                                                            <span class="subfamily-letter">91</span>
                                                            <span class="subfamily-title">ATM</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C036092">
                                                            <span class="subfamily-letter">92</span>
                                                            <span class="subfamily-title">COVETE</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C036093">
                                                            <span class="subfamily-letter">93</span>
                                                            <span class="subfamily-title">VÁCUO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C036094">
                                                            <span class="subfamily-letter">94</span>
                                                            <span class="subfamily-title">SACO</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C036095">
                                                            <span class="subfamily-letter">95</span>
                                                            <span class="subfamily-title">SKIN</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C036096">
                                                            <span class="subfamily-letter">96</span>
                                                            <span class="subfamily-title">AVULSO</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="tab-pane fade" id="v-pills-c03-mbrancas" role="tabpanel" aria-labelledby="v-pills-c03-mbrancas-tab">
                                                    <ul class="nested">
                                                        <li class="disabled text-center">
                                                            <span class="cons-title-static">SUB-FAMILIA</span>
                                                        </li>
                                                        <li data-toggle="tooltip" data-placement="top" title="C038000">
                                                            <span class="subfamily-letter">00</span>
                                                            <span class="subfamily-title">GERAL</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready( function() 
        {
            $(function () {
              $('[data-toggle="tooltip"]').tooltip();
            });

            $( ".nav-link.active" ).dblclick(function() {
                alert( "Handler for .dblclick() called." );
            });

            var element = $( ".nav-link.active" );

            element.dblclick(function() {
                alert('ok');
            });

        });
    </script>
    <script> 



    $(document).on('click', '.nav-link.active', function() { 
        var href = $(this).attr('href').substring(1); 
        //alert(href); 
        $(this).removeClass('active');
        $('.tab-pane[id="' + href + '"]').removeClass('active'); 
        /*$('.tab-content .nav-link[id="' + href + '"]').removeClass('active'); 
        $(this).dblclick(function() 
        {
            $('.tab-pane[id="' + href + '"]').removeClass('active');
        });*/
    }); 

    /*$(document).mouseup(function(e) { 
        var container = $(".tab-content");  
        if (!container.is(e.target) && container.has(e.target).length === 0) { 
            $('.active').removeClass('active'); 
        } 
    }); */
    </script> 
@endsection

