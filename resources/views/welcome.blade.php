<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- LIBRARIES -->
        <!-- BOOTSTRAP -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                height: 100%;
            }
			html {
		      	font-family: sans-serif;
			    line-height: 1.15;
			    -webkit-text-size-adjust: 100%;
			    -webkit-tap-highlight-color: transparent;
			    height: 100%;
			}
			body {
			    margin: 0;
			    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
			    font-size: 1rem;
			    font-weight: 400;
			    line-height: 1.5;
			    color: #212529;
			    text-align: left;
			    background-color: #fff;
			}

			/*body > .container {
			  padding: 60px 15px 0;
			}

			.footer > .container {
			  padding-right: 15px;
			  padding-left: 15px;
			}*/


			/*.footer {
			  position: absolute;
			  bottom: 0;
			  width: 100%;
			  height: 60px;
			  line-height: 60px;
			  background-color: #f5f5f5;
			}*/

            /*.full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }*/

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .navbar-dark .navbar-nav .nav-link {
			    color: #94BB1E;
			}

			.navbar-dark .navbar-nav .nav-link:focus, .navbar-dark .navbar-nav .nav-link:hover {
			    color: #333333;
			}

            .links > a, .nav-link {
                color: #94BB1E;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover {
                color: #636b6f;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .tile{
            	border-radius: 3px;
            	border: 1px solid rgba(0, 0, 0, 0.125);
            	text-decoration: none;
            	word-wrap: break-word;
    			transition: .15s box-shadow ease,.15s transform ease;
    			-moz-transition: .15s box-shadow ease,.15s transform ease;
    			box-shadow: 0 2rem 1.5rem -1.5rem rgba(33,37,41,.15),0 0 1.5rem .5rem rgba(33,37,41,.05)!important;
    			position:relative;
            }

            .tile:hover{
        	    transform: translateY(-0.25rem);
    			box-shadow: 0 2.25rem 1.5rem -1.5rem rgba(33,37,41,.3),0 0 1.5rem .5rem rgba(33,37,41,.05)!important;
            }
            .tile:hover a{
            	text-decoration: none;
            }
            .tile.tile-medium {
			    height: 150px;
			    width: 250px;
			}
			a.fa-links {
			    color: #fff;
			}
			.tile h1, .tile h2, .tile h3, .tile h4, .tile h5, .tile h6 {
			    color: #fff;
			    -webkit-user-select: none;
			}
			.tile-icon{
				padding: 1rem !important;
			}
			h2.tile-title, .fa-3x{
				-webkit-transition: all 1s ease;
				-moz-transition: all 1s ease;
				transition: all 1s ease;
			}
			h2.tile-title {
				font-size: 1.3em;
			    letter-spacing: .15em;
			    color: #828a9f;
			    text-transform: uppercase;
			    font-weight: normal;
			    color: rgba(255, 255, 255, 0.65);
			}
            .tile:hover h2.tile-title{
            	/*font-size: 1.5em;*/
            	color: #333;
            }
            .tile:hover .fa-3x {
			    /*font-size: 3.2em;*/
			}
			.tile-title {
			    margin-top: 10px;
			    margin-bottom: 0;
			}
			.logo-bg{
				width: 400px;
				height: 300px;
			}
			.logo-wrapper{
				width: 100%;
				height: 300px;
			}
			.navbar-light .navbar-nav .nav-link {
			    color: #94bb1e
			}
			.footer{
				background-color: #e9ecef;
			}
        </style>
    </head>
    <body class="d-flex flex-column h-100">
		<header>
		  <div class="navbar navbar-dark shadow-sm">
		    <div class="container d-flex justify-content-between">
                <a class="navbar-brand" href="{{ url('/') }}" style="width: 50px; height: 50px;">
                    <img src="/images/Nobrega-01.png" class="img-fluid rounded mx-auto d-block" alt="...">
                </a>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
		    </div>
		  </div>
		</header>
		<!-- Begin page content -->
	    <main role="main" class="flex-shrink-0">
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
	    <footer class="footer mt-auto py-3">
	      <div class="container">
	      	<div class="col-lg-12 text-center">
	      		<p>Política de Privacidade | © Copyright Grupo Nóbrega <?php echo date('Y'); ?> . Todos os direitos reservados.</p>
				<p><a href="#">Back to top</a></p>
			</div>
	      </div>
	    </footer>
	    <!-- Scripts --> 
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
