<div class="form-check">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        @foreach($value as $key => $val)
            <label class="form-check-label">
                @if($checked->count())
                    @for($i = 0; $i < $checked->count(); $i++)
                        {{ Form::checkbox($name . '[]', $key, $checked->contains('id', $key)) }}
                        @break
                    @endfor
                @else
                    {{ Form::checkbox($name . '[]', $key) }}
                @endif
                {{ $val }}
            </label>
        @endforeach
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
{{-- . '[' . $key . ']' --}}
