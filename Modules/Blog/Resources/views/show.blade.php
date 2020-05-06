@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('css')
  <!--Gallery CSS-->
  <link type="text/css" rel="stylesheet" href="{{ asset('/storage/admin-custom-template/gallery/gallery.css') }}">
  <!--Gallery Plugins CSS-->
  <link type="text/css" rel="stylesheet" href="{{ asset('/storage/plugins/baguettebox/baguettebox.min.css') }}">
  <!-- Dropzone CSS-->
  <link type="text/css" rel="stylesheet" href="{{ asset('/storage/plugins/dropzone/dropzone.min.css') }}">
@endsection
@section('content')
  @component('components.read.detail', ['settings'=> $settings])@endcomponent
@endsection
@section('js')
  <!-- Gallery JS-->
  <script type="text/javascript" src="{{ asset('/storage/plugins/baguettebox/baguettebox.min.js') }}"></script>
  <!-- Gallery Plugins JS-->
  <script type="text/javascript" src="{{ asset('/storage/admin-custom-template/gallery/gallery.js') }}"></script>
  <!-- Dropzone JS-->
  <script type="text/javascript" src="{{ asset('/storage/plugins/dropzone/dropzone.min.js') }}"></script>
@endsection
