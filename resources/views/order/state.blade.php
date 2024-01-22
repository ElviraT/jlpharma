@extends('layouts_new.base')
@section('css')
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
                            <h3>{{ 'Pedidos - Estado' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-md-12 mt-3">
                        <table id="AllDataTable" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __('No. Orden') }}</th>
                                    <th>{{ __('Realizado Por') }}</th>
                                    <th>{{ __('Para') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Estado') }}</th>
                                    <th>{{ __('Observación') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $resultado)
                                    <tr>
                                        <td>{{ $resultado->nOrder }}</td>
                                        <td>{{ $resultado->user->name }}</td>
                                        <td>{{ $resultado->userReceives->name }}</td>
                                        <td>{{ '$' . number_format($resultado->total, 2) }}</td>
                                        <td style="background-color: {{ $resultado->status->color }}; color: #fff">
                                            {{ $resultado->status->name }}</td>
                                        @if (@isset($resultado->observation))
                                            <td>{{ $resultado->observation }}</td>
                                        @else
                                            <td>{{ 'NINGUNA' }}</td>
                                        @endif
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target=".bd-example-modal-sm" data-record-id="{{ $resultado->id }}"
                                                data-record-status="{{ $resultado->status->name }}">
                                                <i class="ri-eye-line"></i>
                                            </button> &nbsp;&nbsp;
                                            <a href="{{ route('order.edit', $resultado->id) }}"
                                                class="btn btn-secondary btn-sm">
                                                <i class="ri-edit-line"></i>
                                            </a> &nbsp;&nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('order.modal.info')
@endsection
@section('js')
    @include('order.js.js')
@endsection
