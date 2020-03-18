<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::input('dateTime-local', $name, \Carbon\Carbon::parse($value)->format('d.m.yy H:i:s') ?? \Carbon\Carbon::now()->format('d.m.yy H:i:s'), array_merge(['class' => 'form-control m-b'], $attributes ?? [])) }}
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
