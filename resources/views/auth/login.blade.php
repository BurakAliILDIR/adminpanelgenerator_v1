@extends('auth.layouts.master')
@section('title', __('Login'))
@section('content')
  @component('components.alert.alert_messages')@endcomponent
  {{ Form::open(['route' => ['login'], 'class' => 'panel-body wrapper-lg']) }}
  <div class="form-group @error('email') is-invalid @enderror">
    <label class="control-label">{{ __('E-Mail Address') }}</label>
    {{ Form::email('email', null, ['class' => 'form-control input-md', 'required', 'autocomplete' => 'email', 'autofocus']) }}
    @error('email')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group @error('password') is-invalid @enderror">
    <label class="control-label">{{ __('Password') }}</label>
    {{ Form::password('password', ['class' => 'form-control input-md', 'required', 'autocomplete' => 'current-password']) }}
    @error('password')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="remember"
             id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
    </label>
  </div>
  <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
  @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}" class="pull-right m-t-xs"><small>{{ __('Forgot Your Password?') }}</small></a>
  @endif
  {{--<a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with
    Facebook</a>
  <a href="#" class="btn btn-twitter btn-block"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a>
    <div class="line line-dashed"></div>--}}
  @if (Route::has('register'))
    <div class="line line-dashed"></div>
    <a href="{{ route('register') }}" class="btn btn-default btn-block">{{ __('Register') }}</a>
  @endif
  {!! Form::close() !!}
@endsection
