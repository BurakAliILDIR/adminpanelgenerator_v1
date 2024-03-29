<div class="form-group">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 @error($key) is-invalid @enderror">
    {{ Form::textarea($key, null, array_merge(['class' => 'form-control m-b'], $attributes ?? [])) }}
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
<script>
  CKEDITOR.replace('{{ $key }}');
</script>
