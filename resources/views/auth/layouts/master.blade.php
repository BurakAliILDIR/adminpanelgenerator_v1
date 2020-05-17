<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-dark">
<head>
	<meta charset="utf-8"/>
	<title>@yield('title') | {{ $system_settings('name') }}</title>
	<meta name="description" content="{{ $system_settings('description') }}"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/bootstrap.css') }}" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/animate.css') }}" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/font-awesome.min.css') }}" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/font.css') }}" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/app.css') }}" type="text/css"/>
<!--[if lt IE 9]>
  <script src="{{ asset('/storage/admin-template/js/ie/html5shiv.js') }}"></script>
  <script src="{{ asset('/storage/admin-template/js/ie/respond.min.js') }}"></script>
  <script src="{{ asset('/storage/admin-template/js/ie/excanvas.js') }}"></script>
  <![endif]-->
</head>
<body>
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
  <div class="container aside-xxl">
    <a class="navbar-brand block" href="{{ route('home') }}">{{ $system_settings('name') }}</a>
    <section class="panel panel-default bg-white m-t-lg">
      <header class="panel-heading text-center">
        <strong>@yield('title')</strong>
      </header>
      @yield('content')
    </section>
  </div>
</section>
<!-- footer -->
<footer id="footer">
  <div class="text-center padder">
    <p>
      <small> {{ __('All rights reserved.') }} TheNobleBrain<br>&copy; 2020</small>
    </p>
  </div>
</footer>
<!-- / footer -->
<script src="{{ asset('/storage/admin-template/js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('/storage/admin-template/js/bootstrap.js') }}"></script>
<!-- App -->
<script src="{{ asset('/storage/admin-template/js/app.js') }}"></script>
<script src="{{ asset('/storage/admin-template/js/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('/storage/admin-template/js/app.plugin.js') }}"></script>
</body>
</html>
