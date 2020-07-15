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
        <style type="text/css">
            .refund_table, .refund_table th, .refund_table td {
              border: 1px solid black;
            }
        </style>
        
        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <script src="/js/app.js"></script>
    </head>

    <body bgcolor="#FFFFFF">
        <table class="head-wrap wrapper" width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <table class="content" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center"><h6 style="color:#94bb1e">Portal do Cliente | Madeira Cash</h6></td>
                        </tr>
                        <!-- Email Body -->
                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <!-- Body content -->
                                    <tr>
                                        <td class="content-cell">
                                            <h3>Olá, agradecemos a sua encomenda.</h3>
                                            <p>Iremos dar inicio à preparação da sua encomenda, se verificar alguma informação ou dado incorrecto favor informar de imediato respondendo a este email.</p> 
                                            <p> Código de Encomenda: <b>{{ $data['encomenda_id'] }}</b> </p>
                                            <p>Nome: <b>{{ $data['nome'] }}</b>
                                            @if(isset($data['id_sap']))
                                                <p> Código Cliente: <b>{{ $data['id_sap'] }}</b> </p>
                                            @endif
                                            <p>Telefone: <b>{{ $data['telefone'] }}</b>
                                            <p>NIF: <b>{{ $data['nif'] }}</b>        
                                            <p>Email: <b>{{ $data['email'] }}</b>
                                            <p>Data prevista de Entrega:
                                                <br>
                                                <b>{{ $data['order_date'] }}</b>
                                            </p>
                                            <p>Entrega da encomenda na seguinte morada:
                                                <br>
                                                <b>{{ $data['morada'] }}</b>
                                                <br>
                                                <b>{{ ucfirst ($data['concelho']).' '.$data['cod_postal'] }}</b>
                                            </p>
                                            <p>Observações:</p>
                                            <p>{{ $data['nota'] }}</p>
                                            <p>Resumo da Encomenda:</p>
                                            <table class="refund_table" width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <!--th>Código</th-->
                                                    <th>Material</th>
                                                    <th>A Encomendar</th>
                                                    <!--th>Unidade</th-->
                                                </tr>
                                                @foreach ($data['material'] as $key => $material)
                                                    <tr>
                                                        <!--td>{{ $material['codigo'] }}</td-->
                                                        <td>{{ $material['name'] }}</td>
                                                        <td>{{ $material['quantidade'] }}</td>
                                                    </tr>
                                                @endforeach
                                                <tfoot>
                                                    <tr>
                                                      <td>Total a Pagar:</td>
                                                      <td>€ {{ $data['valor_total'] }}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <p><b>PESAGEM DA ENCOMENDA:</b> O valor apresentado é uma estimativa de valor uma vez que todos os artigos deverão ser pesados. Os produtos que não estejam embalados em vácuo ou outra embalagem protetora, a sua encomenda mínima será à caixa. </p>
                                            <p><b>PAGAMENTO:</b> A sua encomenda será preparada e deverá ser paga no acto de entrega através de <b>MULTIBANCO</b> ou <b>MBWAY</b>.</p>  
                                            <p>Esteja atento ao seu email, receberá um email de confirmação de quantidades e valor, caso pretenda alterar terá <u>uma hora</u> para o fazer.</p>
                                            <p>Melhores cumprimentos.</p>
                                            <hr>
                                            <br>
                                            <p>António N. Nóbrega II S.A</p>
                                            <p>Estrada do Aeroporto n° 39</p>
                                            <p>9125-078 Caniço</p>
                                            <p>Madeira-Portugal</p>
                                            <p>Telm.: (+351) 961 309 735</p>
                                            <p>Telf.: (+351) 291 934 333</p>
                                            <p style="color: #94bb1e;">Proteja o ambiente. Imprima este e-mail apenas se necessário.</p>
                                            <p style="color: #94bb1e;">Care for the environment. Print thus e-mail only if necessary.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>




