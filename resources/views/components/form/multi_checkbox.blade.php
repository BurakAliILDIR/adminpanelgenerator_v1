<div class="form-check">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        @foreach($value as $key => $val)
            <label class="form-check-label">
                {{ Form::checkbox($name . '[' . $key . ']', null) }}
                {{ $val }}
            </label>
        @endforeach
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
