<div class="row">
    <div class="col-md-12">

        <div class="modal-body">
            @csrf
            <div class="col-md-12">
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ @$seller ? $seller->id : 0 }}">
                    <input type="hidden" name="idUser" id="idUser" value="{{ @$seller ? $seller->user->id : 0 }}">
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Nombre' }}</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Ingrese el nombre" required value="{{ @$seller ? $seller->name : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Cedula / RIF' }}</label>
                        <input type="text" name="dni" class="form-control" id="rif"
                            placeholder="Ingrese la Cedula / RIF" required value="{{ @$seller ? $seller->dni : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Email' }}</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Ingrese el Email" required
                            value="{{ @$seller ? $seller->user->email : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Teléfono' }}</label>
                        <input type="text" name="telefono" class="form-control" id="telefono"
                            placeholder="Ingrese el Teléfono" required
                            value="{{ @$seller ? $seller->telefono : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="zona">{{ 'Zona' }}</label>
                        {!! Form::select('idZone', $zones, isset($seller) ? $seller->idZone : null, [
                            'placeholder' => 'Seleccione',
                            'class' => 'otro',
                            'id' => 'idZone',
                            'required' => 'required',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer p-3">
            <a href="{{ route('seller.index') }}" class="mt-1 btn btn-outline-secondary">
                <span class="btn-icon-wrapper pr-2 opacity-7">
                    <i class="ri-arrow-go-back-line" aria-hidden="true"></i>
                </span>{{ __('Back') }}
            </a>
            <button type="submit" class="mt-1 btn-transition btn btn-outline-primary">
                <span class="btn-icon-wrapper pr-2 opacity-7">
                    <i class="ri-save-3-line"></i>
                </span>{{ __('Add') }}
            </button>
        </div>
    </div>
</div>
