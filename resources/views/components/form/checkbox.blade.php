<div class="form-check">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <div class="checkbox">
        <label class="checkbox-custom">
        {{ Form::checkbox($name, $value) }}
            <i class="fa fa-fw fa-square-o"></i>
            {{ $title }}
        </label>
    </div>
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>

