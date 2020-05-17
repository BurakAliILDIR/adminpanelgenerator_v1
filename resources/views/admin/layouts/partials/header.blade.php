<header class="bg-black navbar-fixed-top header navbar navbar-fixed-top-xs">
	<div class="navbar-header aside-logo">
		<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
			<i class="fa fa-bars"></i>
		</a>
		<a href="{{ route('home') }}" class="navbar-brand" data-toggle="fullscreen">
			@if ($system_settings['isLogo'])
				<img src="{{ asset('logo.png') }}" alt="{{ $system_settings['name'] }}">
			@endif
			{{ $system_settings['name'] }}</a>
	</div>
	@php($auth_user = \Illuminate\Support\Facades\Auth::user())
	<ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
		<li>
			<a href="{{ route('profile.index') }}">
            <span class="thumb-sm avatar pull-left">
              <img src="{{ asset($auth_user->getFirstMediaUrl('profile') === '' ? '/storage/application/defaults/avatar.jpg' : $auth_user->getFirstMediaUrl('profile')) }}">
            </span>
        {{ "$auth_user->name $auth_user->surname" }} </b>
      </a>
    </li>
    <li>
      <a href="{{ route('logout') }}"
         onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa 
         fa-sign-out"></i> Çıkış</a>
      {{ Form::open(['route' => ['logout'], 'style' => 'display: none;', 'id' => 'logout-form']) }}
      {!! Form::close() !!}
    </li>
  </ul>

  {{--Orjinal:
    
    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user">
    <li class="hidden-xs">
      <a href="#" class="dropdown-toggle dk" data-toggle="dropdown">
        <i class="fa fa-bell"></i>
        <span class="badge badge-sm up bg-danger m-l-n-sm count">2</span>
      </a>
      <section class="dropdown-menu aside-xl">
        <section class="panel bg-white">
          <header class="panel-heading b-light bg-light">
            <strong>You have <span class="count">2</span> notifications</strong>
          </header>
          <?php $auth_user = \Illuminate\Support\Facades\Auth::user(); ?>
          <div class="list-group list-group-alt animated fadeInRight">
            <a href="#" class="media list-group-item">
                  <span class="pull-left thumb-sm">
                    <img src="{{ asset('/storage/admin-template/images/avatar.jpg') }}" alt="Mikel"
                         class="img-circle">
                  </span>
              <span class="media-body block m-b-none">
                    Use awesome animate.css<br>
                    <small class="text-muted">10 minutes ago</small>
                  </span>
            </a>
            <a href="#" class="media list-group-item">
                  <span class="media-body block m-b-none">
                    1.0 initial released<br>
                    <small class="text-muted">1 hour ago</small>
                  </span>
            </a>
          </div>
          <footer class="panel-footer text-sm">
            <a href="#" class="pull-right"><i class="fa fa-cog"></i></a>
            <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
          </footer>
        </section>
      </section>
    </li>
    <li class="dropdown hidden-xs">
      <a href="#" class="dropdown-toggle dker" data-toggle="dropdown"><i class="fa fa-fw fa-search"></i></a>
      <section class="dropdown-menu aside-xl animated fadeInUp">
        <section class="panel bg-white">
          <form role="search">
            <div class="form-group wrapper m-b-none">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-icon"><i class="fa fa-search"></i></button>
                    </span>
              </div>
            </div>
          </form>
        </section>
      </section>
    </li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
              <img
                src="{{ $auth_user->getFirstMediaUrl('profile') === '' ? asset('/storage/application/defaults/avatar.jpg') : 
                $auth_user->getFirstMediaUrl('profile') }}">
            </span>
        {{ "$auth_user->name $auth_user->surname" }} <b class="caret"></b>
      </a>
      <ul class="dropdown-menu animated fadeInRight">
        <span class="arrow top"></span>
        <li>
          <a href="#">Settings</a>
        </li>
        <li>
          <a href="{{ route('profile.index') }}">Profile</a>
        </li>
        <li>
          <a href="#">
            <span class="badge bg-danger pull-right">3</span>
            Notifications
          </a>
        </li>
        <li>
          <a href="docs.html">Help</a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="{{ route('logout') }}"
             onclick="event.preventDefault();document.getElementById('logout-form').submit();">Çıkış</a>
          {{ Form::open(['route' => ['logout'], 'style' => 'display: none;', 'id' => 'logout-form']) }}
          {!! Form::close() !!}
        </li>
      </ul>
    </li>
  </ul>--}}
</header>
