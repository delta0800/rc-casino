@extends('auth.layout')
@section('title', 'Change Password')
@section('content')
<section class="login-block">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form method="POST" action="{{ route('password.change') }}" class="md-float-material form-material">
          @csrf
          <div class="text-center">
            <img src="{{ asset('backend/png/logo.png') }}" style="width: 120px; height: 120px;" class="img-radius" alt="Royal Casino">
          </div>
          <div class="auth-box card">
            <div class="card-block">
              <div class="row m-b-20">
                <div class="col-md-12">
                  <h3 class="text-center txt-primary">Update your password</h3>
                </div>
              </div>
              <div class="form-group form-primary">
                <input id="current_password" type="password" class="form-control form-control-lg @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}" required autocomplete="current_password">
                <span class="form-bar"></span>
                @error('current_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label class="float-label">Current Password</label>
              </div>
              <div class="form-group form-primary">
                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <span class="form-bar"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label class="float-label">New Password</label>
              </div>
              <div class="form-group form-primary">
                <input id="password_confirmation" type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="password_confirmation">
                <span class="form-bar"></span>
                <label class="float-label">New Confirm Password</label>
              </div>

              <div class="row m-t-30">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Update Password</button>
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
@endsection