<script type="text/javascript">

	// CONFIRMATION SAVE MODEL
	$('#confirmPriceConsult').on('show.bs.modal', function (e) {
		var image 			= $(e.relatedTarget).attr('data-image');
		var title 			= $(e.relatedTarget).attr('data-title');
		var codigo 			= $(e.relatedTarget).attr('data-codigo');
		var vendedor 		= $(e.relatedTarget).attr('data-vendedor');
		var vendedor_mail 	= $(e.relatedTarget).attr('data-vend_mail');
		var form 			= $(e.relatedTarget).closest('form');

		//$(this).find('.modal-body img src').text(image);
		$("#material-modal-image").attr('src', image);
		$(this).find('.modal-body img title').text(title);
		$(this).find('.modal-title').text(title);
		$(this).find('.product_id').val(codigo);
		$(this).find('.product_name').val(title);
		$(this).find('.vend_name').val(vendedor);
		$(this).find('.vend_mail').val(vendedor_mail);
		$(this).find('.modal-footer #confirmPrice').data('form', form);
	});
	
	$('#confirmPriceConsult').find('.modal-footer #confirmPrice').on('click', function(){
		
	  	$('#formConsultPrice').submit();
	});

</script>
