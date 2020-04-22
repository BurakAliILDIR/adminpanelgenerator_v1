<aside class="bg-light aside-md hidden-print hidden-xs" id="nav">
  <section class="vbox">
    <header class="header bg-primary lter text-center">
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
    </header>
    <section class="w-f scrollable">
      <div class=" " data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px"
           data-color="#333333">
        <!-- nav -->
        <nav class="nav-primary hidden-xs">
          <ul class="nav">
            <?php $auth_user = auth()->user(); ?>
            <li>
              <a href="{{ route('home') }}">
                <i class="fa fa-home }} icon"><b class="bg-primary"></b></i>
                <span>Anasayfa</span>
              </a>
            </li>

            @can('Application.Settings')
              <li class="">
                <a class="">
                  <i class="fa fa-steam icon">
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
                    <a href="{{ \Illuminate\Support\Facades\URL::to('loglar') }}">
                      <i class="fa fa-angle-right"></i>
                      <span>Hata Logları</span>
                    </a>
                  </li>
                </ul>
              </li>
            @endif
            @if($auth_user->can('Role.index') || $auth_user->can('Permission.index') || $auth_user->can('User.index'))
              <li class="">
                <a class="">
                  <i class="fa fa-user icon">
                    <b class="bg-danger"></b>
                  </i>
                  <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                  <span>Kullanıcı İşlemleri</span>
                </a>
                <ul class="nav lt">
                  @can('User.index')
                    <li>
                      <a href="{{ route('user.index') }}">
                        <i class="fa fa-angle-right"></i>
                        <span>Kullanıcılar</span>
                      </a>
                    </li>
                  @endcan
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
                  @can('Logs')
                    <li>
                      <a href="{{ route('Logs') }}">
                        <i class="fa fa-angle-right"></i>
                        <span>Etkinlikler</span>
                      </a>
                    </li>
                  @endcan
                </ul>
              </li>
            @endif
            <?php
            $menus_path = config('cache.prefix') . ':menus';
            if ( !($menus = unserialize(\Illuminate\Support\Facades\Redis::get($menus_path)))) {
              $menus = json_decode(file_get_contents(storage_path('app\public\application\settings\menu.json')), true);
              \Illuminate\Support\Facades\Redis::set($menus_path, serialize($menus));
            }
            ?>
            @foreach($menus as $key => $val)
              @can($key . '.index')
                <li>
                  <a href="{{ route(strtolower($key).'.index') }}">
                    <i class="fa fa-{{ $val['icon'] ?? 'angle-right' }} icon"><b class="bg-primary"></b></i>
                    <span>{!! $val['title'] !!}</span>
                  </a>
                </li>
              @endcan
            @endforeach
            {{--<li class="active">
                <a href="#layout" class="active">
                    <i class="fa fa-columns icon">
                        <b class="bg-warning"></b>
                    </i>
                    <span class="pull-right">
              <i class="fa fa-angle-down text"></i>
              <i class="fa fa-angle-up text-active"></i>
            </span>
                    <span>Layouts</span>
                </a>
                <ul class="nav lt">
                    <li>
                        <a href="layout-c.html">
                            <i class="fa fa-angle-right"></i>
                            <span>Color option</span>
                        </a>
                    </li>
                    <li>
                        <a href="layout-r.html">
                            <i class="fa fa-angle-right"></i>
                            <span>Right nav</span>
                        </a>
                    </li>
                    <li>
                        <a href="layout-h.html">
                            <i class="fa fa-angle-right"></i>
                            <span>Hbox Layout</span>
                        </a>
                    </li>
                    <li>
                        <a href="layout-boxed.html">
                            <i class="fa fa-angle-right"></i>
                            <span>Boxed Layout</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="layout-fluid.html" class="active">
                            <i class="fa fa-angle-right"></i>
                            <span>Fluid Layout</span>
                        </a>
                    </li>
                </ul>
            </li>--}}

            {{--  Burası sonraki menüler --}}
            {{--   <li>
                 <a href="#uikit">
                   <i class="fa fa-flask icon">
                     <b class="bg-success"></b>
                   </i>
                   <span class="pull-right">
                             <i class="fa fa-angle-down text"></i>
                             <i class="fa fa-angle-up text-active"></i>
                           </span>
                   <span>UI kit</span>
                 </a>
                 <ul class="nav lt">
                   <li>
                     <a href="buttons.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Buttons</span>
                     </a>
                   </li>
                   <li>
                     <a href="icons.html">
                       <b class="badge bg-info pull-right">369</b>
                       <i class="fa fa-angle-right"></i>
                       <span>Icons</span>
                     </a>
                   </li>
                   <li>
                     <a href="grid.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Grid</span>
                     </a>
                   </li>
                   <li>
                     <a href="widgets.html">
                       <b class="badge  pull-right">8</b>
                       <i class="fa fa-angle-right"></i>
                       <span>Widgets</span>
                     </a>
                   </li>
                   <li>
                     <a href="components.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Components</span>
                     </a>
                   </li>
                   <li>
                     <a href="list.html">
                       <i class="fa fa-angle-right"></i>
                       <span>List group</span>
                     </a>
                   </li>
                   <li>
                     <a href="#table">
                       <i class="fa fa-angle-down text"></i>
                       <i class="fa fa-angle-up text-active"></i>
                       <span>Table</span>
                     </a>
                     <ul class="nav bg">
                       <li>
                         <a href="table-static.html">
                           <i class="fa fa-angle-right"></i>
                           <span>Table static</span>
                         </a>
                       </li>
                       <li>
                         <a href="table-datatable.html">
                           <i class="fa fa-angle-right"></i>
                           <span>Datatable</span>
                         </a>
                       </li>
                       <li>
                         <a href="table-datagrid.html">
                           <i class="fa fa-angle-right"></i>
                           <span>Datagrid</span>
                         </a>
                       </li>
                     </ul>
                   </li>
                   <li>
                     <a href="#form">
                       <i class="fa fa-angle-down text"></i>
                       <i class="fa fa-angle-up text-active"></i>
                       <span>Form</span>
                     </a>
                     <ul class="nav bg">
                       <li>
                         <a href="form-elements.html">
                           <i class="fa fa-angle-right"></i>
                           <span>Form elements</span>
                         </a>
                       </li>
                       <li>
                         <a href="form-validation.html">
                           <i class="fa fa-angle-right"></i>
                           <span>Form validation</span>
                         </a>
                       </li>
                       <li>
                         <a href="form-wizard.html">
                           <i class="fa fa-angle-right"></i>
                           <span>Form wizard</span>
                         </a>
                       </li>
                     </ul>
                   </li>
                   <li>
                     <a href="chart.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Chart</span>
                     </a>
                   </li>
                   <li>
                     <a href="fullcalendar.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Fullcalendar</span>
                     </a>
                   </li>
                   <li>
                     <a href="portlet.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Portlet</span>
                     </a>
                   </li>
                   <li>
                     <a href="timeline.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Timeline</span>
                     </a>
                   </li>
                 </ul>
               </li>
               <li>
                 <a href="#pages">
                   <i class="fa fa-file-text icon">
                     <b class="bg-primary"></b>
                   </i>
                   <span class="pull-right">
                             <i class="fa fa-angle-down text"></i>
                             <i class="fa fa-angle-up text-active"></i>
                           </span>
                   <span>Pages</span>
                 </a>
                 <ul class="nav lt">
                   <li>
                     <a href="gallery.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Gallery</span>
                     </a>
                   </li>
                   <li>
                     <a href="profile.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Profile</span>
                     </a>
                   </li>
                   <li>
                     <a href="invoice.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Invoice</span>
                     </a>
                   </li>
                   <li>
                     <a href="intro.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Intro</span>
                     </a>
                   </li>
                   <li>
                     <a href="master.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Master</span>
                     </a>
                   </li>
                   <li>
                     <a href="gmap.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Google Map</span>
                     </a>
                   </li>
                   <li>
                     <a href="jvectormap.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Vector Map</span>
                     </a>
                   </li>
                   <li>
                     <a href="signin.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Signin</span>
                     </a>
                   </li>
                   <li>
                     <a href="signup.html">
                       <i class="fa fa-angle-right"></i>
                       <span>Signup</span>
                     </a>
                   </li>
                   <li>
                     <a href="404.html">
                       <i class="fa fa-angle-right"></i>
                       <span>404</span>
                     </a>
                   </li>
                 </ul>
               </li>
               <li>
                 <a href="mail.html">
                   <b class="badge bg-danger pull-right">3</b>
                   <i class="fa fa-envelope-o icon">
                     <b class="bg-primary dker"></b>
                   </i>
                   <span>Message</span>
                 </a>
               </li>
               <li>
                 <a href="notebook.html">
                   <i class="fa fa-pencil icon">
                     <b class="bg-info"></b>
                   </i>
                   <span>Notes</span>
                 </a>
               </li>--}}
          </ul>
        </nav>
        <!-- / nav -->
      </div>
    </section>

    <footer class="footer lt hidden-xs b-t b-light">
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
      </div>
      <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-black btn-icon">
        <i class="fa fa-angle-left text"></i>
        <i class="fa fa-angle-right text-active"></i>
      </a>
      <div class="btn-group hidden-nav-xs">
        <button type="button" title="Chats" class="btn btn-icon btn-sm btn-black"
                data-toggle="dropdown" data-target="#chat"><i class="fa fa-comment-o"></i></button>
        <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-black"
                data-toggle="dropdown" data-target="#invite"><i class="fa fa-facebook"></i></button>
      </div>
    </footer>
  </section>
</aside>
