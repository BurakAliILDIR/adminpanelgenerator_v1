<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea($name, $value, array_merge(['class' => 'form-control m-b', 'id' => $id], $attributes ?? [])) }}
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
