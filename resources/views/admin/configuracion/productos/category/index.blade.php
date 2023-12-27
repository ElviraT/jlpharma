@extends('layouts_new.base')
@section('css')
    @include('admin.configuracion.productos.category.css.css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('List Category') }}</h3>
                        </div>
                        <div class="col-md-1">
                            @can('category.create')
                                <button type="button" class="btn-transition btn btn-outline-primary" data-toggle="modal"
                                    data-action="{{ route('category.store') }}" data-target=".bd-example-modal-sm">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i data-feather="plus-circle" class="feather-icon"></i>
                                    </span>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    @if (count($category) == 0)
                        <br>
                        <p class="text-center">{{ __('No matching records found') }}</p>
                    @else
                        <div class="col-md-12 mt-3">
                            <table id="AllDataTable" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="40%">{{ __('Name') }}</th>
                                        <th width="20%">{{ __('Color') }}</th>
                                        <th width="20%">{{ __('Speciality') }}</th>
                                        <th width="20%">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category as $resultado)
                                        <tr>
                                            <td>{{ $resultado->name }}</td>
                                            <td align="center">
                                                <div class="col-md-12 p-1"
                                                    style="background: {{ $resultado->color }};color: #fff">
                                                    <p class="mt-2">{{ $resultado->color }}</p>
                                                </div>
                                            </td>
                                            <td>{{ $resultado->Speciality->name }}</td>
                                            <td>
                                                @can('category.edit')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#modal_categoria"
                                                        class="btn-transition btn btn-outline-success"
                                                        data-record-id="{{ $resultado['id'] }}"
                                                        title="{{ __('Edit Category') }}"
                                                        data-action="{{ route('category.update', $resultado) }}">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="edit-3" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
                                                @can('category.destroy')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#confirm-delete" data-record-id="{{ $resultado->id }}"
                                                        data-record-title="{{ 'la categoría ' }}{{ $resultado->name }}"
                                                        data-action="{{ route('category.destroy', $resultado->id) }}"
                                                        title="{{ __('Delete Category') }}"
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
    @include('admin.configuracion.productos.category.modal_categoria')
    @include('admin.modales.eliminar')
@endsection

@section('js')
    @include('admin.configuracion.productos.category.js.js')
@endsection
