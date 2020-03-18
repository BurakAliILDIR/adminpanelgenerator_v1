<td>
    @switch($lower_val['type'])
        @case('image')
        <img
            src="{{ $upper_val->getFirstMediaUrl($lower_key) === "" ? $lower_val['value'] : $upper_val->getFirstMediaUrl($lower_key) }}"
            width="61">
        @break
        @case('file')
        @if(($file = $upper_val->getFirstMediaUrl($lower_key)) !== '')
            <a class="btn btn-default btn-xs btn-rounded"
               href="{{ $file }}">
                {{ $lower_val['title'] }}
                Görüntüle
            </a>
        @else
            -
        @endif
        @break
        @case('select')
        @foreach($lower_val['relationship']['fields'] as $v)
            {{ $upper_val->relation($lower_val['relationship'])->first()[$v] }}
            @if(!$loop->last)
                {{ ' - ' }}
            @endif
        @endforeach
        @break
        @case('multi_checkbox')
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
        @break
        @case('date')
        {{ \Carbon\Carbon::parse($upper_val[$lower_key])->format('d/m/Y') }}
        @break
        @case('date_time')
        {{ \Carbon\Carbon::parse($upper_val[$lower_key])->format('d/m/Y H:i:s') }}
        @break
        @default
        {{ $upper_val[$lower_key] }}
        @break
    @endswitch
</td>
