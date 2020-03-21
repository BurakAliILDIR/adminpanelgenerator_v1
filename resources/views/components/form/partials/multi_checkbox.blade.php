<div class="form-check">
    {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10 @error($key.'[]') is-invalid @enderror">
        @error($key)
        <div class="label bg-danger">{{ $message }}</div>
        @enderror
        @foreach($value as $k => $v)
            <div class="checkbox">
                <label class="checkbox-custom center-block">
                    @if($checked->count())
                        @for($i = 0; $i < $checked->count(); $i++)
                            {{ Form::checkbox($key.'[]', $k, $checked->contains('id', $k)) }}
                            @break
                        @endfor
                    @else
                        {{ Form::checkbox($key.'[]', $k) }}
                    @endif
                    <i class="fa fa-fw fa-square-o"></i>
                    {{ $v }}
                </label>
            </div>
        @endforeach
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
