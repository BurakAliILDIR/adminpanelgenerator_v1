<table class="table table-responsive table-hover table-bordered table-head-fixed">
    <thead class="thead-dark">
    <tr>
        {{--Düzeltilecek--}}
        @foreach($settings['fields'] as $key => $val)
            @if($settings['fields'][$key][$settings['operation']] )
                <th>{{ $val['title'] }}</th>
            @endif
        @endforeach
        <th>Detay</th>
        <th>Düzenle</th>
        <th>Sil</th>
    </tr>
    </thead>
    <tbody>
    @foreach($settings['data'] as $upper_key => $upper_val)
        <tr>
            @foreach($settings['fields'] as $lower_key => $lower_val)
                @if($settings['fields'][$lower_key][$settings['operation']] )
                    <td>
                        @if($settings['fields'][$lower_key]['image'])
                            <img src="{{ $settings['data'][$upper_key][$lower_key] }}">
                        @elseif($settings['fields'][$lower_key]['file'])
                            <a class="btn btn-link btn-sm" href="{{ $settings['data'][$upper_key][$lower_key] }}">
                                {{ $settings['fields'][$lower_key]['title']}}
                            </a>
                        @else
                            <span>{{ $settings['data'][$upper_key][$lower_key] }}</span>
                        @endif
                    </td>
                @endif
            @endforeach
            <td>
                <a class="btn btn-outline-warning btn-sm"
                   href="{{ route($settings['route']['show'], $settings['data'][$upper_key]['id']) }}">
                    Detay
                </a>
            </td>
            <td>
                <a class="btn btn-outline-info btn-sm"
                   href="{{ route($settings['route']['edit'], $settings['data'][$upper_key]['id']) }}">
                    Düzenle
                </a>
            </td>
            <td>
                <form action="{{ route($settings['route']['delete'], $settings['data'][$upper_key]['id']) }}"
                      method="post">
                    @Csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm" type="submit"
                            onclick="return confirm('Kaydı silmek istediğinize emin misiniz?');">
                        Sil
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
