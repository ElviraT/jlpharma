@extends('layouts_new.base')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ 'Producto - Categorías' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            @foreach ($categorias as $item)
                                <a href="{{ url('./order/products/' . $item->id . '/null') }}" class="btn"
                                    onclick="loading_show()">
                                    <div class="col-12 mb-3" style="border: 2px solid {{ $item->color }}; padding: 25px;"
                                        align="left">
                                        <div class="row">
                                            <div class="col-8">
                                                {{ $item->name }}
                                            </div>

                                            <div class="col-4" style="display: flex;justify-content: flex-end;">
                                                <i class="ri-arrow-right-s-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        {{ $categorias->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
