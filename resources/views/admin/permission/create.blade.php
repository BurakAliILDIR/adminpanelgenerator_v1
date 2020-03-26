@extends('admin.layouts.master')
@section('title', 'İzin Ekle')
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
                   href="{{ route('permission.index') }}">
                  <i class="fa fa-arrow-left"></i>
                  Tüm Kayıtlara Dön
                </a>
                <span class="m-l">İzin Ekle</span>
              </div>
            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          {{ Form::model($model, ['route' => ['permission.store'], 'class' => 'form-horizontal']) }}
          @component('components.form.partials.text',
               ['key' => 'name',
               'title' => 'İzin Adı',
          ])@endcomponent
          @component('components.form.partials.multi_checkbox',
          ['key' => 'roles',
          'value' => $roles,
          'checked' => Collect([]),
          'title' => 'Roller',
          ])@endcomponent
          {{ Form::submit("Ekle", array_merge(['class' => 'btn btn-primary btn-block'])) }}
          {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
@endsection
@section('js')
@endsection