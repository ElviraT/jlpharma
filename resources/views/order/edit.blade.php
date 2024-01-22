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
                            <h3>{{ 'Editar pedido de:' }}&nbsp;{{ $order->userSend->name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
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
                                        <td><input type="text" name="cant" id="cant{{ $resultado->id }}"
                                                class="form-control" value="{{ $resultado->cant }}"
                                                onchange="update('{{ $resultado->id }}')"></td>
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
    @include('order.js.js')
    <script>
        function update(id) {
            var cant = $('#cant' + id).val();
            $.ajax({
                url: '../../update_pedido/' + id + '/' + cant + '/order',
                type: 'GET',

                error: function(err) {
                    console.log(err);
                },

                success: function(options) {
                    window.location.reload();
                    console.log('OK');
                }

            });
        }
    </script>
@endsection
