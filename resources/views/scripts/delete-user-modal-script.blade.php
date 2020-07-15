<script type="text/javascript">
	// CONFIRMATION SAVE MODEL
	$('#confirmDeleteUser').on('show.bs.modal', function (e) 
	{
		var title = $(e.relatedTarget).attr('data-title');
		var sap_id = $(e.relatedTarget).attr('data-sap');
		var parent_id = $(e.relatedTarget).attr('data-parent');
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-title').text(title);
		$(this).find('.modal-sap').val(sap_id);
		$(this).find('.modal-parent').val(parent_id);
		$(this).find('.modal-footer #deleteUser').data('form', form);
	});
	
	$('#confirmDeleteUser').find('.modal-footer #deleteUser').on('click', function()
	{
	  	$("#formDeleteUser").submit();
	});

</script>


