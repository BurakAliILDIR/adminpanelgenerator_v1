@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('css')
@endsection
@section('content')
    @component('components.read.table', ['settings' => $settings])@endcomponent
@endsection
@section('js')
@endsection
