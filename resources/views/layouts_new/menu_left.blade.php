<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" style="overflow-y:auto !important;" id="menu">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown mt-3">
                        <div class="user-pic">
                            <img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" alt="users"
                                class="rounded-circle" width="50" />
                        </div>
                        <div class="user-content hide-menu ms-2">
                            <a href="#" class="" id="Userdd" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 user-name font-medium">
                                    {{ auth()->user()->name }}
                                    <i data-feather="chevron-down" class="feather-sm"></i>
                                </h5>
                                <span class="op-5 user-email">{{ auth()->user()->email }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Userdd">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i data-feather="user"
                                        class="feather-sm text-info me-1"></i> {{ __('es.My_Profile') }}</a>
                                <a class="dropdown-item" href="#"><i data-feather="credit-card"
                                        class="feather-sm text-primary me-1"></i> My
                                    Balance</a>
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
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->
                <li class="sidebar-item {{ @request()->routeIs('dashboard') ? 'active' : ' ' }}">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">{{ __('Dashboard') }}</span></a>
                </li>
                @canany(['order.index', 'order.state', 'request.index'])
                    <li class="nav-small-cap">
                        <i data-feather="more-horizontal" class="feather-icon"></i>
                        <span class="hide-menu">{{ __('menu.Order') }}</span>
                    </li>
                    @can('request.index')
                        <li class="sidebar-item {{ @request()->routeIs('request.index') ? 'active' : ' ' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('request.index') }}"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">{{ 'Solicitar Permiso' }}</span></a>
                        </li>
                    @endcan
                    @can('order.index')
                        <li class="sidebar-item {{ @request()->routeIs('order') ? 'active' : ' ' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('order.index') }}"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">{{ 'Realizar Pedido' }}</span></a>
                        </li>
                    @endcan
                    @can('order.state')
                        <li class="sidebar-item {{ @request()->routeIs('order.state') ? 'active' : ' ' }}">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('order.state') }}"
                                aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                    class="hide-menu">{{ 'Estado de Pedido' }}</span></a>
                        </li>
                    @endcan

                @endcanany
                <li class="nav-small-cap">
                    <i data-feather="more-horizontal" class="feather-icon"></i>
                    <span class="hide-menu">{{ __('menu.Configuration') }}</span>
                </li>
                @canany(['roles.index'])
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark {{ @request()->routeIs('roles*') || @request()->routeIs('limits.*') ? 'active' : ' ' }}"
                            href="#" aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                class="hide-menu">{{ __('menu.Sistem') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @can('roles.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('roles.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('roles*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Role') }} </span></a>
                                </li>
                            @endcan
                            {{-- <li class="sidebar-item">
                            <a href="https://demos.wrappixel.com/premium-admin-templates/bootstrap/xtreme-bootstrap/package/html/ltr/sidebar-type-overlaysidebar.html"
                                class="sidebar-link"><i class="mdi mdi-view-day"></i><span class="hide-menu"> Overlay
                                    Sidebar </span></a>
                        </li> --}}
                        </ul>
                    </li>
                @endcanany
                @canany(['prefixes.index', 'sexes.index', 'maritalStatus.index', 'status.index', 'statusp.index'])
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark {{ @request()->routeIs('prefix*') || @request()->routeIs('sexes*') || @request()->routeIs('status*') || @request()->routeIs('maritalStatus*') ? 'active' : ' ' }}"
                            href="#" aria-expanded="false"><i data-feather="arrow-down-circle"
                                class="feather-icon"></i><span class="hide-menu">{{ __('Combos') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @can('status.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('status.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('status*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Status') }} </span></a>
                                </li>
                            @endcan
                            @can('statusp.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('statusp.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('statusp*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ 'Status de Pedidos' }} </span></a>
                                </li>
                            @endcan
                            @can('prefixes.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('prefixes.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('prefixes*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Prefix') }} </span></a>
                                </li>
                            @endcan
                            @can('sexes.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('sexes.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('sexes*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Sex') }} </span></a>
                                </li>
                            @endcan
                            @can('maritalStatus.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('maritalStatus.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('maritalStatus*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Marital Status') }} </span></a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['countries.index', 'states.index', 'cities.index', 'municipality.index', 'parishes.index',
                    'zones.index'])
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark {{ @request()->routeIs('countries*') || @request()->routeIs('states*') || @request()->routeIs('cities*') || @request()->routeIs('municipality*') || @request()->routeIs('parishes*') || @request()->routeIs('zones*') ? 'active' : ' ' }}"
                            href="#" aria-expanded="false"><i data-feather="map-pin"
                                class="feather-icon"></i><span class="hide-menu">{{ __('menu.Direction') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @can('countries.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('countries.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('countries*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Country') }} </span></a>
                                </li>
                            @endcan
                            @can('states.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('states.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('states*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.State') }} </span></a>
                                </li>
                            @endcan
                            @can('cities.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('cities.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('cities*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.City') }} </span></a>
                                </li>
                            @endcan
                            @can('municipality.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('municipality.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('municipality*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Municipality') }} </span></a>
                                </li>
                            @endcan
                            {{-- @can('parishes.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('parishes.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('parishes*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Parish') }} </span></a>
                                </li>
                            @endcan --}}
                            @can('zones.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('zones.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('zones*') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Zone') }} </span></a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['pharmacy.index', 'drugstore.index', 'jluser.index', 'seller.index'])
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark {{ @request()->routeIs('pharmacy') || @request()->routeIs('pharmacy.create') ? 'active' : ' ' }}"
                            href="#" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
                                class="hide-menu">{{ __('Usuarios') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @can('pharmacy.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('pharmacy.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('pharmacy') || @request()->routeIs('pharmacy.create') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Pharmacy') }} </span></a>
                                </li>
                            @endcan
                            @can('drugstore.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('drugstore.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('drugstore') || @request()->routeIs('drugstore.create') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Drugstore') }} </span></a>
                                </li>
                            @endcan
                            @can('jluser.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('jluser.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('jluser') || @request()->routeIs('jluser.create') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Jluser') }} </span></a>
                                </li>
                            @endcan
                            @can('seller.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('seller.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('seller') || @request()->routeIs('seller.create') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Seller') }} </span></a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                @canany(['category.index', 'speciality.index', 'product.index', 'mis_productos.index', 'mark.index'])
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark {{ @request()->routeIs('category') || @request()->routeIs('speciality') ? 'active' : ' ' }}"
                            href="#" aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span
                                class="hide-menu">{{ __('Configuración Productos') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            @can('speciality.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('speciality.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('speciality') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Speciality') }} </span></a>
                                </li>
                            @endcan
                            @can('category.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('category.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('category') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Category') }} </span></a>
                                </li>
                            @endcan
                            @can('mark.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('mark.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('mark') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Mark') }} </span></a>
                                </li>
                            @endcan
                            @can('product.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('product.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('product') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Product') }} </span></a>
                                </li>
                            @endcan
                            @can('mis_productos.index')
                                <li class="sidebar-item">
                                    <a href="{{ route('mis_productos.index') }}"
                                        class="sidebar-link {{ @request()->routeIs('mis_productos') ? 'active' : ' ' }}"><i
                                            class="ri-arrow-right-s-line"></i><span class="hide-menu">
                                            {{ __('menu.Product') }} </span></a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                <li class="sidebar-item">
                    <a class="dropdown-item"
                        href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>
                        {{ __('es.Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
