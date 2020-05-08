@extends('admin.layouts.master')
@section('title', 'Profil Düzenle')
@section('css')
  <!-- datepicker -->
  <link href="{{ asset('/storage/admin-custom-template/datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
  <!-- datetimepicker -->
  <link href="{{ asset('/storage/admin-custom-template/datetimepicker/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet">
  <!-- CkEditor -->
  <script src="{{ asset('/storage/admin-custom-template/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
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
                   href="{{ route('profile.index') }}">
                  <i class="fa fa-arrow-left"></i>
                  Profile Geri Dön
                </a>
                <span class="m-l">{{ 'Profil Düzenle' }}</span>
              </div>
            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          @component('components.alert.error_messages')@endcomponent
          {{ Form::model($model, ['route' => ['profile.update'],  'method' => 'put', 'class' => 'form-horizontal', 'files' => true]) }}
          @component('components.form.partials.text',
               ['key' => 'name',
               'title' => 'Ad',
          ])@endcomponent
          @component('components.form.partials.text',
               ['key' => 'surname',
               'title' => 'Soyad',
          ])@endcomponent
          @component('components.form.partials.email',
               ['key' => 'email',
               'title' => 'E-posta',
          ])@endcomponent
          @component('components.form.partials.password',
               ['key' => 'password',
               'title' => 'Parola',
          ])@endcomponent
          @component('components.form.partials.password',
               ['key' => 'password_confirmation',
               'title' => 'Parola Tekrar',
          ])@endcomponent
          @component('components.form.partials.number',
               ['key' => 'phone',
               'title' => 'Telefon',
          ])@endcomponent
          @component('components.form.partials.radio',
                 ['key' => 'gender',
                 'items' => ['Bay' => 'Bay', 'Bayan' => 'Bayan'],
                 'checked' => $model->gender,
                 'title' => 'Cinsiyet',
          ])@endcomponent
          @component('components.form.partials.date',
               ['key' => 'date_of_birth',
               'title' => 'Doğum Tarihi',
               'value' => $model->date_of_birth,
          ])@endcomponent
            @component('components.form.partials.image',
            ['key' => 'profile',
            'type' => 'image',
            'value' => $model->getFirstMediaUrl('profile'),
            'title' => 'Profil Fotoğrafı',
            ])@endcomponent
            @component('components.form.partials.textarea',
           ['key' => 'bio',
           'title' => 'Hakkımda',
           ])@endcomponent
            {{ Form::submit('Kaydet', array_merge(['class' => 'btn btn-info btn-block'])) }}
            {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>
@endsection
@section('js')
  <!-- datetimepicker -->
  <script src="{{ asset('/storage/admin-custom-template/datetimepicker/moment.min.js') }}"
          type="text/javascript"></script>
  <script type="text/javascript"
          src="{{ asset('/storage/admin-custom-template/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
  <!-- datepicker -->
  <script type="text/javascript"
          src="{{ asset('/storage/admin-custom-template/datepicker/bootstrap-datepicker.js') }}"></script>
@endsection
