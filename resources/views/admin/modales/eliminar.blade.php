<div id="confirm-delete" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-danger">
                <h4 class="modal-title" id="myModalLabel">Confirmación de Eliminado</h4>
                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="#" id="form-eliminar" method="post">
                @method('DELETE')
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <p>{{ __("You're deleting") }} <b><i class="title"></i></b>,
                        {{ __('This process is irreversible') }}</p>
                    <p>{{ __('Do you want to continue') }}</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-transition btn btn-outline-secondary" data-dismiss="modal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="ri-arrow-go-back-line" aria-hidden="true"></i>
                        </span>{{ __('Back') }}
                    </button>
                    <button type="submit" class="btn-transition btn btn-outline-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="ri-delete-bin-line"></i>
                        </span>{{ __('Delete') }}</a>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
