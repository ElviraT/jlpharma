@extends('layouts_new.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ 'Pedidos - Estado' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    <div class="col-md-12 mt-3">
                        <table id="AllDataTable" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="40%">{{ __('Número de Orden') }}</th>
                                    <th width="20%">{{ __('Para') }}</th>
                                    <th width="20%">{{ __('Total') }}</th>
                                    <th width="20%">{{ __('Estado') }}</th>
                                    <th width="20%">{{ __('Observación') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $resultado)
                                    <tr>
                                        <td>{{ $resultado->nOrder }}</td>
                                        <td>{{ $resultado->userReceives->name }}</td>
                                        <td>{{ number_format($resultado->total, 2) }}</td>
                                        <td style="background-color: {{ $resultado->status->color }}; color: #fff">
                                            {{ $resultado->status->name }}</td>
                                        @if (@isset($resultado->observation))
                                            <td>{{ $resultado->observation }}</td>
                                        @else
                                            <td>{{ 'NINGUNA' }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('order.aceptar_modal')
@endsection
@section('js')
    @include('order.js.js')
@endsection
