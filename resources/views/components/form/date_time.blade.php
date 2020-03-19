<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::text($name, $value, array_merge(['class' => 'form-control m-b', 'data-toggle' => 'datetimepicker'.$id], $attributes ?? [])) }}
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>

<script>$(function () {
        $('input[data-toggle="datetimepicker{{ $id }}"]').datetimepicker({
            viewMode: 'years',
            inline: true,
            sideBySide: true,
            defaultDate: new Date('{{ $value ?? now() }}'),
            keyBinds: true,
        });
    });
</script>
