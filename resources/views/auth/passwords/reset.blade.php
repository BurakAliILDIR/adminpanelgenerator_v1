@extends('auth.layouts.master')
@section('title', 'Parola Yenileme Formu')
@section('content')
  {{ Form::open(['route' => ['password.update'], 'class' => 'panel-body wrapper-lg']) }}
  <div class="form-group @error('email') is-invalid @enderror">
    <label class="control-label">{{ __('auth.email') }}</label>
    {{ Form::email('email', null, ['class' => 'form-control input-md', 'placeholder' => 'E-posta adresinizi giriniz']) }}
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
  <div class="form-group">
    <label class="control-label">{{ __('auth.password_confirmation') }}</label>
    {{ Form::password('password_confirmation', ['class' => 'form-control input-md', 'placeholder' => 'Parolanızı tekrar giriniz']) }}
  </div>

  <button type="submit" class="btn btn-primary">Parola Yenile</button>
  <div class="line line-dashed"></div>
  <p class="text-muted text-center"><small>Parolanı değiştirmekten vaz mı geçtin?</small></p>
  <a href="{{ route('login') }}" class="btn btn-default btn-block">Giriş Formuna Geri Dön</a>
  {!! Form::close() !!}
@endsection
