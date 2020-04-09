<div class="form-group">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 @error($key) is-invalid @enderror">
    {!! Form::select($key, $items, @$selected, array_merge(['placeholder' => $title . ' Seçiniz', 'class' => 'js-example-basic-single m-b', 'style'=> 'width:100%;'], $attributes ?? [])) !!}
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
