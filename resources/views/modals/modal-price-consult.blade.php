<div class="modal fade modal-danger" id="confirmPriceConsult" role="dialog" aria-labelledby="confirmPriceConsult" aria-hidden="true" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">
          Consultar Preço
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">close</span>
        </button>
      </div>
      <form id="formConsultPrice" class="form-horizontal" role="form" method="POST" action="{{ route('consultPriceModal') }}">
        {{ csrf_field() }}
        <!--Body-->
        <div class="modal-body text-center">
          <div class="row">
            <div class="col-12">
              <img src="" title="" class="img-fluid" alt="" id="material-modal-image">
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-12">
              <p><strong>Pretende solicitar a cotação deste artigo?</strong></p>
              <small class="text-muted"> <i class="fas fa-info-circle text-primary"></i> Brevemente irá receber um contato de seu vendedor com a cotação solicitada.</small>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col-12">
              <button type="button" class="btn btn-block btn-success" id="confirmPrice">Confirmar</button>
              <input type="hidden" class="product_name" name="product_name" value="">
              <input type="hidden" class="product_id"   name="product_id"   value="">
              <input type="hidden" class="vend_name"    name="vend_name"    value="">
              <input type="hidden" class="vend_mail"    name="vend_mail"    value="">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
