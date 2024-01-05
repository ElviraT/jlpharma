@extends('layouts_new.base')
@section('css')
    @include('admin.configuracion.productos.mis_productos.css.css')
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
                    @if (count($product) == 0)
                        <br>
                        <p class="text-center">{{ __('No matching records found') }}</p>
                    @else
                        <div class="col-md-12 mt-3">
                            <table id="AllDataTable" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ 'Nombre' }}</th>
                                        <th>{{ 'Precio' }}</th>
                                        <th>{{ 'stock' }}</th>
                                        <th width="200px">{{ 'Acción' }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $resultado)
                                        <tr>
                                            <td>{{ $resultado->Product }}</td>
                                            <td>{{ number_format($resultado->price, 2) }}</td>
                                            <td>{{ $resultado->quantity }}</td>
                                            <td>
                                                @can('mis_productos.edit')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#modal_producto"
                                                        class="btn-transition btn btn-outline-success"
                                                        data-record-id="{{ $resultado['id'] }}"
                                                        title="{{ __('Edit Product') }}"
                                                        data-action="{{ route('product.update', $resultado) }}">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="edit-3" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan

                                                @if ($resultado->quantity <= $resultado->quantity_min)
                                                    <button type="button" class="btn btn-warning" data-toggle="tooltip"
                                                        data-placement="bottom" title="Producto con cantidad minima"><i
                                                            class="fas fa-exclamation-triangle text-white"></i></button>
                                                @endif
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
    @include('admin.configuracion.productos.mis_productos.modal_producto')
@endsection
@section('js')
    @include('admin.configuracion.productos.mis_productos.js.js')
@endsection
