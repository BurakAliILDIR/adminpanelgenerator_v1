<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::file($name, array_merge(['class' => 'filestyle', 'data-icon'=>'false', 'data-classButton' => 'btn btn-default', 'data-classInput' => 'form-control inline input-s', 'id' => $id], $attributes ?? [])) }}
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
