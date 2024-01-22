@extends('layouts_new.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('List Seller') }}</h3>
                        </div>
                        <div class="col-md-1">
                            @can('seller.create')
                                <a class="btn-transition btn btn-outline-primary" href="{{ route('seller.create') }}">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i data-feather="plus-circle" class="feather-icon"></i>
                                    </span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    @if (count($seller) == 0)
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
                                    @foreach ($seller as $resultado)
                                        <tr>
                                            <td>{{ $resultado->name }}</td>
                                            <td>{{ $resultado->telefono }}</td>
                                            <td style="background-color: {{ $resultado->status->color }}; color: #fff">
                                                {{ $resultado->status->name }}</td>
                                            <td width="30">
                                                @can('seller.edit')
                                                    <a href="{{ route('seller.edit', $resultado) }}" type="button"
                                                        class="btn-transition btn btn-outline-success btn-sm"
                                                        title="{{ __('Edit seller') }}">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="edit-3" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
                                                @can('seller.destroy')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#confirm-delete" data-record-id="{{ $resultado->id }}"
                                                        data-record-title="{{ 'el vendedor ' }}{{ $resultado->name }}"
                                                        data-action="{{ route('seller.destroy', $resultado->id) }}"
                                                        title="{{ __('Delete seller') }}"
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
                            {{ $seller->links('vendor.pagination.bootstrap-5') }}
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
    @include('admin.configuracion.usuarios.sellers.js.js')
@endsection
