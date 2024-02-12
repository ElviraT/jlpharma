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
            background-color: #049383;
            color: white;
            border-bottom: 1px solid #555;
        }

        #detalle_info tfoot {
            border-top: 1px solid #555;
        }

        .dos_lineas {
            white-space: initial;
        }

        .active_tap {
            border-bottom: 2px solid #049383;
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
                    @php($id = substr(str_replace('/', '', $_SERVER['REQUEST_URI']), -1))
                    <ul class="nav nav-tabs nav-justified">
                        @foreach ($status as $item)
                            @if ($item->orden != 4)
                                <li class="nav-item {{ $id == $item->id ? 'active_tap' : '' }}">
                                    <a class="nav-link" href="{{ route('order.state', $item->id) }}"
                                        onclick="loading_show()">{{ $item->name }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="col-md-12 mt-3">
                        <table id="AllDataTable" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __('No. Orden') }}</th>
                                    <th>{{ __('RIF') }}</th>
                                    <th>{{ __('Cliente') }}</th>
                                    <th>{{ __('Fecha') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th>{{ __('Vendedor') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $resultado)
                                    <tr>
                                        <td>{{ $resultado->nOrder }}</td>
                                        <td>{{ $resultado->userSend->dni }}</td>
                                        <td>{{ $resultado->userSend->name }}</td>
                                        <td>{{ $resultado->created_at->format('d-m-Y') }}</td>
                                        <td>{{ '$' . number_format($resultado->total, 2) }}</td>
                                        <td>{{ $resultado->user->name }}</td>
                                        <td>
                                            @can('order.pdf')
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#modal_info" data-record-id="{{ $resultado->id }}"
                                                    title="{{ __('Ver Proforma') }}"
                                                    data-record-status="{{ $resultado->status->name }}">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            @endcan
                                            &nbsp;
                                            @if (Auth::user()->hasAnyRole('SuperAdmin', 'Vendedor'))
                                                @can('order.edit')
                                                    @if ($resultado->status->orden == 1)
                                                        @if (Session::get('orden') != '')
                                                            <a href="#" class="btn btn-secondary btn-sm"
                                                                title="{{ __('Editar pedido') }}"
                                                                onclick="verificar_edit('{{ $resultado->id }}')">
                                                                <i class="ri-edit-line"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('order.edit', $resultado->id) }}"
                                                                class="btn btn-secondary btn-sm"
                                                                title="{{ __('Editar pedido') }}">
                                                                <i class="ri-edit-line"></i>
                                                            </a>
                                                        @endif
                                                    @endif
                                                @endcan
                                                @can('order.permiso')
                                                    @if ($resultado->status->orden == 2)
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal" data-target="#permiso_modal"
                                                            data-record-npedido="{{ $resultado->nOrder }}"
                                                            data-record-cliente="{{ $resultado->userSend->name }}"
                                                            data-record-id="{{ $resultado->id }}"
                                                            title="{{ __('solicitar cambio de status') }}">
                                                            <i class="ri-exchange-line"></i>
                                                        </button>
                                                    @endif
                                                @endcan
                                            @endif
                                            &nbsp;
                                            @if (Auth::user()->hasAnyRole('SuperAdmin', 'Latinfarma'))
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#cambiar_status" data-record-id="{{ $resultado->id }}"
                                                    data-record-orden="{{ $resultado->status->orden }} title="{{ __('Cambiar status') }}">
                                                    <i class="ri-draft-line"></i>
                                                </button>
                                            @endif
                                            &nbsp;
                                            @can('order.aceptar')
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#confirm-aceptar" data-record-id="{{ $resultado->id }}"
                                                    title="{{ __('Aceptar pedido') }}"
                                                    data-record-title="{{ 'Aceptar el pedido de ' }}{{ $resultado->userSend->name }}">
                                                    <i class="ri-checkbox-line"></i>
                                                </button>
                                            @endcan
                                            &nbsp;
                                            @can('order.rechazar')
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    title="{{ __('Eliminar pedido') }}" data-target="#confirm-rechazar"
                                                    data-record-id="{{ $resultado->id }}"
                                                    data-record-title="{{ 'Rechazar el pedido de ' }}{{ $resultado->userSend->name }}">
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $order->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('order.aceptar_modal')
    @include('order.cambiar_status')
    @include('order.rechazar_modal')
    @include('order.permiso_modal')
    @include('order.modal.info')
@endsection
@section('js')
    @include('order.js.js')
    <script>
        function generar_pdf() {
            loading_show();
            var id = $('#id_pdf').val();
            console.log(id);
            window.open('../../order/pdf/' + id, '_blank');
            loading_hide();
        }
    </script>
@endsection
