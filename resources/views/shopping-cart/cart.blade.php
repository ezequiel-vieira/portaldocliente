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
                        <h6 style="font-size: .8rem;">Se tiver dúvidas ou necessitar de ajuda, <a href="mailto:encomendas@gruponobrega.pt?Subject=Olá. Preciso de ajuda." target="_top">contacte-nos.</a></h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-5">
                    <span id="status"></span>
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th style="width:20%">Produto</th>
                            <th style="width:30%">Nome</th>
                            <th style="width:10%">Preço</th>
                            <th style="width:8%">Quantidade</th>
                            <th style="width:8%">Unidade</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                            <th style="width:10%"></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $total = 0 ?>

                        @if(session('cart'))
                            @foreach( session('cart') as $id => $details)

                                <?php 

                                if ($details['codigo'] === 'R030496003') {
                                    $details['price'] = '94.08';
                                    $details['unity'] = 'UN';
                                } elseif ($details['codigo'] === 'R030496004') {
                                    $details['price'] = '80.15';
                                    $details['unity'] = 'UN';
                                } else {
                                }
                                $total += $details['price'] * $details['quantity'];
                                ?>

                                <tr>
                                    <td data-th="Produto">
                                        <div class="row">
                                            <div class="col-sm-12 hidden-xs"><img src="{{ $details['photo'] }}" width="100" height="100" class="img-responsive"/></div>
                                        </div>
                                    </td>
                                    <td data-th="Nome">
                                        <h4 class="nomargin">{{ $details['name'] }}</h4>
                                    </td>
                                    <td data-th="Preço">€{{ $details['price'] }}</td>
                                    <td data-th="Quantity">
                                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" min="1"/>
                                    </td>
                                    <td data-th="Unidade">{{ $details['unity'] }}</td>
                                    <td data-th="Subtotal" class="text-center">
                                        €<span class="product-subtotal">
                                        <?php
                                        if ($details['codigo'] === 'R030496003') {
                                            echo $details['price'] * $details['quantity'];
                                        } elseif ($details['codigo'] === 'R030496004') {
                                            echo $details['price'] * $details['quantity'];
                                        } else {
                                            echo $details['price'] * $details['quantity'];
                                        }
                                        
                                        ?>
                                        </span>
                                    </td>
                                    <td class="actions" data-th="">
                                        <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fas fa-sync"></i></button>
                                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><!--i class="fa fa-trash-o"></i--><i class="fas fa-trash-alt"></i></button>
                                        <i class="fa fa-circle-o-notch fa-spin btn-loading" style="font-size:24px; display: none"></i>
                                    </td>
                                    <input class="form-control codigo_quantidade" type="hidden" name="material[{{$details['codigo']}}]" title="{{$details['codigo']}}" value="{{$details['quantity']}}">
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                        <tfoot>
                        <tr>
                            <td><a href="{{ url('/catalogo') }}" class="btn btn-warning"><!--i class="fa fa-angle-left"></i--><i class="fas fa-angle-left"></i> Continuar Compras</a></td>
                            <td colspan="4" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Total: €<span class="cart-total">{{ $total }}</span></strong></td>
                            <td></td>
                            <input type="hidden" id="valor_total" name="valor_total" value="{{ $total }}">
                        </tr>
                        </tfoot>
                    </table>
                    <div class="alert alert-danger" style="background: #f2f3f4;">
                      <strong><i class="far fa-bell"></i></strong>  Valor aproximado calculado pelo peso médio do artigo. O valor final será apresentado depois de pesada a mercadoria.
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <h5>CONTACTO DE ENVIO</h5>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label for="InputNome">Nome:</label>
                        <input type="text" class="form-control" id="InputNome" name="InputNome" aria-describedby="nomeHelp" placeholder="Introduza seu Nome" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                    </div>
                    <div class="form-group">
                        <label for="InputTelefone">Telefone / Telemóvel:</label>
                        <input type="tel" class="form-control" id="InputTelefone" name="InputTelefone" aria-describedby="telefoneHelp" placeholder="Introduza seu Número" pattern="[0-9]{9}" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                    </div>
                    <div class="form-group">
                        <label for="InputNif">NIF:</label>
                        <input type="tel" class="form-control" id="InputNif" name="InputNif" aria-describedby="nifHelp" placeholder="Introduza seu NIF" pattern="[0-9]{9}" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                    </div>
                    <div class="form-group">
                        <label for="InputEmail">Email</label>
                        <input type="email" class="form-control" id="InputEmail" name="InputEmail" aria-describedby="emailHelp" placeholder="Introduza Email" required>
                        <small id="emailHelp" class="form-text text-muted">O seu email será utilizado exclusivamente para enviar-lhe uma cópia da encomenda e um com a confirmação da mesma.</small>
                    </div>
                    <div class="form-group">
                        <label for="InputAddress">Morada</label>
                        <input type="text" class="form-control" id="InputAddress" name="InputAddress" placeholder=" Exemplo: Estrada do Aeroporto n° 39" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                          <label for="InputCidade">Cidade</label>
                          <input type="text" class="form-control" id="InputCidade" name="InputCidade" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="InputCodPostal">Cód. Postal</label>
                          <input type="text" class="form-control" id="InputCodPostal" name="InputCodPostal" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="userNote">Observação:</label>
                            <textarea class="form-control" id="userNote" name="userNote" rows="3" style="height: auto;"></textarea>
                            <small id="noteHelp" class="form-text text-muted">Adicione uma nota à encomenda.</small>
                        </div>
                    </div>
                    <button type="button" class="btn btn-block btn-success mt-4 mb-5" data-toggle='modal' data-target='#confirmSendEncomenda'>Encomendar</button>
                </div>
            </div>
        </div>
    </form>
    @include('modals.modal-encomenda')
@endsection

@section('footer_scripts')
    @include('scripts.save-encomenda-modal-script')
    <script type="text/javascript">

        $(".update-cart").click(function (e) {
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

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                    $("#header-bar").html(response.data);

                    product_subtotal.text(response.subTotal);

                    codigo_quantidade.val(response.quantidade);

                    cart_total.text(response.total);

                    valor_total.val(response.total);
 
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
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
