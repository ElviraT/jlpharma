@extends('layouts_new.base')

@section('css')
    @include('admin.configuracion.usuarios.sellers.css.css')
    <!-- selectize -->
    <link href="{{ asset('css/selectize.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">{{ 'Nuevo ' }}{{ __('menu.Seller') }}</h5>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-3">
                    <form action="{{ route('seller.store') }}" method="POST">
                        @include('admin.configuracion.usuarios.sellers.fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.configuracion.usuarios.sellers.js.js')
@endsection
