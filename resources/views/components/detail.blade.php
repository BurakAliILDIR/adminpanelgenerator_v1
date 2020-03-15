<section class="vbox">
    <header class="header bg-white b-b b-light">
        <p>{{ $settings['title'] }}</p>
    </header>
    <section class="scrollable">
        <section class="hbox stretch">
            <aside class="aside-lg bg-light lter b-r">
                <section class="vbox">
                    <section class="scrollable">
                        <div class="wrapper">
                            <div class="clearfix m-b">
                                <a href="#" class="pull-left thumb m-r">
                                    <img src="images/avatar.jpg" class="img-circle">
                                </a>
                                <div class="clear">
                                    <div class="h3 m-t-xs m-b-xs">John.Smith</div>
                                    <small class="text-muted"><i class="fa fa-map-marker"></i> London,
                                        UK</small>
                                </div>
                            </div>
                            <div class="panel wrapper panel-success">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <a href="#">
                                            <span class="m-b-xs h4 block">245</span>
                                            <small class="text-muted">Followers</small>
                                        </a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a href="#">
                                            <span class="m-b-xs h4 block">55</span>
                                            <small class="text-muted">Following</small>
                                        </a>
                                    </div>
                                    <div class="col-xs-4">
                                        <a href="#">
                                            <span class="m-b-xs h4 block">2,035</span>
                                            <small class="text-muted">Tweets</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group btn-group-justified m-b">
                                <a class="btn btn-primary btn-rounded" data-toggle="button">
                            <span class="text">
                              <i class="fa fa-eye"></i> Follow
                            </span>
                                    <span class="text-active">
                              <i class="fa fa-eye-slash"></i> Following
                            </span>
                                </a>
                                <a class="btn btn-dark btn-rounded" data-loading-text="Connecting">
                                    <i class="fa fa-comment-o"></i> Chat
                                </a>
                            </div>
                            <div>
                                @foreach($settings['fields'] as $key => $val)
                                    @if($val[$settings['operation']])
                                        @switch($val['type'])
                                            @case('text')
                                            @case('email')
                                            @case('date')
                                            @case('number')
                                            @case('radio')
                                            <small class="text-uc text-xs text-muted">{{ $val['title'] }}</small>
                                            <p>{{ $settings['model'][$val['name']] }}</p>
                                        @endswitch
                                    @endif
                                @endforeach
                                <div class="line"></div>


                                <small class="text-uc text-xs text-muted">connection</small>
                                <p class="m-t-sm">
                                    <a href="#" class="btn btn-rounded btn-twitter btn-icon"><i
                                            class="fa fa-twitter"></i></a>
                                    <a href="#" class="btn btn-rounded btn-facebook btn-icon"><i
                                            class="fa fa-facebook"></i></a>
                                    <a href="#" class="btn btn-rounded btn-gplus btn-icon"><i
                                            class="fa fa-google-plus"></i></a>
                                </p>
                            </div>
                        </div>
                    </section>
                </section>
            </aside>
            <aside class="bg-white">
                <section class="vbox">
                    <header class="header bg-light bg-gradient">
                        <ul class="nav nav-tabs nav-white">
                            {{--<li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>--}}
                            @foreach($settings['fields'] as $key => $val)
                                @if(($val[$settings['operation']]) && @$val['multiple'] && $val['type'] !== 'multi_image')
                                    <li class="">
                                        <a href="#{{ $val['name'] }}" data-toggle="tab">{{ $val['title'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </header>
                    <section class="scrollable">
                        <div class="tab-content">
                            @foreach($settings['fields'] as $key => $val)
                                @if(($val[$settings['operation']]) && @$val['multiple'])
                                    <div class="tab-pane" id="{{ $val['name'] }}">
                                        <section class="scrollable wrapper w-f">
                                            <section class="panel panel-default">
                                                <div class="table-responsive">
                                                    <table class="table table-striped m-b-none">
                                                        <thead>
                                                        <tr>
                                                            @if($val['type'] !== 'multi_image')
                                                                @foreach($val['relationship']['fields'] as $field)
                                                                    <th>{{ $field }}</th>
                                                                @endforeach
                                                            @endif
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if($val['type'] !== 'multi_image')
                                                            @foreach($settings['model']->relation($val['relationship'])->limit($val['relationship']['perPage'])->get() as $data)
                                                                <tr>
                                                                    @foreach($data->getFields() as $lower_key => $lower_val)

                                                                        @if(array_search($lower_key, $val['relationship']['fields']) !== false)
                                                                            <td>
                                                                                @switch($lower_val['type'])
                                                                                    @case('image')
                                                                                    <img
                                                                                        src="{{ $data[$lower_key] ?? $lower_val['value'] }}">
                                                                                    @break
                                                                                    @case('file')
                                                                                    <a class="btn btn-default btn-sm"
                                                                                       href="{{ $data[$lower_key] }}">
                                                                                        {{ $lower_val['title']}}
                                                                                        Görüntüle
                                                                                    </a>
                                                                                    @break
                                                                                    @case('select')
                                                                                    @foreach($data->relation($lower_val['relationship'])->get() as $val)
                                                                                        @foreach($lower_val['relationship']['fields'] as $v)
                                                                                            {{ $val[$v] }}
                                                                                            @if(!$loop->last)
                                                                                                {{ ' - ' }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endforeach
                                                                                    @break
                                                                                    @case('multi_checkbox')
                                                                                    @foreach($data->relation($lower_val['relationship'])->get() as $val)
                                                                                        @foreach($lower_val['relationship']['fields'] as $v)
                                                                                            {{ $val[$v] }}
                                                                                            @if(!$loop->last)
                                                                                                {{ ' - ' }}
                                                                                            @endif
                                                                                        @endforeach
                                                                                        @if(!$loop->last)
                                                                                            {{ ' | ' }}
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @break
                                                                                    @default
                                                                                    {{ $data[$lower_key] }}
                                                                                    @break
                                                                                @endswitch
                                                                            </td>
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </section>
                                        </section>
                                    </div>
                                    {{--<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                                    @foreach($settings['model']->relation($val['relationship'])->get() as $val)
                                                        <li class="list-group-item" href="#email-content"
                                                            data-toggle="class:show">
                                                            <a href="#" class="thumb-sm pull-left m-r-sm">
                                                                <img src="images/avatar_default.jpg" class="img-circle">
                                                            </a>
                                                            <a href="#" class="clear">
                                                                <small class="pull-right">3 minuts ago</small>
                                                                <strong class="block">Drew Wllon</strong>
                                                                <small>Vestibulum ullamcorper sodales nisi nec sodales nisi nec
                                                                    sodales nisi
                                                                    nec...</small>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            --}}
                                    {{--<div class="tab-pane active" id="activity">
                                        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                            <li class="list-group-item" href="#email-content"
                                                data-toggle="class:show">
                                                <a href="#" class="thumb-sm pull-left m-r-sm">
                                                    <img src="images/avatar_default.jpg" class="img-circle">
                                                </a>
                                                <a href="#" class="clear">
                                                    <small class="pull-right">3 minuts ago</small>
                                                    <strong class="block">Drew Wllon</strong>
                                                    <small>Vestibulum ullamcorper sodales nisi nec sodales nisi nec
                                                        sodales nisi
                                                        nec...</small>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>--}}
                                    {{--<div class="tab-pane" id="events">
                                           <div class="text-center wrapper">
                                              <i class="fa fa-spinner fa fa-spin fa fa-large"></i>
                                           </div>
                                        </div>
                                    --}}
                                @endif
                            @endforeach
                        </div>
                    </section>
                </section>
            </aside>
            @foreach($settings['fields'] as $key => $val)
                @if($val[$settings['operation']] && @$val['multiple'] && $val['type'] === 'multi_image')
                    <aside class="col-lg-4 b-l">
                        <section class="vbox">
                            <section class="scrollable">
                                <div class="wrapper">
                                    <section class="panel panel-default">
                                        <form
                                            action="{{ route($settings['route']['imageUpload'], $settings['model']->id) }}"
                                            class="dropzone">
                                            @csrf
                                        </form>
                                        <div class="tz-gallery">
                                            @php($say = 0)
                                            @foreach($settings['model']->getMedia() as $image)
                                                @if($say % 2 == 0)
                                                    <div class="row">
                                                        @endif
                                                        <div class="col-sm-12 col-md-6">
                                                            <section class="panel panel-default" style="height: 165px">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <a class="lightbox"
                                                                           href="{{ $image->getUrl() }}">
                                                                            <img
                                                                                src="{{ $image->getUrl() }}"
                                                                                alt="{{ $image->name }}">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <footer
                                                                            class="panel-footer bg-light lter">
                                                                            <ul class="nav nav-pills nav-sm">
                                                                                <button
                                                                                    class="btn btn-danger pull-right btn-icon btn-sm"
                                                                                    onclick="return confirm('Kaydı silmek istediğinize emin misiniz?');">
                                                                                    <i class="fa fa-trash"></i>
                                                                                    {{--TODO : Silme işlemi burada gerçekleşecek.--}}
                                                                                </button>
                                                                            </ul>
                                                                        </footer>
                                                                    </div>
                                                                </div>
                                                            </section>

                                                        </div>
                                                        @if($say % 2 == 1)
                                                    </div>
                                                @endif
                                                @php($say += 1)
                                            @endforeach
                                        </div>
                                    </section>
                                </div>
                            </section>
                        </section>
                    </aside>
                @endif
            @endforeach
        </section>
    </section>
</section>
