@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Registrazione')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>{{ __('Registrati') }}</strong></h4>
            <div class="social-line"></div>
          </div>
          <div class="card-body ">
            <!--<p class="card-description text-center">{{ __('Or Be Classical') }}</p>-->
            <!--name-->
            <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="name" class="form-control" placeholder="{{ __('Name...') }}" value="{{ old('name') }}" required>
              </div>
              @if ($errors->has('name'))
                <div id="name-error" class="error text-danger pl-3" for="name" style="display: block;">
                  <strong>{{ $errors->first('name') }}</strong>
                </div>
              @endif
            </div>
            <!--Surname-->
            <div class="bmd-form-group{{ $errors->has('surname') ? ' has-danger' : '' }}" style="margin-top: 5%">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">face</i>
                  </span>
                </div>
                <input type="text" name="surname" class="form-control" placeholder="{{ __('Surname...') }}" value="{{ old('surname') }}" required>
              </div>
              @if ($errors->has('surname'))
                <div id="name-error" class="error text-danger pl-3" for="surname" style="display: block;">
                  <strong>{{ $errors->first('surname') }}</strong>
                </div>
              @endif
            </div>
            <!--email-->
            <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
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
            <!--password-->
            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>
            <!--passconfirm-->
            <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password...') }}" required>
              </div>
              @if ($errors->has('password_confirmation'))
                <div id="password_confirmation-error" class="error text-danger pl-3" for="password_confirmation" style="display: block;">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
              @endif
            </div>

<!--Occupazioni-->
<div class="bmd-form-group{{ $errors->has('occupazione') ? ' has-danger' : '' }}" style="margin-top: 5%">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="material-icons">badge</i>
        </span>
      </div>
      <input type="text" name="occupazione" class="form-control" placeholder="{{ __('Occupazione') }}" value="{{ old('occupazione') }}" required>
    </div>
    @if ($errors->has('occupazione'))
      <div id="name-error" class="error text-danger pl-3" for="occupazione" style="display: block;">
        <strong>{{ $errors->first('occupazione') }}</strong>
      </div>
    @endif
  </div>

  <!--Studi-->
  <div class="bmd-form-group{{ $errors->has('studi') ? ' has-danger' : '' }}" style="margin-top: 5%">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="material-icons">school</i>
        </span>
      </div>
      <input type="text" name="studi" class="form-control" placeholder="{{ __('Studi') }}" value="{{ old('studi') }}" required>
    </div>
    @if ($errors->has('studi'))
      <div id="name-error" class="error text-danger pl-3" for="studi" style="display: block;">
        <strong>{{ $errors->first('studi') }}</strong>
      </div>
    @endif
  </div>

  <!--Linkedin-->
  <div class="bmd-form-group{{ $errors->has('linkedin') ? ' has-danger' : '' }}" style="margin-top: 5%">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
            <i class="material-icons">person</i>
        </span>
      </div>
      <input type="text" name="linkedin" class="form-control" placeholder="{{ __('Profilo LinkedIn') }}" value="{{ old('linkedin') }}" required>
    </div>
    @if ($errors->has('linkedin'))
      <div id="name-error" class="error text-danger pl-3" for="linkedin" style="display: block;">
        <strong>{{ $errors->first('linkedin') }}</strong>
      </div>
    @endif
  </div>

              <!-- type of user -->

              <div class="form-check form-check-radio" style="margin-left: 5% ; margin-top: 10%">
                <label class="form-check-label">
                <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="Ricercatore">
                Ricercatore
                <span class="circle">
                  <span class="check"></span>
                </span>
                </label>

                <label class="form-check-label" style="margin-left:20px">
                <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="Manager">
                  Manager
                  <span class="circle">
                   <span class="check"></span>
                </span>
                  </label>
              </div>

            <div class="form-check mr-auto ml-3 mt-3">
              <label class="form-check-label" style="margin-top:10%">
                <input class="form-check-input" type="checkbox" id="policy" name="policy" {{ old('policy', 1) ? 'checked' : '' }} >
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
                {{ __('I agree with the ') }} <a href="#">{{ __('Privacy Policy') }}</a>
              </label>
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" name="submit" class="btn btn-primary btn-link btn-lg">{{ __('Create account') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
