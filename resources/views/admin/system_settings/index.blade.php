@extends('admin.layouts.master')
@section('title', 'Sistem Bilgileri')
@section('css')
@endsection
@section('content')
	<section class="vbox">
		<header class="header bg-white b-b b-light">
			<div class="row">
				<div class="col-md-6 col-xs-6">
					<div class="m-t">
						<span class="m-l">Sistem Bilgileri</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="m-t m-r pull-right">
						<a class="btn btn-xs btn-info btn-rounded "
							 href="{{ route('system_settings.edit') }}">
							<i class="fa fa-edit"></i>
							Sistem Bilgilerini Düzenle
						</a>
					</div>
				</div>
			</div>
		</header>
		<section class="scrollable">
			<section class="hbox stretch row">
				<aside class="bg-light lter b-r col-sm-12">
					<section class="vbox">
						<section class="scrollable">
							<div class="wrapper-lg">
								<div style="word-break: break-all">
									<small class="text-uc text-muted">Ad : </small>
									<span>{!! $system_settings['name'] !!}</span>
									<div class="line"></div>
									<small class="text-uc text-muted">Açıklama : </small>
									<span>{!! $system_settings['description'] !!}</span>
									<div class="line"></div>
									<small class="text-uc text-muted">E-posta : </small>
									<span>{{ $system_settings['email'] }}</span>
									<div class="line"></div>
									<small class="text-uc text-muted">Telefon : </small>
									<span>{{ $system_settings['phone'] }}</span>
									<div class="line"></div>
									<small class="text-uc text-muted">Faks : </small>
									<span>{{ $system_settings['fax'] }}</span>
									<div class="line"></div>
									<small class="text-uc text-muted">Adres : </small>
									<span>{{ $system_settings['address'] }}</span>
									<div class="line"></div>
									<small class="text-uc text-muted">Hakkımızda : </small>
									<span>{!! $system_settings['about'] !!}</span>
									<div class="line"></div>
								</div>
							</div>
						</section>
					</section>
				</aside>
			</section>
		</section>
	</section>
@endsection
@section('js')
@endsection
