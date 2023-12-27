<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <!-- logo -->
            <a href="#">
                <img class="img-fluid" src="{{ asset('img/Logo_blanco.png')}}" alt="Theme-Logo" width="90%"/>
            </a>
              <!-- opcion movil-->
            <a class="mobile-options waves-effect waves-light">
                <i class="ti-more"></i>
            </a>
        </div>                
        <div class="navbar-container container-fluid">
              <ul class="nav-left">
                  <li>
                      <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                  </li>
                  <li>
                      <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                          <i class="ti-fullscreen"></i>
                      </a>
                  </li>
              </ul>
              <ul class="nav-right">
                  <li class="user-profile header-notification">
                      <a href="#!" class="waves-effect waves-light">
                          <img @if(isset($foto->Foto_Medico) && $foto->Foto_Medico  == '')src="{{ ("avatars/".str_replace('\\','/', $foto->Foto_Medico)) }}"  @else src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" @endif class="img-radius" alt="User-Profile-Image">
                          <span> {{auth()->user()->name}} </span>
                          <i class="ti-angle-down"></i>
                      </a>
                      <ul class="show-notification profile-notification">
                          
                          <!--li class="waves-effect waves-light">
                              <a href="#">
                                  <i class="ti-user"></i> Perfil
                              </a>
                          </li -->                                  
                          <li class="waves-effect waves-light">
                              <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="ti-layout-sidebar-left"></i>                  
                                    {{ 'Logout' }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form> 
                          </li>
                      </ul>
                  </li>
              </ul>
        </div>
    </div>
</nav>