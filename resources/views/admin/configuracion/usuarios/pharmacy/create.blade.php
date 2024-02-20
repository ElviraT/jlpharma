@extends('layouts_new.base')

@section('css')
    @include('admin.configuracion.usuarios.pharmacy.css.css')
    <!-- selectize -->
    <link href="{{ asset('css/selectize.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-3">
                    <form action="{{ route('pharmacy.store') }}" method="POST">
                        @include('admin.configuracion.usuarios.pharmacy.fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.configuracion.usuarios.pharmacy.js.js')
@endsection
