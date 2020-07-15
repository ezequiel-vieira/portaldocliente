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
            /*.refund_table, .refund_table th, .refund_table td {
              border: 1px solid black;
            }*/
        </style>
        
        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <script src="/js/app.js"></script>
    </head>

    <body bgcolor="#FFFFFF" style="color: #555454;font-size: 13px;line-height: 18px;"> 
        <div style="background-color:#fff;width:650px;color:#555454;font-size:13px;line-height:18px;margin:auto">
            <table class="head-wrap wrapper" style="width:100%;margin-top:10px">
                <tr>
                    <td align="center">
                        <table class="content" style="width:100%" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                    <td style="border-bottom:2px solid #93ba1f;;padding:7px 0" align="center">
                                        <a title="Grupo Nóbrega" href="http://portaldocliente.gruponobrega.pt/" style="color:#337ff1; text-decoration: none" target="_blank"> 
                                            <h3 style="color:#94bb1e">Portal do Cliente</h3>
                                            <img width="65" src="{{asset('images/images-logos/Logotipo.png')}}" alt="Grupo Nóbrega" style="width: 65px;">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <h3>Olá, agradecemos a sua encomenda.</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="font-size: 14px;">Iremos dar inicio à preparação da sua encomenda, se verificar alguma informação ou dado incorrecto favor informar de imediato respondendo a este email.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #d6d4d4;background-color:#f8f8f8;padding:7px 0; margin-bottom: 5px;">
                                        <table style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:7px 0" width="10">&nbsp;</td>
                                                    <td style="padding:7px 0">
                                                        <p style="border-bottom:1px solid #d6d4d4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">Detalhes do Cliente</p>
                                                        <p>
                                                            <span color="#555454" style="color:#555454;font-size:small">
                                                                <span style="color:#777"> 
                                                                    <span style="color:#333">
                                                                        <strong> Código de Encomenda:</strong>
                                                                    </span> 
                                                                    {{ $data['encomenda_id'] }} &nbsp;
                                                                </span>
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <span color="#555454" style="color:#555454;font-size:small">
                                                                <span style="color:#777">
                                                                    <strong>
                                                                        <span style="color:#000000">Nome:</span>&nbsp;
                                                                    </strong>
                                                                    {{ $data['nome'] }}
                                                                </span>
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <span color="#555454" style="color:#555454;font-size:small">
                                                                <span style="color:#777">
                                                                    <strong>
                                                                        <span>
                                                                            <strong>
                                                                                <span style="color:#000000">Telefone:</span>&nbsp;
                                                                            </strong>
                                                                        </span>
                                                                    </strong>
                                                                    <span>{{ $data['telefone'] }}</span>
                                                                </span>
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <span color="#555454" style="color:#555454;font-size:small">
                                                                <span style="color:#777">
                                                                    <strong>
                                                                        <span>
                                                                            <strong>
                                                                                <span style="color:#000000">NIF:</span>&nbsp;
                                                                            </strong>
                                                                        </span>
                                                                    </strong>
                                                                    <span>{{ $data['nif'] }}</span>
                                                                </span>
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <span color="#555454" style="color:#555454;font-size:small">
                                                                <span style="color:#777">
                                                                    <strong>
                                                                        <span style="color:#000000">Email:</span>&nbsp;
                                                                    </strong>
                                                                    <span>
                                                                        {{ $data['email'] }}
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </p>
                                                    </td>
                                                    <td style="padding:7px 0" width="10">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #d6d4d4;background-color:#f8f8f8;padding:7px 0">
                                        <table style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:7px 0" width="10">&nbsp;</td>
                                                    <td style="padding:7px 0">
                                                        <p style="border-bottom:1px solid #d6d4d4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">Detalhes de Entrega</p>
                                                        <span color="#555454" style="color:#555454;font-size:small">
                                                            <span style="color:#777"> 
                                                                <span style="color:#333">
                                                                    <strong>Entrega da encomenda na seguinte morada:</strong>
                                                                </span> 
                                                                <br>
                                                                {{ $data['morada'] }}
                                                                <br>
                                                                {{ ucfirst ($data['concelho']).' '.$data['cod_postal'] }}.
                                                                <br>
                                                                <br> 
                                                                <span style="color:#333">
                                                                    <strong>Observações:</strong>
                                                                </span> 
                                                                {{ $data['nota'] }}
                                                            </span> 
                                                        </span>
                                                    </td>
                                                    <td style="padding:7px 0" width="10">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- -->
                                <tr>
                                    <td style="border:1px solid #d6d4d4;background-color:#f8f8f8;padding:7px 0">
                                        <table style="width:100%;border-collapse:collapse" bgcolor="#ffffff">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:7px 0" width="10">&nbsp;</td>
                                                    <td colspan="3" style="padding:7px 0">
                                                        <p style="border-bottom:1px solid #d6d4d4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">Detalhes da Encomenda</p>
                                                    </td>
                                                    <td style="padding:7px 0" width="10">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px" bgcolor="#f8f8f8">Código de Artigo</th>
                                                    <th style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px" bgcolor="#f8f8f8">Artigo</th>
                                                    <th style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px" width="17%" bgcolor="#f8f8f8">Preço Unidade</th>
                                                    <th style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px" bgcolor="#f8f8f8">Quantidade</th>
                                                    <th style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px" width="17%" bgcolor="#f8f8f8">Preço Total</th>
                                                </tr>
                                                <!--tr>
                                                    <td colspan="5" style="border:1px solid #d6d4d4;text-align:center;color:#777;padding:7px 0"></td>
                                                </tr-->
                                                @foreach ($data['material'] as $key => $material)
                                                    <tr>
                                                        <td style="border:1px solid #d6d4d4">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="10">&nbsp;</td>
                                                                        <td> 
                                                                            <font color="#555454"> {{ $material['codigo'] }} </font>
                                                                        </td>
                                                                        <td width="10">&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="border:1px solid #d6d4d4">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="10">&nbsp;</td>
                                                                        <td> 
                                                                            <font color="#555454"> 
                                                                                <strong>{{ $material['name'] }}</strong>
                                                                            </font>
                                                                        </td>
                                                                        <td width="10">&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="border:1px solid #d6d4d4">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="10">&nbsp;</td>
                                                                        <td align="right"> 
                                                                            <font color="#555454">{{ $material['preco'] }} €</font>
                                                                        </td>
                                                                        <td width="10">&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="border:1px solid #d6d4d4">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="10">&nbsp;</td>
                                                                        <td align="right"> 
                                                                            <font color="#555454">{{ $material['quantidade'] }}</font>
                                                                        </td>
                                                                        <td width="10">&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td style="border:1px solid #d6d4d4">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width="10">&nbsp;</td>
                                                                        <td align="right"> 
                                                                            <font color="#555454">{{ $material['preco'] * $material['quantidade'] }} €</font>
                                                                        </td>
                                                                        <td width="10">&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="5" style="border:1px solid #d6d4d4;text-align:center;color:#777;"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" style="border:1px solid #d6d4d4;color:#333;padding:7px 0" bgcolor="#f8f8f8">
                                                        <table style="width:100%;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                    <td style="color:#333;padding:0" align="right">
                                                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                                                            <strong>Artigos</strong> 
                                                                        </span>
                                                                    </td>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td colspan="4" style="border:1px solid #d6d4d4;color:#333;padding:7px 0" bgcolor="#f8f8f8" align="right">
                                                        <table style="width:100%;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                    <td style="color:#333;padding:0" align="right">
                                                                        <span color="#555454" style="color:#555454;font-size:small"> {{$data['valor_total']}} €</span>
                                                                    </td>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="4" style="border:1px solid #d6d4d4;color:#333;padding:7px 0" bgcolor="#f8f8f8">
                                                        <table style="width:100%;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                    <td style="color:#333;padding:0" align="right">
                                                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                                                            <strong>Taxa de Entrega</strong> 
                                                                        </span>
                                                                    </td>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td colspan="4" style="border:1px solid #d6d4d4;color:#333;padding:7px 0" bgcolor="#f8f8f8">
                                                        <table style="width:100%;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                    <td style="color:#333;padding:0" align="right">
                                                                        <span color="#555454" style="color:#555454;font-size:small"> {{$data['taxa']}} €</span>
                                                                    </td>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4" style="border:1px solid #d6d4d4;color:#333;padding:7px 0" bgcolor="#f8f8f8">
                                                        <table style="width:100%;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                    <td style="color:#333;padding:0" align="right">
                                                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                                                            <strong>Total a Pagar</strong> 
                                                                        </span>
                                                                    </td>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td colspan="4" style="border:1px solid #d6d4d4;color:#333;padding:7px 0" bgcolor="#f8f8f8">
                                                        <table style="width:100%;border-collapse:collapse">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                    <td style="color:#333;padding:0" align="right">
                                                                        <span size="4" face="Open-sans, sans-serif" color="#555454" style="color:#555454;font-size:large"> {{$data['valor_total'] + $data['taxa']}} €</span>
                                                                    </td>
                                                                    <td style="color:#333;padding:0" width="10">&nbsp;</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- -->
                                <tr>
                                    <td style="border:1px solid #d6d4d4;background-color:#f8f8f8;padding:7px 0">
                                        <table style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:7px 0" width="10">&nbsp;</td>
                                                    <td style="padding:7px 0">
                                                        <p style="border-bottom:1px solid #d6d4d4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">Detalhes de Pagamento e Pesagem</p>
                                                        <span color="#555454" style="color:#555454;font-size:small">
                                                            <span style="color:#777"> 
                                                                <span style="color:#333">
                                                                    <strong>Pagamento:</strong>
                                                                </span> 
                                                                A sua encomenda será preparada e deverá ser paga no acto de entrega através de <b>MULTIBANCO</b> ou <b>MBWAY</b>.
                                                                <br>
                                                                <br> 
                                                                <span style="color:#333">
                                                                    <strong>Pesagem da Encomenda:</strong>
                                                                </span> 
                                                                O valor apresentado é uma estimativa de valor uma vez que todos os artigos deverão ser pesados. Os produtos que não estejam embalados em vácuo ou outra embalagem protetora, a sua encomenda mínima será à caixa. 
                                                            </span> 
                                                        </span>
                                                    </td>
                                                    <td style="padding:7px 0" width="10">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:7px 0">
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span> Esteja atento ao seu email, receberá um email de confirmação de quantidades e valor, caso pretenda alterar terá uma hora para o fazer.</span> 
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:7px 0">
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span>Melhores cumprimentos.</span> 
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0!important">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="border-top:2px solid #93ba1f;;padding:7px 0"></td>
                                </tr>
                                <tr>
                                    <td style="padding:7px 0">
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            António N. Nóbrega II S.A
                                            <br>
                                            Estrada do Aeroporto n° 39
                                            <br>
                                            9125-078 Caniço
                                            <br>
                                            Madeira-Portugal
                                            <br>
                                            Telm.: (+351) 961 309 735
                                            <br>
                                            Telf.: (+351) 291 934 333
                                            <br>
                                            Proteja o ambiente. Imprima este e-mail apenas se necessário.
                                            <br>
                                            Care for the environment. Print thus e-mail only if necessary.
                                            <br>
                                        </span>
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span></span> 
                                        </span>
                                        </span>
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span></span> 
                                        </span> 
                                        </span>
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span></span> 
                                        </span> 
                                        </span>
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span></span> 
                                        </span> 
                                        </span>
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span></span> 
                                        </span>
                                        </span>
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span></span> 
                                        </span>
                                        <span color="#555454" style="color:#555454;font-size:small"> 
                                            <span></span> 
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>




