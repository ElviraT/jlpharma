@extends('layouts_new.base')

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
                                                <input type="hidden" id="id[]" value="{{ $item->id }}">
                                            </td>
                                            <td>
                                                {{ $item->name }}
                                                <input type="hidden" id="name[]" value="{{ $item->name }}">
                                            </td>
                                            <td>
                                                {{ $item->qty }}
                                                <input type="hidden" id="cantidad[]" value="{{ $item->qty }}">
                                            </td>
                                            <td>
                                                {{ number_format($item->price, 2) }}
                                                <input type="hidden" id="price[]"
                                                    value="{{ number_format($item->price, 2) }}">

                                            </td>
                                            <td>
                                                {{ number_format($item->qty * $item->price, 2) }}
                                                <input type="hidden" id="importe[]"
                                                    value="{{ number_format($item->qty * $item->price, 2) }}">

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
                                            <input type="hidden" id="total" value="{{ Cart::total() }}">
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
                                        <a href="#" class="btn btn-outline-info btn-sm text-center"
                                            onclick="return enviar()">{{ 'Solicitar Pedido' }}</a>
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
    </div>
@endsection
@section('js')
    <script>
        function enviar() {
            var id = $('#id').val();
            var name = $('#name').val();
            var total = $('#total').val();
            var cantidad = $('#cantidad').val();
            var importe = $('#importe').val();

            console.log(id, name, total, cantidad, importe, );
        }
    </script>
@endsection
