@extends('auth.layouts.master')
@section('title', 'E-posta Doğrulama')
@section('content')
  {{ Form::open(['route' => ['verification.resend'], 'class' => 'panel-body wrapper-lg']) }}
  @if (session('resent'))
    <div class="alert alert-success" role="alert">
      E-posta adresinize yeni bir doğrulama bağlantısı gönderildi.
    </div>
  @endif
  <p>Devam etmeden önce lütfen bir doğrulama bağlantısı için e-postanızı kontrol edin.</p>
  <p>E-postayı almadıysanız,</p>
  <button type="submit" class="btn btn-primary">Başka bir tane talep etmek için buraya tıklayın</button>
  <div class="line line-dashed"></div>
  <a href="{{ route('logout') }}" class="btn btn-default btn-block"
     onclick="event.preventDefault();document.getElementById('logout-form').submit();">Vazgeç ve Giriş Formuna Dön</a>
  {!! Form::close() !!}

  {{ Form::open(['route' => ['logout'], 'style' => 'display: none;', 'id' => 'logout-form']) }}
  {!! Form::close() !!}
@endsection
