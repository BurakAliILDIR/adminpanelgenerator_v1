<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="app-fluid">
<head>
    @include('admin.layouts.partials.head')
    @yield('css')
</head>

<body>
<section class="vbox">
    @include('admin.layouts.partials.header')
    <section>
        <section class="hbox stretch">
            <!-- .aside -->
        @include('admin.layouts.partials.navbar')
        <!-- /.aside -->
            <section id="content">
                <section class="wrapper">
                    @yield('content')
                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open"
                   data-target="#nav,html"></a>
            </section>
            <aside class="bg-light lter b-l aside-md hide" id="notes">
                <div class="wrapper">Notification</div>
            </aside>
        </section>
    </section>
</section>
@include('admin.layouts.partials.script')
</body>
</html>
