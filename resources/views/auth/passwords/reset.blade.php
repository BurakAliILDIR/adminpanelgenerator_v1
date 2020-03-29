@extends('auth.layouts.master')
@section('title', __('Reset Password'))
@section('content')
  {{ Form::open(['route' => ['password.update'], 'class' => 'panel-body wrapper-lg']) }}
  <input type="hidden" name="token" value="{{ $token }}">
  <div class="form-group @error('email') is-invalid @enderror">
    <label class="control-label">{{ __('E-Mail Address') }}</label>
    {{ Form::email('email', null, ['class' => 'form-control input-md', 'required', 'autocomplete' => 'email']) }}
    @error('email')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group @error('password') is-invalid @enderror">
    <label class="control-label">{{ __('Password') }}</label>
    {{ Form::password('password', ['class' => 'form-control input-md', 'required']) }}
    @error('password')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label class="control-label">{{ __('Confirm Password') }}</label>
    {{ Form::password('password_confirmation', ['class' => 'form-control input-md', 'required', 'autocomplete' => 'new-password']) }}
  </div>

  <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
  <div class="line line-dashed"></div>
  <a href="{{ route('logout') }}" class="btn btn-default btn-block"
     onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Turn Back') }}</a>
  {!! Form::close() !!}
  {{ Form::open(['route' => ['logout'], 'style' => 'display: none;', 'id' => 'logout-form']) }}
  {!! Form::close() !!}
@endsection
