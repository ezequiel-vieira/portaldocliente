<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container d-flex justify-content-between" id="header-bar">
        <a class="navbar-brand" href="{{ url('/') }}" >
            @if ($user->type === 'default' )
                <img src="/images/images-logos/Logo_NB_notext.png" class="img-fluid rounded d-inline-block" alt="Madeira Cash" style="max-width: 50px;margin-top: -5px;">
                <span class="navbar-brand-title d-none d-sm-none d-md-inline-block">PORTAL DO CLIENTE</span>
            @else
                <img src="/images/images-logos/Logo_MC_notext.png" class="img-fluid rounded d-inline-block" alt="Madeira Cash" style="max-width: 50px;margin-top: -5px;">
                <span class="navbar-brand-title d-none d-sm-none d-md-inline-block">LOJA ONLINE</span>
            @endif
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse" id="mainNavbar">
            <!--ul class="navbar-nav ml-auto d-none d-sm-none d-md-none d-lg-inline"-->
            <ul class="navbar-nav ml-auto d-lg-inline">
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
                        <div class="dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="far fa-user"></i> Terminar Sessão <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                                @if ($user->perfil_page === 1)
                                <a class="dropdown-item {{ ( Request::is('cliente/'.$client->alias)  ) ? 'active' : null }}" href="/cliente/{{$client->alias}}">
                                    <span class="dropdown-icon"><i class="fas fa-user-edit"></i></span> Perfil
                                </a>
                                @endif
                                @if ($user->cco_page === 1)
                                    <a class="dropdown-item {{ ( Request::is('cliente/'.$client->alias.'/conta-corrente')  ) ? 'active' : null }}" href="/cliente/{{$client->alias}}/conta-corrente">
                                        <span class="dropdown-icon"><i class="fas fa-euro-sign"></i></span> Conta Corrente
                                    </a>
                                @endif
                                @if ($user->refunds_page === 1)
                                    <a class="dropdown-item {{ ( Request::is('cliente/'.$client->alias.'/devolucao')  ) ? 'active' : null }}" href="/cliente/{{$client->alias}}/devolucoes">
                                        <span class="dropdown-icon"><i class="fas fa-exchange-alt"></i></span> Devoluções
                                    </a>
                                @endif
                                @if ($user->orders_page === 1)
                                    <a class="dropdown-item {{ ( Request::is('cliente/'.$client->alias.'/encomendas')  ) ? 'active' : null }}" href="/cliente/{{$client->alias}}/encomendas">
                                        <span class="dropdown-icon"><i class="fas fa-box-open"></i> </span> Encomendas
                                    </a>
                                @endif
                                @if ($user->news_page === 1)
                                    <a class="dropdown-item {{ ( Request::is('novidades')  ) ? 'active' : null }}" href="/novidades">
                                        <span class="dropdown-icon"><i class="fas fa-rss"></i></span> Novidades
                                    </a>
                                @endif
                                @if ($user->cat_page === 1)
                                    <a class="dropdown-item {{ ( Request::is('catalogo2')  ) ? 'active' : null }}" href="/catalogo">
                                        <span class="dropdown-icon"><i class="far fa-images"></i></span> Catálogo
                                    </a>
                                @endif
                                @if ($user->owner_page === 1)
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item {{ ( Request::is('cliente/'.$client->alias.'/utilizadores')  ) ? 'active' : null }}" href="/cliente/{{$client->alias}}/utilizadores">
                                        <span class="dropdown-icon"><i class="fas fa-user-lock"></i></span> G. Acessos
                                    </a>
                                @endif
                                @if (auth()->user()->isAdmin())
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item {{ ( Request::is('admin/users')  ) ? 'active' : null }}" href="/admin/users">
                                        <span class="dropdown-icon"><i class="fas fa-users-cog"></i></span> Utilizadores
                                    </a>
                                    <a class="dropdown-item {{ ( Request::is('/login-activity')  ) ? 'active' : null }}" href="/login-activity">
                                        <span class="dropdown-icon"><i class="fas fa-user-clock"></i></span> Histórico
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ ( Request::is('/logout')  ) ? 'active' : null }}" href="/logout">
                                        <span class="dropdown-icon"><i style="color: red;" class="fas fa-power-off" aria-hidden="true"></i></span>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
        <!-- TEMP -->
        @if ($user->cat_page_lite === 1 || $user->cat_page === 1)
            <div class="dropdownCart mx-auto">
                <button type="button" class="btn btn-cart-shop" data-toggle="dropdown" style="background-color: #93ba1f; border-color: #93ba1f;">
                    <i class="fa fa-shopping-cart" aria-hidden="true" style="color: #FFFFFF;left: 5px;position: relative;"></i> 
                    <span class="badge badge-pill badge-danger cart-basket">{{ count((array) session('cart2')) }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="overflow-y: auto;">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout" style="border-top: 0px solid #d2d2d2; border-bottom: 1px solid #d2d2d2;padding-top: 5px;">
                            <a href="{{ url('cart') }}" class="btn btn-primary btn-block">Finalizar Encomenda</a>
                        </div>
                    </div>
                    <div class="row total-header-section mt-3">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                            <span class="badge badge-pill badge-danger">
                                {{ count((array) session('cart2')) }}
                            </span>
                        </div>

                        <?php $total = 0 ?>
                        @if(session('cart2'))
                            @foreach( session('cart2') as $id => $details)
                                <?php $total += $details['price'] * $details['quantity']; ?>
                            @endforeach
                        @endif
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">€ {{ number_format($total, 2) }}</span></p>
                        </div>
                    </div>

                    @if(session('cart2'))
                        @foreach( session('cart2') as $id => $details)
                            <div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    <img src="{{ $details['photo'] }}" />
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['name'] }}</p>
                                    <span class="price text-info"> €{{ number_format($details['price'], 2) }}</span> 
                                    <h6><span class="count">Quantidade:</span> <span class="badge badge-secondary">{{ $details['quantity'] }}</span></h6>
                                    <!--span class="count"> Quantidade:{{ $details['quantity'] }}</span-->
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{ url('cart') }}" class="btn btn-primary btn-block">Finalizar Encomenda</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- TEMP -->
    </div>
</nav>
