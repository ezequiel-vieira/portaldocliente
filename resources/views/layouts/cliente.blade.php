<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | ANN @endif </title>
        <meta name="description" content="">
        <meta name="author" content="Ezequiel Vieira">
        <!--link rel="shortcut icon" href="/favicon.ico"-->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >

        {{-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries --}}
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        
        <!-- LIBRARIES -->
        <!-- BOOTSTRAP -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        <link rel="stylesheet" type="text/css" href="/css/style.css">

        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')
        </style>

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>

        {{-- Styles Custom--}}
        <!--link rel="stylesheet" type="text/css" href="/css/custom.css" -->

        @yield('head')
    </head>

    <body class="d-flex flex-column h-100">
        <header>
            @include('partials.navbar')
        </header>

        <!-- Begin page content -->
        <main role="main" class="flex-shrink-0">
            <!-- FORM STATUS -->
            @include('partials.form-status')
            
            <section class="jumbotron text-center">
                <div class="container">
                    <div class="logo-wrapper text-center">
                        <img src="/images/Nobrega-bg-darkletters.png" class="logo-bg img-fluid rounded mx-auto d-block" alt="...">
                    </div>
                </div>
            </section>

            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                            <div class="thumbnail tile tile-medium tile-green" style="background-color: #CF4917;">
                                <a href="#" class="fa-links">
                                    <div class="tile-icon">
                                        <i class="fas fa-users-cog fa-3x"></i>
                                        <h2 class="tile-title">cliente</h2>
                                    </div>                                  
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="thumbnail tile tile-medium tile-orange" style="background-color: #2D758C;">
                                <a href="#" class="fa-links">
                                    <div class="tile-icon">
                                        <i class="fas fa-file-invoice-dollar fa-3x"></i>
                                        <h2 class="tile-title">conta corrente</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <div class="thumbnail tile tile-medium tile-orange" style="background-color: #F9AC3D;">
                                <a href="#" class="fa-links">
                                    <div class="tile-icon">
                                        <i class="fab fa-hotjar fa-3x"></i>
                                        <h2 class="tile-title">novidades</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- MAIN FOOTER -->
        <footer class="footer mt-auto py-3">
            <div class="container">
                <div class="col-lg-12 text-center">
                    <p>Política de Privacidade | © Copyright Grupo Nóbrega <?php echo date('Y'); ?> . Todos os direitos reservados.</p>
                    <p><a href="#">Back to top</a></p>
                </div>
            </div>
        </footer>
        
        <div class="container-fluid">
            <div class="row">
                <!-- SIDEBAR -->
                @include('partials.sidebar')
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <!-- FORM STATUS -->
                    @include('partials.form-status')
                    <!-- CONTENT CONTAINER -->
                    @yield('content')
                </main>
            </div>
        </div>
        
        <!-- FOOTER -->

        @include('partials.footer')

        {{-- Footer Scripts --}}
        <!-- Scripts --> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        @yield('footer_scripts')

    </body>
</html>
