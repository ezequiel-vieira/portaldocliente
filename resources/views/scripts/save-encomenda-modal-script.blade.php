<script type="text/javascript">
	// CONFIRMATION SAVE MODEL
	$('#confirmSendEncomenda').on('show.bs.modal', function (e) 
	{
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-footer #confirmEncomenda').data('form', form);
	});
	
	$('#confirmSendEncomenda').find('.modal-footer #confirmEncomenda').on('click', function()
	{
	  	//$(this).addClass("disabled");
	  	document.getElementById("confirmEncomenda").disabled = true;
	  	$(".form-encomenda").submit();
	});

</script>


