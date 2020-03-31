<div class="form-group">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 @error($key) is-invalid @enderror">
    <select class="js-example-basic-single m-b" id="{{ $key }}" name="{{ $key }}" style="width: 100%"
    @foreach($attributes as $key => $val)
      {{ $key . '="' . $val .'"' }}
      @endforeach>
      @foreach($value as $key => $val)
        <option {{ $selected == $key ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $val }}</option>
      @endforeach
    </select>
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>

{{--
<div class="form-group">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 @error($key) is-invalid @enderror">
    {{ Form::select($key, $value, $selected, ['placeholder' => $title.' seçiniz...', 'class' => 'form-control m-b'], $attributes ?? []) }}
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>

--}}
