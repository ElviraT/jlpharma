@extends('layouts_new.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('menu.Order') }}&nbsp;{{ $order->userSend->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-12" align="center">
                        <a href="#" class="btn btn-primary">{{ 'Aceptar Pedido' }}</a> &nbsp;&nbsp;
                        <a href="#" class="btn btn-danger">{{ 'Rechazar Pedido' }}</a> &nbsp;&nbsp;
                        <a href="{{ route('dashboard') }}" class="btn btn-info">{{ 'Volver' }}</a>
                    </div>
                    <div class="col-md-12 mt-3">
                        <table id="AllDataTable" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="40%">{{ __('Name') }}</th>
                                    <th width="20%">{{ __('Cant') }}</th>
                                    <th width="20%">{{ __('Price') }}</th>
                                    <th width="20%">{{ __('Importe') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->detalle as $resultado)
                                    <tr>
                                        <td>{{ $resultado->name }}</td>
                                        <td>{{ $resultado->cant }}</td>
                                        <td>{{ number_format($resultado->price, 2) }}</td>
                                        <td>{{ number_format($resultado->importe, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2"></th>
                                    <th>{{ 'Total' }}</th>
                                    <th>{{ number_format($order->total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('admin.configuracion.productos.category.js.js')
@endsection
