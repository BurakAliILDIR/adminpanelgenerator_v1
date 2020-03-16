<div class="form-check">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        <label class="form-check-label">
            {{ Form::checkbox($name, null) }}
            {{ $title }}
        </label>
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
{{-- TODO: veritabanından gelen değerle örtüşüyor mu kontrol edilecek. --}}
