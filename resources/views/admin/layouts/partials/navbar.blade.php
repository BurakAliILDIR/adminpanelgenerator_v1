<?php $auth_user = auth()->user(); ?>
<aside class="bg-dark aside-md hidden-print hidden-xs" id="nav">
  <section class="vbox">
    <header class="bg-primary lter text-center " style="min-height: 130px;">
      <a href="{{ route('profile.index') }}"><img src="{{ $auth_user->getFirstMediaUrl('profile') === '' ? asset
       ('/storage/media/defaults/avatar.jpg') :
         $auth_user->getFirstMediaUrl('profile') }}" class="m-t" style="height: 100px; border-radius: 
         50px;">
        <h5 style="padding-bottom: 15px;" class="text-dark">{{ "$auth_user->name $auth_user->surname" }}</h5></a>

      {{--
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i
                  class="fa fa-plus"></i></button>
              <div class="btn-group hidden-nav-xs">
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                        data-toggle="dropdown">
                  Switch Project
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu text-left">
                  <li><a href="#">Project</a></li>
                  <li><a href="#">Another Project</a></li>
                  <li><a href="#">More Projects</a></li>
                </ul>
              </div>
            </div>
      --}}
    </header>
    <section class="w-f scrollable">
      <div class=" " data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px"
           data-color="#333333">
        <nav class="nav-primary hidden-xs">
          <ul class="nav">
            <?php $is_home = Route::is("home") ? 'active' : ''; ?>
            <li class="{{ $is_home }}">
              <a class="{{ $is_home }}" href="{{ route('home') }}">
                <i class="fa fa-home icon"><b class="bg-primary"></b></i>
                <span>Anasayfa</span>
              </a>
            </li>
            @can('Application.Settings')
              <?php $is_settings = (Route::is('modules.index') || Route::is('log-viewer::logs.filter')) ? 'active' :
                ''; ?>
              <li class="{{ $is_settings }}">
                <a class="{{ $is_settings }}">
                  <i class="fa fa-code icon">
                    <b class="bg-warning"></b>
                  </i>
                  <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                  <span>Uygulama İşlemleri</span>
                </a>
                <ul class="nav lt">
                  <li>
                    <a href="{{ route('modules.index') }}">
                      <i class="fa fa-angle-right"></i>
                      <span>Modüller</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ \Illuminate\Support\Facades\URL::to('error-logs') }}">
                      <i class="fa fa-angle-right"></i>
                      <span>Hata Logları</span>
                    </a>
                  </li>
                </ul>
              </li>
            @endif
            @can('User.index')
              <?php $isActiveMenu = Route::is('user.index') ? 'active' : ''; ?>
              <li class="{{ $isActiveMenu }}">
                <a class="{{ $isActiveMenu }}" href="{{ route('user.index') }}">
                  <i class="fa fa-group icon"><b
                      class="bg-info"></b></i>
                  <span>Kullanıcılar</span>
                </a>
              </li>
            @endcan
            @if($auth_user->can('Role.index') || $auth_user->can('Permission.index'))
              <?php $isActiveMenu = Route::is('role.index') || Route::is('permission.index') ? 'active' : ''; ?>
              <li class="{{ $isActiveMenu }}">
                <a class="{{ $isActiveMenu }}">
                  <i class="fa fa-filter icon">
                    <b class="bg-danger"></b>
                  </i>
                  <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                  <span>Yetki İşlemleri</span>
                </a>
                <ul class="nav lt">
                  @can('Role.index')
                    <li>
                      <a href="{{ route('role.index') }}">
                        <i class="fa fa-angle-right"></i>
                        <span>Roller</span>
                      </a>
                    </li>
                  @endcan
                  @can('Permission.index')
                    <li>
                      <a href="{{ route('permission.index') }}">
                        <i class="fa fa-angle-right"></i>
                        <span>İzinler</span>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endif
            @can('Logs.index')
              <?php $isActiveMenu = Route::is('Logs.index') ? 'active' : ''; ?>
              <li class="{{ $isActiveMenu }}">
                <a class="{{ $isActiveMenu }}" href="{{ route('Logs.index') }}">
                  <i class="fa fa-yelp icon"><b class="bg-info"></b></i>
                  <span>Etkinlikler</span>
                </a>
							</li>
							@endcan
							@php
								$colors = ['', 'danger', 'warning', 'info', 'primary'];
								$menus_path = config('cache.prefix') . ':menus';
								if ( !($menus = unserialize(\Illuminate\Support\Facades\Redis::get($menus_path)))) {
									$menus = json_decode(file_get_contents(storage_path('app\public\application\settings\menu.json')), true);
									\Illuminate\Support\Facades\Redis::set($menus_path, serialize($menus));
								}
								$menu_order = 0
							@endphp
							@foreach($menus as $key => $val)
								@can("$key.index")
									@php
										$menu_order %= 4;
										$menu_order++;
										$isActiveMenu =  Route::is("$key.index") ? 'active' : ''
									@endphp
									<li class="{{ $isActiveMenu }}">
										<a class="{{ $isActiveMenu }}"
											 href="{{ route("$key.index") }}">
											<i class="fa fa-{{ $val['icon'] ?? 'angle-right' }} icon"><b
													class="bg-{{ $colors[$menu_order] }}"></b></i>
											<span>{!! $val['title'] !!}</span>
										</a>
									</li>
								@endcan
							@endforeach
								<?php $isActiveMenu = Route::is('system_settings.index') ? 'active' : ''; ?>
								<li class="{{ $isActiveMenu }}">
									<a class="{{ $isActiveMenu }}" href="{{ route('system_settings.index') }}">
										<i class="fa fa-cogs icon"><b
												class="bg-primary"></b></i>
										<span>Sistem Bilgileri</span>
									</a>
								</li>
							@auth
								<li>
									<a href="{{ route('logout') }}"
										 onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa 
         fa-sign-out"></i> Çıkış</a>
								</li>
							@endauth
					</ul>
				</nav>
			</div>
		</section>
		{{--<footer class="footer lt hidden-xs b-t b-light">
			--}}{{--
			<div id="chat" class="dropup">
				<section class="dropdown-menu on aside-md m-l-n">
					<section class="panel bg-white">
						<header class="panel-heading b-b b-light">Active chats</header>
						<div class="panel-body animated fadeInRight">
							<p class="text-sm">No active chats.</p>
							<p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
						</div>
					</section>
				</section>
			</div>
		 <div id="invite" class="dropup">
				<section class="dropdown-menu on aside-md m-l-n">
					<section class="panel bg-white">
						<header class="panel-heading b-b b-light">
							John <i class="fa fa-circle text-success"></i>
						</header>
						<div class="panel-body animated fadeInRight">
							<p class="text-sm">No contacts in your lists.</p>
							<p><a href="#" class="btn btn-sm btn-facebook"><i
										class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p>
						</div>
					</section>
				</section>
			</div>--}}{{--
	 --}}{{--   <a href="#nav" id="menu-hide" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-black btn-icon">
				<i class="fa fa-angle-left text"></i>
				<i class="fa fa-angle-right text-active"></i>
			</a>--}}{{--
		 --}}{{-- <script>
				const prefix = '{{ config('cache.prefix') }}menu-hide';
				$(function () {
					const result = localStorage.getItem(prefix);
alert(result)
					if (result == 'hide') {
						$('#nav').addClass('nav-xs')
					}
				});

				alert(localStorage.getItem())
				// menüyü gizlemek için kullanılan kod
				$('#menu-hide').click(function () {
					const val = localStorage.getItem(prefix);
					alert(val)
					if (!val) {
						localStorage.setItem(prefix, 'hide');
					} else
						localStorage.removeItem(prefix);
				});
			</script>--}}{{--
			--}}{{--<div class="btn-group hidden-nav-xs">
				<button type="button" title="Chats" class="btn btn-icon btn-sm btn-black"
								data-toggle="dropdown" data-target="#chat"><i class="fa fa-comment-o"></i></button>
				<button type="button" title="Contacts" class="btn btn-icon btn-sm btn-black"
								data-toggle="dropdown" data-target="#invite"><i class="fa fa-facebook"></i></button>
			</div>--}}{{--
		</footer>--}}
  </section>
</aside>
