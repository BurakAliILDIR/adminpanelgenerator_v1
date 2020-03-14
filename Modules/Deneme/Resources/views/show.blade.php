@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('css')
    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
@endsection
@section('content')
    @component('components.detail', ['settings'=> $settings])@endcomponent
@endsection
