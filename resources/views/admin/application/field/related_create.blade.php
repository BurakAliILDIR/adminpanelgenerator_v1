@extends('admin.layouts.master')
@section('title', "$module_name - İlişkili Alan Ekle")
@section('css')
  <link href="/plugins/select2/css/select2.min.css" rel="stylesheet"/>
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
                  Tüm Alanlara Dön
                </a>
                <span class="m-l">{{ "$module_name - İlişkili Alan Ekle" }}</span>
              </div>
            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          @component('components.alert.error_messages')@endcomponent
          {{ Form::open(['route' => ['fields.store', $module_name, false], 'class' => 'form-horizontal', 'files' => true]) }}
          @component('components.form.partials.select',
          ['key' => 'model',
          'title' => 'Model',
          'items' => $models,
          'selected' => null,
          'attributes' => ['required'],
          ])@endcomponent            
          @component('components.form.partials.select',
          ['key' => 'relationship',
          'title' => 'İlişki',
          'items' => $relationships,
          'selected' => null,
          'attributes' => ['required'],
          ])@endcomponent
          @component('components.form.partials.select',
          ['key' => 'types',
          'title' => 'Tip',
          'items' => $types,
          'selected' => null,
          'attributes' => ['required'],
          ])@endcomponent
          @component('components.form.partials.text',
          ['key' => 'name',
          'title' => 'Ad',
          'attributes'=> ['autofocus', 'required']
          ])@endcomponent
          @component('components.form.partials.text',
          ['key' => 'title',
          'title' => 'Başlık',
          'attributes'=> ['required']
          ])@endcomponent
          @component('components.form.partials.number',
          ['key' => 'order',
          'title' => 'Sıra',
          'attributes'=> ['required']          
          ])@endcomponent

          {{ Form::submit("Ekle", array_merge(['class' => 'btn btn-primary btn-block'])) }}
          {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
@endsection
@section('js')
  <script src="/plugins/select2/js/select2.min.js"></script>
  <script>
    $(document).ready(function () {
      $('.js-example-basic-single').select2();
    });
  </script>
  <script src="/admin-custom-template/form/only_number.js"></script>
@endsection
