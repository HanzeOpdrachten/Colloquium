@extends('layouts.app')

@section('breadcrumbs')
  @include('components.breadcrumbs', [
    'crumbs' => [
      'Home' => route('home'),
      'Login' => '#'
    ]
  ])
@endsection

@section('content')
  <div class="column column--whole">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default login-panel">
          <div class="panel-heading login-heading">Login</div>

          <div class="panel-body">
            <form class="form" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif

                <label for="email" class="form__label">E-Mail Address</label>
                <input id="email" type="email" class="form__input" name="email" value="{{ old('email') }}" required autofocus>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="form__label">Password</label>
                <input id="password" type="password" class="form__input" name="password" required>

                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif

              </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                  <button type="submit" class="button button--primary">
                    Login
                  </button>

                  <a class="btn btn-link fpw" href="{{ route('password.request') }}">
                    Forgot Your Password?
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
