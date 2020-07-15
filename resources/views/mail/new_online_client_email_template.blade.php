<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <!-- Styles -->
        <!-- LIBRARIES -->
        <link rel="stylesheet" type="text/css" href="http://192.168.110.234/css/email.css">
        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <script src="/js/app.js"></script>
        <style type="text/css">
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
            .card-body {
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                padding: 1.25rem;
            }
            .card-img-top {
                width: 100%;
                border-top-left-radius: calc(.25rem - 1px);
                border-top-right-radius: calc(.25rem - 1px);
            }
            .card-text:last-child {
                margin-bottom: 0;
            }
        </style>
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
            label{
                font-weight: bold;
                text-decoration: underline;
            }
        </style>
    </head>
    <body bgcolor="#FFFFFF">
        <table class="head-wrap wrapper" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td class="content-cell">
                    <h6>Olá</h6> 
                    <p>O cliente <b>{{ $data['cod_sap'] }}:</b> deseja completar sua conta. Seus dados são os seguintes:</p>
                    <!-- DADOS PESSOAIS -->
                    <fieldset class="mb-3">
                        <p style="border-bottom: 1px solid #333333; margin-bottom: 20px; mso-border-bottom-alt: 1px solid #333333;mso-margin-bottom: 20px; text-transform: uppercase;">Dados Receptor de Mercadoria</p>
                        <p><b>Primeiro Nome:</b> {{ $data['input_primeiro_nome'] }}</p>
                        <p><b>Último Nome:</b> {{ $data['input_ultimo_nome'] }}</p>
                        <p><b>Telefone:</b> {{ $data['input_telefone'] }}</p>
                        <p><b>Telemóvel:</b> {{ $data['input_telemovel'] }}</p>
                        <p><b>Email:</b> {{ $data['input_email'] }}</p>
                        <p><b>Cód. Postal:</b> {{ $data['input_cod_postal'] }}</p> 
                        <p><b>Localidade:</b> {{ $data['input_concelho'] }}</p>
                    </fieldset>
                    <!-- DADOS FISCAIS -->
                    <fieldset class="mb-3">
                        <p style="border-bottom: 1px solid #333333; margin-bottom: 20px; mso-border-bottom-alt: 1px solid #333333;mso-margin-bottom: 20px; text-transform: uppercase;">Dados Fiscais </p>
                        <p><b>NIF:</b> {{ $data['input_nif'] }}</p>
                        <p><b>Denominação Fiscal:</b> {{ $data['input_denominacao_fiscal'] }}</p>
                        <p><b>Endereço Fiscal:</b> {{ $data['input_endereco_fiscal'] }}</p>
                        <p><b>Código Postal Fiscal:</b> {{ $data['input_codigo_postal_fiscal'] }}</p>
                        <p><b>Localidade Fiscal:</b> {{ $data['input_localidade_fiscal'] }}</p>
                        <p><hr></p>
                        <p><b>Nome Estabelecimento:</b> {{ $data['input_nome_estabelecimento'] }}</p>
                        <p><b>Endereço:</b> {{ $data['input_endereco_estabelecimento'] }}</p>
                        <p><b>Código Postal:</b> {{ $data['input_codigo_postal_estabelecimento'] }}</p>
                        <p><b>Localidade:</b> {{ $data['input_localidade_estabelecimento'] }}</p>
                    </fieldset>
                    <!-- DADOS COMPRAS -->
                    <fieldset class="mb-3">
                        <p style="border-bottom: 1px solid #333333; margin-bottom: 20px; mso-border-bottom-alt: 1px solid #333333;mso-margin-bottom: 20px; text-transform: uppercase;"> Dados Compras </p>
                        <p><b>Primeiro Nome:</b> {{ $data['input_primeiro_nome_compras'] }}</p>
                        <p><b>Último Nome:</b> {{ $data['input_ultimo_nome_compras'] }}</p>
                        <p><b>Telefone:</b> {{ $data['input_telefone_compras'] }}</p>
                        <p><b>Telemóvel:</b> {{ $data['input_telemovel_compras'] }}</p>
                        <p><b>Email:</b> {{ $data['input_email_compras'] }}</p>
                    </fieldset>
                    <!-- DADOS FINANCEIROS -->
                    <fieldset class="mb-3">
                        <p style="border-bottom: 1px solid #333333; margin-bottom: 20px; mso-border-bottom-alt: 1px solid #333333;mso-margin-bottom: 20px; text-transform: uppercase;"> Dados Financeiros </p>
                        <p><b>Primeiro Nome:</b> {{ $data['input_primeiro_nome_fin'] }}</p>
                        <p><b>Último Nome:</b> {{ $data['input_ultimo_nome_fin'] }}</p>
                        <p><b>Telefone:</b> {{ $data['input_telefone_fin'] }}</p>
                        <p><b>Email:</b> {{ $data['input_email_fin'] }}</p>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td class="content-cell">
                    <hr>
                    <p>Melhores cumprimentos.</p>
                    <br>
                    <p>António N. Nóbrega II S.A</p>
                    <p>Estrada do Aeroporto n° 39</p>
                    <p>9125-078 Caniço</p>
                    <p>Madeira-Portugal</p>
                    <p>Telf.: (+351) 291 934 333</p>
                    <p style="color: #94bb1e;">Proteja o ambiente. Imprima este e-mail apenas se necessário.</p>
                    <p style="color: #94bb1e;">Care for the environment. Print thus e-mail only if necessary.</p>
                </td>
            </tr>
        </table>
    </body>
</html>




