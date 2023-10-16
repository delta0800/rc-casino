<body>
  <div class="loader-bg">
    <div class="loader-bar"></div>
  </div>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      
      <nav class="navbar header-navbar pcoded-header" header-theme="theme1">
        <div class="navbar-wrapper">
          <div class="navbar-logo" logo-theme="theme1">
            <a href="#!">
              Royal Casino
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
              <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
              <i class="feather icon-more-horizontal"></i>
            </a>
          </div>
          <div class="navbar-container container-fluid">
            <ul class="nav-right">
              <li class="user-profile header-notification">
              <div class="dropdown-primary dropdown">
                <div class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('backend/png/logo.png') }}" class="img-radius" alt="User-Profile-Image">
                    @if(Auth::guard('admin')->check())
                      <span>{{ Auth::guard('admin')->user()->name }}</span>
                    @elseif(Auth::guard('super')->check())
                      <span>{{ Auth::guard('super')->user()->name }}</span>
                    @elseif(Auth::guard('senior')->check())
                      <span>{{ Auth::guard('senior')->user()->name }}</span>
                    @elseif(Auth::guard('master')->check())
                      <span>{{ Auth::guard('master')->user()->name }}</span>
                    @elseif(Auth::guard('agent')->check())
                      <span>{{ Auth::guard('agent')->user()->name }}</span>
                    @endif
                  <i class="feather icon-chevron-down"></i>
                </div>
                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                  <li>
                    <a href="{{ route('change.password') }}">
                      <i class="feather icon-lock"></i> Change Password
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="feather icon-log-out"></i> Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">