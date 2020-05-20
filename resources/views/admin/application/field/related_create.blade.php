@extends('admin.layouts.master')
@section('title', "$module_name - İlişkili Alan Ekle")
@section('css')
  <link href="{{ asset('/storage/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-5 col-md-offset-3">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">
					<div class="row">
						<div class="col-md-12">
							<div class="m-t">
								<a class="btn btn-xs btn-default btn-rounded "
									 href="{{ route('modules.show', $module_name) }}">
									<i class="fa fa-arrow-left"></i>
									{{ $module_name }} Alanlarına Dön
								</a>
								<span class="m-l">{{ $module_name }} - İlişkili Alan Ekle</span>
							</div>
						</div>
					</div>
				</header>
				<div class="panel-body">
					@component('components.alert.alert_messages')@endcomponent
					@component('components.alert.error_messages')@endcomponent
					{{ Form::open(['route' => ['fields.store', [$module_name, true]], 'class' => 'form-horizontal']) }}
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
					<table class="table">
						<tr>
							<td>HasMany</td>
							<td>"Select" tipinde olmalı. Ekleme ve güncelleme işlemleri bu modülde görünür olmalı. Karşı modül
								birden fazla bu modül verisine sahip olabilir.
							</td>
						</tr>
						<tr>
							<td>HasOne</td>
							<td>"Select" tipinde olmalı. Ekleme ve güncelleme işlemleri bu modülde görünür olmalı. Karşı modül
								bir bu modül verisine sahip olabilir.
							</td>
						</tr>
						<tr>
							<td>BelongsTo (HasOne)</td>
							<td>"Select" tipinde olmalı. Ekleme ve güncelleme işlemleri karşı modülde görünür olmalı. İki modül de
								birbirine bağlanan bir adet veriye sahip olabilir.
							</td>
						</tr>
						<tr>
							<td>BelongsTo (HasMany)</td>
							<td>"Select" tipinde olmalı. Ekleme ve güncelleme işlemleri karşı modülde görünür olmalı. Bu modül
								birden fazla karşı modül verisine sahip olabilir.
							</td>
						</tr>
						<tr>
							<td>BelongsToMany</td>
							<td>"Multi Select" veya "Multi Checkbox" tipinde olmalı. İsteğe bağlı olarak en az bir modülde ekleme
								ve güncelleme işlemleri görünür olmalıdır. İki modül de birden fazla karşı modül verisine sahip
								olabilir.
							</td>
						</tr>
					</table>
					@component('components.form.partials.select',
					['key' => 'relationship',
					'title' => 'İlişki',
					'items' => $relationships,
					])@endcomponent
					<small>Çoklu seçim isteniyorsa "BelongsToMany" olmak zorundadır. Aksi taktirde "Select" seçilmedir.</small>
					@component('components.form.partials.select',
					['key' => 'type',
					'title' => 'Tip',
					'items' => $types,
					])@endcomponent
					<small>Eğer "belogsTo" seçildiyse:</small>
					@component('components.form.partials.radio',
								 ['key' => 'partner',
								 'items' => ['hasOne' => 'HasOne (Tek)', 'hasMany' => 'HasMany (Karşısı Çok)'],
								 'checked' => null,
								 'title' => 'Karşı Tablo Yapısı',
					])@endcomponent
					<small>--- Form kontorlü ---</small>
					@component('components.form.partials.select',
					['key' => 'display',
					'title' => 'Görünecek Alan',
					'items' => []
					])@endcomponent
					<small>--- Listeleme ve detay sayfalarında ---</small>
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
					['key' => 'title',
					'title' => 'Başlık',
					'attributes'=> ['required']
					])@endcomponent
					@component('components.form.partials.number',
					['key' => 'order',
					'title' => 'Sıra',
					'attributes'=> ['required']          
					])@endcomponent
					@include('admin.application.field.partials.rules_table')
					<div class="form-group">
						{{ Form::label('rules', 'Kurallar', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10">
							{{ Form::textarea('rules', null, ['class' => 'form-control m-b', 'rows' => '3']) }}
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
					<strong class="text-danger">Aşağıdaki alanlar sadece "tip" alanı "HasOne", "HasMany" ve ("belongsTo" ve
						Karşı
						taraf "HasMany") ve BelongsToMany ise doldurulacaktır.</strong>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group">
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
						<div class="col-sm-10 m-b">
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
					@include('admin.application.field.partials.rules_table')
					<div class="form-group">
						{{ Form::label('partner_rules', 'Karşı Taraf Kurallar', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10">
							{{ Form::textarea('partner_rules', null, ['class' => 'form-control m-b', 'rows' => '3']) }}
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-check m-b">
						{{ Form::label('partner_pages', 'Karşı Taraf Görünüm', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10 m-b">
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
					{{ Form::submit("Ekle", array_merge(['class' => 'btn btn-primary btn-block'])) }}
					{!! Form::close() !!}
				</div>
			</section>
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('/storage/plugins/select2/js/select2.min.js') }}"></script>
	<script src="{{ asset('/storage/admin-custom-template/form/only_number.js') }}"></script>
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
