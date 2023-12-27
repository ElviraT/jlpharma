<div class="row">
    <div class="col-md-12">

        <div class="modal-body">
            @csrf
            <div class="col-md-12">
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ @$pharmacy ? $pharmacy->id : 0 }}">
                    <input type="hidden" name="idUser" id="idUser"
                        value="{{ @$pharmacy ? $pharmacy->user->id : 0 }}">
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Nombre' }}</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Ingrese el nombre" required value="{{ @$pharmacy ? $pharmacy->name : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'RIF' }}</label>
                        <input type="text" name="rif" class="form-control" id="rif"
                            placeholder="Ingrese el RIF" required value="{{ @$pharmacy ? $pharmacy->rif : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Email' }}</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Ingrese el Email" required
                            value="{{ @$pharmacy ? $pharmacy->user->email : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'SADA' }}</label>
                        <input type="text" name="sada" class="form-control" id="sada"
                            placeholder="Ingrese el SADA" required value="{{ @$pharmacy ? $pharmacy->sada : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'SICM' }}</label>
                        <input type="text" name="sicm" class="form-control" id="sicm"
                            placeholder="Ingrese el SICM" required value="{{ @$pharmacy ? $pharmacy->sicm : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Teléfono' }}</label>
                        <input type="text" name="telefono" class="form-control" id="telefono"
                            placeholder="Ingrese el Teléfono" required
                            value="{{ @$pharmacy ? $pharmacy->telefono : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="zona">{{ 'Zona' }}</label>
                        {!! Form::select('idZone', $zones, isset($pharmacy) ? $pharmacy->idZone : null, [
                            'placeholder' => 'Seleccione',
                            'class' => 'otro',
                            'id' => 'idZone',
                            'required' => 'required',
                        ]) !!}
                    </div>
                    {{-- DATOS DE CONTACTO --}}
                    <div class="col-12">
                        <div class="card p-2" style="border: 1px solid #999797">
                            <center><strong>Datos de contacto</strong></center>
                            <div class="row">
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>{{ 'Nombre' }}</label>
                                    <input type="text" name="namec" class="form-control" id="namec"
                                        placeholder="Ingrese el Nombre" required
                                        value="{{ @$pharmacy ? $pharmacy->contact->name : null }}">
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>{{ 'Apellido' }}</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                        placeholder="Ingrese el Apellido" required
                                        value="{{ @$pharmacy ? $pharmacy->contact->last_name : null }}">
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>{{ 'Teléfono 1' }}</label>
                                    <input type="text" name="telephone" class="form-control" id="telephone"
                                        placeholder="Ingrese el Teléfono 1" required
                                        value="{{ @$pharmacy ? $pharmacy->contact->telephone : null }}">
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>{{ 'Teléfono 2' }}</label>
                                    <input type="text" name="telephone2" class="form-control" id="telephone2"
                                        placeholder="Ingrese el Teléfono 2"
                                        value="{{ @$pharmacy ? $pharmacy->contact->telephone2 : null }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label>Dirección</label>
                        <textarea name="direccion" id="direccion" rows="3" class="form-control">{{ @$pharmacy ? $pharmacy->direccion : null }}</textarea>
                    </div>
                    <div class="col-md-12" id="check" hidden>
                        <label>{{ 'Estatus' }}</label><br>
                        <input type="checkbox" name="status" id="status_check" data-toggle="toggle" data-style="ios"
                            data-on="Activo" data-off="Inactivo" data-onstyle="success" data-offstyle="danger"
                            data-width="90" data-height="30">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer p-3">
            <a href="{{ route('pharmacy.index') }}" class="mt-1 btn btn-outline-secondary">
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
