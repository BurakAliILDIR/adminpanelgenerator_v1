<div class="form-check">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 @error($key) is-invalid @enderror">
    @foreach($items as $item_key => $item)
      <div class="radio">
        <label class="radio-custom">
          {{ Form::radio($key, $item_key, $checked ? $item_key == $checked : $loop->first, array_merge(['class' => 'form-check-input'], $attributes ?? [])) }}
          <i class="fa fa-circle-o"></i>
          {{ $item }}
        </label>
      </div>
    @endforeach
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
