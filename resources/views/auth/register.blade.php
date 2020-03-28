@extends('auth.layouts.master')
@section('title', 'Kayıt Formu')
@section('content')
  {{ Form::open(['route' => ['register'], 'class' => 'panel-body wrapper-lg']) }}
  <div class="form-group @error('name') is-invalid @enderror">
    <label class="control-label">{{ __('auth.name') }}</label>
    {{ Form::text('name', null, ['class' => 'form-control input-md', 'placeholder' => 'Adınızı giriniz', 'autofocus']) }}
    @error('name')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group @error('surname') is-invalid @enderror">
    <label class="control-label">{{ __('auth.surname') }}</label>
    {{ Form::text('surname', null, ['class' => 'form-control input-md', 'placeholder' => 'Soyadınızı giriniz']) }}
    @error('surname')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
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

  <div class="checkbox @error('condition_acceptance') is-invalid @enderror">
    <label>
      <input type="checkbox" name="condition_acceptance"> <a class="btn-link" target="_blank" href="https://www.tchibo.com.tr/kullanim-kosullari-uyelik-sozlesmesi-s400013090.html">Kullanım koşularını </a> kabul ediyorum.
    </label>
    @error('condition_acceptance')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Hesap Oluştur</button>
  <div class="line line-dashed"></div>
  <p class="text-muted text-center"><small>Zaten bir hesabın var mı?</small></p>
  <a href="{{ route('login') }}" class="btn btn-default btn-block">Giriş Yap</a>
  {!! Form::close() !!}
@endsection
