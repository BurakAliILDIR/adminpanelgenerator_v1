@extends('admin.layouts.master')
@section('title', 'Modül Düzenle')
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
                   href="{{ route('modules.index') }}">
                  <i class="fa fa-arrow-left"></i>
                  Tüm Modüllere Dön
                </a>
                <span class="m-l">{{ 'Modül Düzenle' }}</span>
              </div>
            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          @component('components.alert.error_messages')@endcomponent
          {{ Form::model($source, ['route' => ['modules.update', $name],  'method' => 'put', 'class' => 'form-horizontal']) }}
          @component('components.form.partials.text',
               ['key' => 'index',
               'title' => 'Listeleme Sayfa Başlık',
               'value' => $source['titles']['index'],
               'attributes' => ['autofocus']
          ])@endcomponent
          @component('components.form.partials.text',
               ['key' => 'menu_title',
               'title' => 'Menü Başlık',
               'value' => $menu['title'],
          ])@endcomponent
            <small>Icon listesi <a href="https://fontawesome.com/v4.7.0/cheatsheet/"><strong>sitesini ziyaret ediniz.</strong></a><br>
            Not: Sadece uzantıyı yazınız.</small>
          @component('components.form.partials.text',
               ['key' => 'menu_icon',
               'title' => 'Menü Icon',
               'value' => $menu['icon'],
          ])@endcomponent
          @component('components.form.partials.text',
               ['key' => 'show',
               'title' => 'Detay Sayfa Başlık',
               'value' => $source['titles']['show'],
          ])@endcomponent
          @component('components.form.partials.text',
               ['key' => 'create',
               'title' => 'Ekleme Sayfa Başlık',
               'value' => $source['titles']['create'],
          ])@endcomponent
          @component('components.form.partials.text',
               ['key' => 'edit',
               'title' => 'Düzenleme Sayfa Başlık',
               'value' => $source['titles']['edit'],
          ])@endcomponent
          @component('components.form.partials.number',
               ['key' => 'paginate',
               'title' => 'Sayfa Başına Kayıt',
          ])@endcomponent
          <div class="form-check m-b">
            {{ Form::label('searchable', 'Arama Yapılabilecek Alanlar', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b @error('searchable[]') is-invalid @enderror">
              @error('searchable[]')
              <div class="label bg-danger">{{ $message }}</div>
              @enderror
              @foreach(array_keys($source['fields']) as $field)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    @if(in_array($field, $source['searchable']))
                      {{ Form::checkbox('searchable[]', $field, true) }}
                    @else
                      {{ Form::checkbox('searchable[]', $field, false) }}
                    @endif
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $field }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <div class="form-check m-b">
            {{ Form::label('slugs', 'Slug Değerini Oluşturacak Alanlar', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b @error('searchable[]') is-invalid @enderror">
              @error('slugs[]')
              <div class="label bg-danger">{{ $message }}</div>
              @enderror
              @foreach(array_keys($source['fields']) as $field)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    @if(in_array($field, $source['slugs']))
                      {{ Form::checkbox('slugs[]', $field, true) }}
                    @else
                      {{ Form::checkbox('slugs[]', $field, false) }}
                    @endif
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $field }}
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
