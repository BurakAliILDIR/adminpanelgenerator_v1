@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('css')
    {{--Gallery CSS--}}
    <link type="text/css" rel="stylesheet" href="/admin-custom-template/gallery/gallery.css">
    {{--Gallery Plugins CSS--}}
    <link type="text/css" rel="stylesheet" href="/plugins/baguettebox/baguettebox.min.css">
    {{-- Dropzone CSS--}}
    <link type="text/css" rel="stylesheet" href="/plugins/dropzone/dropzone.min.css">
@endsection
@section('content')
    @component('components.detail', ['settings'=> $settings])@endcomponent
@endsection
@section('js')
    {{-- Gallery JS--}}
    <script type="text/javascript" src="/plugins/baguettebox/baguettebox.min.js"></script>
    {{-- Gallery Plugins JS--}}
    <script type="text/javascript" src="/admin-custom-template/gallery/gallery.js"></script>
    {{-- Dropzone JS--}}
    <script type="text/javascript" src="/plugins/dropzone/dropzone.min.js"></script>
@endsection
