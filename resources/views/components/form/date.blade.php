<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10 @error($name) is-invalid @enderror">
        {{ Form::text($name, $value ? \Carbon\Carbon::parse($value)->format('d.m.Y') : \Carbon\Carbon::now()->format('d.m.Y'), array_merge(['class' => 'form-control m-b', 'readonly' => 'readonly', "data-toggle" => "date"], $attributes ?? [])) }}
        @error($name)
        <div class="label bg-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>

