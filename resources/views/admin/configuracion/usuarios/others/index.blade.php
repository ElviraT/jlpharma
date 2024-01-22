@extends('layouts_new.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ 'Usuario Latinfarma' }}</h3>
                        </div>
                        <div class="col-md-1">
                            @can('other.create')
                                <a class="btn-transition btn btn-outline-primary" href="{{ route('other.create') }}">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i data-feather="plus-circle" class="feather-icon"></i>
                                    </span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    @if (count($other) == 0)
                        <br>
                        <p class="text-center">{{ __('No matching records found') }}</p>
                    @else
                        <div class="col-md-12 mt-3">
                            <table id="AllDataTable" class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ 'Teléfono' }}</th>
                                        <th>{{ 'Status' }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($other as $resultado)
                                        <tr>
                                            <td>{{ $resultado->name }}</td>
                                            <td>{{ $resultado->telefono }}</td>
                                            <td style="background-color: {{ $resultado->status->color }}; color: #fff">
                                                {{ $resultado->status->name }}</td>
                                            <td width="30">
                                                @can('other.edit')
                                                    <a href="{{ route('other.edit', $resultado) }}" type="button"
                                                        class="btn-transition btn btn-outline-success btn-sm"
                                                        title="{{ __('Edit other') }}">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="edit-3" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
                                                @can('other.destroy')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#confirm-delete" data-record-id="{{ $resultado->id }}"
                                                        data-record-title="{{ 'el usuario ' }}{{ $resultado->name }}"
                                                        data-action="{{ route('other.destroy', $resultado->id) }}"
                                                        title="{{ __('Delete other') }}"
                                                        class="btn-transition btn btn-outline-danger btn-sm">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="trash-2" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $other->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('admin.modales.eliminar')
@endsection
@section('js')
    @include('admin.configuracion.usuarios.others.js.js')
@endsection
