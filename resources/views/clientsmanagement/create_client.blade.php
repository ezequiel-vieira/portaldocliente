@extends('layouts.index')

@section('template_title')
    Novo Cliente
@endsection

@section('template_linked_css') 
<style type="text/css">
	.page-header{
		font-size: 34px;
	    font-weight: 900;
	    padding-bottom: 9px;
    	margin: 40px 0 40px;
    	border-bottom: 1px solid #eee;
	}

</style>
@endsection

@section('content')
<div class="container">
	<div class="page-header">
	   	<h1>Novo</h1>
	   	<small class="text-muted">Novo perfil de Cliente</small>
	</div>
</div>

<div class="container mt-3">
	<div class="row">
		<div class="col-md-6">
			<!-- Start of Card Deck Layout -->
			<div class="">
	            <form class="wrapper-wide form-horizontal needs-validation" class="form-inline" role="form" method="POST" action="/sendemail/sendNewClientMail" novalidate>
	            	{{ csrf_field() }}
	            	{{ method_field('POST') }}
            	  	<div class="form-group">
						<label for="InputGuestName">Nome Fiscal</label>
						<input type="text" class="form-control form-control-sm" id="InputGuestName" name="InputGuestName" aria-describedby="nomeHelp" placeholder="Nome Fiscal" required>
					</div>
                    <div class="form-group">
                        <label for="InputNIF">NIF</label>
                        <input type="text" class="form-control form-control-sm" id="InputNIF" name="InputNIF" aria-describedby="nifHelp" placeholder="Inserir NIF" required>
                    </div>
                    <div class="form-group">
                        <label for="InputTelefone">Telefone</label>
                        <input type="text" class="form-control form-control-sm" id="InputTelefone" name="InputTelefone" aria-describedby="telefoneHelp" placeholder="Inserir Telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="InputTelemovel">Telemóvel</label>
                        <input type="text" class="form-control form-control-sm" id="InputTelemovel" name="InputTelemovel" aria-describedby="telemovelHelp" placeholder="Inserir Telemovel">
                    </div>
                    <div class="form-group">
                        <label for="InputGuestEmail">Email</label>
                        <input type="email" class="form-control form-control-sm" id="InputGuestEmail" name="InputGuestEmail" aria-describedby="emailHelp" placeholder="Inserir Email" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupMoradaFiscal">Morada Fiscal</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupMoradaFiscal" placeholder="Morada Fiscal" name="InputMoradaFiscal" required>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="InputReceptorName">Nome Receptor</label>
                        <input type="text" class="form-control form-control-sm" id="InputReceptorName" name="InputReceptorName" aria-describedby="nomeHelp" placeholder="Nome Receptor" required>
                    </div>
                    <div class="form-group">
                        <label for="InputReceptorTelefone">Telefone Receptor</label>
                        <input type="text" class="form-control form-control-sm" id="InputReceptorTelefone" name="InputReceptorTelefone" aria-describedby="telefoneReceptorHelp" placeholder="Telefone Receptor" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupMoradaFiscalReceptor">Morada Receptor Mercadoria</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupMoradaFiscalReceptor" placeholder="Morada Receptor Mercadoria" name="InputMoradaFiscalReceptor" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupContatoResponsavel">Contato/Responsável</label>
                        <input type="text" class="form-control form-control-sm" id="formGroupContatoResponsavel" placeholder="Contato/Responsável" name="InputContatoResponsavel" required>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="InputCPagamento">Condições de Pagamento</label>
                        <input type="text" class="form-control form-control-sm" id="InputCPagamento" name="InputCPagamento" aria-describedby="cpagamentoHelp" placeholder="Condições de Pagamento" required>
                    </div>
                    <div class="form-group">
                        <label for="InputMPagamento">Método de Pagamento:</label>
                    </div>
                    <div class="form-group">
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="InputMPagamento" value="cheque" checked>Cheque
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="InputMPagamento" value="numerario">Numerário
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="InputMPagamento" value="transf_bancaria">Transf. Bancária
                          </label>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <button type="submit" class="btn btn-info btn-block"> Enviar  </button>
                    </div>                                                                 
	            </form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer_scripts')
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    form.addEventListener('submit', function(event) {
    if (form.checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.classList.add('was-validated');
    }, false);
    });
    }, false);
})();
</script>
@endsection
