@extends('layouts_new.base')
@section('css')
    <link href="{{ asset('css/selectize.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .espacio_modal {
            letter-spacing: 1px;
            line-height: 27px;
        }

        #detalle_info,
        tr th td {
            border: 2px solid #555;
        }

        #detalle_info thead {
            background-color: rgb(80, 255, 182);
            border-bottom: 1px solid #555;
        }

        #detalle_info tfoot {
            border-top: 1px solid #555;
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
                            <h3>{{ __('menu.Order') }}&nbsp;{{ $order->userSend->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-12" align="center">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target=".bd-example-modal-sm" data-record-id="{{ $order->id }}"
                            data-record-title="{{ 'Aceptar el pedido de ' }}{{ $order->userSend->name }}">
                            {{ 'Aceptar Pedido' }}
                        </button> &nbsp;&nbsp;
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target=".bd-example-rechazo-sm" data-record-id="{{ $order->id }}"
                            data-record-title="{{ 'Rechazar el pedido de ' }}{{ $order->userSend->name }}">
                            {{ 'Rechazar Pedido' }}
                        </button> &nbsp;&nbsp;
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal_info"
                            data-record-id="{{ $order->id }}" data-record-status="{{ $order->status->name }}">
                            {{ 'Ver Pedido' }}
                        </button> &nbsp;&nbsp;
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
@section('modal')
    @include('order.aceptar_modal')
    @include('order.rechazar_modal')
    @include('order.modal.info')
@endsection
@section('js')
    @include('order.js.js')
@endsection
