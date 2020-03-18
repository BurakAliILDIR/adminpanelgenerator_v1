@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('css')
    <link href="/admin-custom-template/datepicker/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <section class="panel panel-default">
                <header class="panel-heading font-bold">
                    {{ $settings['title'] }}
                </header>
                <div class="panel-body">
                    {{ Form::model($settings['model'], ['route' => [$settings['route']['action'], $settings['params']], 'method' => 'put'], ['class' => 'form-horizontal']) }}
                    @component('components.form.generator', ['settings'=> $settings,])@endcomponent
                    {{ Form::submit($settings['submitText'], array_merge(['class' => 'btn btn-success'], $settings['submitAttributes'] ?? [])) }}
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <!-- datepicker -->
    <script type="text/javascript" src="/admin-custom-template/datepicker/bootstrap-datepicker.js"></script>
@endsection
