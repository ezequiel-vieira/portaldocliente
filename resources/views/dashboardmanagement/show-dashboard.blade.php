@extends('layouts.index')

@section('template_title')
    Portal do Cliente
@endsection

@section('template_linked_css') 
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"-->
    @if ($user->type === 'default' )
        <style type="text/css">
            .jumbotron-img-bg
            {
                background-image: url("../images/bg-products.jpg");
            }
        </style>
    @else
        <style type="text/css">
            .jumbotron-img-bg
            {
                background-image: url("../images/madeira_cash.jpg");
            }
        </style>
    @endif
    <style type="text/css">
        .jumbotron-img-bg
        {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 0rem;
            padding: 0;
        }
        .bg-dark{
            background: linear-gradient(219deg, rgba(246, 246, 246, 0.02) 0%, rgba(246, 246, 246, 0.02) 20%,rgba(225, 225, 225, 0.02) 20%, rgba(225, 225, 225, 0.02) 40%,rgba(136, 136, 136, 0.02) 40%, rgba(136, 136, 136, 0.02) 60%,rgba(216, 216, 216, 0.02) 60%, rgba(216, 216, 216, 0.02) 80%,rgba(35, 35, 35, 0.02) 80%, rgba(35, 35, 35, 0.02) 100%),linear-gradient(299deg, rgba(213, 213, 213, 0.02) 0%, rgba(213, 213, 213, 0.02) 20%,rgba(150, 150, 150, 0.02) 20%, rgba(150, 150, 150, 0.02) 40%,rgba(161, 161, 161, 0.02) 40%, rgba(161, 161, 161, 0.02) 60%,rgba(186, 186, 186, 0.02) 60%, rgba(186, 186, 186, 0.02) 80%,rgba(28, 28, 28, 0.02) 80%, rgba(28, 28, 28, 0.02) 100%),linear-gradient(50deg, rgba(157, 157, 157, 0.02) 0%, rgba(157, 157, 157, 0.02) 16.667%,rgba(147, 147, 147, 0.02) 16.667%, rgba(147, 147, 147, 0.02) 33.334%,rgba(42, 42, 42, 0.02) 33.334%, rgba(42, 42, 42, 0.02) 50.001000000000005%,rgba(214, 214, 214, 0.02) 50.001%, rgba(214, 214, 214, 0.02) 66.668%,rgba(34, 34, 34, 0.02) 66.668%, rgba(34, 34, 34, 0.02) 83.33500000000001%,rgba(211, 211, 211, 0.02) 83.335%, rgba(211, 211, 211, 0.02) 100.002%),linear-gradient(278deg, rgba(79, 79, 79, 0.03) 0%, rgba(79, 79, 79, 0.03) 20%,rgba(217, 217, 217, 0.03) 20%, rgba(217, 217, 217, 0.03) 40%,rgba(5, 5, 5, 0.03) 40%, rgba(5, 5, 5, 0.03) 60%,rgba(200, 200, 200, 0.03) 60%, rgba(200, 200, 200, 0.03) 80%,rgba(125, 125, 125, 0.03) 80%, rgba(125, 125, 125, 0.03) 100%),linear-gradient(274deg, rgba(235, 235, 235, 0.03) 0%, rgba(235, 235, 235, 0.03) 12.5%,rgba(100, 100, 100, 0.03) 12.5%, rgba(100, 100, 100, 0.03) 25%,rgba(44, 44, 44, 0.03) 25%, rgba(44, 44, 44, 0.03) 37.5%,rgba(228, 228, 228, 0.03) 37.5%, rgba(228, 228, 228, 0.03) 50%,rgba(36, 36, 36, 0.03) 50%, rgba(36, 36, 36, 0.03) 62.5%,rgba(72, 72, 72, 0.03) 62.5%, rgba(72, 72, 72, 0.03) 75%,rgba(30, 30, 30, 0.03) 75%, rgba(30, 30, 30, 0.03) 87.5%,rgba(109, 109, 109, 0.03) 87.5%, rgba(109, 109, 109, 0.03) 100%),linear-gradient(90deg, hsl(28,0%,14%),hsl(28,0%,14%));
        }
        .tile-catalogo{
            /*background: #ff6348;*/
            background: #597532;
        }

        .tile-cliente{
            background: #D07228;
        }
        .tile-news{
            background: #C32A2C;
        }
        .tile-cco{
            background:#48B693;
        }
        .tile-refund{
            background: #60a3bc;
        }   
        .tile-orders{
            background: #0C0E25
        }
        .tile-meat{
            background: #A62D37;
        }
        .tile-access{
            background: #B3A800;
        }
        .tile-users{
            background: #4F415D;
        }
        .tile-history{
            background: #6D8764;
        }
        .tile:hover h2.tile-title, .tile:hover .fa-links{
            color: #FFF;
            text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
                     0px 8px 13px rgba(0,0,0,0.1),
                     0px 18px 23px rgba(0,0,0,0.1);
        }
        .tile-hierarquias{
            background: #647800;
        }
        .tile-client-form{
            background: #93ba1f;
        }
        h2.tile-title {
            font-weight: normal;
        }
        /*#dashboard_grid:hover .thumbnail, .dashboard_grid:hover .thumbnail{
          opacity:0.5;
        }
        #dashboard_grid .thumbnail:hover, .dashboard_grid .thumbnail:hover{
          opacity:1;
        }*/
    </style>
@endsection

@section('content')
    <section class="jumbotron jumbotron-img-bg" style="margin-bottom: 0rem;">
        <div  style="background-color:rgba(0, 0, 0, 0.7); padding: 2rem 2rem 2rem 2rem;">
            <div class="container">
                <div class="logo-wrapper text-center">
                    <div class="row">
                        <div class="col" style="display: flex; justify-content: center; align-items: center;">
                            @if ($user->type === 'default' )
                                <img src="/images/images-logos/Logo_NB_notext.png" class="logo-bg img-fluid rounded mx-auto d-block logo_dashboard" alt="Grupo Nóbrega"/>
                            @else
                                <img src="/images/images-logos/Logo_MC_notext.png" class="logo-bg img-fluid rounded mx-auto d-block logo_dashboard" alt="Madeira Cash"/>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--section class="album py-5 bg-light"-->
    <section class="album py-5">
        @if ($user->type === 'default' )
            <div class="container">
                <div class="row justify-content-center" id="dashboard_grid2">
                    @if ($user->cat_page === 1 || $user->cat_page_lite === 1)
                        <div class="col col-6 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-catalogo rounded-0">  
                                <a href="/catalogo" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="far fa-images fa-3x"></i>
                                        <h2 class="tile-title">Catálogo</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->news_page === 1)
                        <div class="col col-6 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-news rounded-0">  
                                <a href="/novidades" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fab fa-hotjar fa-3x"></i>
                                        <h2 class="tile-title">novidades</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center" id="dashboard_grid">
                    @if ($user->gestao_page === 1)
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange bg-primary rounded-0">  
                                <a href="/gestao" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="far fa-images fa-3x"></i>
                                        <h2 class="tile-title">Gestão Utilizadores</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->perfil_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-green tile-cliente rounded-0">
                                <a href="/cliente/{{$cliente->alias}}" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-users-cog fa-3x"></i>
                                        <h2 class="tile-title">cliente</h2>
                                    </div>                                  
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->cco_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-cco rounded-0">
                                <a href="/cliente/{{$cliente->alias}}/conta-corrente" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-file-invoice-dollar fa-3x"></i>
                                        <h2 class="tile-title">conta corrente</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->refunds_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-refund rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/devolucoes" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-exchange-alt fa-3x"></i>
                                        <h2 class="tile-title">Devolução</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->orders_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-orders rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/encomendas" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-box-open fa-3x"></i>
                                        <h2 class="tile-title">Encomendas</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (auth()->user()->isAdmin())
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-access tile-orders rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/utilizadores" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-lock fa-3x"></i>
                                        <h2 class="tile-title">Acessos</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-history tile-orders rounded-0">  
                                <a href="/login-activity" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-clock fa-3x"></i>
                                        <h2 class="tile-title">Histórico</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-users tile-orders rounded-0">  
                                <a href="/admin/users" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-users-cog fa-3x"></i>
                                        <h2 class="tile-title">Utilizadores</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-meat tile-orders rounded-0">  
                                <a href="/cortes" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-utensils  fa-3x"></i>
                                        <h2 class="tile-title">Cortes</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif  
                    @if ($user->family_page === 1 || auth()->user()->isAdmin())
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-hierarquias tile-orders rounded-0">  
                                <a href="/familias" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-chess fa-3x"></i>
                                        <h2 class="tile-title">COMPOSIÇÃO CÓDIGOS</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->client_form_page === 1)
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-client-form tile-orders rounded-0">  
                                <a href="/novo/cliente" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-plus fa-3x"></i>
                                        <h2 class="tile-title">Criar Cliente</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="col-12 text-center mb-3">
                        <h6>Dúvidas como efectuar a sua encomenda? Saiba mais<a href="/faq"> aqui.</a></h6>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <img src="/images/Sentimadeirenses1.png" class="logo-bg img-fluid rounded mx-auto d-block logo_dashboard" alt="Madeira Cash"/>
                    </div> 
                </div>
            </div>
        @elseif($user->type === 'guest')
            <div class="container">
                @if ($user->cat_page === 1 || $user->cat_page_lite === 1)
                    <div class="row justify-content-center" id="dashboard_grid2">
                        <div class="col col-8 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-catalogo rounded-0">  
                                <a href="/catalogo" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="far fa-images fa-3x"></i>
                                        <h2 class="tile-title">Catálogo de Entregas em Casa</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center" id="dashboard_grid">
                    @if ($user->gestao_page === 1)
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange bg-primary rounded-0">  
                                <a href="/gestao" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="far fa-images fa-3x"></i>
                                        <h2 class="tile-title">Gestão Utilizadores</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->perfil_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-green tile-cliente rounded-0">
                                <a href="/cliente/{{$cliente->alias}}" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-users-cog fa-3x"></i>
                                        <h2 class="tile-title">cliente</h2>
                                    </div>                                  
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->news_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-news rounded-0">  
                                <a href="/novidades" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fab fa-hotjar fa-3x"></i>
                                        <h2 class="tile-title">novidades</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->cco_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-cco rounded-0">
                                <a href="/cliente/{{$cliente->alias}}/conta-corrente" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-file-invoice-dollar fa-3x"></i>
                                        <h2 class="tile-title">conta corrente</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->refunds_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-refund rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/devolucoes" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-exchange-alt fa-3x"></i>
                                        <h2 class="tile-title">Devolução</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->orders_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-orders rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/encomendas" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-box-open fa-3x"></i>
                                        <h2 class="tile-title">Encomendas</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (auth()->user()->isAdmin())
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-access tile-orders rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/utilizadores" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-lock fa-3x"></i>
                                        <h2 class="tile-title">Acessos</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-history tile-orders rounded-0">  
                                <a href="/login-activity" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-clock fa-3x"></i>
                                        <h2 class="tile-title">Histórico</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-users tile-orders rounded-0">  
                                <a href="/admin/users" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-users-cog fa-3x"></i>
                                        <h2 class="tile-title">Utilizadores</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-meat tile-orders rounded-0">  
                                <a href="/cortes" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-utensils  fa-3x"></i>
                                        <h2 class="tile-title">Cortes</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif  
                    @if ($user->family_page === 1 || auth()->user()->isAdmin())
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-hierarquias tile-orders rounded-0">  
                                <a href="/familias" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-chess fa-3x"></i>
                                        <h2 class="tile-title">COMPOSIÇÃO CÓDIGOS</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->client_form_page === 1)
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-client-form tile-orders rounded-0">  
                                <a href="/novo/cliente" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-plus fa-3x"></i>
                                        <h2 class="tile-title">Criar Cliente</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="col-12 text-center mb-3">
                        <h6>Dúvidas como efectuar a sua encomenda? Saiba mais<a href="/faq"> aqui.</a></h6>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <img src="/images/Sentimadeirenses1.png" class="logo-bg img-fluid rounded mx-auto d-block logo_dashboard" alt="Madeira Cash"/>
                    </div> 
                </div>
            </div>
        @else
            <div class="container">
                @if ($user->cat_page === 1 || $user->cat_page_lite === 1)
                    <div class="row justify-content-center" id="dashboard_grid2">
                        <div class="col col-8 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-catalogo rounded-0">  
                                <a href="/catalogo" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="far fa-images fa-3x"></i>
                                        <h2 class="tile-title">Catálogo de Entregas em Casa</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row justify-content-center" id="dashboard_grid">
                    @if ($user->gestao_page === 1)
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange bg-primary rounded-0">  
                                <a href="/gestao" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="far fa-images fa-3x"></i>
                                        <h2 class="tile-title">Gestão Utilizadores</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->perfil_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-green tile-cliente rounded-0">
                                <a href="/cliente/{{$cliente->alias}}" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-users-cog fa-3x"></i>
                                        <h2 class="tile-title">cliente</h2>
                                    </div>                                  
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->news_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-news rounded-0">  
                                <a href="/novidades" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fab fa-hotjar fa-3x"></i>
                                        <h2 class="tile-title">novidades</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->cco_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-cco rounded-0">
                                <a href="/cliente/{{$cliente->alias}}/conta-corrente" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-file-invoice-dollar fa-3x"></i>
                                        <h2 class="tile-title">conta corrente</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->refunds_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-refund rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/devolucoes" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-exchange-alt fa-3x"></i>
                                        <h2 class="tile-title">Devolução</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->orders_page === 1)
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-orange tile-orders rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/encomendas" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-box-open fa-3x"></i>
                                        <h2 class="tile-title">Encomendas</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (auth()->user()->isAdmin())
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-access tile-orders rounded-0">  
                                <a href="/cliente/{{$cliente->alias}}/utilizadores" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-lock fa-3x"></i>
                                        <h2 class="tile-title">Acessos</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-history tile-orders rounded-0">  
                                <a href="/login-activity" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-clock fa-3x"></i>
                                        <h2 class="tile-title">Histórico</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-4 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-users tile-orders rounded-0">  
                                <a href="/admin/users" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-users-cog fa-3x"></i>
                                        <h2 class="tile-title">Utilizadores</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-meat tile-orders rounded-0">  
                                <a href="/cortes" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-utensils  fa-3x"></i>
                                        <h2 class="tile-title">Cortes</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif  
                    @if ($user->family_page === 1 || auth()->user()->isAdmin())
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-hierarquias tile-orders rounded-0">  
                                <a href="/familias" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-chess fa-3x"></i>
                                        <h2 class="tile-title">COMPOSIÇÃO CÓDIGOS</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    @if ($user->client_form_page === 1)
                        <div class="col col-12 text-center mb-3">
                            <div class="thumbnail tile tile-medium tile-client-form tile-orders rounded-0">  
                                <a href="/novo/cliente" class="fa-links">
                                    <div class="tile-icon text-center">
                                        <i class="fas fa-user-plus fa-3x"></i>
                                        <h2 class="tile-title">Criar Cliente</h2>
                                    </div>              
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="col-12 text-center mb-3">
                        <h6>Dúvidas como efectuar a sua encomenda? Saiba mais<a href="/faq"> aqui.</a></h6>
                    </div>
                    <div class="col-12 text-center mt-3 mb-3">
                        <img src="/images/Sentimadeirenses1.png" class="logo-bg img-fluid rounded mx-auto d-block logo_dashboard" alt="Madeira Cash"/>
                    </div> 
                </div>
            </div>
        @endif

    </section>
@endsection

@section('footer_scripts')
    <!-- Start of  Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=8c2a3f10-72ad-40bf-ae67-8da6923471cf"> </script>
    <!-- End of  Zendesk Widget script -->
    <script type="text/javascript">
        /*$(document).ready( function() 
        {
          var childCount = document.getElementById("dashboard_grid").childElementCount;

          for(i = 0; i < childCount; i++) 
          {
            if(childCount === 6)
            {
                document.getElementById("dashboard_grid").children[i].className = "text-center mb-3 col-lg-4";
            }
            if(childCount === 5)
            {
                document.getElementById("dashboard_grid").children[i].className = "text-center mb-3 col-lg-6";
                document.getElementById("dashboard_grid").lastChild.className = "text-center mb-3 col-lg-12";
            }
            if(childCount === 4)
            {
                document.getElementById("dashboard_grid").children[i].className = "text-center mb-3 col-lg-6";
            }
            if(childCount === 3)
            {
                document.getElementById("dashboard_grid").children[i].className = "text-center mb-3 col-lg-4";
                document.getElementById("dashboard_grid").lastChild.className = "text-center mb-3 col-lg-12";
            }
            if(childCount === 2)
            {
                document.getElementById("dashboard_grid").children[i].className = "text-center mb-3 col-lg-6";
            }
            if(childCount === 1)
            {
                document.getElementById("dashboard_grid").children[i].className = "text-center mb-3 col-lg-12";
            }
          }
        });*/
    </script>
@endsection
