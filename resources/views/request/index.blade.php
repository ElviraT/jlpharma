@extends('layouts_new.base')
@section('css')
    <link href="{{ asset('css/selectize.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="col-md-12 mb-3">
                        <h3>{{ 'Solicitar Permiso' }}</h3>
                    </div>
                    <div class="col-md-12 p-2">

                        <form action="{{ route('request.store') }}" method="post">
                            @csrf
                            <div class="row">
                                @if (Auth::user()->hasAnyRole('Vendedor', 'SuperAdmin'))
                                    <div class="col-md-6 mb-3">
                                        <label for="zona">{{ __('menu.Pharmacy') }}</label>
                                        {!! Form::select('idPharmacy', $pharmacies, Auth::user()->id, [
                                            'placeholder' => 'Seleccione',
                                            'class' => 'otro',
                                            'id' => 'idPharmacy',
                                        ]) !!}
                                    </div>
                                @else
                                    <input type="hidden" name="idPharmacy" value="{{ Auth::user()->id }}">
                                @endif
                                <div class="col-md-6 mb-3">
                                    <label for="zona">{{ 'Droguerías' }}</label>
                                    {!! Form::select('idDrugstore', $drugstore, null, [
                                        'placeholder' => 'Seleccione',
                                        'class' => 'otro',
                                        'id' => 'idDrugstore',
                                        'required' => 'required',
                                    ]) !!}
                                </div>
                                <div class="col-md-6 mb-3 mt-4">
                                    <button type="submit" class="btn btn-primary">{{ 'Enviar Solicitud' }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/selectize.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(function() {
            $('.otro').selectize({
                preload: true,
                loadingClass: 'loading',
                closeAfterSelect: true
            });
        });
    </script>
@endsection
