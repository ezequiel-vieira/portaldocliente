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
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >

        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        
        <!-- LIBRARIES -->
        <!-- BOOTSTRAP -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/css/style.css">
        <link rel="stylesheet" type="text/css" href="/css/dashboard.css">
        @yield('template_linked_css')
        <style type="text/css">
            @yield('template_fastload_css')
            .footer-left{
                display: inline-block;
                vertical-align: top;
            }
            .footer-links {
                color: #ffffff;
                margin: 20px 0 12px;
                padding: 0;
            }
            .footer-links a {
                display: inline-block;
                line-height: 1.8;
                text-decoration: none;
                color: inherit;
            }
            .footer-links a:hover {
                color: #94bb1e;
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
        <header>
            @include('partials.navbar')
        </header>
        <!-- Begin page content -->
        <main role="main" class="flex-shrink-0 container" style="margin-top: 76px;">
            <!-- FORM STATUS -->
            @include('partials.form-status')
            <!-- CONTENT CONTAINER -->
            @yield('content')
            <!------------------------>
            <div id="goUp">
                <a href="javascript:" class="voltar">
                    <i class="fas fa-angle-up"></i>
                </a>
            </div>
        </main>
        <!-- MAIN FOOTER -->

        <!-- Footer SCRIPTS-->
        <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
