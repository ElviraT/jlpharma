<div class="row" style="padding: 30px;">
    <div class="form-group col-md-12">
        <div class="col-md-4 mb-3">
            <label for="validationCustom01">{{ __('Name') }}</label>
            {!! form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'autofocus' => 'autofocus']) !!}
        </div>
        <div class="col-md-12">
            <div class="cont">
                <h5>{{ 'Listado de Permisos' }}</h5>
                <div class="row mt-2">
                    @foreach ($permission as $permiso)
                        <div class="single-item col-md-3 mt-2">
                            <label>
                                {!! form::checkbox('permissions[]', $permiso->id, null, [
                                    'class' => 'form-control checkbox',
                                    'data-toggle' => 'toggle',
                                    'data-on' => 'Si',
                                    'data-off' => 'No',
                                    'data-size' => 'xs',
                                    'id' => 'check',
                                ]) !!}
                                {{ $permiso->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer p-3">
    <a href="{{ route('roles.index') }}" class="mt-1 btn btn-outline-secondary">
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
