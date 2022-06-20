@extends('layouts.guest', ['class' => 'off-canvas-sidebar', 'activePage' => 'email', 'title' => __('Send Password Reset Link')])

@section('content')
<div class="container  px-2 px-sm-0" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-info text-center">
            <h4 class="card-title"><strong>{{ __('auth.remember_password_name') }}</strong></h4>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="row">
                <div class="col-sm-12">
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status') }}</span>
                  </div>
                </div>
              </div>
            @endif
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">email</i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="{{ old('email') }}" required>
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-info btn-link btn-lg">{{ __('auth.send_password_reset_link') }}</button>
          </div>
        </div>
      </form>
        <div class="row">
            <div class="col-6">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-light">
                        <small>{{ __('auth.login_form') }}</small>
                    </a>
                @endif
            </div>
            <div class="col-6 text-right">
                <a href="{{ route('register') }}" class="text-light">
                    <small>{{ __('create_new_account') }}</small>
                </a>
            </div>
        </div>

    </div>
  </div>
</div>
@endsection
