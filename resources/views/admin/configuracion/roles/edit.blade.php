@extends('layouts_new.base')
@section('css')
    @include('admin.configuracion.roles.css.css')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra">
                    {!! Form::model($role, ['route' => ['roles.update', $role], 'method' => 'put', 'autocomplete' => 'off']) !!}
                    @include('admin.configuracion.roles.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('admin.configuracion.roles.js.js')
@endsection
