@extends('layouts_new.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card sombra p-2">
                    <div class="row">
                        <div class="col-md-11">
                            <h3>{{ __('Todas las solicitudes pendientes') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="card sombra p-2">
                    @if (count($solicitudes) == 0)
                        <br>
                        <p class="text-center">{{ __('No matching records found') }}</p>
                    @else
                        <div class="col-md-12 mt-3">
                            <table id="AllDataTable" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ 'De' }}</th>
                                        <th>{{ 'Para' }}</th>
                                        <th>{{ 'Fecha' }}</th>
                                        <th>{{ 'Acción' }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $item)
                                        <tr>
                                            <td>{{ $item->userPharmacy->name }}</td>
                                            <td>{{ $item->userDrugstore->name }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target=".bd-example-modal-sm" data-record-id="{{ $item->id }}"
                                                    data-record-title="{{ 'Aceptar la solicitud de ' }}{{ $item->userPharmacy->name }}"
                                                    title="{{ __('Aceptar solicitud') }}">
                                                    <i class="ri-checkbox-line"></i>
                                                </button> &nbsp;&nbsp;
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target=".bd-example-rechazo-sm"
                                                    data-record-id="{{ $item->id }}"
                                                    data-record-title="{{ 'Rechazar la solicitud de ' }}{{ $item->userPharmacy->name }}"
                                                    title="{{ __('Rechazar solicitud') }}">
                                                    <i class="ri-close-line"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $solicitudes->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @include('aceptar_modal')
    @include('rechazar_modal')
@endsection
@section('js')
    <script>
        $('#confirm-aceptar').on('show.bs.modal', function(e) {
            var modal = $(e.delegateTarget),
                data = $(e.relatedTarget).data();
            modal.addClass('loading');
            $('#id', modal).val(data.recordId);
            $('.title', this).text(data.recordTitle);
            modal.removeClass('loading');
        });

        $('#confirm-rechazar').on('show.bs.modal', function(e) {
            var modal = $(e.delegateTarget),
                data = $(e.relatedTarget).data();
            modal.addClass('loading');
            $('#id', modal).val(data.recordId);
            $('.title', this).text(data.recordTitle);
            modal.removeClass('loading');
        });
    </script>
@endsection
