<script type="text/javascript">
	// CONFIRMATION SAVE MODEL
	$('#confirmAddUser').on('show.bs.modal', function (e) 
	{
		var title = $(e.relatedTarget).attr('data-title');
		var sap_id = $(e.relatedTarget).attr('data-sap');
		var parent_id = $(e.relatedTarget).attr('data-parent');
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-title').text(title);
		$(this).find('.modal-sap').val(sap_id);
		$(this).find('.modal-parent').val(parent_id);
		$(this).find('.modal-footer #confirmUser').data('form', form);
	});
	
	$('#confirmAddUser').find('.modal-footer #confirmUser').on('click', function()
	{
	  	$("#formNewUser").submit();
	});

</script>


