<body>
  <div class="loader-bg">
    <div class="loader-bar"></div>
  </div>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      
      <nav class="navbar header-navbar pcoded-header" header-theme="theme5">
        <div class="navbar-wrapper">
          <div class="navbar-logo" logo-theme="theme5">
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
                    <a href="#exampleModal-4" data-toggle="modal">
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

      <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="ModalLabel">Change Password</h4>
            </div>
            <form method="POST" action="{{ route('password.change') }}">
              @csrf
              <div class="modal-body">
                <div class="form-group">
                  <label>Current Password</label>
                  <input type="password" class="form-control" id="current_password" name="current_password">
                </div>
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                  @error('new_password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label>New Confirm Password</label>
                  <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>