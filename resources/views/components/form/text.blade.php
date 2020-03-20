<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10 @error($name) is-invalid @enderror">
        {{ Form::text($name, $value, array_merge(['class' => 'form-control m-b', 'id' => $id], $attributes ?? [])) }}
        @error($name)
        <div class="label bg-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
