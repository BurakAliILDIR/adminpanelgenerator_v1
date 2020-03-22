<div class="form-check">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 @error($key) is-invalid @enderror">
    <div class="checkbox">
      <label class="checkbox-custom center-block">
        {{ Form::checkbox($key) }}
        <i class="fa fa-fw fa-square-o"></i>
        {{ $label }}
      </label>
      @error($key)
      <div class="label bg-danger">{{ $message }}</div>
      @enderror
    </div>

  </div>
</div>
<br>
<div class="line line-dashed line-lg pull-in"></div>

