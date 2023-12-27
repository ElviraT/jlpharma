<div id="modal_zona" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Zona</h5>
                <button type="button" class="btn btn-ligth close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="form-enviar" method="post">

                <input type="hidden" id="method" name="_method" value="" />
                <div class="modal-body">
                    @csrf
                    <div class="col-md-12">
                        <div class="row">
                            <input type="hidden" name="id" id="modal_add_zona_id" value="0">
                            <div class="col-md-12 mb-3">
                                <label for="country">{{ 'País' }}</label>
                                <select id="country" name="idCountry" class="otro form-control" style="width: 100%">
                                    <option></option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="state">{{ 'Estado' }}</label>
                                <select id="state" name="idState" class="pickerSelectClass form-control"
                                    style="width: 100%" disabled>
                                    <option></option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="city">{{ 'Ciudad' }}</label>
                                <select id="city" name="idCity" class="pickerSelectClass form-control"
                                    style="width: 100%" disabled>
                                    <option></option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>{{ 'Nombre' }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Ingrese el nombre de la zona" onfocus="true" required>
                            </div>
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
