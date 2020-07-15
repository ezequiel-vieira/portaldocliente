<!-- Footer Links -->
<div class="container text-center text-md-left py-3">
    @if ($user->type === 'default' )
    <!-- Grid row -->
    <div class="row">
        <!-- Grid column -->
        <div class="col-12 col-md-6 mb-md-0 mb-3 order-1 order-md-1">
            <address class="text-light">
                <strong class="text-uppercase pantone">António N. Nóbrega II S.A.</strong>
                <hr>
                <span title="Morada" class="dropdown-icon" ><i class="fas fa-map-marker-alt fa-xs"></i></span>
                <span class="text-80"> Estrada do Aeroporto n° 39 </span>
                <br>
                <span title="Morada" class="dropdown-icon" ><i class="fas fa-map-signs fa-xs"></i></span>
                <span class="text-80">  9125-078 Caniço</span>
                <br>
                <span title="Morada" class="dropdown-icon" ><i class="fas fa-globe-europe fa-xs"></i></span>
                <span class="text-80"> Madeira-Portugal</span>
                <br>
                <span title="Telefone" class="dropdown-icon" ><i class="fas fa-phone fa-xs"></i></span><span class="text-80"><a href="tel:+351291934333" class="text-white"> (+351) 291 934 333</a></span><br>
                <span title="Email" class="dropdown-icon" ><i class="far fa-envelope fa-xs"></i></span><span class="text-80"><a href="mailto:geral@gruponobrega.pt" class="text-white"> geral@gruponobrega.pt</a></span>
            </address>  
        </div>
        <!-- Grid column -->
        <!--hr class="clearfix w-100 d-md-none pb-3 order-2 order-md-2"-->
        <!-- Grid column -->
        <!--div class="col-12 col-md-4 mt-md-0 mt-3 text-light order-3 order-md-3 footer-left">
            <span class="text-uppercase pantone"><strong>categorias</strong></span>
            <hr>
            @isset($client)
                <div class="footer-links">
                    <ul style="padding-left: 1.8em;list-style-type:square;">
                        <li><a href="/cliente/{{$client->alias}}/conta-corrente">C.Corrente</a></li>
                        <li><a href="/cliente/{{$client->alias}}/devolucoes">Devoluções</a></li>
                        <li><a href="/cliente/{{$client->alias}}/encomendas">Encomendas</a></li>
                        <li><a href="/catalogo">Catálogo</a></li>
                        <li><a href="/novidades">Novidades</a></li>
                    </ul>
                </div>
            @endisset
        </div-->
        <!-- Grid column -->
        <hr class="clearfix w-100 d-md-none pb-3 order-2 order-md-4">
        <!-- Grid column -->
        <div class="col-12 col-md-6 mb-md-0 mb-3 order-3 order-md-5">
            <address class="text-light">
                <strong class="text-uppercase pantone">Privacidade</strong>
                <hr>
                <a href="/faq" class="text-light text-privacy"><span class="text-80"> Perguntas Frequentes </span></a>
                <br>
                <a href="/politica-de-privacidade" class="text-light text-privacy"><span class="text-80"> Termos & Condições </span></a>
                <br>
                <a href="/politica-de-privacidade" class="text-light text-privacy"><span class="text-80"> Política de Privacidade</span></a>
                <br>
                <br>
            </address>
            <p><small class="text-light">&copy; Copyright <?php echo date('Y'); ?>, Grupo Nóbrega.</small></p>
        </div>
        <!-- Grid column -->
    </div>
    <!-- Grid row -->
    @else
        <!-- Grid row -->
        <div class="row">
            <!-- Grid column -->
            <div class="col-12 col-md-3 mb-md-0 mb-3 order-1 order-md-1  justify-content-center">
                <address class="text-light">
                    <strong class="text-uppercase pantone">Madeira Cash - Tendeira</strong>
                    <hr>
                    <span title="Morada" class="dropdown-icon" ><i class="fas fa-map-marker-alt fa-xs"></i></span>
                    <span class="text-80"> Estrada do Portinho nº 8 </span>
                    <br>
                    <span title="Morada" class="dropdown-icon" ><i class="fas fa-map-signs fa-xs"></i></span>
                    <span class="text-80">  9125-110 Caniço</span>
                    <br>
                    <span title="Morada" class="dropdown-icon" ><i class="fas fa-globe-europe fa-xs"></i></span>
                    <span class="text-80"> Madeira-Portugal</span>
                    <br>
                    <span title="Telefone" class="dropdown-icon" ><i class="fas fa-phone fa-xs"></i></span><span class="text-80"><a href="tel:+351291526839" class="text-white"> (+351) 291 526 839</a></span><br>
                    <span title="Email" class="dropdown-icon" ><i class="far fa-envelope fa-xs"></i></span><span class="text-80"><a href="mailto:geral.madeiracash@ann.com.pt" class="text-white"> geral.madeiracash@ann.com.pt</a></span>
                </address>  
            </div>
            <!-- Grid column -->
            <hr class="clearfix w-100 d-md-none pb-3 order-2 order-md-2">
            <div class="col-12 col-md-3 mb-md-0 mb-3 order-3 order-md-3 justify-content-center">
                <address class="text-light">
                    <strong class="text-uppercase pantone">Madeira Cash - Funchal</strong>
                    <hr>
                    <span title="Morada" class="dropdown-icon" ><i class="fas fa-map-marker-alt fa-xs"></i></span>
                    <span class="text-80"> Estrada de São João nº19B </span>
                    <br>
                    <span title="Morada" class="dropdown-icon" ><i class="fas fa-map-signs fa-xs"></i></span>
                    <span class="text-80">  9000-123 Funchal</span>
                    <br>
                    <span title="Morada" class="dropdown-icon" ><i class="fas fa-globe-europe fa-xs"></i></span>
                    <span class="text-80"> Madeira-Portugal</span>
                    <br>
                    <span title="Telefone" class="dropdown-icon" ><i class="fas fa-phone fa-xs"></i></span><span class="text-80"><a href="tel:+351291100330" class="text-white"> (+351) 291 100 330</a></span><br>
                    <span title="Email" class="dropdown-icon" ><i class="far fa-envelope fa-xs"></i></span><span class="text-80"><a href="mailto:alimentar.mc@gruponobrega.pt" class="text-white"> alimentar.mc@gruponobrega.pt</a></span>
                </address>  
            </div>
            <!-- Grid column -->
            <hr class="clearfix w-100 d-md-none pb-3 order-4 order-md-4">
            <div class="col-12 col-md-3 mb-md-0 mb-3 order-5 order-md-5 justify-content-center">
                <address class="text-light">
                    <strong class="text-uppercase pantone">Horário de Funcionamento</strong>
                    <hr>
                    <span title="Horário" class="dropdown-icon" ><i class="far fa-clock"></i></span>
                    <span class="text-80"> Segunda a Sexta : 08:00 às 20:00</span>
                    <br>
                    <span title="Morada" class="dropdown-icon" ><i class="far fa-clock"></i></span>
                    <span class="text-80">  Sábados: 08:00 às 20:00</span>
                    <br>
                </address>  
            </div>
            <!-- Grid column -->
            <hr class="clearfix w-100 d-md-none pb-3 order-6 order-md-6">
            <!-- Grid column -->
            <div class="col-12 col-md-3 mb-md-0 mb-3 order-7 order-md-7">
                <address class="text-light">
                    <strong class="text-uppercase pantone">Privacidade</strong>
                    <hr>
                    <a href="/faq" class="text-light text-privacy"><span class="text-80"> Perguntas Frequentes </span></a>
                    <br>
                    <a href="/politica-de-privacidade" class="text-light text-privacy"><span class="text-80"> Termos & Condições </span></a>
                    <br>
                    <a href="/politica-de-privacidade" class="text-light text-privacy"><span class="text-80"> Política de Privacidade</span></a>
                    <br>
                    <br>
                </address>
                <p><small class="text-light">&copy; Copyright <?php echo date('Y'); ?>, Madeira Cash.</small></p>
            </div>
        </div>
        <!-- Grid row -->
    @endif
</div>


