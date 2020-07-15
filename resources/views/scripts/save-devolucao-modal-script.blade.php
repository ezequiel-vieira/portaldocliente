<script type="text/javascript">
	// CONFIRMATION SAVE MODEL
	$('#confirmSendRefund').on('show.bs.modal', function (e) 
	{
		var title = $(e.relatedTarget).attr('data-title');
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-title').text(title);
		$(this).find('.modal-footer #confirmRefund').data('form', form);
	});
	
	$('#confirmSendRefund').find('.modal-footer #confirmRefund').on('click', function()
	{
	  	//console.log('send form');
	  	//$(this).data('form').submit();
	  	$(".form-refund").submit();
	});

</script>


