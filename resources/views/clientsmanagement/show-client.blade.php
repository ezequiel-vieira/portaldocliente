@extends('layouts.index')

@section('template_title')
    Área de Cliente
@endsection

@section('template_linked_css') 
<style type="text/css">
.form-control:disabled, .form-control[readonly] {
    background-color: #e9ecef !important;
    opacity: 1;
    cursor: not-allowed;
}
.client-tabs-content span.input-group-text {
    width: 40px;
}
</style>
@endsection

@section('template_breadcrumbs')
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb rounded-0">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home pr-1"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Área de Cliente</li>
      </ol>
    </nav>
  </div>
@endsection

@section('content')
<div class="container">
	<div class="page-header">
        <h1>CLIENTE</h1>
        <small class="text-muted">Detalhes e Privacidade</small>
    </div>
    @if($user->hot_news === 0)
        <div class="row form-row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="shadow-sm alert alert-light alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading"> Novidades </h4>
                    <small class="text-muted">Sempre que houver artigos novos, enviaremos-lhe um email dando conta dessas novidades. </small>
                    <hr>
                    <button class="btn btn-block btn-sm btn-success btn-outline-white my-0 btn-hotnews" data-hot_news="{{$user->hot_news}}" type="button">Receber Novidades</button>
                </div>
            </div>
        </div>
    @endif
    @if($user->hot_news === 1)
        <div class="row form-row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="shadow-sm alert alert-light alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading"> Novidades </h4>
                    <small class="text-muted">Caso não queira continuar a receber um email sempre que houver novidades, clique no botão abaixo: </small>
                    <hr>
                    <button id="btn-newsletter" class="btn btn-block btn-sm btn-danger btn-outline-white my-0 btn-hotnews" data-hot_news="{{$user->hot_news}}" type="button">Não Receber</button>
                </div>
            </div>
        </div>
    @endif
    @if($user->newsletter === 0)
        <div class="row form-row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="shadow-sm alert alert-light alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading"> Newsletter </h4>
                    <small class="text-muted">Assine nossa newsletter para receber mensalmente todas as nossas Novidades. </small>
                    <hr>
                    <button id="btn-newsletter" class="btn btn-block btn-sm btn-success btn-outline-white my-0 btn-newsletter" data-status="{{$user->newsletter}}" type="button">Assinar Newsletter</button>
                </div>
            </div>
        </div>
    @endif
    @if($user->newsletter === 1)
        <div class="row form-row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="shadow-sm alert alert-light alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading"> Newsletter </h4>
                    <small class="text-muted">Caso não queira continuar a receber mensalmente a nossa newsletter com todas as nossas Novidades, clique no botão abaixo: </small>
                    <hr>
                    <button id="btn-newsletter" class="btn btn-block btn-sm btn-danger btn-outline-white my-0 btn-newsletter" data-status="{{$user->newsletter}}" type="button">Remover Newsletter</button>
                </div>
            </div>
        </div>
    @endif
	<ul class="nav nav-tabs client-tabs" id="client-tabs" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" id="geral-tab" data-toggle="tab" href="#geral" role="tab" aria-controls="geral" aria-selected="true">Geral</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="email-tab" data-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="false">Senha&Email</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Sugestão</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="politics-tab" data-toggle="tab" href="#politics" role="tab" aria-controls="politics" aria-selected="false">Políticas</a>
	  </li>
	</ul>
	<div class="tab-content client-tabs-content" id="client-tabs-content">
		<div class="tab-pane fade show active" id="geral" role="tabpanel" aria-labelledby="geral-tab">
			<h2>Detalhes</h2>
			<div class="wrapper-wide my-3 bg-white rounded">
				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-user" title="Nome"></i></span>
					</div>
			        <input title="Nome" class="form-control not-allowed" placeholder="Nome Completo" type="text" value="{{$cliente->name}}" disabled>
			    </div>
				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-home" title="Morada"></i> </span>
					</div>
			        <input name="" class="form-control" placeholder="Morada" type="text" title="Morada" value="{{$cliente->morada}}" disabled>
			    </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-map-marked-alt" title="Cód. Postal"></i></span>
                    </div>
                    <input name="" class="form-control not-allowed" placeholder="Cód. Postal" title="Cód. Postal" type="text" value="{{$cliente->cod_postal.' '.$cliente->localidade}}" disabled>
                </div>
			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-phone" title="Telefone"></i> </span>
					</div>
			        <input name="" class="form-control" placeholder="Telefone" title="Telefone" type="text" value="{{$cliente->telefone}}" disabled>
			    </div>
			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fas fa-mobile-alt" title="Telemovel"></i> </span>
					</div>
			        <input name="" class="form-control" placeholder="Telemóvel" title="Telemovel" type="text" value="{{$cliente->telemovel}}" disabled>
			    </div>
			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-envelope" title="Email"></i> </span>
					</div>
			        <input name="" class="form-control not-allowed" placeholder="Email" title="Email" type="email" value="{{$cliente->email1}}" disabled>
			    </div>
			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fas fa-calculator" title="NIF"></i> </span>
					 </div>
			        <input name="" class="form-control not-allowed" placeholder="NIF" title="NIF" type="text" value="{{$cliente->nif}}" disabled>
			    </div>   
			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fas fa-id-card" title="Nº Cliente"></i> </span>
					</div>
			        <input name="" class="form-control" placeholder="Nº Cliente" title="Nº Cliente" type="text" value="{{$cliente->id_sap}}" disabled>
			    </div>
			</div>
		    <hr>
            <form class="wrapper-wide form-horizontal" method="POST"action="{{url('sendemail/sendChangePerfilMail')}}">
                <h2>Editar Perfil</h2>
                {{ csrf_field() }}
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-home" title="Morada"></i> </span>
                    </div>
                    <input name="morada" class="form-control" placeholder="{{$cliente->morada}}" type="text" title="Morada">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-map-marker-alt" title="Cód. Postal"></i> </span>
                    </div>
                    <input name="cod_postal" class="form-control not-allowed" placeholder="{{$cliente->cod_postal}}" title="Cód. Postal" type="text">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-map-marked-alt" title="Localidade"></i> </span>
                    </div>
                    <input name="localidade" class="form-control not-allowed" placeholder="{{$cliente->localidade}}" title="Localidade" type="text">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone" title="Telefone"></i> </span>
                    </div>
                    <input name="telefone" class="form-control" placeholder="{{$cliente->telefone}}" title="Telefone" type="text">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-mobile-alt" title="Telemovel"></i> </span>
                    </div>
                    <input name="telemovel" class="form-control" placeholder="{{$cliente->telemovel}}" title="Telemovel" type="text">
                </div>    
                <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block"> Enviar alterações  </button>
                </div>                                                                 
            </form>
            @if($user->type === 'default')
                <hr> 
    		    <h2>Representante de vendas</h2>
    		    <div class="my-3 p-3 bg-white rounded shadow-sm">
    			    <div class="media">
                        <a data-fancybox="vendedor" href="{{$cliente->vendedor_foto}}" title="{{$cliente->vendedor_nome}}" data-caption="{{$cliente->vendedor_nome}}">
                            <img width="110" height="94" class="img-thumbnail align-self-start mr-3 shadow" alt="{{$cliente->vendedor_nome}}" src="{{$cliente->vendedor_foto}}">
                        </a>
    					<div class="media-body" style="border-left: 1px solid #b2b2b2; padding-left: 10px;">
    						<h5 class="mt-0"  style="margin-bottom: 1rem;">{{$cliente->vendedor_nome}}</h5>
    						<p style="margin-bottom: 0.2rem;"><i class="fas fa-mobile-alt fa-sm"></i><span><a href="tel:+351{{$cliente->vendedor_telef}}" class="text-dark"> (+351) {{$cliente->vendedor_telef}}</a></span></p>
    						<p><i class="far fa-envelope fa-sm"></i><span> <a href="mailto:{{$cliente->vendedor_email}}" class="text-dark">{{$cliente->vendedor_email}}</a> </span></p> 
    					</div>
    				</div>
    			</div>
    			<hr>
            @endif
		</div>
		<div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
			@if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Erro</strong> {{ session('error') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Sucesso</strong> {{ session('success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
            @endif
			<p class="mb-30"><h2>Senha</h2></p>
            <form class="wrapper-wide form-horizontal" method="POST" action="{{ route('changePassword') }}">
                {{ csrf_field() }}
				<div class="form-group input-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fab fa-keycdn"></i> </span>
					 </div>
			        <input id="current-password" type="password" class="form-control" name="current-password" placeholder="Password Atual" required>
			        @if ($errors->has('current-password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('current-password') }}</strong>
                    </span>
                    @endif
			    </div>
				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fas fa-key"></i> </span>
					 </div>
			        <input id="new-password" type="password" class="form-control" name="new-password" placeholder="Nova Password" required>
			        @if ($errors->has('new-password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('new-password') }}</strong>
                    </span>
                    @endif
			    </div>
			    <div class="form-group input-group">
			    	<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fas fa-key"></i> </span>
					 </div>
			        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" placeholder="Confirmar Nova Password" required>
			    </div>
			    <div class="form-group">
			        <button type="submit" class="btn btn-info btn-block"> Gravar alterações  </button>
			    </div>
             </form>
			<hr>
			<p class="mb-30"><h2>Email</h2></p>
			<form class="wrapper-wide form-horizontal" method="POST"action="{{url('sendemail/sendChangeEmailMail')}}">
                {{ csrf_field() }}
				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
					 </div>
			        <input name="email_novo" class="form-control" placeholder="Novo Email" type="text" required>
			    </div>
				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
					 </div>
			        <input name="email_novo_2" class="form-control" placeholder="Confirmar Novo Email" type="text" required>
			    </div>     
			    <div class="form-group">
			        <button type="submit" class="btn btn-info btn-block"> Enviar alterações  </button>
			    </div>                                                                 
			</form>
			<hr>
		</div>
        @if($user->type === 'default')
		<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">				
			<p class="mb-30">
				<h2>Inquérito de Assiduidade</h2> 
				<small> Quando foi a última vez que contatou pessoalmente o nosso vendedor?</small>
			</p> 
			<form class="wrapper-wide" method="post" action="{{url('sendemail/sendQuestionMail')}}">
				{{ csrf_field() }}
				<div class="form-group form-check-inline col-sm-12">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="question_opt" value="Hoje">Hoje
					</label>
				</div>
				<div class="form-group form-check-inline col-sm-12">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="question_opt" value="Esta Semana">Esta Semana
					</label>
				</div>
				<div class="form-group form-check-inline col-sm-12">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="question_opt" value="Este Mês">Este Mês
					</label>
				</div>
				<div class="form-group form-check-inline col-sm-12">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="question_opt" value="Não me lembro.">Não me lembro. 
					</label>
				</div>
				<div class="form-group form-check-inline col-sm-12">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="question_opt" value="Nunca o vi. Tenho mesmo um vendedor?">Nunca o vi. Tenho mesmo um vendedor?
					</label>
				</div>
				<div class="form-group">
				    <button type="submit" class="btn btn-info btn-block"> Enviar Mensagem  </button>
				</div> 
			</form>
			<hr>
			<p class="mb-30">
				<h2>Sugestão</h2>
				<small>Coloque uma pergunte ou partilhe uma ideia</small>
			</p>
		   	<form class="wrapper-wide" method="post" action="{{url('sendemail/send')}}">
				{{ csrf_field() }}
				<div class="input-group mb-3">
				  	<div class="input-group-prepend">
				    	<label class="input-group-text" for="select"><i class="fas fa-mail-bulk"></i></label>
					</div>
					<select name="select_assunto" class="custom-select" id="select_assunto">
						<option selected>Selecione um tema</option>
						<option value="Sugestão/Pedido de informação">Sugestão/Pedido de informação</option>
						<option value="Pedido de informação sobre um produto">Pedido de informação sobre um produto</option>
						<option value="Questões sobre a minha encomenda">Questões sobre a minha encomenda</option>
						<option value="Outras informações">Outras informações</option>
					</select>
				</div>
				<div class="form-group input-group">
					<div class="input-group-prepend">
					    <span class="input-group-text"> <i class="fas fa-user-circle"></i> </span>
					 </div>
			        <input type="text" name="name" placeholder="Nome" class="form-control" value="" required/>
			    </div>
			    <div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="far fa-comment-alt"></i></span>
					</div>
					<textarea class="form-control" rows="5" id="comment" name="message" placeholder="Seja o mais preciso possível na sua sugestão, para que o possamos compreender ou ajudar da melhor forma." required></textarea>
				</div>
			    <div class="input-group mt-3">
			        <button type="submit" class="btn btn-info btn-block">Enviar Mensagem</button>
			    </div>                                                                 
			</form>
			<hr>
		</div>
        @endif
		<div class="tab-pane fade" id="politics" role="tabpanel" aria-labelledby="politics-tab">
			<p class="mb-30">
				<h2>Políticas</h2>
				Na Nóbrega, acreditamos que você deve sempre saber quais dados coletamos de você e como os usamos, e que você deve possuir um controle significativo sobre ambos. 
				Encontre abaixo links para nossos Termos de Serviço e Política de Privacidade.
			</p>	
			<hr>
			<!--div class="media">
				<i class="fas fa-user-shield fa-2x mr-3 pantone"></i>
			  	<div class="media-body">
			    	<h5 class="mt-0">Política de Privacidade</h5>
			    	Nós não vendemos, trocamos, ou fornecemos qualquer informação pessoal identificável para outro time ou organização. Nós iremos atualizar essa política. Vamos notificar você sobre as mudanças significantes no modo como tratamos informações pessoais enviando essas informações para o primeiro email especificado em sua conta ou colocando uma notícia saliente em nosso site. 
			    	<a target="_blank" href="/politica-de-privacidade">Leia na íntegra</a>
			  	</div>
			</div>
			<hr>
			<div class="media">
				<i class="fas fa-user-check fa-2x mr-3 pantone"></i>
			  	<div class="media-body">
			    	<h5 class="mt-0">Termos de Serviço</h5>
			    	Quando se cadastrou para nosso(s) produto(s), você concordou com nossos Termos de Serviço. Eles funcionam como um contrato entre a Nóbrega e você, ditando o que você pode fazer com nossos serviços e, consequentemente, qual é nossa responsabilidade para com você. 
			    	<a target="_blank" href="/termos-e-condicoes">Leia na íntegra</a>
			  	</div>
			</div>
			<hr>
			<div class="media">
				<i class="fas fa-exclamation-triangle fa-2x mr-3 text-warning"></i>
			  	<div class="media-body">
			    	<h5 class="mt-0">Contacte-nos</h5>
			    	Se você tiver alguma dúvida sobre nossas políticas, <a target="_blank" href="javascript:">entre em contato connosco.</a>
			  	</div>
			</div-->
		</div>
	</div>
</div>
@endsection
@section('footer_scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-newsletter').click(function(e) 
        {
            e.preventDefault();

            var newsletterStatus = $(this).data("status");

            //console.log(newsletterStatus);

            //return false;

            $.ajax({
               type:'POST',
               url:'/newsletterRequest2',
               data: {
                "_token": "{{ csrf_token() }}",
                "element": newsletterStatus
                },
                success: function(result)
                {
                    console.log(result);
                    location.reload();
                }
            });
        });
        $('.btn-hotnews').click(function(e) 
        {
            e.preventDefault();

            var hotNewsStatus = $(this).data("hot_news");

            console.log(hotNewsStatus);

            $.ajax({
               type:'POST',
               url:'/hotNewsRequest',
               data: {
                "_token": "{{ csrf_token() }}",
                "element": hotNewsStatus
                },
                success: function(result)
                {
                    console.log(result);
                    location.reload();
                }
            });
        });
    </script>
@endsection
