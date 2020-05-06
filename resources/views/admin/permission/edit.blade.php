@extends('admin.layouts.master')
@section('title', 'İzin Düzenle')
@section('css')
  <link href="{{ asset('/storage/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>
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
                   href="{{ route('permission.index') }}">
                  <i class="fa fa-arrow-left"></i>
                  Tüm Kayıtlara Dön
                </a>
                <span class="m-l">{{ 'İzin Düzenle' }}</span>
              </div>
            </div>
            <div class="col-md-6">
              @can('Permission.detail')
                <div class="m-t">
                  <a class="btn btn-xs btn-default btn-rounded pull-right"
                     href="{{ route('permission.show', $model->id) }}">
                    Detay Sayfasına Git
                    <i class="fa fa-arrow-right"></i>
                  </a>
                </div>
              @endcan
            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          @component('components.alert.error_messages')@endcomponent
          {{ Form::model($model, ['route' => ['permission.update', $model->id],  'method' => 'put', 'class' => 'form-horizontal']) }}
          @component('components.form.partials.text',
          ['key' => 'name',
          'title' => 'İzin Adı',
          'attributes' => ['readonly']
          ])@endcomponent
          @component('components.form.partials.multi_select',
          ['key' => 'roles',
          'value' => $roles,
          'checked' => $model->roles()->get(),
          'title' => 'Roller',
          ])@endcomponent
            {{ Form::submit('Kaydet', array_merge(['class' => 'btn btn-info btn-block'])) }}
            {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
@endsection
@section('js')
  <script src="{{ asset('/storage/plugins/select2/js/select2.min.js') }}"></script>
@endsection
