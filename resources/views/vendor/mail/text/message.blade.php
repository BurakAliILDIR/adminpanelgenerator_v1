@component('mail::layout')
	{{-- Header --}}
	@slot('header')
		@component('mail::header', ['url' => config('app.url')])
			{{ $system_settings['name'] }}
		@endcomponent
	@endslot

	{{-- Body --}}
	{{ $slot }}

	{{-- Subcopy --}}
	@isset($subcopy)
		@slot('subcopy')
			@component('mail::subcopy')
				{{ $subcopy }}
			@endcomponent
		@endslot
	@endisset

	{{-- Footer --}}
	@slot('footer')
		@component('mail::footer')
			© {{ date('Y') }} {{ $system_settings['name'] }}. @lang('All rights reserved.')
		@endcomponent
	@endslot
@endcomponent
