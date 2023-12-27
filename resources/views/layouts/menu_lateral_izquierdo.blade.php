<nav class="pcoded-navbar">
    <div class="sidebar_toggle">
        <a href="#">
            <i class="icon-close icons"></i>
        </a>
    </div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius"
                    @if (isset($foto->Foto_Medico) && $foto->Foto_Medico == '') src="{{ 'avatars/' . str_replace('\\', '/', $foto->Foto_Medico) }}"  @else src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" @endif
                    alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{ auth()->user()->name }}</i></span>
                </div>
            </div>
        </div>
        <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">{{ 'Inicio' }}
        </div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ @request()->routeIs('home') ? 'active' : ' ' }}">
                <a href="{{ route('home') }}" onclick="loading_show();" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigation-label" data-i18n="nav.category.forms">{{ 'Registros' }}
        </div>
        @can(['user-list'])
            <ul class="pcoded-item pcoded-left-item">
                <li
                    class="{{ @request()->routeIs('roles*') ||@request()->routeIs('pais') ||@request()->routeIs('estado') ||@request()->routeIs('ciudad') ||@request()->routeIs('municipio') ||@request()->routeIs('parroquia') ||@request()->routeIs('usuario_m*') ||@request()->routeIs('prefijo') ||@request()->routeIs('sexo') ||@request()->routeIs('civil') ||@request()->routeIs('status_m') ||@request()->routeIs('status_c') ||@request()->routeIs('status_f') ||@request()->routeIs('status_t') ||@request()->routeIs('status') ||@request()->routeIs('usuario_a*') ||@request()->routeIs('usuario_p*') ||@request()->routeIs('usuario_pe*') ||@request()->routeIs('usuario_g*') ||@request()->routeIs('banco') ||@request()->routeIs('tipoC') ||@request()->routeIs('cuentaUSD') ||@request()->routeIs('entidad') ||@request()->routeIs('cripto') ||@request()->routeIs('billetera') ||@request()->routeIs('cuenta_banco') ||@request()->routeIs('especialidad') ||@request()->routeIs('controlE') ||@request()->routeIs('consultorio') ||@request()->routeIs('tpago')? 'active pcoded-hasmenu pcoded-trigger': 'pcoded-hasmenu' }} ">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-settings"></i><b>C</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.menu-levels.main">{{ 'Configuración' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        @can('role-list')
                            <li class="{{ @request()->routeIs('roles*') ? 'active' : ' ' }}">
                                <a href="{{ route('roles.index') }}" onclick="loading_show();" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-id-badge"></i><b>R</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Roles' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        @endcan
                        @canany(['pais', 'estado', 'ciudad', 'municipio', 'parroquia'])
                            <li
                                class="{{ @request()->routeIs('pais') || @request()->routeIs('estado') || @request()->routeIs('ciudad') || @request()->routeIs('municipio') || @request()->routeIs('parroquia') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.menu-levels.menu-level-22.main">{{ 'Dirección' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul
                                    class="{{ @request()->routeIs('pais') || @request()->routeIs('estado') || @request()->routeIs('ciudad') || @request()->routeIs('municipio') || @request()->routeIs('parroquia') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                                    @can('pais')
                                        <li class="{{ @request()->routeIs('pais') ? 'active' : '' }}">
                                            <a href="{{ route('pais') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'País' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('estado')
                                        <li class="{{ @request()->routeIs('estado') ? 'active' : '' }}">
                                            <a href="{{ route('estado') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Estado' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('ciudad')
                                        <li class="{{ @request()->routeIs('ciudad') ? 'active' : '' }}">
                                            <a href="{{ route('ciudad') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Ciudad' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('municipio')
                                        <li class="{{ @request()->routeIs('municipio') ? 'active' : '' }}">
                                            <a href="{{ route('municipio') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Municipio' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('parroquia')
                                        <li class="{{ @request()->routeIs('parroquia') ? 'active' : '' }}">
                                            <a href="{{ route('parroquia') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Parroquia' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['prefijo', 'sexo', 'civil'])
                            <li
                                class="{{ @request()->routeIs('prefijo') || @request()->routeIs('sexo') || @request()->routeIs('civil') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.menu-levels.menu-level-22.main">{{ 'Config. Personas' }}</span>&nbsp;
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul
                                    class="{{ @request()->routeIs('prefijo') || @request()->routeIs('sexo') || @request()->routeIs('civil') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                                    @can('prefijo')
                                        <li class="{{ @request()->routeIs('prefijo') ? 'active' : ' ' }}">
                                            <a href="{{ route('prefijo') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-id-badge"></i><b>P</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Prefijo DNI' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('sexo')
                                        <li class="{{ @request()->routeIs('sexo') ? 'active' : ' ' }}">
                                            <a href="{{ route('sexo') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>S</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Sexo' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('civil')
                                        <li class="{{ @request()->routeIs('civil') ? 'active' : ' ' }}">
                                            <a href="{{ route('civil') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>EC</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Estado Civil' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['status_m', 'status_c', 'status_f', 'status_t', 'status'])
                            <li
                                class="{{ @request()->routeIs('status_m') || @request()->routeIs('status_c') || @request()->routeIs('status_f') || @request()->routeIs('status_t') || @request()->routeIs('status') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.menu-levels.menu-level-22.main">{{ 'Estatus' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul
                                    class="{{ @request()->routeIs('status_m') || @request()->routeIs('status_c') || @request()->routeIs('status_f') || @request()->routeIs('status_t') || @request()->routeIs('status') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                                    @can('status')
                                        <li class="{{ @request()->routeIs('status') ? 'active' : '' }}">
                                            <a href="{{ route('status') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Estatus' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('status_c')
                                        <li class="{{ @request()->routeIs('status_c') ? 'active' : '' }}">
                                            <a href="{{ route('status_c') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Estatus Consulta' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('status_f')
                                        <li class="{{ @request()->routeIs('status_f') ? 'active' : '' }}">
                                            <a href="{{ route('status_f') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Estatus Factura' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('status_m')
                                        <li class="{{ @request()->routeIs('status_m') ? 'active' : '' }}">
                                            <a href="{{ route('status_m') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Estatus Médico' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('status_t')
                                        <li class="{{ @request()->routeIs('status_t') ? 'active' : '' }}">
                                            <a href="{{ route('status_t') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Estatus Tasas' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['usuario_m', 'usuario_a', 'usuario_p', 'usuario_pe', 'usuario_g'])
                            <li
                                class="{{ @request()->routeIs('usuario_m*') || @request()->routeIs('usuario_a*') || @request()->routeIs('usuario_p*') || @request()->routeIs('usuario_pe*') || @request()->routeIs('usuario_g*') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.menu-levels.menu-level-22.main">{{ 'Usuarios' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul
                                    class="{{ @request()->routeIs('usuario_m*') || @request()->routeIs('usuario_a*') || @request()->routeIs('usuario_p*') || @request()->routeIs('usuario_pe*') || @request()->routeIs('usuario_g*') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                                    @can('usuario_g')
                                        <li class="{{ @request()->routeIs('usuario_g*') ? 'active' : '' }}">
                                            <a href="{{ route('usuario_g') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Administrativo' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('usuario_m')
                                        <li class="{{ @request()->routeIs('usuario_m*') ? 'active' : '' }}">
                                            <a href="{{ route('usuario_m') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Médicos' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('usuario_a')
                                        <li class="{{ @request()->routeIs('usuario_a*') ? 'active' : '' }}">
                                            <a href="{{ route('usuario_a') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Asistente' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('usuario_p')
                                        <li
                                            class="{{ @request()->routeIs('usuario_p*') || @request()->routeIs('usuario_pe*') ? 'active' : '' }}">
                                            <a href="{{ route('usuario_p') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.menu-levels.menu-level-22.menu-level-31">{{ 'Paciente' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan

                                </ul>
                            </li>
                        @endcanany
                        @canany(['banco', 'cuentaUSD', 'tipoC', 'entidad', 'cripto', 'billetera', 'cuenta_banco', 'tpago'])
                            <li
                                class="{{ @request()->routeIs('banco') || @request()->routeIs('cuentaUSD') || @request()->routeIs('tipoC') || @request()->routeIs('entidad') || @request()->routeIs('cripto') || @request()->routeIs('billetera') || @request()->routeIs('cuenta_banco') || @request()->routeIs('tpago') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.menu-levels.menu-level-22.main">{{ 'Cuentas' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul
                                    class="{{ @request()->routeIs('banco') || @request()->routeIs('cuentaUSD') || @request()->routeIs('tipoC') || @request()->routeIs('entidad') || @request()->routeIs('cripto') || @request()->routeIs('billetera') || @request()->routeIs('cuenta_banco') || @request()->routeIs('tpago') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                                    @can('banco')
                                        <li class="{{ @request()->routeIs('banco') ? 'active' : ' ' }}">
                                            <a href="{{ route('banco') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>B</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Bancos' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('tipoC')
                                        <li class="{{ @request()->routeIs('tipoC') ? 'active' : ' ' }}">
                                            <a href="{{ route('tipoC') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>TC</b></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.dash.main">{{ 'Tipo de Cuenta' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('entidad')
                                        <li class="{{ @request()->routeIs('entidad') ? 'active' : ' ' }}">
                                            <a href="{{ route('entidad') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>EU</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Entidades USD' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('cuentaUSD')
                                        <li class="{{ @request()->routeIs('cuentaUSD') ? 'active' : ' ' }}">
                                            <a href="{{ route('cuentaUSD') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>CU</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Cuentas USD' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('cripto')
                                        <li class="{{ @request()->routeIs('cripto') ? 'active' : ' ' }}">
                                            <a href="{{ route('cripto') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>C</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Criptos' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('billetera')
                                        <li class="{{ @request()->routeIs('billetera') ? 'active' : ' ' }}">
                                            <a href="{{ route('billetera') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>B</b></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.dash.main">{{ 'Billeteras Criptos' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('cuenta_banco')
                                        <li class="{{ @request()->routeIs('cuenta_banco') ? 'active' : ' ' }}">
                                            <a href="{{ route('cuenta_banco') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>CB</b></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.dash.main">{{ 'Cuentas de Banco' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('tpago')
                                        <li class="{{ @request()->routeIs('tpago') ? 'active' : ' ' }}">
                                            <a href="{{ route('tpago') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>TP</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Tipo de Pago' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['especialidad', 'consultorio', 'controlE'])
                            <li
                                class="{{ @request()->routeIs('especialidad') || @request()->routeIs('consultorio') || @request()->routeIs('controlE') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }}">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-direction-alt"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.menu-levels.menu-level-22.main">{{ 'Config. Medico' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul
                                    class="{{ @request()->routeIs('especialidad') || @request()->routeIs('consultorio') || @request()->routeIs('controlE') ? 'active pcoded-submenu pcoded-trigger' : 'pcoded-submenu' }}">
                                    @can('especialidad')
                                        <li class="{{ @request()->routeIs('especialidad') ? 'active' : ' ' }}">
                                            <a href="{{ route('especialidad') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>EM</b></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.dash.main">{{ 'Especialidades Medicas' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('controlE')
                                        <li class="{{ @request()->routeIs('controlE') ? 'active' : ' ' }}">
                                            <a href="{{ route('controlE') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>CM</b></span>
                                                <span class="pcoded-mtext"
                                                    data-i18n="nav.dash.main">{{ 'Control Especialidades' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('consultorio')
                                        <li class="{{ @request()->routeIs('consultorio') ? 'active' : ' ' }}">
                                            <a href="{{ route('consultorio') }}" onclick="loading_show();"
                                                class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-minus"></i><b>C</b></span>
                                                <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Consultorios' }}</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                    </ul>
                </li>
            </ul>
        @endcan
        @can('tcambio')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('tcambio') ? 'active' : ' ' }}">
                    <a href="{{ route('tcambio') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-bar-chart"></i><b>TC</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Tasa de Cambio' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('servicio')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('servicio') ? 'active' : ' ' }}">
                    <a href="{{ route('servicio') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-list"></i><b>S</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Servicios' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('horario')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('horario*') ? 'active' : ' ' }}">
                    <a href="{{ route('horario') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-alarm-clock"></i><b>HC</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Horarios' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('agendas')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('agendas') ? 'active' : ' ' }}">
                    <a href="{{ route('agendas') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-calendar"></i><b>A</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Agenda' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('citas')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('citas') ? 'active' : ' ' }}">
                    <a href="{{ route('citas') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-bookmark-alt"></i><b>C</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Citas Consulta' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('consultao')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('consultao') ? 'active' : ' ' }}">
                    <a href="{{ route('consultao') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-headphone-alt"></i><b>CO</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Consulta Online' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('consulta')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('consulta') ? 'active' : ' ' }}">
                    <a href="{{ route('consulta') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-pulse"></i><b>C</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Consulta' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @canany(['urologia'])
            <ul class="pcoded-item pcoded-left-item">
                <li
                    class="{{ @request()->routeIs('urologia*') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }} ">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                        <span class="pcoded-mtext"
                            data-i18n="nav.basic-components.main">{{ 'Historias Clínicas' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    <ul class="pcoded-submenu">
                        @can('urologia')
                            <li class="{{ @request()->routeIs('urologia*') ? 'active' : '' }}">
                                <a href="{{ route('urologia') }}" onclick="loading_show();"
                                    class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.basic-components.alert">{{ 'Urología' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        @endcanany
        @can('factura')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('factura') ? 'active' : ' ' }}">
                    <a href="{{ route('factura') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-notepad"></i><b>F</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Facturación' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('pago')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('pago') ? 'active' : ' ' }}">
                    <a href="{{ route('pago') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-credit-card"></i><b>Pa</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Pago' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @can('confirmar_pago')
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ @request()->routeIs('confirmar_pago') ? 'active' : ' ' }}">
                    <a href="{{ route('confirmar_pago') }}" onclick="loading_show();" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-check-box"></i><b>CP</b></span>
                        <span class="pcoded-mtext" data-i18n="nav.dash.main">{{ 'Confirmar Pago' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                </li>
            </ul>
        @endcan
        @canany(['reporte_consulta', 'facturaH', 'cservicios'])
            <ul class="pcoded-item pcoded-left-item">
                <li
                    class="{{ @request()->routeIs('reporte_consulta') || @request()->routeIs('facturaH') || @request()->routeIs('cservicios') || @request()->routeIs('cxp*') ? 'active pcoded-hasmenu pcoded-trigger' : 'pcoded-hasmenu' }} ">
                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="ti-write"></i></span>
                        <span class="pcoded-mtext" data-i18n="nav.basic-components.main">{{ 'Reportes' }}</span>
                        <span class="pcoded-mcaret"></span>
                    </a>
                    @can('reporte_consulta')
                        <ul class="pcoded-submenu">
                            <li class="{{ @request()->routeIs('reporte_consulta') ? 'active' : '' }}">
                                <a href="{{ route('reporte_consulta') }}" onclick="loading_show();"
                                    class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.basic-components.alert">{{ 'Consultas' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    @endcan
                    @can('facturaH')
                        <ul class="pcoded-submenu">
                            <li class="{{ @request()->routeIs('facturaH') ? 'active' : '' }}">
                                <a href="{{ route('facturaH') }}" onclick="loading_show();"
                                    class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.basic-components.alert">{{ 'Histórico de Factura' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    @endcan
                    @can('cservicios')
                        <ul class="pcoded-submenu">
                            <li class="{{ @request()->routeIs('cservicios') ? 'active' : '' }}">
                                <a href="{{ route('cservicios') }}" onclick="loading_show();"
                                    class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.basic-components.alert">{{ 'Consulta de Servicios' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    @endcan
                    @can('cxp')
                        <ul class="pcoded-submenu">
                            <li class="{{ @request()->routeIs('cxp') ? 'active' : '' }}">
                                <a href="{{ route('cxp') }}" onclick="loading_show();" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext"
                                        data-i18n="nav.basic-components.alert">{{ 'Consulta de CxP' }}</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    @endcan
                </li>
            </ul>
        @endcanany
    </div>
</nav>
