<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | ANNII @endif </title>
        <meta name="description" content="Portal do Cliente | ANN">
        <meta name="author" content="Ezequiel Vieira">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=69BAegy8mB">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=69BAegy8mB">
        <link rel="manifest" href="/site.webmanifest?v=69BAegy8mB">
        <link rel="mask-icon" href="/safari-pinned-tab.svg?v=69BAegy8mB" color="#93ba1f">
        <link rel="shortcut icon" href="/favicon.ico?v=69BAegy8mB">
        <meta name="msapplication-TileColor" content="#93ba1f">
        <meta name="theme-color" content="#ffffff">

        <!--link rel="shortcut icon" href="{{ asset('favicon.ico') }}" -->

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        
        <!-- LIBRARIES -->
        <!-- BOOTSTRAP -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        @yield('template_linked_css')
        <style type="text/css">
            @yield('template_fastload_css')
            * {
              margin: 0;
              padding: 0;
            }
            html,
            body {
                width: 100%;
                height: 100%;
            }
            body {
                display:flex;
                flex-direction:column;
            }
            .ann{
                background-image: url(/images/bg-products.jpg);
 
                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-size: auto 100%;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
            }
            .ann-right{
                background-image: url(/images/madeira_cash.jpg);
 
                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-size: auto 100%;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
            }
            .flex-fill {
                flex: 1 1 auto;
            }
            .flex-shrink {
                flex-shrink: 0;
            }
            .ann-message {
                color: #fff;
                /*text-shadow: #343a40 2px 2px;*/
            }
            .ann-message{
                /*position: absolute;*/
                z-index: 2;
                top: 0;
                width: 100%;
                height: 100%;
                transition: .5s ease;
                background: rgba(0, 0, 0, .7);
                padding: 1.5rem;
                /*padding: 3rem 3.5rem;*/
            }
            .ann-title,
            .ann-subtitle {
                width: 100%;
                display: block;
                color: #FFF;
            }
            .ann-subtitle{
                font-size: 1.2rem;
                font-weight: 200;
                margin: 2.5rem 0 3.5rem 0;
                color: rgba(255,255,255,0.7);
            }
            .ann-title {
                margin: 3% 0;
                text-transform: uppercase;
            }

            .btn-link-login, .fa-user-lock{
                -webkit-transition: all 0.3s ease;
                -moz-transition: all 0.3s ease;
                -ms-transition: all 0.3s ease;
                -o-transition: all 0.3s ease;
                transition: all 0.3s ease;
            }

            .btn-link-login:hover .fa-user-lock:before{
                content:"\f09c";
                opacity:0.8;
            }
            .card{
                background: rgba(0, 0, 0, 0.8) !important;
            }

            @media (max-width: 991px)
            {
                .ann-message{
                    padding: 2rem 2.5rem;
                }
            }

            @media (max-width: 767px)
            {
                .page-wrapper
                {
                    background: rgba(0, 0, 0, 0.5) !important;
                }
                .ann{
                    height: 100%;
                }

                .ann-right{
                    background-image: url(/images/bg-products.jpg);
                    position: relative;
                    height: 100%;
                }

                .ann-right .pb-5, .ann-right .py-5 {
                    padding-top: 1.5rem!important;
                    padding-bottom: 1.5rem!important;
                }

                .card{
                    background: rgba(0, 0, 0, 0.8) !important;
                }

                .card-header {
                    background: rgba(0, 0, 0, 0.8) !important;
                    color: #FFF !important;
                }
                .remember-label{
                    color: #FFF !important;
                }

                .text-dark {
                    color: #007bff!important;
                }

                a.text-dark:focus, a.text-dark:hover {
                    color: #0056b3!important;
                }

                .text-dark:hover {
                    color: #0056b3;
                    text-decoration: underline;
                }

                .login-card .form-check {
                    padding-left: 2.25rem;
                }

                p, .col-form-label{
                    color: #FFF;
                }
            }  
        </style>
        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        @yield('head')
    </head>
    <body class="body d-flex flex-column h-100 scrollBarInvisibility">
        @if(session()->has('message'))
            <div class="alert {{ Session::get('alert-class') }} alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">{{ Session::get('alert-class') }}</h4>
                <p>{{ session()->get('message') }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Begin page content -->
        <div class="container-fluid d-flex flex-fill flex-column p-0 no-gutters page-wrapper">
            <div class="row flex-fill no-gutters">
                <!-- Main body of page -->
                <div class="col-12 col-md-12 col-lg-12 ann d-none d-md-block" style="position: relative;">
                        <div class="ann-message" style="padding: 0rem;">
                            <div class="container h-100">
                                <div class="row align-items-center h-100 no-gutters">
                                    <!--div class="col-12 mx-auto">
                                        <div class="h-100 text-center w-50 mx-auto">
                                            <img src="/images/images-logos/Logo_Branco.png" class="img-fluid">
                                        </div>
                                    </div-->
                                    <div class="col-12 mx-auto">
                                        <div class="h-100">
                                            @yield('content')
                                        </div>
                                    </div>
                                    <div class="col-12 mx-auto d-none d-md-block">
                                        <div class="h-100">
                                            <div class="text-center d-block m-3">
                                                <small class="text-light text-center">&copy; Copyright <?php echo date('Y'); ?>, Grupo Nóbrega.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                </div>
                <!-- MOBILE -->
                <div class="col-12 col-md-12 col-lg-12 ann-right d-block d-md-none" style="height:100%;">
                    <div class="container h-100">
                        <div class="row align-items-center h-100">
                            <div class="col-12 mx-auto">
                                <div class="h-100 text-center">
                                    <h3 class="ann-title">BEM-VINDO AO PORTAL DO CLIENTE</h3>
                                </div>
                            </div>
                            <div class="col-12 mx-auto">
                                <div class="h-100 text-center w-50 mx-auto">
                                    <img src="/images/images-logos/Logo_Branco.png" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12 mx-auto">
                                <div class="h-100">
                                    @yield('content')
                                </div>
                            </div>
                            <div class="col-12 mx-auto">
                                <div class="h-100">
                                    <div class="text-center d-block m-3">
                                        <small class="text-light text-center">&copy; Copyright <?php echo date('Y'); ?>, Grupo Nóbrega.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/js/jquery-3.4.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $('.alert').alert();
        </script>
        @yield('footer_scripts')
    </body>
</html>

