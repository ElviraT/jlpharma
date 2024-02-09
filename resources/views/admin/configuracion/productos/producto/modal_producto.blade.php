<div id="modal_producto" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Producto</h5>
                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form-enviar" method="post" enctype="multipart/form-data">
                <input type="hidden" id="method" name="_method" value="" />
                <div class="modal-body">
                    {{ Form::hidden('id', 0, ['class' => 'modal_product_id']) }}
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Código' }}</label>
                            <input type="text" name="codigo" class="form-control" id="codigo" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Nombre' }}</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="Ingrese el nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="zona">{{ 'Categorías' }}</label>
                            <select id="category" name="idCategory" class="otro" style="width: 100%">
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="img">Imagen</label>
                            <input type="file" class="form-control-file form-control" id="img" name="img">
                        </div>
                        <div class="col-12 mb-3">
                            <label>Descripción</label>
                            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <h4><strong>Precios</strong></h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Centro de salud' }}</label>
                            <input type="number" name="price_cs" class="form-control" id="price_cs" step="0.01"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Drogueria' }}</label>
                            <input type="number" name="price_dg" class="form-control" id="price_dg" step="0.01"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Cantidad' }}</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" step="1"
                                required step="1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Cantidad minima' }}</label>
                            <input type="number" name="quantity_min" class="form-control" id="quantity_min"
                                step="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Transferencia' }}</label>
                            <input type="number" name="price_tf" class="form-control" id="price_tf" step="0.01"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Cantidad (Transferencia)' }}</label>
                            <input type="number" name="quantity_tf" class="form-control" id="quantity_tf"
                                step="1" required>
                        </div>
                        <div class="col-md-12" id="check" hidden>
                            <label>{{ 'Disponible' }}</label><br>
                            <input type="checkbox" name="available" id="available" data-toggle="toggle" data-style="ios"
                                data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger"
                                data-width="30" data-height="20">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mt-1 btn-transition btn btn-outline-secondary"
                        data-dismiss="modal">
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
