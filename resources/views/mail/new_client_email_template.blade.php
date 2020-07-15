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
    </head>
    <body bgcolor="#FFFFFF">
        <table class="head-wrap wrapper" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="">
                    <h6>Olá</h6> 
                    <p>O vendedor <b>{{ $data['nome_vendedor'] }}</b> deseja criar o seguinte cliente:</p>
                    <div class="form-group">
                        <label for="InputGuestName"><b>NOME: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputGuestName" name="InputGuestName" aria-describedby="nomeHelp" value="{{ $data['nome_cliente'] }}">
                    </div>
                    <div class="form-group">
                        <label for="InputNIF"><b>NIF: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputNIF" name="InputNIF" aria-describedby="nifHelp" placeholder="Inserir NIF" value="{{ $data['nif_cliente'] }}">
                    </div>
                    <div class="form-group">
                        <label for="InputTelefone"><b>TELEFONE: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputTelefone" name="InputTelefone" aria-describedby="telefoneHelp" placeholder="Inserir Telefone" value="{{ $data['telefone_cliente'] }}">
                    </div>
                    <div class="form-group">
                        <label for="InputTelemovel"><b>TELEMOVEL: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputTelemovel" name="InputTelemovel" aria-describedby="telemovelHelp" placeholder="Inserir Telemovel" value="{{ $data['telemovel_cliente'] }}">
                    </div>
                    <div class="form-group">
                        <label for="InputGuestEmail"><b>EMAIL: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputGuestEmail" name="InputGuestEmail" aria-describedby="emailHelp" placeholder="Inserir Email" value="{{ $data['email_cliente'] }}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupMoradaFiscal"><b>MORADA FISCAL: </b></label>
                        <input type="text" class="form-control form-control-sm" id="formGroupMoradaFiscal" placeholder="Morada Fiscal" name="InputMoradaFiscal" value="{{ $data['morada_cliente'] }}">
                    </div>
                    <div class="form-group">
                        <label for="InputReceptorName"><b>NOME RECEPTOR: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputReceptorName" name="InputReceptorName" aria-describedby="nomeReceptorHelp" value="{{ $data['nome_cliente_receptor'] }}">
                    </div>
                    <div class="form-group">
                        <label for="InputTelefoneReceptor"><b>TELEFONE RECEPTOR: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputTelefoneReceptor" name="InputTelefoneReceptor" aria-describedby="telefoneReceptorHelp" placeholder="Telefone Receptor" value="{{ $data['telefone_cliente_receptor'] }}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupMoradaFiscalReceptor"><b>MORADA RECEPTOR MERCADORIA: </b></label>
                        <input type="text" class="form-control form-control-sm" id="formGroupMoradaFiscalReceptor" placeholder="Morada Receptor Mercadoria" name="InputMoradaFiscalReceptor" value="{{ $data['morada_cliente_receptor'] }}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupContatoResponsavel"><b>CONTATO/RESPONSÁVEL: </b></label>
                        <input type="text" class="form-control form-control-sm" id="formGroupContatoResponsavel" placeholder="Contato/Responsável" name="InputContatoResponsavel" value="{{ $data['contato_responsavel'] }}">
                    </div>
                    <div class="form-group">
                        <label for="InputCPagamento"><b>CONDIÇÕES DE PAGAMENTO: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputCPagamento" name="InputCPagamento" aria-describedby="cpagamentoHelp" placeholder="Condições de Pagamento" value="{{ $data['pagamento_cliente'] }}">
                    </div> 
                    <div class="form-group">
                        <label for="InputMPagamento"><b>MÉTODO DE PAGAMENTO: </b></label>
                        <input type="text" class="form-control form-control-sm" id="InputMPagamento" name="InputMPagamento" aria-describedby="mpagamentoHelp" placeholder="Método de Pagamento" value="{{ $data['metodo_pagamento_cliente'] }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="content-cell">
                    <hr>
                    <p>{{ $data['nome_vendedor'] }}</p>
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




