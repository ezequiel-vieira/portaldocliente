<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@if (trim($__env->yieldContent('template_title'))) @yield('template_title') | ANN @endif </title>
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

        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')
            .pantone{
                color: #94bb1e;
            }

            .navbar-brand-title {
                padding-top: 0;
                padding-bottom: 0;
                height: 50px;
                line-height: 50px;
            }

            .slideRight {
                color: #5778F3;
                transition: transform .3s ease-in-out;
                font-size: 25px;
                padding: 15px 20px;
            }

            .slideRight:hover {
                transform: translateY(-25px);
            }

            .text-privacy{
                text-decoration: underline;
            }

            .dropdown-item.active, .dropdown-item:active {
                background-color: #94bb1e;
            }

            #goUp {
                z-index: 999999;
                position: fixed;
                bottom: 0;
                display: none;
                text-align: center;
                margin-left: -60px;
                left: 50%;
                height: 55px;
                width: 120px;
                overflow: hidden;
                -webkit-transition: all 0.3s ease;
                -moz-transition: all 0.3s ease;
                -ms-transition: all 0.3s ease;
                -o-transition: all 0.3s ease;
                transition: all 0.3s ease;
            }

            #goUp a {
                line-height: 55px;
                background-color: rgba(0, 0, 0, 0.25);
                display: block;
                width: 120px;
                height: 120px;
                padding: 0;
                color: #fff;
                -webkit-border-radius: 60px;
                -moz-border-radius: 60px;
                border-radius: 60px;
                -webkit-transition: all 0.3s ease;
                -moz-transition: all 0.3s ease;
                -ms-transition: all 0.3s ease;
                -o-transition: all 0.3s ease;
                transition: all 0.3s ease;
            }

            #goUp a .fa-angle-up {
                font-size: 46px;
                padding-top: 5px;
                -webkit-transition: all 0.3s ease;
                -moz-transition: all 0.3s ease;
                -ms-transition: all 0.3s ease;
                -o-transition: all 0.3s ease;
                transition: all 0.3s ease;
            }

            #goUp a:hover {
                background-color: #94bb1e;
            }

            .card-header{
                background-color: #94bb1e!important;
                color: #FFF!important;
            }
            /* FOOTER */

            @media only screen and (max-width: 991px) and (min-width: 770px) 
            {
                .tile.tile-medium {
                    width: 100% !important;
                }
            }

            @media (max-width: 991px)
            {
                .square-item{
                    border-right: 0px solid #eee;
                    border-bottom: 1px solid #eee;
                    text-align: center;
                }
            }

            @media (max-width: 769px)
            {
                .tile.tile-medium {
                    height: 100%;
                    width: 100% !important;
                    margin-bottom: 20px;
                }

                .client-tabs a {
                    margin: 0 10px;
                }
            }

            @media (max-width: 399px) 
            {
                .client-tabs a {
                    margin: 0 5px;
                    font-size: 12px;
                }
            }

            @media (max-width: 991.98px) {
              .offcanvas-collapse {
                position: fixed;
                top: 56px; /* Height of navbar */
                bottom: 0;
                left: 100%;
                width: 100%;
                padding-right: 1rem;
                padding-left: 1rem;
                overflow-y: auto;
                visibility: hidden;
                background-color: #343a40;
                transition: visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
                transition: transform .3s ease-in-out, visibility .3s ease-in-out;
                transition: transform .3s ease-in-out, visibility .3s ease-in-out, -webkit-transform .3s ease-in-out;
              }
              .offcanvas-collapse.open {
                visibility: visible;
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
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
    <body class="d-flex flex-column h-100">
        <!-- Begin page content -->
        <main role="main" class="flex-shrink-0" style="margin-top: 76px;">
            <!-- FORM STATUS -->
            @include('partials.form-status')
            <!-- CONTENT CONTAINER -->
            @yield('content')
            <div id="goUp">
                <a href="#" class="voltar">
                    <i class="fas fa-angle-up"></i>
                </a>
            </div>
        </main>
        <!-- MAIN FOOTER -->
        <footer class="footer mt-auto">
            @include('partials.main-footer')
        </footer>
        <!-- Footer -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script type="text/javascript">
            $(function () {
              'use strict'

              $('[data-toggle="offcanvas"]').on('click', function () {
                $('.offcanvas-collapse').toggleClass('open')
              })
            });

            /* TOP BUTTON FUNCTION */
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() 
            {
                scrollFunction();
            };

            function scrollFunction() {
              if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("goUp").style.display = "block";
              } else {
                document.getElementById("goUp").style.display = "none";
              }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() 
            {
                //$("html, body").animate({scrollTop: 0}, 1000);
                $('html, body').animate({scrollTop:0}, 'slow');
              //document.body.scrollTop = 0; // For Safari
              //document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }
        </script>
    </body>
</html>
