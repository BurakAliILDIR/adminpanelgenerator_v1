@if($value !== '')
  <div class="row">
    <div class="col-sm-offset-3 col-sm-4">
      <a class="btn btn-default btn-sm m-b"
         href="{{ $value }}" target="_blank">
        {{ $title }}
        Görüntüle
      </a>
    </div>
  </div>
@endif
<div class="form-group">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 @error($key) is-invalid @enderror">
    {{ Form::file($key, array_merge(['class' => 'filestyle', 'data-icon' => 'false', 'data-classButton' => 'btn btn-default', 'data-classInput' => 'form-control inline input-s'], $attributes ?? [])) }}
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
