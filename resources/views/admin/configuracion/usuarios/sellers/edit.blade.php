@extends('layouts_new.base')

@section('css')
    @include('admin.configuracion.usuarios.sellers.css.css')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">{{ 'Editar Vendedor: ' }}{{ $seller->name }}</h5>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-3">
                    <form action="{{ route('seller.update', $seller) }}" method="POST">
                        @method('PUT')
                        @include('admin.configuracion.usuarios.sellers.fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.configuracion.usuarios.sellers.js.js')
    <script>
        $('#check').attr('hidden', false);
    </script>
@endsection
