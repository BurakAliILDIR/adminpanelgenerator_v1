<div class="form-group">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 @error($key) is-invalid @enderror">
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
    {{ Form::text($key, $value, array_merge(['class' => 'form-control m-b', 'data-toggle' => 'datetimepicker'.$key, 'readonly' => 'readonly'], $attributes ?? [])) }}
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>

<script>
  $(function () {
    $('input[data-toggle="datetimepicker{{ $key }}"]').datetimepicker({
      //viewMode: 'years',
      inline: true,
      sideBySide: true,
      defaultDate: new Date('{{ $value ?? now() }}'),
      keyBinds: true,
      focusOnShow: false,
      ignoreReadonly: true,
    });
  });
</script>
