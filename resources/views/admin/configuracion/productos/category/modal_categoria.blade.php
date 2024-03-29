<div id="modal_categoria" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Categoría</h5>
                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form-enviar" method="post">

                <input type="hidden" id="method" name="_method" value="" />
                <div class="modal-body">
                    {{ Form::hidden('id', 0, ['class' => 'modal_registro_category_id']) }}
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01">{{ __('Name') }}</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nombre"
                            required onkeypress='return soloLetras(event)' maxlength="128">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>{{ __('Color') }}</label>
                        <input id="color" type="color" class="form-control" name="color" maxlength="20">
                    </div>
                    <div class="col-md-12" hidden>
                        <label for="speciality">{{ 'Especialidad' }}</label>
                        <select id="speciality" name="idSpeciality" class="otro form-control" style="width: 100%">
                            <option></option>
                            @foreach ($specialities as $speciality)
                                <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                            @endforeach
                        </select>
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
