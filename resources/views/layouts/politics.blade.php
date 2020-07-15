<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | ANNII @endif </title>
        <meta name="description" content="Portal do Cliente | ANNII">
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

        @yield('head')
    </head>
    <body class="d-flex flex-column h-100">
        <header>
            @include('partials.navbar_logo')
        </header>

        <!-- Begin page content -->
        <main role="main" class="flex-shrink-0" style="margin-top: 76px;">
            <!-- FORM STATUS -->
            @include('partials.form-status')
            <!-- CONTENT CONTAINER -->
            @yield('content')
            <div id="goUp">
                <a href="javascript:" class="voltar">
                    <i class="fas fa-angle-up"></i>
                </a>
            </div>
        </main>

        <!-- MAIN FOOTER -->
        <footer class="footer mt-auto">
            @include('partials.main-footer')
        </footer>
        <!-- Footer -->
        <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('.nav-link').on('show.bs.tab', function(e) {
                    localStorage.setItem('activeTab', $(e.target).attr('href'));
                });

                var activeTab = localStorage.getItem('activeTab');
                if(activeTab)
                {
                    $('.client-tabs a[href="' + activeTab + '"]').tab('show');
                }
            });

            $(function() 
            {
              'use strict'

                $('[data-toggle="offcanvas"]').on('click', function () 
                {
                    $('.offcanvas-collapse').toggleClass('open');
                    $('.body').toggleClass('scrollBarVisibility scrollBarInvisibility');
                });
            });

            /* TOP BUTTON FUNCTION */
            window.onscroll = function() 
            {
                scrollFunction();
            };
            function scrollFunction() 
            {
              /*When the user scrolls down 20px from the top of the document, show the button*/
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) 
              {
                $('#goUp').fadeIn(200);
              }else{
                $('#goUp').fadeOut(200);
              }
            }
            $('#goUp').click(function() 
            {
                $('body,html').animate({
                    scrollTop : 0
                }, 500);
            });
        </script>
    </body>
