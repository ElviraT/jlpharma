@extends('layouts_new.base')

@section('content')
    <div class="row">
        @role(['SuperAdmin', 'JL', 'Vendedor'])
            <div class="col-lg-12 margin-tb">
                <div class="card sombra">
                    <div class="card-body border-top">
                        <div class="row mb-0">
                            <!-- col -->
                            @foreach ($pedidos as $item)
                                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                                    <div class="d-flex align-items-center sombra p-3"
                                        style="background-color: {{ $item->color }}; justify-content: flex-end;">
                                        <div align="right">
                                            <h3 class="font-medium mb-0 text-white">{{ $item->count }}</h3>
                                            <span class="text-white">{{ $item->name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12 sombra" style="border: 1px solid {{ $item->color }}">
                                        <a href="{{ route('order.state', $item->id) }}" class="btn btn-outline-ligth"
                                            onclick="loading_show()">{{ 'Ver detalle' }}</a>
                                    </div>
                                </div>
                            @endforeach
                            <!-- col -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 margin-tb">
                    <div class="card sombra">
                        <div class="card-body border-top">
                            <div class="row mb-0">
                                @foreach ($user as $item2)
                                    <div class="col-lg-4 col-md-6 mb-2 mb-lg-3">
                                        <div class="col-12 sombra p-3" style="border: 2px solid #043484;">
                                            <div class="row">
                                                <div class="col-3 me-2">
                                                    <span class="display-5"><i class="ri-account-circle-line"></i></span>
                                                </div>
                                                <div class="col-7" align="right">
                                                    <h3 class="font-medium mb-0">{{ $item2->count }}</h3>
                                                    <span>{{ $item2->last_name }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        {{-- <div class="col-lg-12 margin-tb">
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
                                        @if (isset($item->user->seller->name))
                                            {{ 'Vendedor: ' }} {{ $item->user->seller->name }}
                                        @else
                                            {{ 'Realizado por: ' }} {{ $item->user->name }}
                                        @endif
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
        </div> --}}
        @role(['Drogueria', 'Vendedor', 'SuperAdmin'])
            <div class="col-lg-8 col-sm-12 margin-tb">
                <div class="card sombra p-3">
                    <h3>{{ 'Solicitud de Permisos' }}</h3>
                    <hr>
                    <div class="table-responsive">
                        <table id="DashboardTable" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>{{ 'De' }}</th>
                                    <th>{{ 'Para' }}</th>
                                    <th>{{ 'Fecha' }}</th>
                                    <th>{{ 'Acción' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($solicitudes as $item)
                                    <tr>
                                        <td>{{ $item->userPharmacy->name }}</td>
                                        <td>{{ $item->userDrugstore->name }}</td>
                                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                        <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target=".bd-example-modal-sm" data-record-id="{{ $item->id }}"
                                                data-record-title="{{ 'Aceptar la solicitud de ' }}{{ $item->userPharmacy->name }}"
                                                title="{{ __('Aceptar solicitud') }}">
                                                <i class="ri-checkbox-line"></i>
                                            </button> &nbsp;
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target=".bd-example-rechazo-sm" data-record-id="{{ $item->id }}"
                                                data-record-title="{{ 'Rechazar la solicitud de ' }}{{ $item->userPharmacy->name }}"
                                                title="{{ __('Rechazar solicitud') }}">
                                                <i class="ri-close-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">{{ __('No data found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            <a class="theme-link font-14 font-medium d-flex align-items-center justify-content-center mt-20"
                                href="{{ route('request.all') }}">
                                {{ __('View All') }}<i class="ri-arrow-right-line ms-2"></i>
                            </a>
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
