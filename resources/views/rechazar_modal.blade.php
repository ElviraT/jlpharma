<div id="confirm-rechazar" class="modal fade bd-example-rechazo-sm" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-danger">
                <h4 class="modal-title" id="myModalLabel">Rechazar de Solicitud</h4>
                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ route('request.rechazar') }}" id="form-rechazar" method="post">

                <div class="modal-body">
                    @csrf
                    <div class="col-12 p-3" align="center">
                        <input type="hidden" name="id" id="id">
                        <h5><b><i class="title"></i></h5>
                        <hr>
                        <div class="col-12">
                            <label for="">{{ 'Observación' }}</label>
                            <textarea name="observation" id="observation" rows="3" class="form-control"></textarea>
                        </div>
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
