<div id="permiso_modal" class="modal fade bd-example-modal-sm" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <h4 class="modal-title" id="myModalLabel">Solicitar cambio de status</h4>
                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('order.permiso') }}" id="form-permido" method="post">

                <div class="modal-body">
                    @csrf
                    <div class="col-12 p-3" align="center">
                        <h5>{{ 'Solicitar el cambio de estatus del pedido número' }}</h5>
                        <b><span id="no_pedido"></span></b>
                        <input type="hidden" name="pedido" id="pedido">
                        <input type="hidden" name="cliente" id="cliente">
                        <input type="hidden" name="id" id="id_pedido">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mt-1 btn-transition btn btn-outline-secondary" data-dismiss="modal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="ri-arrow-go-back-line" aria-hidden="true"></i>
                        </span>{{ __('Back') }}
                    </button>
                    <button type="submit" class="mt-1 btn-transition btn btn-outline-primary" onclick="loading_show()">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="ri-save-3-line"></i>
                        </span>{{ __('Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
