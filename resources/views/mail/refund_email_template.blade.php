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
                            <td align="center"><h6 style="color:#94bb1e">Portal do Cliente | ANNII</h6></td>
                        </tr>
                        <!-- Email Body -->
                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <!-- Body content -->
                                    <tr>
                                        <td class="content-cell">
                                            <h3>Olá Departamento de Qualidade</h3>
                                            <p>O Cliente <b>{{ $data['nome'] }}</b> com o número <b>{{ $data['sap_id'] }}</b> e com o endereço <b>{{ $data['email'] }}</b> deseja efetuar uma devolução do documento com o número <b>{{ $data['document'] }}</b>.</p>

                                            @if($data['type'] === 'NormalRefund')
                                                <p>Foram selecionados para devolução os seguintes produtos e respectivas quantidades:</p>
                                                <table class="refund_table" width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Material</th>
                                                        <th>Lote</th>
                                                        <th>Original</th>
                                                        <th>A Devolver</th>
                                                        <th>Unidade</th>
                                                        <th>Notas</th>
                                                    </tr>
                                                    @foreach ($data['material'] as $key => $material)
                                                        <tr>
                                                            <td>{{ $material['codigo'] }}</td>
                                                            <td>{{ $material['name'] }}</td>
                                                            <td>{{ $material['lote'] }}</td>
                                                            <td>{{ $material['unidade'] }}</td>
                                                            <td>{{ $material['devolver'] }}</td>
                                                            <td>{{ $material['quantidade'] }}</td>
                                                            <td>{{ $material['notas'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @endif
                                            @if($data['type'] === 'CustomRefund')
                                                <p>Devolução:</p>
                                                <p>{{ $data['notas'] }}</p>
                                            @endif
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




