@extends('auth.layouts.master')
@section('title', __('Verify Your Email Address'))
@section('content')
  {{ Form::open(['route' => ['verification.resend'], 'class' => 'panel-body wrapper-lg']) }}
  @if (session('resent'))
    <div class="alert alert-success" role="alert">
      {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
  @endif
  <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
  <p>{{ __('If you did not receive the email') }},</p>
  <button type="submit" class="btn btn-primary">{{ __('click here to request another') }}</button>
  <div class="line line-dashed"></div>
  <a href="{{ route('logout') }}" class="btn btn-default btn-block"
     onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Turn Back') }}</a>
  {!! Form::close() !!}

  {{ Form::open(['route' => ['logout'], 'style' => 'display: none;', 'id' => 'logout-form']) }}
  {!! Form::close() !!}
@endsection
