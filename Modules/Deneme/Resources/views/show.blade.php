@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('css')

        <link type="text/css" rel="stylesheet" href="/admin-custom-template/gallery/gallery.css">

    <link type="text/css" rel="stylesheet"
          href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    {{-- Dropzone --}}
    <link type="text/css" rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.js"></script>
@endsection
@section('content')
    @component('components.detail', ['settings'=> $settings])@endcomponent
@endsection
@section('js')
    {{-- Gallery --}}

    <script type="text/javascript" src="/admin-custom-template/gallery/gallery.js"></script>

@endsection
