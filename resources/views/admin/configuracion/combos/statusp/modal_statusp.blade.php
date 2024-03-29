<div id="modal_statusp" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Status</h5>
                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form-enviar" method="post">

                <input type="hidden" id="method" name="_method" value="" />
                <div class="modal-body">
                    {{ Form::hidden('id', 0, ['class' => 'modal_registro_status_id']) }}
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="{{ __('Name') }}" required onkeypress='return soloLetras(event)'
                            maxlength="128">
                    </div>
                    <div class="col-12 mb-3">
                        <label>{{ 'Orden' }}</label>
                        <input type="number" name="orden" id="orden" class="form-control" step="1"
                            min="1" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>{{ __('Color') }}</label>
                        <input id="color" type="color" class="form-control" name="color" maxlength="20">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mt-1 btn-transition btn btn-outline-secondary" data-dismiss="modal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="ri-arrow-go-back-line" aria-hidden="true"></i>
                        </span>{{ 'Volver' }}
                    </button>
                    <button type="submit" class="mt-1 btn-transition btn btn-outline-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="ri-save-3-line"></i>
                        </span>{{ 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
