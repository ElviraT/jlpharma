@extends('layouts_new.base')
@section('css')
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
                            <div class="col-lg-7">
                                <h4>{{ __('Products In Our Store') }}</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            @foreach ($products['products'] as $pro)
                                @if (isset($pro->img))
                                    <div class="col-lg-3">
                                        <div class="card sombra" style="margin-bottom: 20px; height: auto;">
                                            <img src="{{ str_replace('\\', '/', '../storage/' . $pro->img) }}"
                                                alt="producto" class="card-img-top mx-auto"
                                                style="height: 150px; width: 150px;display: block;"
                                                alt="{{ $pro->img }}">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $pro->name }}</h6>
                                                <div class="col-12">
                                                    <p class="-b-expander -b-text-undexpanded">
                                                        {{ $pro->description }}
                                                    </p>

                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p>${{ $pro->price_dg }}</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="input-group">
                                                                <strong>{{ 'Cant:' }}</strong>&nbsp;&nbsp;<input
                                                                    type="number" id="cant{{ $pro->id }}"
                                                                    min="1" class="form-control" value="1"
                                                                    onchange="add_cant({{ $pro->id }})">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    @can('order.store')
                                                        <form action="{{ route('order.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="product"
                                                                value="{{ $products['para'] }}">
                                                            <input type="hidden" name="id" value="{{ $pro->id }}">
                                                            <input type="hidden" name="cant"
                                                                id="cantidad{{ $pro->id }}" value="1">
                                                            <input type="submit" name="add" class="btn btn-outline-success"
                                                                value="Agregar">
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-3">
                                        <div class="card sombra" style="margin-bottom: 20px; height: auto;">
                                            <img src="{{ str_replace('\\', '/', '../storage/' . $pro->product->img) }}"
                                                alt="producto" class="card-img-top mx-auto"
                                                style="height: 150px; width: 150px;display: block;"
                                                alt="{{ $pro->product->img }}">
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $pro->product->name }}</h6>
                                                <div class="col-12">
                                                    <p class="-b-expander -b-text-undexpanded">
                                                        {{ $pro->product->description }}
                                                    </p>

                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <p>${{ $pro->price }}</p>
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="input-group">
                                                                <strong>{{ 'Cant:' }}</strong>&nbsp;&nbsp;<input
                                                                    type="number" id="cant{{ $pro->product->id }}"
                                                                    min="1" class="form-control" value="1"
                                                                    onchange="add_cant({{ $pro->product->id }})">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    @can('order.store')
                                                        <form action="{{ route('order.store') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="inventary"
                                                                value="{{ $products['para'] }}">
                                                            <input type="hidden" name="id"
                                                                value="{{ $pro->product->id }}">
                                                            <input type="hidden" name="cant"
                                                                id="cantidad{{ $pro->product->id }}" value="1">
                                                            <input type="submit" name="add" class="btn btn-outline-success"
                                                                value="Agregar">
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script>
        document.querySelectorAll(".-b-expander").forEach(function(el) {
            el.addEventListener("click", () => {
                el.classList.toggle("-b-text-undexpanded");
            });
        });

        function add_cant(id) {
            var cant = document.getElementById("cant" + id).value;
            $('#cantidad' + id).val(cant);
        }
    </script>
@endsection
