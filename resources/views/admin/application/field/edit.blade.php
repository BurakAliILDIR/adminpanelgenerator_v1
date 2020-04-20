@extends('admin.layouts.master')
@section('title', 'Alan Düzenle')
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
                   href="{{ route('modules.show', $module_name) }}">
                  <i class="fa fa-arrow-left"></i>
                  {{ $module_name }} Alanlarına Dön
                </a>
                <span class="m-l">{{ 'Modül Düzenle' }}</span>
              </div>
            </div>
            <div class="col-md-6">

            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          @component('components.alert.error_messages')@endcomponent
          {{ Form::model($cells, ['route' => ['fields.update', $module_name, $key],  'method' => 'put', 'class' => 'form-horizontal']) }}
          @component('components.form.partials.text',
          ['key' => 'title',
          'title' => 'Başlık',
          'value' => $cells['title'],
          'attributes'=> ['required' => 'required']
          ])@endcomponent
          <div class="form-check m-b">
            {{ Form::label('rules', 'Kurallar', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b">
              @foreach($rules as $rule)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    {{ Form::checkbox('rules[]', $rule) }}
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $rule }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <div class="form-check m-b">
            {{ Form::label('attributes', 'Özellikler', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b">
              @foreach($attributes as $attribute_key => $attribute)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    {{ Form::checkbox('attributes[]', $attribute_key) }}
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $attribute }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <small>Multi Image: Sadece "detail" görünümü seçilmelidir.</small><br><br>
          <div class="form-check m-b">
            {{ Form::label('pages', 'Görünüm', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b">
              @foreach($pages as $page)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    {{ Form::checkbox('pages[]', $page, $cells[$page]) }}
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $page }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          {{ Form::submit('Kaydet', array_merge(['class' => 'btn btn-info btn-block'])) }}
          {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
@endsection
@section('js')
@endsection
