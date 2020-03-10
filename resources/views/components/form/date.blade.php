<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::date($name, $value ?? \Carbon\Carbon::now(), array_merge(['class' => 'form-control'], $attributes ?? [])) }}
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
