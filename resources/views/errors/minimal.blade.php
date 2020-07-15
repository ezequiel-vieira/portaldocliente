<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | ANNII</title>
        <!-- BOOTSTRAP -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #FFF;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
                position: relative;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .code {
                border-right: 2px solid;
                font-size: 30px;
                padding: 0 15px 0 15px;
                /*text-align: center;*/
                display: inline-block;
            }
            .message {
                font-size: 22px;
                display: inline-block;
                /*text-align: center;*/
            }
            .text-center {
                text-align: center!important;
            }

            .btn-pantone{
                background-color: #94bb1e;
                border-color: #b2b2b2;
            }
            .image-background {
                background-image: url(../images/bg-products.jpg);
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 0rem;
            }
        </style>
    </head>
    <body>
        <div class="full-height image-background">
            <div  style="background-color:rgba(0, 0, 0, 0.7); height: 100vh; padding: 4rem 2rem;">
                <div class="container">
                    <div class="logo-wrapper text-center">
                        <img src="/images/Logotipo.png" class="logo-bg img-fluid rounded mx-auto d-block" alt="..."/>
                    </div>
                </div>            
                <div class="container text-center mt-3 mb-3">
                    <div class="code">
                        @yield('code')
                    </div>
                    <div class="message" style="padding: 10px;">
                        @yield('message')
                    </div>
                </div>
                <div class="container text-center mt-3 mb-3">
                    <div class="">
                        <a href="/" class="btn btn-success btn-pantone" role="button"><i class="fas fa-home"></i> Página Principal</a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
