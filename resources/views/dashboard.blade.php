@extends('layouts_new.base')


@section('content')
    {{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card sombra">
                <div class="card-body border-top">
                    <div class="row mb-0">
                        <!-- col -->
                        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                            <div class="d-flex align-items-center sombra" style="border: 1px solid orange;">
                                <div class="me-2">
                                    <span class="text-orange display-5"><i class="ri-stethoscope-fill"></i></span>
                                </div>
                                <div>
                                    <span>{{ __('Registered Medical') }}</span>
                                    <h3 class="font-medium mb-0">20</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                            <div class="d-flex align-items-center sombra" style="border: 1px solid cyan;">
                                <div class="me-2">
                                    <span class="text-cyan display-5"><i class="ri-team-line"></i></span>
                                </div>
                                <div>
                                    <span>{{ __('Registered Patients') }}</span>
                                    <h3 class="font-medium mb-0">50</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6 mb-3 mb-md-0">
                            <div class="d-flex align-items-center sombra" style="border: 1px solid green; ">
                                <div class="me-2">
                                    <span class="text-green display-5"><i class="ri-health-book-line"></i></span>
                                </div>
                                <div>
                                    <span>{{ __('Consultations of the month') }}</span>
                                    <h3 class="font-medium mb-0">5489</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-lg-3 col-md-6">
                            <div class="d-flex align-items-center sombra" style="border: 1px solid blue;">
                                <div class="me-2">
                                    <span class="text-primary display-5"><i class="ri-hospital-line"></i></span>
                                </div>
                                <div>
                                    <span>{{ __('Consulting room') }}</span>
                                    <h3 class="font-medium mb-0">50</h3>
                                </div>
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 margin-tb">
            <div class="card sombra">
                @if (isset($diff) && auth()->user()->id_usuarioP != null)
                    <div class="card" align="center">
                        @if ($diff->invert == 1)
                            <h2>{{ 'Su última cita programada ya pasó' }}</h2>
                        @else
                            <h2>{{ 'Faltan' }}&nbsp;{{ $diff->days }}&nbsp;{{ 'para su cita' }}</h2>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-6 margin-tb">
            <div class="card sombra p-3">
                <h3>{{ __('Appointments of the day') }}</h3>
                <hr>
            </div>
        </div>
    </div> --}}
@endsection
