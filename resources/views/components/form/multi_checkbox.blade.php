<div class="form-check">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        @foreach($value as $key => $val)
            <div class="checkbox">
                <label class="checkbox-custom">
                    @if($checked->count())
                        @for($i = 0; $i < $checked->count(); $i++)
                            {{ Form::checkbox($name . '[]', $key, $checked->contains('id', $key)) }}
                            @break
                        @endfor
                    @else
                        {{ Form::checkbox($name . '[]', $key) }}
                    @endif
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $val }}
                </label>
            </div>
        @endforeach
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
