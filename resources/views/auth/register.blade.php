@extends('layouts.auth2')

@section('template_title')
    Criar Conta
@endsection

@section('template_linked_css') 
    <style type="text/css">
        .form-group .form-control {
            height: auto;
        }
        fieldset {
            display: block;
            margin-inline-start: 2px;
            margin-inline-end: 2px;
            padding-block-start: 0.35em;
            padding-inline-start: 0.75em;
            padding-inline-end: 0.75em;
            padding-block-end: 0.625em;
            min-inline-size: min-content;
            border-width: 2px;
            border-style: groove;
            border-color: threedface;
            border-image: initial;
        }
        legend {
            width: auto;
            display: block;
            padding-inline-start: 2px;
            padding-inline-end: 2px;
            border-width: initial;
            border-style: none;
            border-color: initial;
            border-image: initial;
        }
    </style>
@endsection

@section('content')
    <section class="album py-5" style="background: #FFF; color: #495057 !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('register') }}" class="was-validated">
                        @csrf
                        <div class="text-center">
                            <img src="/images/images-logos/Logo_NB_notext.png" class="img-fluid rounded d-inline-block" alt="Madeira Cash" style="max-width: 100px;margin-top: -5px;">
                        </div>
                        <h1 class="register-heading text-center">Criar Conta Professional</h1>
                        <hr>
                        <div class="row register-form">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="InputCodSap">Se já é um cliente do Grupo Nóbrega, preencha o campo abaixo com o seu número de Cliente. </label>
                                        <input type="text" class="form-control" id="InputCodSap" name="sap_code" aria-describedby="emailHelp" placeholder="Inserir Número de Cliente" required>
                                        <small id="emailHelp" class="form-text text-muted">Poderá visualizá-lo no cabeçalho de sua fatura, identificado por Cliente.</small>
                                        <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                    </div>
                                </div>
                                <!-- DADOS PESSOAIS -->
                                <fieldset class="mb-3">
                                    <legend> Dados Gerais </legend>
                                    <div class="container">
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input_primeiro_nome">Primeiro Nome</label>
                                                <input type="text" class="form-control" id="input_primeiro_nome" name="input_primeiro_nome" placeholder="Primeiro Nome" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input_ultimo_nome">Último Nome</label>
                                                <input type="text" class="form-control" id="input_ultimo_nome" name="input_ultimo_nome" placeholder="Último Nome" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input_telefone">Telefone</label>
                                                <input type="text" class="form-control" id="input_telefone" name="input_telefone" placeholder="Telefone" pattern="[0-9]{9}" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input_telemovel">Telemóvel</label>
                                                <input type="text" class="form-control" id="input_telemovel" name="input_telemovel" placeholder="Telemóvel" pattern="[0-9]{9}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="input_email">Email</label>
                                                <input type="email" class="form-control" id="input_email" name="input_email" aria-describedby="emailHelp" placeholder="Inserir email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                                <small id="emailHelp" class="form-text text-muted">Nunca iremos partilhar seu email com ninguém.</small>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="concelhoFormControlSelect">Concelho</label>
                                                <select class="form-control" id="concelhoFormControlSelect" name="input_concelho">
                                                  <option value="funchal">Funchal</option>
                                                  <option value="santa_cruz">Santa Cruz</option>
                                                  <option value="machico">Machico</option>
                                                  <option value="santana">Santana</option>
                                                  <option value="camara_lobos">Câmara de Lobos</option>
                                                  <option value="ribeira_brava">Ribeira Brava</option>
                                                  <option value="ponta_sol">Ponta de Sol</option>
                                                  <option value="porto_moniz">Porto Moniz</option>
                                                  <option value="sao_vicente">São Vicente</option>
                                                  <option value="calheta">Calheta</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                              <label for="InputCodPostal">Cód. Postal</label>
                                              <input type="text" class="form-control " id="InputCodPostal" name="input_cod_postal" pattern="[0-9]{4}[\-]?[0-9]{3}" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="InputPrevisaoEntrega">Dia de Entrega</label>
                                                <div class="alert alert-info" role="alert">
                                                  <span id="InputPrevisaoEntrega" value=""></span>
                                                  <input type="hidden" name="order-date" id="order-date">
                                                </div>
                                            </div>
                                        </div>
                                        <!--div class="form-row">
                                            <div class="col-md-12">
                                                <label for="">Horário Preferencial Entrega Mercadoria</label>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                                    <label class="form-check-label" for="exampleRadios1">
                                                    2ª Feira
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                                    <label class="form-check-label" for="exampleRadios2">
                                                    3ª Feira
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3">
                                                    <label class="form-check-label" for="exampleRadios3">
                                                    4ª Feira
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" value="option4">
                                                    <label class="form-check-label" for="exampleRadios4">
                                                    5ª Feira
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios5" value="option5">
                                                    <label class="form-check-label" for="exampleRadios5">
                                                    6ª Feira
                                                    </label>
                                                </div>
                                            </div>                                           
                                        </div-->
                                    </div>
                                </fieldset>
                                <!-- DADOS FISCAIS -->
                                <fieldset class="mb-3">
                                    <legend> Dados Fiscais </legend>
                                    <div class="container">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="input_nif">NIF</label>
                                                <input type="text" class="form-control" id="input_nif" name="input_nif" placeholder="NIF" value="" pattern="[0-9]{9}" title="please enter number only" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="input_denominacao_fiscal">Denominação Fiscal</label>
                                                <input type="text" class="form-control" id="input_denominacao_fiscal" name="input_denominacao_fiscal" placeholder="Denominação Fiscal" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="input_endereco_fiscal">Endereço Fiscal</label>
                                                <input type="text" class="form-control" id="input_endereco_fiscal" name="input_endereco_fiscal" placeholder="Endereço" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input_codigo_postal_fiscal">Código Postal</label>
                                                <input type="text" class="form-control" id="input_codigo_postal_fiscal" name="input_codigo_postal_fiscal" placeholder="Código Postal" pattern="[0-9]{4}[\-]?[0-9]{3}" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input_localidade_fiscal">Localidade</label>
                                                <input type="text" class="form-control" id="input_localidade_fiscal" name="input_localidade_fiscal" placeholder="Localidade" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="page-header">
                                            <h5>Receptor de Mercadoria</h5>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="input_nome_estabelecimento">Nome Estabelecimento</label>
                                                <input type="text" class="form-control" id="input_nome_estabelecimento" name="input_nome_estabelecimento" placeholder="Nome Estabelecimento" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="input_endereco_estabelecimento">Endereço Estabelecimento</label>
                                                <input type="text" class="form-control" id="input_endereco_estabelecimento" name="input_endereco_estabelecimento" placeholder="Endereço" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input_codigo_postal">Código Postal</label>
                                                <input type="text" class="form-control" id="input_codigo_postal_estabelecimento" name="input_codigo_postal_estabelecimento" placeholder="Código Postal" pattern="[0-9]{4}[\-]?[0-9]{3}" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input_localidade">Localidade</label>
                                                <input type="text" class="form-control" id="input_localidade_estabelecimento" name="input_localidade_estabelecimento" placeholder="Localidade" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- DADOS COMPRAS -->
                                <fieldset class="mb-3">
                                    <legend> Dados Compras </legend>
                                    <div class="container">
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input_primeiro_nome_compras">Primeiro Nome</label>
                                                <input type="text" class="form-control" id="input_primeiro_nome_compras" name="input_primeiro_nome_compras" placeholder="Primeiro Nome" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input_ultimo_nome_compras">Último Nome</label>
                                                <input type="text" class="form-control" id="input_ultimo_nome_compras" name="input_ultimo_nome_compras" placeholder="Último Nome" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input_telefone_compras">Telefone</label>
                                                <input type="text" class="form-control" id="input_telefone_compras" name="input_telefone_compras" placeholder="Telefone" pattern="[0-9]{9}" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input_telemovel_compras">Telemóvel</label>
                                                <input type="text" class="form-control" id="input_telemovel_compras" name="input_telemovel_compras" placeholder="Telemóvel" pattern="[0-9]{9}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="input_email_compras">Email</label>
                                                <input type="email" class="form-control" id="input_email_compras" name="input_email_compras" aria-describedby="emailHelp" placeholder="Inserir email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                                <small id="emailHelp" class="form-text text-muted">Nunca iremos partilhar seu email com ninguém.</small>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- DADOS FINANCEIROS -->
                                <fieldset class="mb-3">
                                    <legend> Dados Financeiros </legend>
                                    <div class="container">
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input_primeiro_nome_fin">Primeiro Nome</label>
                                                <input type="text" class="form-control" id="input_primeiro_nome_fin" name="input_primeiro_nome_fin" placeholder="Primeiro Nome" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="input_ultimo_nome_fin">Último Nome</label>
                                                <input type="text" class="form-control" id="input_ultimo_nome_fin" name="input_ultimo_nome_fin" placeholder="Último Nome" value="" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="input_telefone_fin">Telefone</label>
                                                <input type="text" class="form-control" id="input_telefone_fin" name="input_telefone_fin" placeholder="Telefone" pattern="[0-9]{9}" required>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label for="input_email_fin">Email</label>
                                                <input type="email" class="form-control" id="input_email_fin" name="input_email_fin" aria-describedby="emailHelp" placeholder="Inserir email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                                <small id="emailHelp" class="form-text text-muted">Nunca iremos partilhar seu email com ninguém.</small>
                                                <div class="valid-feedback">Campo Válido!</div><div class="invalid-feedback">Por favor, preencha este campo.</div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Confirme a Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                                    @if ($errors->has('password-confirm'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password-confirm') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button class="btn btn-block btn-success" type="submit">Registar</button>
                                <div class="form-group">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                      <label class="form-check-label" for="invalidCheck">Li e aceito a <b>Política de Privacidade</b> e os <b>Termos e Condições</b> da Loja Online.</label>
                                      <div class="invalid-feedback">Tem que aceitar os termos e condições de utilização para submeter seus dados.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group row mt-5 mb-5">
                        <div class="col-md-12 col-lg-12"  style="text-align:center;">
                            <p> Já tem Conta? Entre <a href="/login">aqui</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
    <!-- FORM VALIDATION -->
    <script>
    </script>
    <script>
        var currentDate = moment();
        var current_day = moment().format();
        var weekStart = currentDate.clone().startOf('isoWeek');
        var weekEnd = currentDate.clone().endOf('week');
        var days = [];
        for (i = 0; i <= 13; i++) {
           days.push(moment(weekStart).add(i, 'days').format());
        };
    </script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            var moment_days_allowed = [days[0], days[1], days[2], days[3],days[4], days[7], days[8], days[9], days[10],days[11]];
            getNextDayAllowed(moment_days_allowed, current_day);
        });

        $("#concelhoFormControlSelect").change(function () 
        {
            var concelho = this.value;

            console.log(concelho);
            
            if (concelho === 'funchal' || concelho === 'santa_cruz') 
            {
                var moment_days_allowed = [days[0], days[1], days[2], days[3],days[4], days[7], days[8], days[9], days[10],days[11]];
                getNextDayAllowed(moment_days_allowed, current_day);
            }
            if (concelho === 'machico' || concelho === 'santana' || concelho === 'camara_lobos' || concelho === 'ribeira_brava' || concelho === 'ponta_sol') 
            {
                var moment_days_allowed = [days[1], days[3], days[8], days[10]];
                getNextDayAllowed(moment_days_allowed, current_day);
            }
            if (concelho === 'porto_moniz' || concelho === 'sao_vicente' || concelho === 'calheta') 
            {
                var moment_days_allowed = [days[2], days[4], days[9], days[11]];
                getNextDayAllowed(moment_days_allowed, current_day);
            }
        });

        function getNextDayAllowed(moment_days_allowed, current_day){
            var next_day;
            var i;
            var len = moment_days_allowed.length;
            for (i = 0; i < len; i++) {
                var next_day = getNextDayTemp(moment_days_allowed, current_day);
                var format = moment(next_day).locale('pt').format("dddd, D [de] MMMM");
                console.log(format);
                $("#InputPrevisaoEntrega").text(format);
                $("#order-date").val(format);
                break;
            }
        }
        function getNextDayTemp(moment_days_allowed, current_day){
            var i;
            var len = moment_days_allowed.length;
            for (i = 0; i < len; i++) {
                if (moment(current_day).isAfter(moment_days_allowed[i])) {
                } else {
                    var nextValidDay = moment_days_allowed[i];
                    break;
                }
            }
            return nextValidDay;
        }
    </script>
@endsection
