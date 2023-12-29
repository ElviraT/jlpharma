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
                    <div class="col-12 mb-3">
                        <div class="row">
                            @role(['Admin', 'SuperAdmin', 'Vendedor'])
                                <div class="col-6">
                                    <legend>DE:</legend>
                                    <fieldset>
                                        <label>
                                            <input type="radio" name="de" value="Farmacia"> Farmacia
                                        </label>
                                        <label>
                                            <input type="radio" name="de" value="Droguería"> Droguería
                                        </label>
                                        <label>
                                            <input type="radio" name="de" value="JL"> JL
                                        </label>
                                    </fieldset>
                                    <select id="idDe" name="idDe" class="form-control" required></select>
                                </div>
                                <div class="col-6">
                                    <fieldset>
                                        <legend>PARA:</legend>
                                        <label>
                                            <input type="radio" name="para" value="Farmacia"> Farmacia
                                        </label>
                                        <label>
                                            <input type="radio" name="para" value="Droguería"> Droguería
                                        </label>
                                        <label>
                                            <input type="radio" name="para" value="JL"> JL
                                        </label>
                                    </fieldset>
                                    <select id="idPara" name="idPara" class="form-control" required></select>

                                </div>
                            @endrole
                        </div>
                    </div>
                    <div class="col-lg-12">
                        @if (Cart::count())
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
                                                <img src="{{ str_replace('\\', '/', '../' . $item->options->image) }}"
                                                    alt=""class="img-responsive" style="width: 50%;">
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                            </td>
                                            <td>
                                                {{ $item->qty }}
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
                                    <tr class="fw-bolder">
                                        <td colspan="3"></td>
                                        <td class="text-end">{{ 'Subtotal' }}</td>
                                        <td class="text-end">{{ Cart::subtotal() }}</td>
                                        <td></td>
                                    </tr>
                                    <tr class="fw-bolder">
                                        <td colspan="3"></td>
                                        <td class="text-end">{{ 'Total' }}</td>
                                        <td class="text-end">
                                            {{ Cart::total() }}
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('order.clear') }}"
                                            class="btn btn-outline-danger btn-sm text-center">{{ 'Vaciar Pedido' }}</a>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('order.send') }}" method="post">
                                            @csrf
                                            @foreach (Cart::content() as $enviar)
                                                <input type="hidden" name="name[]" value="{{ $enviar->name }}" required>
                                                <input type="hidden" name="cant[]" value="{{ $enviar->qty }}" required>
                                                <input type="hidden" name="price[]"
                                                    value="{{ number_format($enviar->price, 2) }}" required>
                                                <input type="hidden" name="importe[]"
                                                    value="{{ number_format($enviar->qty * $enviar->price, 2) }}" required>
                                            @endforeach
                                            <input type="hidden" name="total" value="{{ Cart::total() }}" required>
                                            <input type="text" name="idSend" id="envia" value="" required>
                                            <input type="text" name="idReceives" id="recibe" value="" required>
                                            <input type="text" name="nOrder" id="order" value="" required>
                                            <button type="submit"
                                                class="btn btn-outline-info btn-sm text-center">{{ 'Solicitar Pedido' }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('order.index') }}"
                                class="btn btn-outline-primary">{{ 'Agregar Producto' }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ isset($pedido->nOrder) ? $pedido->nOrder : '000' }}" id="contador">
@endsection
@section('js')
    <script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
    <script>
        $("input[name='de']").change(function() {
            // ASIGNAR NUMERO DE PEDIDO
            var codigo = 0;
            var letras;
            letras = $('#contador').val().slice(1);
            var contador = parseInt(letras) + parseInt(1);
            if (contador < 10) {
                codigo = ('PE-000' + contador);
            } else if (contador < 100) {
                codigo = ('PE-00' + contador);
            } else if (contador < 1000) {
                codigo = ('PE-0' + contador);
            } else if (contador < 10000) {
                codigo = ('PE-' + contador);
            }
            $('#order').val(codigo);
            // FIN
            var combo = $(this).val();
            $('#idDe').val('');
            $.ajax({
                url: '../combo/' + combo + '/combo_pedido',
                type: 'GET',

                error: function(err) {
                    console.log(err);
                },

                success: function(options) {
                    $('#idDe').selectize()[0].selectize.destroy();
                    $('#idDe').selectize({
                        valueField: 'id',
                        labelField: 'name',
                        searchField: 'name',
                        preload: true,
                        options: options,
                        create: true,
                    });
                }
            });
        });
        $('#idDe').change(function() {
            var idDe = $(this).val();
            if (idDe != '') {
                $("#envia").val(idDe);
            }
        });
        $("input[name='para']").change(function() {
            var combo = $(this).val();
            $('#idPara').val('');
            $.ajax({
                url: '../combo/' + combo + '/combo_pedido',
                type: 'GET',

                error: function(err) {
                    console.log(err);
                },

                success: function(options) {
                    $('#idPara').selectize()[0].selectize.destroy();
                    $('#idPara').selectize({
                        valueField: 'id',
                        labelField: 'name',
                        searchField: 'name',
                        preload: true,
                        options: options,
                        create: true,
                    });
                }
            });
        });
        $('#idPara').change(function() {
            var idPara = $(this).val();
            if (idPara != '') {
                $("#recibe").val(idPara);
            }
        });

        function enviar() {}
    </script>
@endsection
