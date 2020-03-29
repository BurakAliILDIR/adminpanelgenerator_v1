@extends('auth.layouts.master')
@section('title', __('Confirm Password'))
@section('content')
  {{ Form::open(['route' => ['password.confirm'], 'class' => 'panel-body wrapper-lg']) }}
  {{ __('Please confirm your password before continuing.') }}
  <div class="form-group @error('password') is-invalid @enderror">
    <label class="control-label">{{ __('Password') }}</label>
    {{ Form::password('password', ['class' => 'form-control input-md', 'required', 'autocomplete' => 'current-password']) }}
    @error('password')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">{{ __('Confirm Password') }}</button>
  @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}" class="pull-right m-t-xs"><small>{{ __('Forgot Your Password?') }}</small></a>
  @endif
  {!! Form::close() !!}
@endsection

