<div class="form-group">
    {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10 @error($key) is-invalid @enderror">
        {{ Form::text($key, $value ? \Carbon\Carbon::parse($value)->format('d.m.Y') : \Carbon\Carbon::now()->format('d.m.Y'), array_merge(['class' => 'form-control m-b', 'readonly' => 'readonly', "data-toggle" => "date"], $attributes ?? [])) }}
        @error($key)
        <div class="label bg-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>

