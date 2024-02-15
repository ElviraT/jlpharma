@extends('layouts_new.base')
@section('css')
    <link href="{{ asset('css/selectize.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .espacio_modal {
            letter-spacing: 1px;
            line-height: 27px;
        }

        .dos_lineas {
            white-space: initial;
        }

        .active_tap {
            border-bottom: 2px solid #043484;
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
                            <h3>{{ 'Solicitudes de cambio de status' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-md-12 mt-3">
                        <table id="AllDataTable" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ __('No. Orden') }}</th>
                                    <th>{{ __('Cliente') }}</th>
                                    <th>{{ __('Vendedor') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->unreadNotifications->take(20) as $key => $notification)
                                    <tr>
                                        <td>{{ $notification->data['pedido'] }}</td>
                                        <td>{{ $notification->data['cliente'] }}</td>
                                        <td>{{ $notification->data['vendedor'] }}</td>
                                        <td>
                                            @if (Auth::user()->hasAnyRole('SuperAdmin', 'JL'))
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#cambiar_status"
                                                    data-record-id="{{ $notification->data['idPedido'] }}"
                                                    data-record-orden="{{ $notification->data['pedido'] }}"
                                                    data-record-leer="{{ auth()->user()->unreadNotifications[$key]->id }}"
                                                    title="{{ __('Cambiar status') }}">
                                                    <i class="ri-draft-line"></i>
                                                </button>
                                            @endif
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
    @include('order.cambiar_status')
@endsection
@section('js')
    <!-- Select2 -->
    <script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $('.status').selectize({
                preload: true,
                loadingClass: 'loading',
                closeAfterSelect: true
            });
        });
        $('#cambiar_status').on('show.bs.modal', function(e) {
            var modal = $(e.delegateTarget),
                data = $(e.relatedTarget).data();
            modal.addClass('loading');
            $('#id', modal).val(data.recordId);
            modal.removeClass('loading');
        });
    </script>
@endsection
