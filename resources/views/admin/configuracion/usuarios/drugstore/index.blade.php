@extends('layouts_new.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('List Drugstore') }}</h3>
                        </div>
                        <div class="col-md-1">
                            @can('drugstore.create')
                                <a class="btn-transition btn btn-outline-primary" href="{{ route('drugstore.create') }}">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i data-feather="plus-circle" class="feather-icon"></i>
                                    </span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    @if (count($drugstore) == 0)
                        <br>
                        <p class="text-center">{{ __('No matching records found') }}</p>
                    @else
                        <div class="col-md-12 mt-3">
                            <table id="AllDataTable" class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="30%">{{ __('Name') }}</th>
                                        <th>{{ 'RIF' }}</th>
                                        <th>{{ 'Teléfono' }}</th>
                                        <th width="10%">{{ 'Status' }}</th>
                                        <th width="20%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drugstore as $resultado)
                                        <tr>
                                            <td>{{ $resultado->name }}</td>
                                            <td>{{ $resultado->rif }}</td>
                                            <td>{{ $resultado->telefono }}</td>
                                            <td style="background-color: {{ $resultado->status->color }}; color: #fff">
                                                {{ $resultado->status->name }}</td>
                                            <td width="30">
                                                @can('drugstore.edit')
                                                    <a href="{{ route('drugstore.edit', $resultado) }}" type="button"
                                                        class="btn-transition btn btn-outline-success btn-sm"
                                                        title="{{ __('Edit drugstore') }}">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="edit-3" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
                                                @can('drugstore.destroy')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#confirm-delete" data-record-id="{{ $resultado->id }}"
                                                        data-record-title="{{ 'la droguería ' }}{{ $resultado->name }}"
                                                        data-action="{{ route('drugstore.destroy', $resultado->id) }}"
                                                        title="{{ __('Delete drugstore') }}"
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
    @include('admin.configuracion.usuarios.drugstore.js.js')
@endsection
