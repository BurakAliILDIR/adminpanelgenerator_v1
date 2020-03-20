<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <select class="form-control m-b @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $id }}"@foreach($attributes as $key => $val){{ $key . '="' . $val .'"' }}@endforeach>
            <option selected disabled><-- Seçiniz --></option>
            @foreach($value as $key => $val)
                <option {{ $selected == $key ? 'selected="selected"' : '' }} value="{{ $key }}">{{ $val }}</option>
            @endforeach
        </select>
        @error($name)
        <div class="label bg-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
