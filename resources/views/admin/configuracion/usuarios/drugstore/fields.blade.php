<div class="row">
    <div class="col-md-12">

        <div class="modal-body">
            @csrf
            <div class="col-md-12">
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ @$drugstore ? $drugstore->id : 0 }}">
                    <input type="hidden" name="idUser" id="idUser"
                        value="{{ @$drugstore ? $drugstore->user->id : 0 }}">
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Nombre' }}</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Ingrese el nombre" required
                            value="{{ @$drugstore ? $drugstore->name : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'RIF' }}</label>
                        <input type="text" name="rif" class="form-control" id="rif"
                            placeholder="Ingrese el RIF" required value="{{ @$drugstore ? $drugstore->rif : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Email' }}</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Ingrese el Email" required
                            value="{{ @$drugstore ? $drugstore->user->email : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'SADA' }}</label>
                        <input type="text" name="sada" class="form-control" id="sada"
                            placeholder="Ingrese el SADA" required value="{{ @$drugstore ? $drugstore->sada : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'SICM' }}</label>
                        <input type="text" name="sicm" class="form-control" id="sicm"
                            placeholder="Ingrese el SICM" required value="{{ @$drugstore ? $drugstore->sicm : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Teléfono' }}</label>
                        <div class="input-group">
                            <select id="mySelect" class="form-control otro">
                                <option value="">Seleccione</option>
                                <option value="+54">Argentina +54</option>
                                <option value="+591">Bolivia +591</option>
                                <option value="+55">Brasil +55</option>
                                <option value="+56">Chile +56</option>
                                <option value="+593">Ecuador +593</option>
                                <option value="+502">Guatemala +502</option>
                                <option value="+52">México +52</option>
                                <option value="+507">Panamá +507</option>
                                <option value="+51">Perú +51</option>
                                <option value="+598">Uruguay +598</option>
                                <option value="+58">Venezuela +58</option>
                            </select>
                            <input type="text" name="telefono" class="form-control" id="telefono"
                                placeholder="Ingrese el Teléfono" required
                                value="{{ @$drugstore ? $drugstore->telefono : null }}">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="zona">{{ 'Zona' }}</label>
                        {!! Form::select('idZone', $zones, isset($drugstore) ? $drugstore->idZone : null, [
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
                                        value="{{ @$drugstore ? $drugstore->contact->name : null }}">
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>{{ 'Apellido' }}</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                        placeholder="Ingrese el Apellido" required
                                        value="{{ @$drugstore ? $drugstore->contact->last_name : null }}">
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>{{ 'Teléfono 1' }}</label>
                                    <div class="input-group">
                                        <select id="mySelect1" class="form-control otro">
                                            <option value="">Seleccione</option>
                                            <option value="+54">Argentina +54</option>
                                            <option value="+591">Bolivia +591</option>
                                            <option value="+55">Brasil +55</option>
                                            <option value="+56">Chile +56</option>
                                            <option value="+593">Ecuador +593</option>
                                            <option value="+502">Guatemala +502</option>
                                            <option value="+52">México +52</option>
                                            <option value="+507">Panamá +507</option>
                                            <option value="+51">Perú +51</option>
                                            <option value="+598">Uruguay +598</option>
                                            <option value="+58">Venezuela +58</option>
                                        </select>
                                        <input type="text" name="telephone" class="form-control" id="telephone"
                                            placeholder="Ingrese el Teléfono 1" required
                                            value="{{ @$drugstore ? $drugstore->contact->telephone : null }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2 mb-3">
                                    <label>{{ 'Teléfono 2' }}</label>
                                    <div class="input-group">
                                        <select id="mySelect2" class="form-control otro">
                                            <option value="">Seleccione</option>
                                            <option value="+54">Argentina +54</option>
                                            <option value="+591">Bolivia +591</option>
                                            <option value="+55">Brasil +55</option>
                                            <option value="+56">Chile +56</option>
                                            <option value="+593">Ecuador +593</option>
                                            <option value="+502">Guatemala +502</option>
                                            <option value="+52">México +52</option>
                                            <option value="+507">Panamá +507</option>
                                            <option value="+51">Perú +51</option>
                                            <option value="+598">Uruguay +598</option>
                                            <option value="+58">Venezuela +58</option>
                                        </select>
                                        <input type="text" name="telephone2" class="form-control" id="telephone2"
                                            placeholder="Ingrese el Teléfono 2"
                                            value="{{ @$drugstore ? $drugstore->contact->telephone2 : null }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Dirección</label>
                        <textarea name="direccion" id="direccion" rows="3" class="form-control">{{ @$drugstore ? $drugstore->direccion : null }}</textarea>
                    </div>
                    <div class="col-md-6" id="check" hidden>
                        <label>{{ 'Estatus' }}</label><br>
                        {!! Form::select('idStatus', $status, isset($drugstore) ? $drugstore->idstatus : null, [
                            'placeholder' => 'Seleccione',
                            'class' => 'otro',
                            'id' => 'idStatus',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer p-3">
            <a href="{{ route('drugstore.index') }}" class="mt-1 btn btn-outline-secondary">
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
