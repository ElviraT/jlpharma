@extends('layouts_new.base')
@section('css')
    <link href="{{ asset('css/selectize.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('menu.Order') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-lg-12">
                        @if (Cart::count())
                            <div class="table-responsive">
                                <table id="AllDataTable" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th width=15%>{{ 'IMAGEN' }}</th>
                                            <th width=20%>{{ 'NOMBRE' }}</th>
                                            <th width=20%>{{ 'CANTIDAD' }}</th>
                                            <th width=20%>{{ 'PRECIO UNITARIO' }}</th>
                                            <th width=15%>{{ 'IMPORTE' }}</th>
                                            <th width=10%></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::content() as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ str_replace('\\', '/', '../storage/' . $item->options->image) }}"
                                                        alt=""class="img-responsive" style="width: 55%;">
                                                </td>
                                                <td>
                                                    {{ $item->name }}
                                                </td>
                                                <td>
                                                    <input type="text" name="cantidad" id="cantidad{{ $item->rowId }}"
                                                        class="form-control" value="{{ $item->qty }}"
                                                        onchange="return update('{{ $item->rowId }}')">
                                                </td>
                                                <td>
                                                    {{ number_format($item->price, 2) }}
                                                </td>
                                                <td>
                                                    {{ number_format($item->qty * $item->price, 2) }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('order.remove') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->rowId }}">
                                                        <input type="submit" name="add"
                                                            class="btn btn-outline-danger btn-sm" value="X">
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="fw-bolder">
                                            <td colspan="4" class="text-end">{{ 'Subtotal' }}</td>
                                            <td class="text-end">{{ Cart::subtotal() }}</td>
                                            <td></td>
                                        </tr>
                                        <tr class="fw-bolder">
                                            <td colspan="4" class="text-end">{{ 'Total' }}</td>
                                            <td class="text-end">
                                                {{ Cart::total() }}
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
                                                    reaadonly="true">
                                                    @foreach ($status as $item)
                                                        @if ($item->name == 'Procesado')
                                                            <option value="{{ $item->id }}" selected>
                                                                {{ $item->name }}</option>
                                                        @endif
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @foreach (Cart::content() as $enviar)
                                                <input type="hidden" name="name[]" value="{{ $enviar->name }}" required>
                                                <input type="hidden" name="cant[]" value="{{ $enviar->qty }}" required>
                                                <input type="hidden" name="idProduct[]" value="{{ $enviar->id }}"
                                                    required>
                                                <input type="hidden" name="price[]"
                                                    value="{{ number_format($enviar->price, 2) }}" required>
                                                <input type="hidden" name="importe[]"
                                                    value="{{ number_format($enviar->qty * $enviar->price, 2) }}" required>
                                            @endforeach
                                            <input type="hidden" name="total" value="{{ Cart::total() }}" required>
                                            <input type="hidden" name="idSend" id="envia" value="{{ $idSend }}"
                                                required>
                                            <input type="hidden" name="idReceives" id="recibe"
                                                value="{{ $idReceives }}" required>
                                            <input type="hidden" name="nOrder" id="contador" value="" required>

                                            <button type="submit" class="btn btn-outline-info btn-sm text-center"
                                                id="realizar_pedido" disabled>{{ 'Realizar Pedido' }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('order.products') }}"
                                class="btn btn-outline-primary">{{ 'Agregar Producto' }}</a>
                        @endif
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
    </script>
@endsection
