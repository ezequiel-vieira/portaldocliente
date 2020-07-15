@extends('layouts.index')

@section('template_title')
    Catálogo
@endsection

@section('template_linked_css') 

<style type="text/css">
    ul, #myFamilyTree {
      list-style-type: none;
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
</style>
@endsection

@section('content')
<div class="container">
	<div class="page-header">
	   	<h1 class="text-h1"> FAMILIAS </h1>
        <small class="text-muted">COMPOSIÇÃO DOS CÓDIGOS DE PRODUTOS</small>
	</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul id="myFamilyTree">
                <li>
                    <span class="caret">AMBIENTE</span>
                    <ul class="nested">
                        <li><span class="caret">MERCADORIAS</span>
                            <ul class="nested">
                                <li>
                                    <span class="caret">Geral</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Bovinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Suinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Aves</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>FRANGO</li>
                                        <li>PERU</li>
                                        <li>PATO</li>
                                        <li>GALINHAS / PATOS</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Caprinos / Ovinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Produtos do Mar</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Lacticinios</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>LEGUMES</li>
                                        <li>BATATAS</li>
                                        <li>FRUTA</li>
                                        <li>LEGUMES</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Padaria / Pastelaria</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Charcutaria</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>FRANGO</li>
                                        <li>PERU</li>
                                        <li>PATO</li>
                                        <li>GALINHAS / PATOS</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Pré-cozinhados</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>FRANGO</li>
                                        <li>PERU</li>
                                        <li>PATO</li>
                                        <li>GALINHAS / PATOS</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Ovoprodutos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Preparados de Carne</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>LEGUMES</li>
                                        <li>BATATAS</li>
                                        <li>FRUTA</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>EMBALAGENS</li>
                                <li>CARTÃO</li>
                                <li>PLÁSTICO</li>
                                <li>ORGANICO</li>
                                <li>CONSUMIVEIS</li>
                                <li>GORDURAS VEGETAIS</li>
                                <li>MOLHOS E TEMPEROS</li>
                            </ul>
                        </li>   
                    </ul>
                </li>
                <li>
                    <span class="caret">REFRIGERADO</span>
                    <ul class="nested">
                        <li>
                            <span class="caret">MERCADORIAS</span>
                            <ul class="nested">
                                <li>
                                    <span class="caret">Geral</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Bovinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Suinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Aves</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>FRANGO</li>
                                        <li>PERU</li>
                                        <li>PATO</li>
                                        <li>GALINHAS / PATOS</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Caprinos / Ovinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Produtos do Mar</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Vegetais</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>LEGUMES</li>
                                        <li>BATATAS</li>
                                        <li>FRUTA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Lacticinios</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Padaria / Pastelaria</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Charcutaria</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>FRANGO</li>
                                        <li>PERU</li>
                                        <li>PATO</li>
                                        <li>GALINHAS / PATOS</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Pré-cozinhados</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>FRANGO</li>
                                        <li>PERU</li>
                                        <li>PATO</li>
                                        <li>GALINHAS / PATOS</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Ovoprodutos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>LEGUMES</li>
                                        <li>BATATAS</li>
                                        <li>FRUTA</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Preparados de Carne</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>LEGUMES</li>
                                        <li>BATATAS</li>
                                        <li>FRUTA</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>EMBALAGENS</li>
                                <li>CARTÃO</li>
                                <li>PLÁSTICO</li>
                                <li>ORGANICO</li>
                                <li>CONSUMIVEIS</li>
                                <li>MARCAS BRANCAS</li>
                            </ul>
                        </li>
                        <li>
                            <span class="caret">TRANSFORMADOS</span>
                            <ul class="nested">
                                <li>
                                    <span class="caret">Geral</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Bovinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Suinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Aves</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>FRANGO</li>
                                        <li>PERU</li>
                                        <li>PATO</li>
                                        <li>GALINHAS / PATOS</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Caprinos / Ovinos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Produtos do Mar</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Vegetais</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>LEGUMES</li>
                                        <li>BATATAS</li>
                                        <li>FRUTA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Lacticinios</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Padaria / Pastelaria</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Charcutaria</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>FRANGO</li>
                                        <li>PERU</li>
                                        <li>PATO</li>
                                        <li>GALINHAS / PATOS</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Pré-cozinhados</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>LEGUMES</li>
                                        <li>BATATAS</li>
                                        <li>FRUTA</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Ovoprodutos</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>
                                    <span class="caret">Preparados de Carne</span>
                                    <ul class="nested">
                                        <li>GERAL</li>
                                        <li>CARCAÇAS</li>
                                        <li>CORTES</li>
                                        <li>MIUDEZAS</li>
                                        <li>OSSOS</li>
                                        <li>PELES</li>
                                        <li>FILETE</li>
                                        <li>VAZIA</li>
                                        <li>ACÉM</li>
                                        <li>ALCATRA</li>
                                        <li>RABADILHA</li>
                                        <li>PICANHA</li>
                                        <li>CAÇA / OUTROS</li>
                                        <li>PEIXE</li>
                                        <li>MARISCO</li>
                                        <li>LEGUMES</li>
                                        <li>BATATAS</li>
                                        <li>FRUTA</li>
                                        <li>QUEIJOS</li>
                                        <li>MANTEIGAS</li>
                                        <li>IOGURTES</li>
                                        <li>PADARIA</li>
                                        <li>PASTELARIA</li>
                                        <li>ATM</li>
                                        <li>COVETE</li>
                                        <li>VÁCUO</li>
                                        <li>SACO</li>
                                        <li>SKIN</li>
                                        <li>AVULSO</li>
                                    </ul>
                                </li>
                                <li>EMBALAGENS</li>
                                <li>CARTÃO</li>
                                <li>PLÁSTICO</li>
                                <li>ORGANICO</li>
                                <li>CONSUMIVEIS</li>
                                <li>MARCAS BRANCAS</li>
                            </ul>
                        </li>   
                    </ul>
                </li>
                <li>
                    <span class="caret">CONGELADO</span>
                    <ul class="nested">
                    <li>
                        <span class="caret">MERCADORIAS</span>
                        <ul class="nested">
                            <li>Geral</li>
                            <li>Bovinos</li>
                            <li>Suinos</li>
                            <li>Aves</li>
                            <li>Caprinos / Ovinos</li>
                            <li>Produtos do Mar</li>
                            <li>Vegetais</li>
                            <li>Lacticinios</li>
                            <li>Padaria / Pastelaria</li>
                            <li>Charcutaria</li>
                            <li>Pré-cozinhados</li>
                            <li>Ovoprodutos</li>
                            <li>Preparados de Carne</li>
                            <li>SUSHI</li>
                            <li>EMBALAGENS</li>
                            <li>CARTÃO</li>
                            <li>PLÁSTICO</li>
                            <li>ORGANICO</li>
                            <li>CONSUMIVEIS</li>
                            <li>MARCAS BRANCAS</li>
                        </ul>
                    </li>
                    <li>
                        <span class="caret">TRANSFORMADOS</span>
                        <ul class="nested">
                            <li>Geral</li>
                            <li>Bovinos</li>
                            <li>Suinos</li>
                            <li>Aves</li>
                            <li>Caprinos / Ovinos</li>
                            <li>Produtos do Mar</li>
                            <li>Vegetais</li>
                            <li>Lacticinios</li>
                            <li>Padaria / Pastelaria</li>
                            <li>Charcutaria</li>
                            <li>Pré-cozinhados</li>
                            <li>Ovoprodutos</li>
                            <li>Preparados de Carne</li>
                            <li>EMBALAGENS</li>
                            <li>CARTÃO</li>
                            <li>PLÁSTICO</li>
                            <li>ORGANICO</li>
                            <li>CONSUMIVEIS</li>
                            <li>MARCAS BRANCAS</li>
                        </ul>
                    </li>    
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready( function() 
        {
            var toggler = document.getElementsByClassName("caret");
            var i;

            for (i = 0; i < toggler.length; i++) 
            {
              toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
              });
            }
        });
    </script>
@endsection

