<td>
	@switch($lower_val['type'])
		@case('image')
		<img
			src="{{ $upper_val->getFirstMediaUrl($lower_key) === '' ? @$lower_val['value'] ? asset('/storage/media/defaults/'
      .$lower_val['value']) : null : asset($upper_val->getFirstMediaUrl($lower_key)) }}"
			width="66">
		@break
		@case('file')
		@if(($file = $upper_val->getFirstMediaUrl($lower_key)) !== '')
			<a class="btn btn-default btn-xs btn-rounded"
				 href="{{ asset($file) }}" target="_blank">
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
				<small>{{ $upper_val->relation($lower_val['relationship'])->count() }} adet bulunmaktadır.</small>
			@elseif(($item = $upper_val->relation($lower_val['relationship'])->first($lower_val['relationship']['fields'])))
				@foreach($lower_val['relationship']['fields'] as $v)
					{{ (string)$item[$v] }}
					@if(!$loop->last)
						{{ ' - ' }}
					@endif
				@endforeach
			@endif
		@else
			{{ $upper_val[$lower_key] }}
		@endif
		@break
		@case('auth')
		@if(@$lower_val['relationship'] && ($item = $upper_val->relation($lower_val['relationship'])->first(['id', 'name',
		 'surname'])))
			@can('User.detail')
				@if ($item['id'] === \Illuminate\Support\Facades\Crypt::decryptString(config('my-config.super_admin_id')))
					{{ $item['name'] . ' ' . $item['surname'] }}
				@else
					<a
						href="{{ $item['id'] }}"><strong>{{ $item['name'] . ' ' . $item['surname']}}</strong></a>
				@endif
			@else
				{{ $item['name'] . ' ' . $item['surname'] }}
			@endcan
		@endif
		@break
		@case('multi_checkbox')
		@case('multi_select')
		<small>{{ $upper_val->relation($lower_val['relationship'])->count() }} adet bulunmaktadır.</small>
		@break
		@case('date')
		{{ \Carbon\Carbon::parse($upper_val[$lower_key])->format('d/m/Y') }}
		@break
		@case('datetime')
		{{ \Carbon\Carbon::parse($upper_val[$lower_key])->format('d/m/Y H:i:s') }}
		@break
		@default
		{{ "$upper_val[$lower_key] " . @$lower_val['unit'] }}
		@break
	@endswitch
</td>
