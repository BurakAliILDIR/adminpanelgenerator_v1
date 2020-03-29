@extends('auth.layouts.master')
@section('title', __('Reset Password'))
@section('content')
  {{ Form::open(['route' => ['password.email'], 'class' => 'panel-body wrapper-lg']) }}
  @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
  @endif
  <div class="form-group @error('email') is-invalid @enderror">
    <label class="control-label">{{ __('E-Mail Address') }}</label>
    {{ Form::email('email', null, ['class' => 'form-control input-md', 'autofocus', 'required', 'autocomplete'=> 'email']) }}
    @error('email')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">{{ __('Send Password Reset Link') }}</button>
  {!! Form::close() !!}
@endsection
