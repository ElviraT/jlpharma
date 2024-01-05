<div id="modal_producto" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <h5 class="modal-title" id="exampleModalLongTitle">Editar Producto</h5>
                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mis_productos.store') }}" id="form-enviar" method="post">
                <input type="hidden" id="method" name="_method" value="" />
                <div class="modal-body">
                    {{ Form::hidden('id', 0, ['class' => 'modal_product_id']) }}
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Nombre' }}</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Ingrese el nombre" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>{{ 'Precio' }}</label>
                            <input type="number" name="price" class="form-control" id="price" step="0.1"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Cantidad minima' }}</label>
                            <input type="number" name="quantity_min" class="form-control" id="quantity_min"
                                step="1" required>
                        </div>
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
