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
                            @role(['SuperAdmin', 'Vendedor'])
                                <form action="{{ route('order.filtro') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12">
                                            <legend>DE:</legend>
                                            <fieldset>
                                                <label>
                                                    <input type="radio" name="de" value="Farmacia"> Farmacia
                                                </label>
                                                <label>
                                                    <input type="radio" name="de" value="Droguería"> Droguería
                                                </label>
                                            </fieldset>
                                            <select id="idDe" name="idDe" class="form-control" required></select>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <fieldset>
                                                <legend>PARA:</legend>
                                                <label>
                                                    <input type="radio" name="para" value="Droguería"> Droguería
                                                </label>
                                                <label>
                                                    <input type="radio" name="para" value="JL"> JL
                                                </label>
                                            </fieldset>
                                            <select id="idPara" name="idPara" class="form-control" readonly></select>

                                        </div>
                                        <div class="col-4 mt-5">
                                            <button type="submit" class="btn btn-primary mt-3">{{ 'Enviar' }}</button>
                                        </div>
                                    </div>
                                </form>
                            @endrole
                            @role(['Drogueria', 'Farmacia'])
                                <form action="{{ route('order.filtro') }}" method="POST">
                                    @csrf
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-8">
                                                <h4>PARA:</h4>
                                                {!! Form::select('idPara', $combo, null, [
                                                    'placeholder' => 'Seleccione',
                                                    'class' => 'select form-control',
                                                    'id' => 'idPara',
                                                ]) !!}
                                            </div>
                                            <div class="col-4 mt-4">
                                                <button type="submit" class="btn btn-primary mt-1">{{ 'Enviar' }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('order.js.js')
@endsection
