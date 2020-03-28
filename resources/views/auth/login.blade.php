@extends('auth.layouts.master')
@section('title', 'Giriş Formu')
@section('content')
  @component('components.alert.alert_messages')@endcomponent
  {{ Form::open(['route' => ['login'], 'class' => 'panel-body wrapper-lg']) }}
  <div class="form-group @error('email') is-invalid @enderror">
    <label class="control-label">{{ __('auth.email') }}</label>
    {{ Form::email('email', null, ['class' => 'form-control input-md', 'placeholder' => 'E-posta adresinizi giriniz', 'autofocus']) }}
    @error('email')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group @error('password') is-invalid @enderror">
    <label class="control-label">{{ __('auth.password') }}</label>
    {{ Form::password('password', ['class' => 'form-control input-md', 'placeholder' => 'Parolanızı giriniz']) }}
    @error('password')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  {{--<div class="checkbox">
    <label>
      <input type="checkbox"> Keep me logged in
    </label>
    
    aşağıdaki de laravel yapı biçimi
    <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember"
                           id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>
  </div>--}}
  <button type="submit" class="btn btn-primary">Giriş Yap</button>
  @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}" class="pull-right m-t-xs"><small>Parolamı unuttum?</small></a>
  @endif
  {{--<a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with
    Facebook</a>
  <a href="#" class="btn btn-twitter btn-block"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a>
    <div class="line line-dashed"></div>--}}
  @if (Route::has('register'))
    <div class="line line-dashed"></div>
    <p class="text-muted text-center"><small>Hala bir hesabın yok mu?</small></p>
    <a href="{{ route('register') }}" class="btn btn-default btn-block">Hesap Oluştur</a>
  @endif
  {!! Form::close() !!}
@endsection
