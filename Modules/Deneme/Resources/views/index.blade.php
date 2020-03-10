@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('content')
    @component('components.list.table', ['settings' => $settings])@endcomponent
@endsection
