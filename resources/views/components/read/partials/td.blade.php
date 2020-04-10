<td>
  @switch($lower_val['type'])
    @case('image')
    <img
      src="{{ $upper_val->getFirstMediaUrl($lower_key) === "" ? @$lower_val['value'] ? \Illuminate\Support\Facades\Storage::url('/application/defaults/'.$lower_val['value']) : null : $upper_val->getFirstMediaUrl($lower_key) }}"
      width="66">
    @break
    @case('file')
    @if(($file = $upper_val->getFirstMediaUrl($lower_key)) !== '')
      <a class="btn btn-default btn-xs btn-rounded"
         href="{{ $file }}" target="_blank">
        {{ $lower_val['title'] }}
        Görüntüle
      </a>
    @else
      -
    @endif
    @break
    @case('select')
    @if(@$lower_val['relationship'])
      @if($lower_val['relationship']['type'] === 'belongsTo' && @$lower_val['relationship']['keys']['partner'] === 'hasMany')
        <small>Tamamı için detay sayfasını ziyaret ediniz.</small>
      @elseif(($item = $upper_val->relation($lower_val['relationship'])->first()))
        @foreach($lower_val['relationship']['fields'] as $v)
          {{ (string)$item[$v] }}
          @if(!$loop->last)
            {{ ' - ' }}
          @endif
        @endforeach
      @endif
    @else
      {!! $upper_val[$lower_key] !!}
    @endif
    @break
    @case('multi_checkbox')
    @case('multi_select')
    @foreach($upper_val->relation($lower_val['relationship'])->get() as $val)
      @foreach($lower_val['relationship']['fields'] as $v)
        @if(!$loop->last && !$loop->first)
          {{ ' - ' }}
        @endif
        {{ $val[$v] }}
      @endforeach
      @if(!$loop->last)
        {{ ' | ' }}
      @endif
    @endforeach
    @break
    @case('date')
    {{ \Carbon\Carbon::parse($upper_val[$lower_key])->format('d/m/Y') }}
    @break
    @case('datetime')
    {{ \Carbon\Carbon::parse($upper_val[$lower_key])->format('d/m/Y H:i:s') }}
    @break
    @default
    {!! $upper_val[$lower_key] !!}
    @break
  @endswitch
</td>
