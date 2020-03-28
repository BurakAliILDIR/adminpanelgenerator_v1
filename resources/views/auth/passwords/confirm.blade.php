@extends('auth.layouts.master')
@section('title', 'Hasabını Onayla')
@section('content')
  {{ Form::open(['route' => ['password.confirm'], 'class' => 'panel-body wrapper-lg']) }}
  <p>Lütfen devam etmeden önce şifrenizi onaylayın.</p>
  <div class="form-group @error('password') is-invalid @enderror">
    <label class="control-label">{{ __('auth.password') }}</label>
    {{ Form::password('password', ['class' => 'form-control input-md', 'placeholder' => 'Parolanızı giriniz', 'required']) }}
    @error('password')
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Hesabı Onayla</button>
  @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}" class="pull-right m-t-xs"><small>Parolamı unuttum?</small></a>
  @endif
  {!! Form::close() !!}
@endsection

