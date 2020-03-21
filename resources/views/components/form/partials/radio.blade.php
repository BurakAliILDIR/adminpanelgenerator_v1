<div class="form-check">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10 @error($name) is-invalid @enderror">
        @foreach($items as $item)
            <div class="radio">
                <label class="radio-custom">
                    {{ Form::radio($name, $item, $checked ? $item == $checked : $loop->first, array_merge(['class' => 'form-check-input', 'id' => $id], $attributes ?? [])) }}
                    <i class="fa fa-circle-o"></i>
                    {{ $item }}
                </label>
            </div>
        @endforeach
        @error($name)
        <div class="label bg-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
