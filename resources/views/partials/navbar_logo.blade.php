<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="{{ url('/') }}" >
            <img src="/images/images-logos/Logotipo.png" class="img-fluid rounded d-inline-block" alt="..." style="max-width: 50px;margin-top: -5px;">
            <span class="navbar-brand-title">PORTAL DO CLIENTE</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto ">
                <li class="nav-item">
                    <a class="nav-link nav-link-white{{ ( Request::is('/')  ) ? 'active' : null }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-white {{ ( Request::is('politica-de-privacidade')  ) ? 'active' : null }}" href="/politica-de-privacidade">Política de Privacidade e Termos e Condições</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
