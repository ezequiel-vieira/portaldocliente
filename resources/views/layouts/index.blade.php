<!DOCTYPE html>
<html lang="pt" class="h-100">
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
        <!-- Bootstrap CDN -->
        <!-- BOOTSTRAP -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" />
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="/css/style.css"/>
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
                font-size: 14px;
            }
            .footer-links a:hover {
                color: #94bb1e;
            }
            .breadcrumb{
                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                transition: all 1s ease;
                padding: .5rem 1rem;
            }
            .breadcrumb a{
                color:#20a8d8;
            }
            .breadcrumb:hover {
                background-color: white !important;
            }
            .page-header
            {
                padding-bottom: 0px !important;
            }
            .main-container{
              margin-top: 76px;
            }
            .offcanvas-collapse.open #navbarDropdown{
              margin-top: 20px;
            }
            @media (max-width: 991.98px){
              .offcanvas-collapse {
                  top: 76px;
              }            
            }
            @media (max-width: 767.98px){
                .main-container{
                  margin-top: 58.81px;
                }
                .offcanvas-collapse {
                  top: 58.81px;
                }  
            }
        </style>
        <style>
          .main-section{
              background-color: #F8F8F8;
          }
          .dropdownCart{
              float:right;
              padding-right: 30px;
              padding-left: 30px;
          }
          .dropdownCart .dropdown-menu {
              border-radius: 0px;
              background-color: #FFF;
              width:350px !important;
              box-shadow:0px 5px 30px black;
              overflow-x: hidden;
              padding: 20px;
          }
          .total-header-section{
              border-bottom:1px solid #d2d2d2;
          }
          .total-section p{
              margin-bottom:20px;
          }
          .cart-detail{
              padding:15px 0px;
          }
          .cart-detail-img img{
              width:100px;
              height:100px;
              padding-left:15px;
          }
          .cart-detail-product p{
              margin:0px;
              color:#000;
              font-weight:500;
          }
          .cart-detail .price{
              font-size:12px;
              margin-right:10px;
              font-weight:500;
          }
          .cart-detail .count{
              color:#C2C2DC;
          }
          .checkout{
              border-top:1px solid #d2d2d2;
              padding-top: 15px;
          }
          .thumbnail {
              position: relative;
              padding: 0px;
              margin-bottom: 20px;
          }
          .thumbnail img {
              width: 100%;
          }
          .thumbnail .caption{
              margin: 7px;
          }
          .thumbnail p {
              margin-top: 0;
              margin-bottom: 0.5rem;
          }
          .page {
              margin-top: 50px;
          }
          .btn-holder{
              text-align: center;
          }
          .table>tbody>tr>td, .table>tfoot>tr>td{
              vertical-align: middle;
          }
          .dropdown-menu {         
            max-height: 400px;
            overflow-y: auto;
          }
          @media screen and (max-width: 600px) {
              table#cart tbody td .form-control{
                  width:20%;
                  display: inline !important;
              }
              .actions .btn{
                  width:25%;
                  margin:1.5em 0;
              }

              .actions .btn-info{
                  float:left;
              }
              .actions .btn-danger{
                  float:right;
              }

              table#cart thead { display: none; }
              table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
              table#cart tbody tr td:first-child { background: #333; color: #fff; }
              table#cart tbody td:before {
                  content: attr(data-th); font-weight: bold;
                  display: inline-block; width: 8rem;
              }

              table#cart tfoot td{display:block; }
              table#cart tfoot td .btn{display:block;}
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
        <main role="main" class="flex-shrink-0 main-container">
            @yield('template_breadcrumbs')
            <!-- FORM STATUS -->
            @include('partials.form-status')
            <!-- CONTENT CONTAINER -->
            @yield('content')
            <div class="overlay2"></div>
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
        <script src="/js/jquery-3.4.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script type="text/javascript">
          $(function () {
            $('[data-toggle="tooltip"]').tooltip();
          });
        </script>
        @yield('footer_scripts')

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
                    $('.md-tabs a[href="' + activeTab + '"]').tab('show');
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
</html>
