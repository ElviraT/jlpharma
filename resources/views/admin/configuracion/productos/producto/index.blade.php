@extends('layouts_new.base')
@section('css')
    @include('admin.configuracion.productos.producto.css.css')
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
                    @if (count($product) == 0)
                        <br>
                        <p class="text-center">{{ __('No matching records found') }}</p>
                    @else
                        <div class="col-md-12 mt-3">
                            <table id="AllDataTable" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ 'Imagen' }}</th>
                                        <th>{{ 'Código' }}</th>
                                        <th>{{ 'Nombre' }}</th>
                                        <th>{{ 'Precios' }}</th>
                                        <th>{{ 'Categoría' }}</th>
                                        <th>{{ 'Disponible' }}</th>
                                        <th width="200px">{{ 'Acción' }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product as $resultado)
                                        <tr>
                                            <td><img src="{{ str_replace('\\', '/', './storage/' . $resultado->img) }}"
                                                    alt="producto" class="rounded-circle shadow-4-strong img">
                                            </td>
                                            <td>{{ $resultado->codigo }}</td>
                                            <td>{{ $resultado->name }}</td>
                                            <td>{{ $resultado->price_dg . ', ' . $resultado->price_tf . ', ' . $resultado->price_cs }}
                                            </td>
                                            <td>{{ $resultado->category->name }}</td>

                                            <td>
                                                @if ($resultado->available == 1)
                                                    <input type="checkbox" name="available" data-toggle="toggle"
                                                        data-style="ios" data-on="Si" data-off="No"
                                                        data-onstyle="success" data-offstyle="danger" checked disabled>
                                                @else
                                                    <input type="checkbox" name="available" data-toggle="toggle"
                                                        data-style="ios" data-on="Si" data-off="No"
                                                        data-onstyle="success" data-offstyle="danger" disabled>
                                                @endif
                                            </td>
                                            <td>
                                                @can('product.edit')
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
                                                @can('product.destroy')
                                                    <a href="#" type="button" data-toggle="modal"
                                                        data-target="#confirm-delete" data-record-id="{{ $resultado->id }}"
                                                        data-record-title="{{ 'el producto ' }}{{ $resultado->name }}"
                                                        data-action="{{ route('product.destroy', $resultado->id) }}"
                                                        title="{{ __('Delete Product') }}"
                                                        class="btn-transition btn btn-outline-danger">
                                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                                            <i data-feather="trash-2" class="feather-icon"></i>
                                                        </span>
                                                    </a>
                                                @endcan
                                                @if ($resultado->quantity == $resultado->quantity_min)
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
        <input type="hidden" value="{{ isset($codigo->codigo) ? $codigo->codigo : '000' }}" id="contador">
    </div>
@endsection
@section('modal')
    @include('admin.configuracion.productos.producto.modal_producto')
    @include('admin.modales.eliminar')
@endsection
@section('js')
    @include('admin.configuracion.productos.producto.js.js')
@endsection
