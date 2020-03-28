@extends('admin.layouts.master')
@section('title', 'Rol Düzenle')
@section('css')
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
                   href="{{ route('role.index') }}">
                  <i class="fa fa-arrow-left"></i>
                  Tüm Kayıtlara Dön
                </a>
                <span class="m-l">{{ 'Rol Düzenle' }}</span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="m-t">
                <a class="btn btn-xs btn-default btn-rounded pull-right"
                   href="{{ route('role.show', $model->id) }}">
                  Detay Sayfasına Git
                  <i class="fa fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          {{ Form::model($model, ['route' => ['role.update', $model->id],  'method' => 'put', 'class' => 'form-horizontal']) }}
          @component('components.form.partials.text',
               ['key' => 'name',
               'title' => 'Rol Adı',
               'attributes' => ['readonly']
          ])@endcomponent
          @component('components.form.partials.multi_checkbox',
          ['key' => 'permissions',
          'value' => $permissions,
          'checked' => $model->permissions()->get(),
          'title' => 'İzinler',
          ])@endcomponent          {{ Form::submit('Kaydet', array_merge(['class' => 'btn btn-info btn-block'])) }}
          {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
@endsection
@section('js')
@endsection
