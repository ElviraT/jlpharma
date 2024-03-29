<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Mirrored from demos.wrappixel.com/premium-admin-templates/bootstrap/xtreme-bootstrap/package/html/ltr/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Sep 2023 20:41:05 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, xtreme admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, material design, material dashboard bootstrap 5 dashboard template" />
    <meta name="description"
        content="Xtreme is powerful and clean admin dashboard template, inpired from Google's Material Design" />
    <meta name="robots" content="noindex,nofollow" />
    <link rel="stylesheet" href="{{ asset('css/flag-icons.min.css') }}" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}" />
    <!-- Custom CSS -->
    <link href="{{ asset('css/remixicon.css') }}" rel="stylesheet">
    <!--Datatable-->
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    {{-- rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <!-- Loading -->
    <link href="{{ asset('css/jquery.loadingModal.css') }}" rel="stylesheet" type="text/css" />

    @yield('css')
</head>

<body>
    <!-- -------------------------------------------------------------- -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- -------------------------------------------------------------- -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
                stroke=" #049383 " stroke-width="2"></path>
            <path
                d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
                stroke=" #049383 " stroke-width="2"></path>
            <path id="teabag" fill=" #049383 " fill-rule="evenodd" clip-rule="evenodd"
                d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z">
            </path>
            <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" stroke=" #049383 "></path>
            <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke=" #049383 "
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>

    <div id="main-wrapper">
        @include('layouts_new.header')
        @include('layouts_new.menu_left')
        <div class="page-wrapper">
            <div class="col-12 p-2">
                <div class="row saludo">
                    <div class="col-lg-8 col-sm-12">
                        <span id="saludo">
                            <strong>{{ auth()->user()->name }}</strong>{{ __('Current Time') }}<span
                                id="relojnumerico" class="reloj" onload="cargarReloj()">
                                <!-- Acá mostraremos el reloj desde JavaScript -->
                            </span>
                        </span>
                    </div>
                    <div class="col-lg-4 col-sm-12" align="right">
                        <span><strong>{{ ' Tasa del día: ' }}</strong>{{ session('rate') }}</span>
                    </div>
                </div>
            </div>
            {{-- migas de pan --}}
            <!-- Container fluid  -->
            <!-- -------------------------------------------------------------- -->
            <div class="container-fluid">
                @yield('content')
                @yield('modal')
            </div>
            <!-- footer -->
            <!-- -------------------------------------------------------------- -->
            @include('layouts_new.footer')
            <!-- -------------------------------------------------------------- -->
            <!-- End footer -->
            <!-- -------------------------------------------------------------- -->


        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Page wrapper  -->
        <!-- -------------------------------------------------------------- -->
    </div>
    {{-- <div class="chat-windows"></div> --}}
    <!-- -------------------------------------------------------------- -->
    <!-- Required Js files -->
    <!-- -------------------------------------------------------------- -->
    <script src="{{ asset('js_new/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('js_new/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js') }} "></script>
    <!-- Theme Required Js -->
    <script src="{{ asset('js_new/app.min.js') }}"></script>
    <script src="{{ asset('js_new/app.init.js') }}"></script>
    <script src="{{ asset('js_new/switcher.js') }}"></script>
    <!-- perfect scrollbar JavaScript -->
    <script src="{{ asset('js_new/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('js_new/sparkline.min.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js_new/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js_new/feather.min.js') }}"></script>
    <script src="{{ asset('js_new/custom.min.js') }}"></script>
    {{-- datatable --}}
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <!-- Loading -->
    <script src="{{ asset('js/jquery.loadingModal.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js_new/toastr.min.js') }}"></script>
    <script src="{{ asset('js_new/bootstrap-toggle.min.js') }}"></script>
    {!! Toastr::message() !!}
    @include('layouts_new.funciones')
    @yield('js')
</body>

</html>
