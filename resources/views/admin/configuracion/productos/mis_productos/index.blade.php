@extends('layouts_new.base')
@section('css')
    @include('admin.configuracion.productos.mis_productos.css.css')
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
                            <h3>{{ __('List Product') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-md-12 mt-3">
                        <table id="AllDataTable_prod" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ 'Nombre' }}</th>
                                    <th>{{ 'Precio' }}</th>
                                    <th>{{ 'stock' }}</th>
                                    <th width="200px">{{ 'Acción' }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('admin.configuracion.productos.mis_productos.modal_producto')
@endsection
@section('js')
    @include('admin.configuracion.productos.mis_productos.js.js')
@endsection
