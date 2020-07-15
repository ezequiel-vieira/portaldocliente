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
                <td align="center">
                    <table class="content" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center"><h6 style="color:#94bb1e">Portal do Cliente | ANNII</h6></td>
                        </tr>
                        <!-- Email Body -->
                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-cell">
                                            <h3>Olá {{ $data['client']->name }}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-cell">
                                            Estamos enviando-lhe este e-mail de forma a dar-lhe a conhecer os nossos últimos produtos.
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                                    @foreach ($data['data'] as $produto)
                                        <tr style="margin-top: 100px">
                                            <td class="content-cell">
                                                <div>
                                                    <h6> {{ $produto->name }} ( {{ $produto->codigo }} ) </h6>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-cell" valign="top" width="400" height="400" background="{{ $produto->name }}">
                                                <div style="text-align: center">
                                                    <img src="{{ 'http://192.168.110.234'.$produto->url }}" title="{{ $produto->name }}" width="400" height="400">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- footer -->
                                    <tr>
                                        <td class="content-cell">
                                            <p>Poderá ter sempre acesso às nossas últimas novidades, visualizando no Portal de Cliente a<a href="http://portaldocliente.gruponobrega.pt/novidades"> área de novidades.</a></p>
                                            <hr>
                                            <p>Melhores cumprimentos.</p>
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




