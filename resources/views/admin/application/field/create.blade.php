@extends('admin.layouts.master')
@section('title', 'Alan Ekle')
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
                <span class="m-l">Alan Ekle</span>
              </div>
            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          @component('components.alert.error_messages')@endcomponent
          {{ Form::open(['route' => ['fields.store', $module_name, false], 'class' => 'form-horizontal', 'files' => true]) }}
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
          <small>Kimlik (id = 0) alanından kaç sıra sonraya eklensin?</small><br><br>
          @component('components.form.partials.number',
          ['key' => 'order',
          'title' => 'Sıra',
          'attributes'=> ['required']          
          ])@endcomponent
          @component('components.form.partials.select',
          ['key' => 'type',
          'title' => 'Tip',
          'value' => [
          'text' => 'Text',
          'number' => 'Numeric',
          'textarea' => 'Textarea',
          'radio' => 'Radio Button',
          'checkbox' => 'CheckBox (true, false)',
          'select' => 'Select',
          'date' => 'Date (dd.mm.yyyy)',
          'datetime' => 'DateTime (dd.mm.yyyy h:i:s)',
          'image' => 'Image',
          'multi_image' => 'Multi Image',
          'file' => 'File',
          'email' => 'E-mail',
          'hidden' => 'Hidden',
          'password' => 'Secret',
          ],
          'selected' => null,
          'attributes' => ['required'],
          ])@endcomponent
          <div class="form-check m-b">
            {{ Form::label('rules', 'Kurallar', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b @error('rules[]') is-invalid @enderror">
              @error('rules[]')
              <div class="label bg-danger">{{ $message }}</div>
              @enderror
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
            <div class="col-sm-10 m-b @error('attributes[]') is-invalid @enderror">
              @error('attributes[]')
              <div class="label bg-danger">{{ $message }}</div>
              @enderror
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
          <div class="form-check m-b">
            {{ Form::label('pages', 'Görünüm', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b @error('pages[]') is-invalid @enderror">
              @error('pages[]')
              <div class="label bg-danger">{{ $message }}</div>
              @enderror
              @foreach($pages as $page)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    {{ Form::checkbox('pages[]', $page) }}
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $page }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <small>
            Radio: Hangi seçenekler arasında seçim yapılacağını yazın. | işareti ile ayırarak (boşluk olmadan).<br>
            Select: Hangi seçenekler arasında seçim yapılacağını yazın. | işareti ile ayırarak (boşluk olmadan).<br>
            CheckBox: Kutucuğun yanında yazacak yazıyı yazın.<br>
            Image: "avatar.jpg" varsayılan değerlerinden bir tanesini yazın.<br>
            Multi Image: En fazla bulunabilecek resim sayısını yazınız. (Boş bıraklırsa sınırsız resim
            bulundurabilir.)<br>
          </small>
          <br>
          @component('components.form.partials.text',
               ['key' => 'values',
               'title' => 'Değerler',
          ])@endcomponent

          {{ Form::submit("Ekle", array_merge(['class' => 'btn btn-primary btn-block'])) }}
          {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
