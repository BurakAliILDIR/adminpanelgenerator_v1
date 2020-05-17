@extends('admin.layouts.master')
@section('title', 'Sistem Bilgilerini Düzenle')
@section('css')
	<!-- CkEditor -->
	<script src="{{ asset('/storage/admin-custom-template/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-5 col-md-offset-3">
			<section class="panel panel-default">
				<header class="panel-heading font-bold">
					<div class="row">
						<div class="col-md-12">
							@can('SystemSettings.index')
								<div class="m-t">
									<a class="btn btn-xs btn-default btn-rounded "
										 href="{{ route('system_settings.index') }}">
										<i class="fa fa-arrow-left"></i>
										Sistem Bilgilerine Geri Dön
									</a>
									<span class="m-l">Sistem Bilgilerini Düzenle</span>
								</div>
							@endcan
						</div>
					</div>
				</header>
				<div class="panel-body">
					@component('components.alert.alert_messages')@endcomponent
					@component('components.alert.error_messages')@endcomponent
					{{ Form::open(['route' => ['system_settings.update'], 'method' => 'put', 'class' => 'form-horizontal', 
					'files' => true]) }}
					@component('components.form.partials.text',
							 ['key' => 'name',
							 'title' => 'Sistemin Adı',
							 'value' => $system_settings['name']
					])@endcomponent
					<div class="form-group">
						{{ Form::label('description', 'Açıklama', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10">
							{{ Form::textarea('description', $system_settings['description'], array_merge(['class' => 'form-control m-b'], ['rows' => 3])) }}
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group">
						{{ Form::label('email', 'E-posta', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10">
							{{ Form::email('email', $system_settings['email'], array_merge(['class' => 'form-control m-b', 'autocomplete' => 'off'])) }}
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>

					<div class="form-group">
						{{ Form::label('phone', 'Telefon', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10">
							{{ Form::text('phone', $system_settings['phone'], array_merge(['class' => 'form-control m-b', 'autocomplete' => 'off', 'data-mask' => 'only_number'])) }}
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>

					<div class="form-group">
						{{ Form::label('fax', 'Faks', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10">
							{{ Form::text('fax', $system_settings['fax'], array_merge(['class' => 'form-control m-b', 'autocomplete' => 'off', 'data-mask' => 'only_number'])) }}
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-group">
						{{ Form::label('address', 'Adres', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10">
							{{ Form::textarea('address', $system_settings['address'], array_merge(['class' => 'form-control m-b'], ['rows' => 3])) }}
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<div class="form-check m-b">
						{{ Form::label('isLogo', 'Logo Durum', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10 m-b">
							<div class="checkbox">
								<label class="checkbox-custom center-block">
									{{ Form::checkbox('isLogo', true, $system_settings['isLogo']) }}
									<i class="fa fa-fw fa-square-o"></i>
									Logo görünsün
								</label>
							</div>
						</div>
					</div>
					<br>
					<div class="line line-dashed line-lg pull-in"></div>
					@component('components.form.partials.image',
							['key' => 'logo',
							'value' => asset('/logo.png'),
							'title' => 'Logo',
					])@endcomponent
					<div class="row">
						<div class="col-sm-offset-3 col-sm-4">
							<img class="m-b"  src="{{ asset('/favicon.ico') }}">
						</div>
					</div>
					@component('components.form.partials.image',
							['key' => 'favicon',
							'value' => '',
							'title' => 'Sekme Logo',
					])@endcomponent
					<div class="form-group">
						{{ Form::label('about', 'Hakkımızda', ['class' => 'col-sm-2 control-label']) }}
						<div class="col-sm-10">
							{{ Form::textarea('about', $system_settings['about'], array_merge(['class' => 'form-control m-b'])) }}
						</div>
					</div>
					<div class="line line-dashed line-lg pull-in"></div>
					<script>
						CKEDITOR.replace('about');
					</script>

					{{ Form::submit('Kaydet', array_merge(['class' => 'btn btn-info btn-block'])) }}
					{!! Form::close() !!}
				</div>
			</section>
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('/storage/admin-custom-template/form/only_number.js') }}"></script>
@endsection
