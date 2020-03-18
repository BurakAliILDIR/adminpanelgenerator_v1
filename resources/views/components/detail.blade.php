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
                                @foreach($settings['fields'] as $key => $val)
                                    @if($val[$settings['operation']] && $val['type'] === 'image')
                                        <span class="pull-left thumb m-r">
                                            <img
                                                src="{{ $settings['model']->getFirstMediaUrl($key) === "" ? $val['value'] : $settings['model']->getFirstMediaUrl($key) }}"
                                                class="img-circle">
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                @foreach($settings['fields'] as $key => $val)
                                    @if($val[$settings['operation']] && !(@$val['multiple'] ?? true))
                                        @switch($val['type'])
                                            @case('text')
                                            @case('email')
                                            @case('number')
                                            @case('radio')
                                            <small class="text-uc text-xs text-muted">{{ $val['title'] }} : </small>
                                            {{ $settings['model'][$val['name']] }}
                                            <div class="line"></div>
                                            @break
                                            @case('file')
                                            <small class="text-uc text-xs text-muted">{{ $val['title'] }} : </small>
                                            @if($settings['model'][$val['name']])
                                                <a class="btn btn-default btn-xs"
                                                   href="{{ $settings['model'][$val['name']] }}">
                                                    {{ $val['title'] }}
                                                    Görüntüle
                                                </a>
                                            @else
                                                -
                                            @endif
                                            <div class="line"></div>
                                            @break
                                            @case('select')
                                            <small class="text-uc text-xs text-muted">{{ $val['title'] }} : </small>
                                            @foreach($val['relationship']['fields'] as $v)
                                                {{ $settings['model']->relation($val['relationship'])->first()[$v] }}
                                                @if(!$loop->last)
                                                    {{ ' - ' }}
                                                @endif
                                            @endforeach
                                            <div class="line"></div>
                                            @break
                                            @case('date')
                                            <small class="text-uc text-xs text-muted">{{ $val['title'] }} : </small>
                                            {{ \Carbon\Carbon::parse($settings['model'][$val['name']])->format('d/m/Y')}}
                                            <div class="line"></div>
                                            @break
                                            @case('date_time')
                                            <small class="text-uc text-xs text-muted">{{ $val['title'] }} : </small>
                                            {{ \Carbon\Carbon::parse($settings['model'][$val['name']])->format('d/m/Y H:i:s')}}
                                            <div class="line"></div>
                                            @break
                                        @endswitch
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </section>
                </section>
            </aside>
            <aside class="bg-white">
                <section class="vbox">


                    <header class="header bg-light bg-gradient">
                        <ul class="nav nav-tabs nav-white">
                            @foreach($settings['fields'] as $key => $val)
                                @if(($val[$settings['operation']]) && @$val['multiple'] && $val['type'] !== 'multi_image')
                                    <li id="{{ $val['name'] }}Leaf">
                                        <a href="#{{ $val['name'] }}" id="{{ $val['name'] }}A" data-toggle="tab"
                                           onclick="setLeaf('{{ $val['name'] }}')">{{ $val['title'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </header>


                    <section class="scrollable">
                        <div class="tab-content">
                            @foreach($settings['fields'] as $key => $val)
                                @if(($val[$settings['operation']]) && @$val['multiple'] && $val['type'] !== 'multi_image')
                                    <div class="tab-pane" id="{{ $val['name'] }}Page">
                                        <section class="scrollable wrapper w-f">

                                            <section class="panel panel-default">
                                                @php
                                                    $data = $settings['model']->relation($val['relationship'])->orderByDESC('id')->paginate($val['relationship']['perPage'], ['*'], $key);
                                                    //$data->setPageName($key);
                                                @endphp
                                                @if($data->count() > 0)
                                                    <div class="table-responsive">
                                                        <table class="table table-striped m-b-none">
                                                            <thead>
                                                            <tr>
                                                                @foreach($data[0]->getSettings('fields') as $up)

                                                                    @foreach($val['relationship']['fields'] as $field)
                                                                        @if($up['name'] === $field)
                                                                            <th>{{ $up['title'] }}</th>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($data as $upper_val)
                                                                <tr>
                                                                    @foreach($upper_val->getSettings('fields') as $lower_key => $lower_val)
                                                                        @if(array_search($lower_key, $val['relationship']['fields']) !== false)
                                                                            @component('components.table.td', ['lower_val'=> $lower_val, 'lower_key'=> $lower_key, 'upper_val'=> $upper_val])@endcomponent
                                                                        @endif
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    {{ $data->appends([$key => $data->currentPage()])->links() }}
                                                @else
                                                    <small>Kayıt bulunmamaktadır.</small>
                                                @endif
                                            </section>
                                        </section>
                                    </div>
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
                                    <p>{{ $val['title'] . ' : Yükleme Alanı' }}</p>
                                    <section class="panel panel-default">
                                        <form
                                            action="{{ route('imageUpload', [$settings['model']->id, $key, str_replace('\\', '-', get_class($settings['model']))]) }}"
                                            class="dropzone">
                                            @csrf
                                        </form>
                                    </section>
                                    <form action="{{ route('deleteImage') }}" method="post">
                                        @Csrf @method('DELETE')
                                        <p>{{ $val['title'] }}
                                            <button
                                                class="btn btn-danger pull-right btn-xs"
                                                onclick="return confirm('Seçili resimleri silmek istediğinize emin misiniz?');">
                                                <i class="fa fa-trash"></i> Seçili Resimleri Sil
                                            </button>
                                        </p>
                                        <section class="panel panel-default">
                                            <div class="tz-gallery">
                                                @php($say = 0)
                                                @foreach($settings['model']->getMedia($key) as $image)
                                                    @if($say % 2 == 0)
                                                        <div class="row">
                                                            @endif
                                                            <div class="col-sm-12 col-md-6">
                                                                <section class="panel panel-default m-t">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <a class="lightbox"
                                                                               href="{{ $image->getUrl('big') }}">
                                                                                <img
                                                                                    src="{{ $image->getUrl('card') }}"
                                                                                    alt="{{ $image->name }}">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <footer
                                                                                class="panel-footer bg-light lter">
                                                                                <ul class="nav nav-pills nav-sm">
                                                                                    <label class="pull-right">
                                                                                        <input type="checkbox"
                                                                                               name='mediaTodelete[]'
                                                                                               value="{{$image->id}}">
                                                                                        Sil
                                                                                    </label>
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
                                    </form>
                                </div>
                            </section>
                        </section>
                    </aside>
                @endif
            @endforeach
        </section>
    </section>
</section>
<script>
    let value = null;

    function setLeaf(name) {
        value = localStorage.getItem("leaf");
        if (document.getElementById(value + 'Leaf') !== null) {
            document.getElementById(value + 'Leaf').classList.remove('active');
            document.getElementById(value + 'Page').classList.remove('active');
            document.getElementById(value + 'A').removeAttribute("aria-expanded");
        }
        localStorage.setItem("leaf", name);
        document.getElementById(name + 'Leaf').classList.add('active');
        document.getElementById(name + 'Page').classList.add('active');
        document.getElementById(name + 'A').setAttribute("aria-expanded", "true");

    }

    window.onload = function getLeaf() {
        value = localStorage.getItem("leaf");
        if (document.getElementById(value + 'Leaf') !== null) {
            document.getElementById(value + 'Leaf').classList.add('active');
            document.getElementById(value + 'A').setAttribute("aria-expanded", "true");
            document.getElementById(value + 'Page').classList.add('active');
        }
    };
</script>
