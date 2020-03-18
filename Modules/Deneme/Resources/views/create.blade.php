@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
            <section class="panel panel-default">
                <header class="panel-heading font-bold">
                    {{ $settings['title'] }}
                </header>
                <div class="panel-body">
                    {{ Form::model($settings['model'], ['route' => [$settings['route']['action'], $settings['params']]], ['class' => 'form-horizontal']) }}
                    @component('components.form.generator', ['settings'=> $settings,])@endcomponent
                    {{ Form::submit($settings['submitText'], array_merge(['class' => 'btn btn-success'], $settings['submitAttributes'] ?? [])) }}
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">


        $('.date').datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            language: 'tr'

        });
        $('.date_time').datetimepicker({
            format: 'dd/mm/yyyy HH:mm:ss',
            language: 'tr'

        });
    </script>

@endsection
