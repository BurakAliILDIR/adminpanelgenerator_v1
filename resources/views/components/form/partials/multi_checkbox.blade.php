<div class="form-check m-b">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 m-b @error($key.'[]') is-invalid @enderror">
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
    @forelse($value as $k => $v)
      <div class="checkbox">
        <label class="checkbox-custom center-block">
          @if($checked->count())
            @for($i = 0; $i < $checked->count(); $i++)
              {{ Form::checkbox($key.'[]', $k, $checked->contains('id', $k)) }}
              @break
            @endfor
          @else
            {{ Form::checkbox($key.'[]', $k) }}
          @endif
          <i class="fa fa-fw fa-square-o"></i>
          {{ $v }}
        </label>
      </div>
    @empty
      <small>{{ $title }} tablosunda veri bulunmamaktadır. Bu alan ile işlem gerçekleştirmek için lütfen {{ $title }}
        tablosuna veri ekleyiniz.</small>
    @endforelse
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>


