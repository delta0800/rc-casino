<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Royal Casino | Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Royal Casino" />
  <meta name="keywords" content="Royal Casino" />
  <meta name="author" content="Royal Casino" />
  <link rel="icon" href="{{ asset('backend/png/logo.png') }}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/css/waves.min.css') }}" type="text/css" media="all"> 
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/feather.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/icofont.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/pages.css') }}">
</head>
<body themebg-pattern="theme1">
  <section class="login-block">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <form method="POST" action='{{ url("sys-private/$url") }}' class="md-float-material form-material">
            @csrf
            <div class="text-center">
              <img src="{{ asset('backend/png/logo.png') }}" style="width: 120px; height: 120px;" class="img-radius" alt="Royal Casino">
            </div>
            <div class="auth-box card">
              <div class="card-block">
                <div class="row m-b-20">
                  <div class="col-md-12">
                    <h3 class="text-center txt-primary">{{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</h3>
                  </div>
                </div>
                <p class="text-muted text-center p-b-5">Sign in with your account</p>
                <div class="form-group form-primary">
                  <input id="username" type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                  <span class="form-bar"></span>
                  @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <label class="float-label">Username</label>
                </div>
                <div class="form-group form-primary">
                  <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                  <span class="form-bar"></span>
                  <label class="float-label">Password</label>
                </div>
                <div class="row m-t-25 text-left">
                  <div class="col-12">
                    <div class="checkbox-fade fade-in-primary">
                      <label>
                        <input type="checkbox" name="remember_me" id="remember_me" {{ old('remember_me') ? 'checked' : '' }}>
                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                        <span class="text-inverse">Remember me</span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row m-t-30">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript" src="{{ asset('backend/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/css-scrollbars.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/common-pages.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/waves.min.js') }}"></script>
<script src="{{ asset('backend/js/rocket-loader.min.js') }}"></script>
</body>
</html>