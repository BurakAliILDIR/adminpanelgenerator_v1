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
          {{ Form::open(['route' => ['fields.store', $module_name, true], 'class' => 'form-horizontal']) }}
          <div class="form-group">
            {{ Form::label('model', 'Model', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
              <select class="form-control m-b" id="model" name="model" required>
                <option selected hidden disabled><-- Model Seçiniz --></option>
                @foreach($models ?? [] as $key => $val)
                  <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>

          @component('components.form.partials.select',
          ['key' => 'relationship',
          'title' => 'İlişki',
          'items' => $relationships,
          ])@endcomponent
          @component('components.form.partials.select',
          ['key' => 'type',
          'title' => 'Tip',
          'items' => $types,
          ])@endcomponent
          <table class="table table-bordered table-responsive table-hover">
            <thead>
            <tr>
              <th>Tip</th>
              <th>1. Alan</th>
              <th>2. Alan</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>HasOne</td>
              <td>Karşı Tablo Key</td>
              <td>Bu Tablo Key</td>
            </tr>
            <tr>
              <td>belongsTo (Karşısı HasOne)</td>
              <td>Bu Tablodaki Key</td>
              <td>Karşı Tablo Key</td>
            </tr>
            <tr>
              <td>HasMany</td>
              <td>Karşı Tablo Key</td>
              <td>Bu Tablo Key</td>
            </tr>
            <tr>
              <td>belongsTo (Karşısı HasMany)</td>
              <td>Karşı Tablo Key</td>
              <td>Bu Tablo Key</td>
            </tr>
            <tr>
              <td>belongsToMany</td>
              <td>Karşı Tablo Key</td>
              <td>Bu Tablo Key</td>
            </tr>
            </tbody>
          </table>
          @component('components.form.partials.radio',
                 ['key' => 'partner',
                 'items' => ['hasOne' => 'HasOne (Tek)', 'hasMany' => 'HasMany (Çok)'],
                 'checked' => null,
                 'title' => 'Karşı Tablo Yapısı',
          ])@endcomponent
          @component('components.form.partials.text',
          ['key' => 'foreignKey',
          'title' => '1. Alan',
          'attributes'=> ['required' => 'required']
          ])@endcomponent
          @component('components.form.partials.text',
          ['key' => 'otherKey',
          'title' => '2. Alan',
          'attributes'=> ['required' => 'required']
          ])@endcomponent
          <small><u>Eğer belonsToMany ise:</u></small>
          @component('components.form.partials.text',
          ['key' => 'table',
          'title' => 'Tablo Adı',
          ])@endcomponent
          <small>--- PLUCK ---</small>
          @component('components.form.partials.select',
          ['key' => 'value',
          'title' => 'Arkadaki Value',
          'items' => []
          ])@endcomponent
          @component('components.form.partials.select',
          ['key' => 'display',
          'title' => 'Görünecek Alan',
          'items' => []
          ])@endcomponent
          <small>-----------------</small>

          <div class="form-check m-b">
            {{ Form::label('fields', 'Görüntülenecek Alanlar', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b">
              <select class="js-example-basic-multiple" style="width: 100%" name="fields[]" id="fields"
                      multiple="multiple" required></select>
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <script>$(document).ready(() => {
              $('#fields').select2({language: "tr"});
            });</script>
          @component('components.form.partials.number',
          ['key' => 'perPage',
          'title' => 'Sayfa Başı Kayıt',
          ])@endcomponent
          @component('components.form.partials.text',
          ['key' => 'name',
          'title' => 'Ad',
          'attributes'=> [ 'required']
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
            {{ Form::label('pages', 'Görünüm', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b">

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
          <small>Aşağıdaki siyah olan alanlar sadece Tip alanı "HasOne", "HasMany" ve ("belongsTo" ve Karşı taraf
            "HasMany") ise doldurulacaktır.</small>
          <div class="form-group bg-black">
            {{ Form::label('partner_value', 'Karşı Tarafın Arkadaki Value', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
              <select class="form-control m-b" id="partner_value" name="partner_value" required>
                <option selected hidden disabled><-- Karşı Tarafın Arkadaki Value Seçiniz --></option>
                @foreach($this_fields as $key => $val)
                  <option value="{{ $key }}">{{ $key }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <div class="form-group bg-black">
            {{ Form::label('partner_display', 'Karşı Tarafın Görünecek Alan', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10">
              <select class="form-control m-b" id="partner_display" name="partner_display" required>
                <option selected hidden disabled><-- Karşı Tarafın Görünecek Alan Seçiniz --></option>
                @foreach($this_fields as $key => $val)
                  <option value="{{ $key }}">{{ $key }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <div class="form-check m-b">
            {{ Form::label('this_fields', 'Karşı Tarafta Görüntülenebilecek Alanlar', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b bg-black">
              @foreach($this_fields as $key => $val)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    {{ Form::checkbox('this_fields[]', $key) }}
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $key }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <div class="form-check m-b">
            {{ Form::label('partner_pages', 'Karşı Taraf Görünüm', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b bg-black">

              @foreach($pages as $page)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    {{ Form::checkbox('partner_pages[]', $page) }}
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $page }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          <div class="form-check m-b">
            {{ Form::label('partner_rules', 'Karşı Taraf Kurallar', ['class' => 'col-sm-2 control-label']) }}
            <div class="col-sm-10 m-b bg-black">
              @foreach($rules as $rule)
                <div class="checkbox">
                  <label class="checkbox-custom center-block">
                    {{ Form::checkbox('partner_rules[]', $rule) }}
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $rule }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>
          <div class="line line-dashed line-lg pull-in"></div>
          {{ Form::submit("Ekle", array_merge(['class' => 'btn btn-primary btn-block'])) }}
          {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
@endsection
@section('js')
  <script src="/plugins/select2/js/select2.min.js"></script>
  <script src="/admin-custom-template/form/only_number.js"></script>
  <script>
    $(document).ready(() => {
      // select 2 çalışması için.
      $('.js-example-basic-single').select2();

      // seçilen modele göre ajax isteği ile dolduracak.
      $("#model").change(() => {

        const display = $('#display');
        const value = $('#value');
        const fields = $('#fields');
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: "post",
          data: {model: $("#model").val()},
          url: '{{ route('fields.getFields') }}',
        }).done((data) => {
          display.children().remove();
          value.children().remove();
          fields.children().remove();
          $.each(data, (index, item) => {
            display.append($("<option />").val(index).text(index + ' (' + item['title'] + ')'));
            value.append($("<option />").val(index).text(index + ' (' + item['title'] + ')'));
            fields.append($("<option />").val(index).text(index + ' (' + item['title'] + ')'));
          });
        }).fail(() => {
          alert('Hata!');
        });
      });
    });
  </script>
@endsection
