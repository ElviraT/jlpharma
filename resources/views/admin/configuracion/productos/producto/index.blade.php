@extends('layouts_new.base')
@section('css')
    @include('admin.configuracion.productos.producto.css.css')
    <style>
        .img {
            width: 70px;
            height: 70px;
        }

        .dos_lineas {
            white-space: initial;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('List Product') }}&nbsp;{{ 'JL' }}</h3>
                        </div>
                        <div class="col-md-1">
                            @can('product.create')
                                <button type="button" class="btn-transition btn btn-outline-primary" data-toggle="modal"
                                    data-action="{{ route('product.store') }}" data-target=".bd-example-modal-sm">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i data-feather="plus-circle" class="feather-icon"></i>
                                    </span>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">

                    <div class="col-md-12 mt-3" style="overflow-x:auto;">
                        <table id="AllDataTable_prod" class="table table-bordered dataTable_width_auto" style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ 'Imagen' }}</th>
                                    <th>{{ 'Código' }}</th>
                                    <th>{{ 'Nombre' }}</th>
                                    <th>{{ 'Precios' }}</th>
                                    <th>{{ 'Categoría' }}</th>
                                    <th>{{ 'Disponible' }}</th>
                                    <th class="dos_lineas">{{ 'Rotación especial' }}</th>
                                    <th>{{ 'Acción' }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="{{ isset($last_code) ? $last_code->codigo : '000' }}" id="contador">
    </div>
@endsection
@section('modal')
    @include('admin.configuracion.productos.producto.modal_producto')
    @include('admin.modales.eliminar')
@endsection
@section('js')
    @include('admin.configuracion.productos.producto.js.js')
@endsection
