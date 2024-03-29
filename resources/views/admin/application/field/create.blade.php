@extends('admin.layouts.master')
@section('title', 'Alan Ekle')
@section('css')
  <link href="{{ asset('/storage/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>
@endsection
@section('content')
  <div class="row" style="margin-bottom: 300px;">
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
                <span class="m-l">{{ $module_name }} - Alan Ekle</span>
              </div>
            </div>
          </div>
        </header>
        <div class="panel-body">
          @component('components.alert.alert_messages')@endcomponent
          @component('components.alert.error_messages')@endcomponent
          {{ Form::open(['route' => ['fields.store', [$module_name, false]], 'class' => 'form-horizontal']) }}
          @component('components.form.partials.select',
          ['key' => 'type',
          'title' => 'Tip',
          'items' => $types,
          'selected' => null,
          'attributes' => ['required' => 'required'],
          ])@endcomponent
					@component('components.form.partials.text',
					['key' => 'name',
					'title' => 'Key',
					'attributes'=> ['required' => 'required']
					])@endcomponent
					@component('components.form.partials.text',
					['key' => 'title',
					'title' => 'Başlık',
					'attributes'=> ['required' => 'required']
					])@endcomponent
					<small>Eğer Text, Number veya Decimal tipinde ise:</small>
					@component('components.form.partials.text',
					['key' => 'unit',
					'title' => 'Birim (isteğe bağlı)',
					])@endcomponent
					@component('components.form.partials.number',
					['key' => 'order',
					'title' => 'Sıra',
					'attributes'=> ['required']          
					])@endcomponent

					<small>
						<u>Eğer tip aşağıdaki seçeneklerden biriyse;</u> <br>
						<u>Radio:</u> Hangi seçenekler arasında seçim yapılacağını yazın. | işareti ile ayırarak (boşluk
						olmadan).<br>
						<u>Select:</u> Hangi seçenekler arasında seçim yapılacağını yazın. | işareti ile ayırarak (boşluk
						olmadan).<br>
						<u>CheckBox:</u> Kutucuğun yanında yazacak yazıyı yazın.<br>
						<u>Image:</u> "avatar.jpg" veya "image.png" değerlerinden bir tanesini yazın. Varsayılan "image.png"<br>
						<u>Multi Image:</u> En fazla bulunabilecek resim sayısını yazınız. (Boş bıraklırsa sınırsız resim
						bulundurabilir.)<br>
					</small>
					<br>
					@component('components.form.partials.text',
							 ['key' => 'values',
							 'title' => 'Değerler',
					])@endcomponent
					<small>Auth seçildi ise: --- Detay sayfasında görünecek alanlar ---</small>
					<div class="form-check m-b">
						{{ Form::label('fields', 'Görüntülenecek Alanlar', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10 m-b">
							@foreach($this_fields as $key => $val)
								<div class="checkbox">
									<label class="checkbox-custom center-block">
										{{ Form::checkbox('fields[]', $key) }}
										<i class="fa fa-fw fa-square-o"></i>
										{{ "$key (" . $val['title'] . ")" }}
									</label>
								</div>
							@endforeach
						</div>
					</div>
						<div class="line line-dashed line-lg pull-in"></div>
						@include('admin.application.field.partials.rules_table')
						<div class="form-group">
							{{ Form::label('rules', 'Kurallar', ['class' => 'col-sm-2 control-label']) }}
							<div class="col-sm-10">
								{{ Form::textarea('rules', null, ['class' => 'form-control m-b', 'rows' => '3']) }}
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
						{{ Form::submit("Ekle", array_merge(['class' => 'btn btn-primary btn-block'])) }}
						{!! Form::close() !!}
				</div>
			</section>
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('/storage/plugins/select2/js/select2.min.js') }}"></script>
	<script>
    $(document).ready(function () {
      $('.js-example-basic-single').select2();
    });
  </script>
  <script src="{{ asset('/storage/admin-custom-template/form/only_number.js') }}"></script>
@endsection
