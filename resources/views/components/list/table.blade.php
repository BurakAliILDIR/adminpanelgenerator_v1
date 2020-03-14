<h3>{{ $settings['title'] }}</h3>

<aside>
    <section class="vbox">
        <header class="header bg-white b-b clearfix">
            <div class="row m-t-sm">
                <div class="col-sm-8 m-b-xs">
                    <button type="button" class="btn btn-sm btn-default" title="Remove"><i
                            class="fa fa-trash-o"></i></button>
                    <a href="{{ route($settings['route']['create']) }}" class="btn btn-sm btn-default"><i
                            class="fa fa-plus"></i> Ekle</a>
                </div>
                <div class="col-sm-4 m-b-xs">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Ara">
                        <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="button">
                              <i class="fa fa-search"></i>
                              Ara
                          </button>
                        </span>
                    </div>
                </div>
            </div>
        </header>
        <section class="scrollable wrapper w-f">
            <section class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped m-b-none">
                        <thead>
                        <tr>
                            <th width="20"><input type="checkbox"></th>
                            @foreach($settings['fields'] as $key => $val)
                                @if($val[$settings['operation']])
                                    <th>{{ $val['title'] }}</th>
                                @endif
                            @endforeach
                            <th width="20"></th>
                            <th width="20"></th>
                            <th width="20"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($settings['data'] as $upper_val)
                            <tr>
                                <td><input type="checkbox" name="post[]" value="{{ $upper_val['id'] }}"></td>
                                @foreach($settings['fields'] as $lower_key => $lower_val)
                                    @if($lower_val[$settings['operation']] )
                                        <td>
                                            @if($lower_val['type'] == 'image')
                                                <img height="41" src="{{ $upper_val[$lower_key] ?? $lower_val['value'] }}">
                                            @elseif($lower_val['type'] == 'file')
                                                <a class="btn btn-default btn-sm"
                                                   href="{{ $upper_val[$lower_key] }}">
                                                    {{ $lower_val['title']}} Görüntüle
                                                </a>
                                            @elseif($lower_val['type'] == 'select')
                                                @foreach($upper_val->relation($lower_val['relationship'])->get() as $val)
                                                    @foreach($lower_val['relationship']['fields'] as $v)
                                                        {{ $val[$v] }}
                                                        @if(!$loop->last)
                                                            {{ ' - ' }}
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @elseif($lower_val['type'] == 'multi_checkbox')
                                                @foreach($upper_val->relation($lower_val['relationship'])->get() as $val)
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
                                            @else
                                                <span>{{ $upper_val[$lower_key] }}</span>
                                            @endif
                                        </td>
                                    @endif
                                @endforeach
                                <td>
                                    <a class="btn btn-sm btn-icon btn-warning"
                                       href="{{ route($settings['route']['show'], $upper_val['id']) }}">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-icon btn-info"
                                       href="{{ route($settings['route']['edit'], $upper_val['id']) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <form
                                        action="{{ route($settings['route']['delete'], $upper_val['id']) }}"
                                        method="post">
                                        @Csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-icon btn-danger" type="submit"
                                                onclick="return confirm('Kaydı silmek istediğinize emin misiniz?');">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
        <footer class="footer bg-white b-t">
            <div class="row text-center-xs">
                <div class="col-md-6 hidden-sm">
                    <p class="text-muted m-t">
                        Gösterimde
                        olan: {{ $settings['data']->currentPage() * $settings['data']->perPage() - $settings['data']->perPage() }}
                        - {{ $settings['data']->currentPage() != $settings['data']->lastPage() ? $settings['data']->currentPage() * $settings['data']->perPage() : $settings['data']->total() }}
                        | Toplam kayıt: {{ $settings['data']->total() }}</p>
                </div>
                <div class="col-md-6 col-sm-12 text-right text-center-xs">
                    {{ $settings['data']->links() }}
                </div>
            </div>
        </footer>
    </section>
</aside>
