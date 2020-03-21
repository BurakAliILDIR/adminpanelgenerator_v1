<div class="form-check">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10 @error($name) is-invalid @enderror">
        <div class="checkbox">
            <label class="checkbox-custom center-block">
                {{ Form::checkbox($name) }}
                <i class="fa fa-fw fa-square-o"></i>
            </label>
            @error($name)
            <div class="label bg-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>
</div>
<br>
<div class="line line-dashed line-lg pull-in"></div>

