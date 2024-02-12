@extends('layouts_new.base')
@section('css')
    <link href="{{ asset('css/selectize.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .-b-text-undexpanded {
            display: -webkit-box;
            height: 50px;
            -webkit-line-clamp: 3;
            /* Número de líneas */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
            text-align: justify;
        }

        .-b-expander {
            cursor: pointer;
            1 line-height: 1.3;
            text-align: justify;
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
                            <h3>{{ __('menu.Order') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 mt-3">
                                <h4>{{ __('Products In Our Store') }}</h4>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <label>{{ 'Buscar Producto' }}</label>
                                {!! Form::select('idProduct', $combo, null, [
                                    'placeholder' => 'Seleccione',
                                    'class' => 'form-control product',
                                    'id' => 'idProduct',
                                ]) !!}
                                <input type="hidden" id="categoria" value="{{ $categoria }}">
                            </div>
                            <div class="col-lg-2 mt-3">
                                <button type="button" class="btn btn-outline-info mt-1"
                                    onclick="limpiar()">{{ 'Todos' }}</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            @foreach ($products['products'] as $pro)
                                <div class="col-lg-4">
                                    <div class="card sombra" style="margin-bottom: 20px; height: auto;">
                                        <img src="@if (file_exists(asset('storage/' . $pro->img))) {{ asset('storage/' . str_replace('\\', '/', $pro->img)) }}@else{{ asset('img/no-image.jpg') }} @endif"
                                            alt="{{ $pro->name }}" class="card-img-top mx-auto"
                                            style="height: 150px; width: 150px;display: block;">

                                        <div class="card-body">
                                            <h6 class="card-title">{{ $pro->name }}</h6>
                                            <div class="col-12">
                                                <p class="-b-expander -b-text-undexpanded">
                                                    {{ $pro->description }}
                                                </p>

                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p>
                                                            <strong>{{ 'Precio:' }}</strong>
                                                            ${{ number_format($pro->price_dg, 2) }}
                                                        </p>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <strong>{{ 'Cant:' }}</strong>&nbsp;&nbsp;<input
                                                                type="number" id="cant{{ $pro->id }}" min="0"
                                                                class="labelmax form-control" value=""
                                                                max="{{ $pro->quantity }}"
                                                                onchange="add_cant({{ $pro->id }})">
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->hasRole('Vendedor'))
                                                        <div class="col-12">
                                                            <p><strong>{{ 'Stock:' }}</strong>
                                                                {{ $pro->quantity }}{{ ' und.' }}</p>
                                                        </div>
                                                        @if (isset($pro->rotacion) && $pro->rotacion == 1)
                                                            <div class="col-12">
                                                                <span> {{ 'Rotación Especial' }}</span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="card-footer" align="center">
                                @can('order.store')
                                    <form action="{{ route('order.store') }}" method="post">
                                        @csrf
                                        @foreach ($products['products'] as $item)
                                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                                            <input type="hidden" name="cant[]" id="cantidad{{ $item->id }}"
                                                value="">
                                        @endforeach
                                        <input type="hidden" name="cliente" value="{{ $products['de'] }}">
                                        <input type="hidden" name="idCategoria" value="{{ $products['categoria'] }}">
                                        <input type="hidden" name="para" value="{{ $products['para'] }}">
                                        <input type="submit" name="add" class="btn btn-outline-success" value="Agregar"
                                            onclick="loading_show()">
                                        <a href="{{ route('order.filtro') }}" class="btn btn-outline-secondary"
                                            onclick="loading_show()"><i class="ri-arrow-left-s-line"></i>
                                            {{ 'Categorías' }}</a>

                                    </form>
                                @endcan
                            </div>
                            {{ $products['products']->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            $('.product').selectize({
                preload: true,
                loadingClass: 'loading',
                closeAfterSelect: true
            });
        });
        document.querySelectorAll(".-b-expander").forEach(function(el) {
            el.addEventListener("click", () => {
                el.classList.toggle("-b-text-undexpanded");
            });
        });

        function add_cant(id) {
            var cant = document.getElementById("cant" + id).value;
            $('#cantidad' + id).val(cant);
        }

        $('#idProduct').on('change', function() {
            var idProduct = $(this).val();
            var idCategoria = $('#categoria').val();
            location.href = '../' + idCategoria + '/' + idProduct;
        });

        function limpiar() {
            var idCategoria = $('#categoria').val();
            location.href = '../' + idCategoria + '/null';
        }
        $(function() {
            $(".labelmax").keydown(function() {
                var max = parseInt(this.max);

                if (parseInt(this.value) > max) {
                    this.value = max;
                }
            });
        });
    </script>
@endsection
