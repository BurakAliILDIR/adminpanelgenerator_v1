<div class="form-check" style="margin-right: 3rem; display: inline-block;">
    {{ Form::radio($name, $value, $checked, array_merge(['class' => 'form-check-input', 'id' => $id], $attributes ?? [])) }}
    {{ Form::label($id, $title, ['class' => 'form-check-label']) }}
</div>
