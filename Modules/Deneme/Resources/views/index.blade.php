@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('content')
    @component('components.read.table', ['settings' => $settings])@endcomponent
@endsection
