@extends('layouts_new.base')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card sombra">
                <div class="card-body border-top">
                    <div class="row mb-0">
                        <!-- col -->
                        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                            <div class="d-flex align-items-center sombra" style="border: 1px solid #04c38c;">
                                <div class="me-2">
                                    <span class="text-pedido display-5"><i class="ri-file-fill"></i></span>
                                </div>
                                <div>
                                    <span>{{ __('Orders Total') }}</span>
                                    <h3 class="font-medium mb-0">{{ count($pedidos) }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        @role(['SuperAdmin', 'JL'])
                            <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                <div class="d-flex align-items-center sombra" style="border: 1px solid cyan;">
                                    <div class="me-2">
                                        <span class="text-cyan display-5"><i class="ri-team-line"></i></span>
                                    </div>
                                    <div>
                                        <span>{{ __('Registered Users') }}</span>
                                        <h3 class="font-medium mb-0">{{ count($user) }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endrole
                        <!-- col -->
                        <!-- col -->
                        @role(['Drogueria', 'SueperAdmin'])
                            <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                <div class="d-flex align-items-center sombra" style="border: 1px solid #f4ec65;">
                                    <div class="me-2">
                                        <span class="text-solicitud display-5"><i class="ri-list-check-2"></i></span>
                                    </div>
                                    <div>
                                        <span>{{ 'Solicitud de Permiso' }}</span>
                                        <h3 class="font-medium mb-0">{{ count($solicitud) }}</h3>
                                    </div>
                                </div>
                            </div>
                        @endrole
                        <!-- col -->
                        <!-- col -->
                        {{-- <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center sombra" style="border: 1px solid blue;">
                                <div class="me-2">
                                    <span class="text-primary display-5"><i class="ri-hospital-line"></i></span>
                                </div>
                                <div>
                                    <span>{{ __('Consulting room') }}</span>
                                    <h3 class="font-medium mb-0">50</h3>
                                </div>
                            </div>
                        </div> --}}
                        <!-- col -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 margin-tb">
            <div class="card sombra p-3">
                <h3>{{ __('List Order') }}</h3>
                <hr>
                <div class="col-12">
                    <div class="row">
                        @foreach ($pedidos as $item)
                            <div class="col-lg-3">
                                <div class="card pedido sombra">
                                    <div class="card-header primary">
                                        {{ 'De: ' }} {{ $item->userSend->name }}<br>
                                        {{ 'Para: ' }} {{ $item->userReceives->name }}
                                    </div>
                                    <div class="card-body">
                                        <strong> {{ 'Pedido No: ' }}</strong> {{ $item->nOrder }}<br>
                                        <strong> {{ 'Total: ' }} </strong>
                                        {{ number_format($item->total, 2) }}{{ '$' }}
                                    </div>
                                    <div class="card-footer" align="center">
                                        <a href="{{ route('order.detalle', $item) }}"
                                            class="btn btn-info">{{ 'Ver detalle' }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $pedidos->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
        @role(['Drogueria', 'Vendedor', 'SuperAdmin'])
            <div class="col-lg-12 margin-tb">
                <div class="card sombra p-3">
                    <h3>{{ 'Solicitud de Permisos' }}</h3>
                    <hr>
                    <div class="col-12">
                        <div class="row">
                            @foreach ($solicitud as $result)
                                <div class="col-lg-3">
                                    <div class="card warning sombra">
                                        <div class="card-body" align="center">
                                            <br>
                                            <h4>{{ 'De: ' . $result->userPharmacy->name }}</h4>
                                            <h4>{{ 'Para: ' . $result->userDrugstore->name }}</h4>
                                        </div>
                                        <div class="card-footer" align="center">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target=".bd-example-modal-sm" data-record-id="{{ $result->id }}"
                                                data-record-title="{{ 'Aceptar la solicitud de ' }}{{ $result->userPharmacy->name }}">
                                                {{ 'Aceptar' }}
                                            </button> &nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target=".bd-example-rechazo-sm" data-record-id="{{ $result->id }}"
                                                data-record-title="{{ 'Rechazar la solicitud de ' }}{{ $result->userPharmacy->name }}">
                                                {{ 'Rechazar' }}
                                            </button> &nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $solicitud->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        @endrole
    </div>
@endsection
@section('modal')
    @include('aceptar_modal')
    @include('rechazar_modal')
@endsection
@section('js')
    @include('js.js')
@endsection
