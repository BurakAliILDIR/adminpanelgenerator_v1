<div class="row">
    <div class="col-sm-offset-3 col-sm-4">
        @if($type === 'image')
            <img style="width: 100%" src="{{ $value }}" class="img-circle">
        @else
            @if($value !== '')
                <a class="btn btn-default btn-sm m-b"
                   href="{{ $value }}">
                    {{ $title }}
                    Görüntüle
                </a>
            @endif
        @endif
    </div>
</div>

<div class="form-group">
    {{ Form::label($id, $title, ['class' => 'col-sm-2 control-label']) }}
    <div class="col-sm-10">
        {{ Form::file($name, array_merge(['class' => 'filestyle', 'data-icon' => 'false', 'data-classButton' => 'btn btn-default', 'data-classInput' => 'form-control inline input-s', 'id' => $id], $attributes ?? [])) }}
    </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
