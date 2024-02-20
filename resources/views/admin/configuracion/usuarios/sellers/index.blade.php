@extends('layouts_new.base')
@section('css')
    <style>
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

                    <div class="col-md-12 mt-3">
                        <table id="AllDataTable_seller" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ 'Teléfono' }}</th>
                                    <th>{{ 'Status' }}</th>
                                    <th>{{ __('Action') }}</th>
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
    @include('admin.modales.eliminar')
@endsection
@section('js')
    @include('admin.configuracion.usuarios.sellers.js.js')
@endsection
