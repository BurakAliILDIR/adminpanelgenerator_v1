<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-dark">
<head>
  <meta charset="utf-8"/>
  <title>@yield('title') | {{ config('app.name') }}</title>
  <meta name="description" content="{{ config('app.description') }}"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
  <link rel="stylesheet" href="/admin-template/css/bootstrap.css" type="text/css"/>
  <link rel="stylesheet" href="/admin-template/css/animate.css" type="text/css"/>
  <link rel="stylesheet" href="/admin-template/css/font-awesome.min.css" type="text/css"/>
  <link rel="stylesheet" href="/admin-template/css/font.css" type="text/css"/>
  <link rel="stylesheet" href="/admin-template/css/app.css" type="text/css"/>
  <!--[if lt IE 9]>
  <script src="/admin-template/js/ie/html5shiv.js"></script>
  <script src="/admin-template/js/ie/respond.min.js"></script>
  <script src="/admin-template/js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
  <div class="container aside-xxl">
    <a class="navbar-brand block"{{-- href="index.html"--}}>{{ config('app.name', 'Laravel') }}</a>
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
<script src="/admin-template/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/admin-template/js/bootstrap.js"></script>
<!-- App -->
<script src="/admin-template/js/app.js"></script>
<script src="/admin-template/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/admin-template/js/app.plugin.js"></script>
<script>
  localStorage.clear();
</script>
</body>
</html>
