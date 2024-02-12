@extends('layouts_new.base')

@section('css')
    @include('admin.configuracion.usuarios.pharmacy.css.css')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="page-header-title">
            <h5 class="m-b-10">{{ 'Editar Centro de Salud: ' }}{{ $pharmacy->name }}</h5>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-3">
                    <form action="{{ route('pharmacy.update', $pharmacy) }}" method="POST">
                        @method('PUT')
                        @include('admin.configuracion.usuarios.pharmacy.fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.configuracion.usuarios.pharmacy.js.js')
    <script>
        $('#check').attr('hidden', false);
    </script>
@endsection
