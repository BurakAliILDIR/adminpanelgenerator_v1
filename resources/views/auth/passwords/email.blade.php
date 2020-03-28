@extends('auth.layouts.master')
@section('title', 'Parolamı Unuttum')
@section('content')
  {{ Form::open(['route' => ['password.email'], 'class' => 'panel-body wrapper-lg']) }}
  <div class="form-group @error('email') is-invalid @enderror">
    <label class="control-label">{{ __('auth.email') }}</label>
    {{ Form::email('email', null, ['class' => 'form-control input-md', 'placeholder' => 'E-posta adresinizi giriniz', 'autofocus', 'required']) }}
    @error('email')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Parola Yenileme Bağlantısı Gönder</button>
  <div class="line line-dashed"></div>
  <p class="text-muted text-center"><small>Şifreni mi hatırladın?</small></p>
  <a href="{{ route('login') }}" class="btn btn-default btn-block">Giriş Formuna Geri Dön</a>
  {!! Form::close() !!}
@endsection
