@extends('admin.layouts.master')
@section('title', $settings['title'])
@section('css')
  <link href="/plugins/select2/css/select2.min.css" rel="stylesheet" />

<!-- datepicker -->
  <link href="/admin-custom-template/datepicker/bootstrap-datepicker.css" rel="stylesheet">
  <!-- datetimepicker -->
  <link href="/admin-custom-template/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <!-- CkEditor -->
  <script src="/admin-custom-template/ckeditor/ckeditor.js" type="text/javascript"></script>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-5 col-md-offset-3">
      <section class="panel panel-default">
        <header class="panel-heading font-bold">
          <div class="row">
            <div class="col-md-6">
              <div class="m-t">
                <a class="btn btn-xs btn-default btn-rounded "
                   href="{{ route($settings['route']['index']) }}">
                  <i class="fa fa-arrow-left"></i>
                  Tüm Kayıtlara Dön
                </a>
                <span class="m-l">{{ $settings['title'] }}</span>
              </div>
            </div>
            <div class="col-md-6">
              @can(class_basename($settings['model']).'.detail')
                <div class="m-t">
                  <a class="btn btn-xs btn-default btn-rounded pull-right"
                     href="{{ route($settings['route']['show'], $settings['model']['id']) }}">
                    Detay Sayfasına Git
                    <i class="fa fa-arrow-right"></i>
                  </a>
                </div>
              @endcan
            </div>
          </div>
        </header>
        <div class="panel-body">
          {{ Form::model($settings['model'], ['route' => [$settings['route']['update'], $settings['params']], 'method' => 'put', 'class' => 'form-horizontal', 'files' => true]) }}
          @component('components.form.generator', ['settings'=> $settings,])@endcomponent
          {{ Form::submit($settings['submitText'], array_merge(['class' => 'btn btn-info btn-block'], $settings['submitAttributes'] ?? [])) }}
          {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
@endsection
@section('js')
  <script src="/plugins/select2/js/select2.min.js"></script>
  <!-- sadece rakam kısıtlaması -->
  <script src="/admin-custom-template/form/only_number.js"></script>
  <!-- datetimepicker -->
  <script src="/admin-custom-template/datetimepicker/moment.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="/admin-custom-template/datetimepicker/bootstrap-datetimepicker.min.js"></script>
  <!-- datepicker -->
  <script type="text/javascript" src="/admin-custom-template/datepicker/bootstrap-datepicker.js"></script>
  <script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>
@endsection
