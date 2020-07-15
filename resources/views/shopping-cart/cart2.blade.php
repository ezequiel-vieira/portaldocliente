@extends('layouts.index')

@section('template_title')
    Carrinho
@endsection

@section('template_linked_css')
    <style type="text/css">
        .page-header {
            margin: 40px 0 0px;
        }
    </style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item"><a href="/catalogo">Catálogo</a></li>
        <li class="breadcrumb-item active" aria-current="page">Carrinho</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
    <form class="form-encomenda wrapper-wide form-horizontal was-validated" method="POST" action="{{ url('/cliente/encomenda/') }}">
        {{csrf_field()}}
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div id="fixed1" class="page-header pt-3">
                        <h1 class="d-inline-block align-middle">As suas Compras:</h1> 
                        <h6 style="font-size: .8rem;">Se tiver dúvidas ou necessitar de ajuda, <a href="/faq">contacte-nos.</a></h6>
                    </div>
                </div>
            </div>
            <?php
                /*var_dump(session('cart2'));*/
            ?>
            <div class="row">
                <div class="col-md-12 mt-5">
                    <span id="status"></span>
                    <div class="table-responsive">
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>UMB</th>
                                <th>Peso</th>
                                <th>IVA</th>
                                <th style="width: 10%">Quantidade</th>
                                <!--th>Unidade</th-->
                                <th class="text-center">Subtotal</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $total = 0 ?>

                            @if(session('cart2'))
                                @foreach( session('cart2') as $id => $details)

                                    <?php 

                                        switch ($details['tax']) {
                                            case '0':
                                                $details['iva'] = '1';
                                                break;
                                            case '22':
                                                $details['iva'] = '1.22';
                                                break;
                                            case '12':
                                                $details['iva'] = '1.12';
                                                break;
                                            case '5':
                                                $details['iva'] = '1.05';
                                                break;               
                                            default:
                                                $details['iva'] = '1';
                                                break;
                                        }

                                        $total += ( $details['price'] * $details['iva'] ) * $details['quantity']; 

                                        $total = round($total , 2);

                                        $details['peso_venda'] = (empty($details['peso_venda']) ? '1.0' : $details['peso_venda']);
                                    ?>

                                    <tr>
                                        <td data-th="Produto"><img src="{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></td>
                                        <td data-th="Nome"><h6 class="nomargin" style="font-size: 0.8rem;">{{ $details['name'] }}</h6></td>
                                        <td data-th="Preço">€{{ $details['price'] }}</td>
                                        <td data-th="UMB">{{ $details['unity'] }}</td>
                                        <td data-th="UMB">{{ $details['quantity'] * $details['peso_venda'] }} KG</td>
                                        <td data-th="IVA">{{ $details['tax'] }}%</td>
                                        <td data-th="Quantidade">
                                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" min="1"/>
                                        </td>
                                        <!--td data-th="Unidade">UN</td-->
                                        <td data-th="Subtotal" class="text-center">€<span class="product-subtotal">{{ round(( $details['price'] * $details['iva'] ) * $details['quantity'] , 2) }}</span></td>
                                        <td class="actions" data-th="">
                                            <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fas fa-sync"></i></button>
                                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fas fa-trash-alt"></i></button>
                                            <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                                        </td>
                                        <input class="form-control codigo_quantidade" type="hidden" name="material[{{$details['codigo']}}]" title="{{$details['codigo']}}" value="{{$details['quantity']}}">
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                            <tfoot>
                            <tr style="background: #EEE;">
                                <td colspan="2"><a href="{{ url('/catalogo') }}" class="btn btn-warning"><i class="fas fa-angle-left"></i> Continuar Compras</a></td>
                                <td colspan="5" class="hidden-xs"></td>
                                <td class="hidden-xs text-center" style="font-size: 20px;"><strong>Total:<span class="cart-total">{{ $total }}</span>€</strong></td>
                                <td></td>
                                <input type="hidden" id="valor_total" name="valor_total" value="{{ $total }}">
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="alert alert-danger" style="background: #f2f3f4;">
                      <strong><i class="far fa-bell"></i></strong> Atenção: O valor mínimo de encomenda é de 45,00€. Encomendas abaixo deste valor será cobrada uma taxa de entrega de 10,00€.
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <h5>DADOS DE ENVIO</h5>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3">
                    @if ($user['type'] === 'default' || $user['type'] === 'clionline')
                        <input type="hidden" name="user_type" id="registered_type" value="registered_type">
                    @endif
                    <?php if($user['type'] != 'default' && $user['type'] != 'clionline') { ?>
                        <div class="form-group">
                            <label for="InputNome">Nome Completo:</label>
                            <input type="text" class="form-control " id="InputNome" name="InputNome" aria-describedby="nomeHelp" placeholder="Introduza seu Nome Completo" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                        <div class="form-group">
                            <label for="InputTelefone">Telefone / Telemóvel:</label>
                            <input type="tel" class="form-control " id="InputTelefone" name="InputTelefone" aria-describedby="telefoneHelp" placeholder="Introduza seu Número" pattern="[0-9]{9}" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                        <div class="form-group">
                            <label for="InputNif">NIF:</label>
                            <input type="tel" class="form-control " id="InputNif" name="InputNif" aria-describedby="nifHelp" placeholder="Introduza seu NIF" pattern="[0-9]{9}" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                        <div class="form-group">
                            <label for="InputEmail">Email</label>
                            <input type="email" class="form-control " id="InputEmail" name="InputEmail" aria-describedby="emailHelp" placeholder="Introduza Email" required>
                            <small id="emailHelp" class="form-text text-muted">O seu email será utilizado exclusivamente para enviarmos-lhe um resumo da encomenda e um email com a confirmação da mesma.</small>
                        </div>
                        <div class="form-group">
                            <label for="InputAddress">Morada</label>
                            <input type="text" class="form-control " id="InputAddress" name="InputAddress" placeholder=" Exemplo: Estrada do Aeroporto n° 39" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="concelhoFormControlSelect">Concelho</label>
                                <select class="form-control" id="concelhoFormControlSelect" name="concelho">
                                  <option value="funchal">Funchal</option>
                                  <option value="santa_cruz">Santa Cruz</option>
                                  <option value="machico">Machico</option>
                                  <option value="santana">Santana</option>
                                  <option value="camara_lobos">Câmara de Lobos</option>
                                  <option value="ribeira_brava">Ribeira Brava</option>
                                  <option value="ponta_sol">Ponta de Sol</option>
                                  <option value="porto_moniz">Porto Moniz</option>
                                  <option value="sao_vicente">São Vicente</option>
                                  <option value="calheta">Calheta</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="InputCodPostal">Cód. Postal</label>
                              <input type="text" class="form-control " id="InputCodPostal" name="InputCodPostal" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Por favor, preencha este campo.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="InputPrevisaoEntrega">Dia de Entrega</label>
                            <div class="alert alert-info" role="alert">
                              <span id="InputPrevisaoEntrega" value=""></span>
                              <input type="hidden" name="order-date" id="order-date">
                            </div>
                        </div>
                    <?php } ?>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="userNote">Observação:</label>
                            <textarea class="form-control" id="userNote" name="userNote" rows="3"></textarea>
                            <small id="userNoteHelp" class="form-text text-muted">Adicione uma nota à encomenda com alguma especificação ou indicação que nos ajude a encontrar o local de entrega.</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-block btn-success mt-4 mb-5" data-toggle='modal' data-target='#confirmSendEncomenda'>Validar Encomenda</button>
                </div>
            </div>
        </div>
    </form>
    @include('modals.modal-encomenda')
@endsection

@section('footer_scripts')
    <!-- Start of  Zendesk Widget script -->
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=8c2a3f10-72ad-40bf-ae67-8da6923471cf"> </script>
    <!-- End of  Zendesk Widget script -->
    @include('scripts.save-encomenda-modal-script')
    <script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
    <script>
        var currentDate = moment();
        var current_day = moment().format();
        var weekStart = currentDate.clone().startOf('isoWeek');
        var weekEnd = currentDate.clone().endOf('week');
        var days = [];
        for (i = 0; i <= 13; i++) {
           days.push(moment(weekStart).add(i, 'days').format());
        };
    </script>
    <script type="text/javascript">

        $(document).ready(function()
        {
            var moment_days_allowed = [days[0], days[1], days[2], days[3],days[4], days[7], days[8], days[9], days[10],days[11]];
            getNextDayAllowed(moment_days_allowed, current_day);
        });

        $("#concelhoFormControlSelect").change(function () 
        {
            var concelho = this.value;
            
            if (concelho === 'funchal' || concelho === 'santa_cruz') 
            {
                var moment_days_allowed = [days[0], days[1], days[2], days[3],days[4], days[7], days[8], days[9], days[10],days[11]];
                getNextDayAllowed(moment_days_allowed, current_day);
            }
            if (concelho === 'machico' || concelho === 'santana' || concelho === 'camara_lobos' || concelho === 'ribeira_brava' || concelho === 'ponta_sol') 
            {
                var moment_days_allowed = [days[1], days[3], days[8], days[10]];
                getNextDayAllowed(moment_days_allowed, current_day);
            }
            if (concelho === 'porto_moniz' || concelho === 'sao_vicente' || concelho === 'calheta') 
            {
                var moment_days_allowed = [days[2], days[4], days[9], days[11]];
                getNextDayAllowed(moment_days_allowed, current_day);
            }
        });

        function getNextDayAllowed(moment_days_allowed, current_day){
            var next_day;
            var i;
            var len = moment_days_allowed.length;
            for (i = 0; i < len; i++) {
                var next_day = getNextDayTemp(moment_days_allowed, current_day);
                var format = moment(next_day).locale('pt').format("dddd, D [de] MMMM");
                $("#InputPrevisaoEntrega").text(format);
                $("#order-date").val(format);
                break;
            }
        }
        function getNextDayTemp(moment_days_allowed, current_day){
            var i;
            var len = moment_days_allowed.length;
            for (i = 0; i < len; i++) {
                if (moment(current_day).isAfter(moment_days_allowed[i])) {
                } else {
                    var nextValidDay = moment_days_allowed[i];
                    break;
                }
            }
            return nextValidDay;
        }
        /*function getNextDayAllowed(day, days_allowed, concelho, day, moment_days_allowed, current_day){
            var all_days_allowed = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
            var next_day;
            var i;
            var len = days_allowed.length;
            for (i = 0; i < len; i++) {
                if (days_allowed[i] === day) {
                    next_day = days_allowed[(i+1)%len];
                    $("#InputPrevisaoEntrega").val('Proximo dia de entrega: ' + next_day);
                    break;
                }else{
                    var next_day = getNextDayTemp(all_days_allowed, day, days_allowed, moment_days_allowed, current_day);
                    var format = moment(next_day).locale('pt').format("dddd, MMMM Do YYYY");
                    $("#InputPrevisaoEntrega").val(format);
                    break;
                }
            }
        }*/
        /*var curday = function(sp){
            today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //As January is 0.
            var yyyy = today.getFullYear();

            if(dd<10) dd='0'+dd;
            if(mm<10) mm='0'+mm;
            return (mm+sp+dd+sp+yyyy);
        };*/
        /*function getDayName(dateStr, locale)
        {
            var date = new Date(dateStr);
            return date.toLocaleDateString(locale, { weekday: 'long' });        
        }*/
        //var days_allowed = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
        //var day = getDayName(curday('/'), "en-EN");
    </script>
    <!-- UPDATE CART -->
    <script type="text/javascript">

        $(".update-cart").click(function (e) 
        {
            e.preventDefault();

            var ele = $(this);

            var parent_row = ele.parents("tr");

            var quantity = parent_row.find(".quantity").val(); 

            var codigo_quantidade = parent_row.find("input.codigo_quantidade");

            var product_subtotal = parent_row.find("span.product-subtotal");

            var cart_total = $(".cart-total");

            var valor_total = $("#valor_total");

            var loading = parent_row.find(".btn-loading");

            loading.show();

            $.ajax({
                url: '{{ url('update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: quantity},
                dataType: "json",
                success: function (response) {

                    loading.hide();

                    $("span#status").html('<div class="alert alert-success alert-dismissable fade show" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><h4><i class="icon fa fa-check fa-fw" aria-hidden="true"></i> Success</h4>'+response.msg+'</div>');
        
                    $("#header-bar").html(response.data);

                    product_subtotal.text(response.subTotal);

                    codigo_quantidade.val(response.quantidade);

                    cart_total.text(response.total);

                    valor_total.val(response.total);
 
                }
            });
        });

        $(".remove-from-cart").click(function (e) 
        {
            e.preventDefault();

            var ele = $(this);

            var parent_row = ele.parents("tr");

            var cart_total = $(".cart-total");

            var valor_total = $("#valor_total");

            if(confirm("Tem a certeza que deseja apagar este produto?")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    dataType: "json",
                    success: function (response) {

                        parent_row.remove();

                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                        $("#header-bar").html(response.data);

                        cart_total.text(response.total);

                        valor_total.val(response.total);
                    }
                });
            }
        });
    </script>
@endsection
