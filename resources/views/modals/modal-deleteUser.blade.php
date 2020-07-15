<div class="modal fade modal-success modal-save" id="confirmDeleteUser" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5><span class="modal-title badge badge-info"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <form id="formDeleteUser" class="form-horizontal" role="form" method="POST" action="{{ route('deleteUserRole') }}">
                @csrf
                <div class="modal-body">
                    <div class="text-center">
                        <div class="alert alert-danger" role="alert">
                            Tem a certeza que deseja apagar este utilizador?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="deleteUser">Apagar</button>
                </div>
                <input type="hidden" class="modal-sap" name="sap_id" value="">
                <input type="hidden" class="modal-parent" name="parent_id" value="">
            </form>
        </div>
    </div>
</div>
