@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Profilo personale')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <a href="../users/{{ auth()->user()->id }}" class="btn btn-primary btn-round" role="button" aria-disabled="true">Profilo pubblico</a>
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Modifica Profilo') }}</h4>
                <p class="card-category">{{ __('Le tue informazioni') }}</p>
              </div>
              <div class="card-body ">
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
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nome') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Cognome') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" id="input-surname" type="text" placeholder="{{ __('Surname') }}" value="{{ old('surname', auth()->user()->surname) }}" required="true" aria-required="true"/>
                      @if ($errors->has('surname'))
                        <span id="name-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Titolo di studio') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('studi') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('studi') ? ' is-invalid' : '' }}" name="studi" id="input-studi" type="text" placeholder="{{ __('Titolo di studio...') }}" value="{{ old('studi', auth()->user()->studi) }}" required="false" aria-required="true"/>
                    @if ($errors->has('studi'))
                      <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('studi') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Occupazione') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('occupazione') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('occupazione') ? ' is-invalid' : '' }}" name="occupazione" id="input-occupazione" type="text" placeholder="{{ __('Occupazione...') }}" value="{{ old('occupazione', auth()->user()->occupazione) }}" required="false" aria-required="true"/>
                    @if ($errors->has('occupazione'))
                      <span id="name-error" class="error text-danger" for="input-occupazione">{{ $errors->first('occupazione') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Profilo Linkedin') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('linkedin') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('linkedin') ? ' is-invalid' : '' }}" name="linkedin" id="input-linkedin" type="text" placeholder="{{ __('Profilo Linkedin...') }}" value="{{ old('linkedin', auth()->user()->linkedin) }}" required="false" aria-required="true"/>
                    @if ($errors->has('linkedin'))
                      <span id="name-error" class="error text-danger" for="input-linkedin">{{ $errors->first('linkedin') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Aggiorna') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Modifica password') }}</h4>
                <p class="card-category">{{ __('') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status_password'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_password') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Password corrente') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Password corrente') }}" value="" required />
                      @if ($errors->has('old_password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('Nuova password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('Nuova password') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Conferma nuova password') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Conferma nuova password') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Aggiorna') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
