@extends('layouts_new.base')
@section('css')
    <link href="{{ asset('css/selectize.min.css') }}" rel="stylesheet" type="text/css" />
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
                @if (Cart::count())
                    <div class="card sombra p-2">
                        <div class="row">
                            <div class="col-md-10">
                                <h3>{{ __('menu.Order') }}</h3>
                            </div>
                            <div class="col-md-2 mt-1">
                                <a href="{{ url('./order/products/' . $idCategory . '/null') }}"
                                    class="btn btn-outline-warning btn-sm">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        {{ 'Listado Productos' }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card sombra p-2">
                        <div class="col-lg-12">
                            @if (Cart::count())
                                <div class="table-responsive" style="overflow-x:auto;">
                                    <table id="AllDataTable_checkout" class="table table-striped table-bordered"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>{{ 'IMAGEN' }}</th>
                                                <th>{{ 'NOMBRE' }}</th>
                                                <th>{{ 'CANTIDAD' }}</th>
                                                <th class="dos_lineas">{{ 'PRECIO UNITARIO' }}</th>
                                                <th>{{ 'IMPORTE $' }}</th>
                                                <th>{{ 'IMPORTE Bs' }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Cart::content() as $item)
                                                @php($importe = $item->qty * $item->price)
                                                <tr>
                                                    <td>
                                                        <img src="{{ str_replace('\\', '/', '../storage/' . $item->options->image) }}"
                                                            alt=""class="img-responsive" style="width: 55%;">
                                                    </td>
                                                    <td>
                                                        <span class="dos_lineas">{{ $item->name }}</span>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="cantidad"
                                                            id="cantidad{{ $item->rowId }}" class="form-control"
                                                            value="{{ $item->qty }}">
                                                    </td>
                                                    <td>
                                                        {{ number_format($item->price, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($importe, 2) }}
                                                    </td>
                                                    <td>
                                                        {{ number_format($importe * $dolar->monto, 2) }}
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('order.remove') }}" method="post">
                                                            <a href="#" type="button"
                                                                class="btn-transition btn btn-outline-success btn-sm"
                                                                data-toggle="tooltip" title="Actualizar cantidad"
                                                                onclick="return update('{{ $item->rowId }}')"
                                                                onclick="loading_show()">
                                                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                                                    <i class="ri-refresh-line"></i>
                                                                </span>
                                                            </a>&nbsp;&nbsp;

                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $item->rowId }}">
                                                            <input type="submit" name="add"
                                                                class="btn btn-outline-danger btn-sm" value=" X "
                                                                onclick="loading_show()">
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="fw-bolder" style="border-top: 1 solid #043484">
                                                <td class="text-end">{{ 'Totales' }}</td>
                                                <td colspan="2" class="text-end">
                                                    {{ \Cart::count() }}{{ ' Und.' }}</td>
                                                <td colspan="2" class="text-end">
                                                    {{ Cart::total() }}{{ ' $' }}
                                                </td>
                                                <td class="text-end">
                                                    {{ number_format(Cart::total() * $dolar->monto, 2) }}{{ ' Bs' }}
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-12 mt-5">
                                    <form action="{{ route('order.send') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="col-md-12 mb-3">
                                                    <label>{{ 'Observación:' }}</label>
                                                    <textarea name="observation" id="observation" rows="2" class="form-control" required></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                    <a href="{{ route('order.clear') }}"
                                                        class="btn btn-outline-danger btn-sm text-center">{{ 'Vaciar Pedido' }}</a>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="col-md-12 mb-3">
                                                    <label>{{ 'Status' }}</label>
                                                    <select name="idStatus" id="idStatus" class="form-control status"
                                                        required>
                                                        @foreach ($status as $item)
                                                            @if ($item->orden == 1)
                                                                <option value="{{ $item->id }}" selected>
                                                                    {{ $item->name }}</option>
                                                            @endif
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @foreach (Cart::content() as $enviar)
                                                    <input type="hidden" name="name[]" value="{{ $enviar->name }}"
                                                        required>
                                                    <input type="hidden" name="cant[]" value="{{ $enviar->qty }}"
                                                        required>
                                                    <input type="hidden" name="idProduct[]" value="{{ $enviar->id }}"
                                                        required>
                                                    <input type="hidden" name="price[]"
                                                        value="{{ number_format($enviar->price, 2) }}" required>
                                                    <input type="hidden" name="importe[]"
                                                        value="{{ number_format($enviar->qty * $enviar->price, 2) }}"
                                                        required>
                                                    <input type="hidden" name="importe_bs[]"
                                                        value="{{ number_format($importe * $dolar->monto, 2) }}" required>
                                                @endforeach
                                                <input type="hidden" name="total" value="{{ Cart::total() }}" required>
                                                <input type="hidden" name="total_bs"
                                                    value="{{ number_format(Cart::total() * $dolar->monto, 2) }}"
                                                    required>
                                                <input type="hidden" name="idSend" id="envia"
                                                    value="{{ $idSend }}" required>
                                                <input type="hidden" name="idReceives" id="recibe"
                                                    value="{{ $idReceives }}" required>
                                                <input type="hidden" name="nOrder" id="contador" value=""
                                                    required>

                                                <button type="submit" class="btn btn-outline-info btn-sm text-center"
                                                    id="realizar_pedido" disabled>{{ 'Realizar Pedido' }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <a href="{{ url('./order/products/' . $idCategory . '/null') }}"
                                    class="btn btn-outline-primary">{{ 'Agregar Producto' }}</a>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card sombra p-2">
                        <div class="text-center">
                            <p>{{ 'No hay pedidos cargados' }}</p>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                Volver
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('order.js.js')
    <script>
        function update(id) {
            var cant = $('#cantidad' + id).val();
            $.ajax({
                url: '../update/' + id + '/' + cant + '/order',
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
        $('#realizar_pedido').on('click', function() {
            if ($('#observation').val() == '') {
                loading_hide();
                toastr.warning("La observación del pedido es obligatoria", "Advertencia");
                return false;
            }
        });
    </script>
@endsection
