<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ri-close-line fs-6 ri-menu-2-line"></i>
            </a>
            <!-- -------------------------------------------------------------- -->
            <!-- Logo -->
            <!-- -------------------------------------------------------------- -->
            <a class="navbar-brand" href="#">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('img/favicon.png') }}" alt="homepage" class="dark-logo" width="50" />
                    <!-- Light Logo icon -->
                    <img src="{{ asset('img/favicon.png') }}" alt="homepage" class="light-logo" width="50" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="{{ asset('img/icon-logo.png') }}" alt="homepage" class="dark-logo" width="150" />
                    <!-- Light Logo text -->
                    <img src="{{ asset('img/icon-logo.png') }}" alt="homepage" class="light-logo" width="50" />
                </span>
            </a>
            <!-- -------------------------------------------------------------- -->
            <!-- End Logo -->
            <!-- -------------------------------------------------------------- -->
            <!-- -------------------------------------------------------------- -->
            <!-- Toggle which is visible on mobile only -->
            <!-- -------------------------------------------------------------- -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ri-more-line fs-6"></i></a>
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Logo -->
        <!-- -------------------------------------------------------------- -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <div class="col-12">
                <div class="row">
                    <div class="col-8">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                    data-sidebartype="mini-sidebar"><i data-feather="menu" class="feather-sm"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.checkout') }}">{{ 'Carrito' }}&nbsp; <span
                                        class="badge bg-danger">{{ \Cart::count() }}</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fi fi-es"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animate-up"
                                    aria-labelledby="navbarDropdown2">
                                    <a class="dropdown-item" href="{{ url('/lang/es') }}">
                                        <span class="fi fi-es"></span>
                                        {{ __('es.Spanish') }}</a>
                                    <a class="dropdown-item" href="{{ url('/lang/en') }}">
                                        <span class="fi fi-us"></span>
                                        {{ __('es.English') }}</a>
                                    <a class="dropdown-item" href="#">
                                        <span class="fi fi-fr"></span>
                                        {{ __('es.French') }}</a>
                                    <a class="dropdown-item" href="#">
                                        <span class="fi fi-de"></span>
                                        {{ __('es.German') }}</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                    href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"><img
                                        src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" alt="user"
                                        class="rounded-circle" width="31" /></a>
                                <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                                    <span class="with-arrow"><span class="bg-primary"></span></span>
                                    <div class="d-flex no-block align-items-center p-1 bg-primary text-white mb-2">
                                        <div class="">
                                            <img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}"
                                                alt="user" class="rounded-circle" width="60" />
                                        </div>
                                        <div class="ms-2">
                                            <h4 class="mb-0">{{ auth()->user()->name }}</h4>
                                            <p class="mb-0">{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="#"><i data-feather="user"
                                            class="feather-sm text-info me-1 ms-1"></i> {{ __('es.My_Profile') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                        href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>
                                        {{ __('es.Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
