@extends('layouts_new.base')
@section('css')
    @include('admin.configuracion.direccion.zonas.css.css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('List Zones') }}</h3>
                        </div>
                        <div class="col-md-1">
                            @can('zones.create')
                                <button type="button" class="btn-transition btn btn-outline-primary" data-toggle="modal"
                                    data-action="{{ route('zones.store') }}" data-target=".bd-example-modal-sm">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i data-feather="plus-circle" class="feather-icon"></i>
                                    </span>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    @if (count($zones) == 0)
                        <br>
                        <p class="text-center">{{ __('No matching records found') }}</p>
                    @else
                        <div class="col-md-12 mt-3">
                            <table id="AllDataTable" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="60%">{{ __('City') }}</th>
                                        <th width="20%">{{ __('Name') }}</th>
                                        <th width="20%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($zones as $resultado)
                                        <tr>
                                            <td>{{ $resultado->city->name }}</td>
                                            <td>{{ $resultado->name }}</td>
                                            <td>
                                                @can('zones.edit')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#modal_zona" class="btn-transition btn btn-outline-success"
                                                        data-record-id="{{ $resultado['id'] }}" title="{{ __('Edit Zone') }}"
                                                        data-action="{{ route('zones.update', $resultado) }}">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="edit-3" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
                                                @can('zones.destroy')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#confirm-delete" data-record-id="{{ $resultado->id }}"
                                                        data-record-title="{{ 'la zona ' }}{{ $resultado->name }}"
                                                        data-action="{{ route('zones.destroy', $resultado->id) }}"
                                                        title="{{ __('Delete Zone') }}"
                                                        class="btn-transition btn btn-outline-danger">
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
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('admin.configuracion.direccion.zonas.modal_zona')
    @include('admin.modales.eliminar')
@endsection

@section('js')
    @include('admin.configuracion.direccion.zonas.js.js')
@endsection
