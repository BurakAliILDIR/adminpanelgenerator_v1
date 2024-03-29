<head>
<meta charset="utf-8"/>
<title>@yield('title') | {{ $system_settings['name'] }}</title>
<meta name="description" content="{{ $system_settings['description'] }}"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/bootstrap.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/animate.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/font-awesome.min.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/font.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ asset('/storage/admin-template/js/fuelux/fuelux.css') }}" type="text/css"/>

<link rel="stylesheet" href="{{ asset('/storage/admin-template/css/app.css') }}" type="text/css"/>
<!--[if lt IE 9]>
<script src="{{ asset('/storage/admin-template/js/ie/html5shiv.js') }}"></script>
<script src="{{ asset('/storage/admin-template/js/ie/respond.min.js') }}"></script>
<script src="{{ asset('/storage/admin-template/js/ie/excanvas.js') }}"></script>
<![endif]-->
<script src="{{ asset('/storage/admin-template/js/jquery.min.js') }}"></script>
@yield('css')
</head>
