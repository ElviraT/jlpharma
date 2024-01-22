<div class="row">
    <div class="col-md-12">

        <div class="modal-body">
            @csrf
            <div class="col-md-12">
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ @$jluser ? $jluser->id : 0 }}">
                    <input type="hidden" name="idUser" id="idUser" value="{{ @$jluser ? $jluser->user->id : 0 }}">
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Nombre' }}</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Ingrese el nombre" required value="{{ @$jluser ? $jluser->name : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Cedula / RIF' }}</label>
                        <input type="text" name="dni" class="form-control" id="rif"
                            placeholder="Ingrese la Cedula / RIF" required value="{{ @$jluser ? $jluser->dni : null }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>{{ 'Email' }}</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Ingrese el Email" required
                            value="{{ @$jluser ? $jluser->user->email : null }}">
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
                                value="{{ @$jluser ? $jluser->telefono : null }}">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="zona">{{ 'Zona' }}</label>
                        {!! Form::select('idZone', $zones, isset($jluser) ? $jluser->idZone : null, [
                            'placeholder' => 'Seleccione',
                            'class' => 'otro',
                            'id' => 'idZone',
                            'required' => 'required',
                        ]) !!}
                    </div>
                    <div class="col-md-4" id="check" hidden>
                        <label>{{ 'Estatus' }}</label><br>
                        {!! Form::select('idStatus', $status, isset($jluser) ? $jluser->idstatus : null, [
                            'placeholder' => 'Seleccione',
                            'class' => 'otro',
                            'id' => 'idStatus',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer p-3">
            <a href="{{ route('jluser.index') }}" class="mt-1 btn btn-outline-secondary">
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
