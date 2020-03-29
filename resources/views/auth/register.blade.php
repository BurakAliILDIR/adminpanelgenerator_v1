@extends('auth.layouts.master')
@section('title', __('Register'))
@section('content')
  {{ Form::open(['route' => ['register'], 'class' => 'panel-body wrapper-lg']) }}
  <div class="form-group @error('name') is-invalid @enderror">
    <label class="control-label">{{ __('Name') }}</label>
    {{ Form::text('name', null, ['class' => 'form-control input-md', 'required', 'autocomplete' => 'name', 'autofocus']) }}
    @error('name')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group @error('surname') is-invalid @enderror">
    <label class="control-label">{{ __('Surname') }}</label>
    {{ Form::text('surname', null, ['class' => 'form-control input-md', 'required', 'autocomplete' => 'surname']) }}
    @error('surname')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group @error('email') is-invalid @enderror">
    <label class="control-label">{{ __('E-Mail Address') }}</label>
    {{ Form::email('email', null, ['class' => 'form-control input-md', 'required', 'autocomplete' => 'email']) }}
    @error('email')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group @error('password') is-invalid @enderror">
    <label class="control-label">{{ __('Password') }}</label>
    {{ Form::password('password', ['class' => 'form-control input-md', 'required', 'autocomplete' => 'new-password']) }}
    @error('password')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label class="control-label">{{ __('Confirm Password') }}</label>
    {{ Form::password('password_confirmation', ['class' => 'form-control input-md', 'required', 'autocomplete' => 'new-password']) }}
  </div>

  <div class="checkbox @error('condition_acceptance') is-invalid @enderror">
    <small>
      <label>
        <input type="checkbox" name="condition_acceptance">
        {{ __('I accept the terms of use.') }}
        <a class="btn-link" target="_blank"
           href="https://www.tchibo.com.tr/kullanim-kosullari-uyelik-sozlesmesi-s400013090.html">

          <strong>{{env('APP_NAME')}}</strong>
        </a>
      </label>
    </small>
    @error('condition_acceptance')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
  <div class="line line-dashed"></div>
  <p class="text-muted text-center">
    <small> {{ __('Do you already have an account?') }}</small></p>
  <a href="{{ route('login') }}" class="btn btn-default btn-block">{{ __('Login') }}</a>
  {!! Form::close() !!}
@endsection
