<div class="form-check m-b">
  {{ Form::label($key, $title, ['class' => 'col-sm-2 control-label']) }}
  <div class="col-sm-10 m-b @error($key.'[]') is-invalid @enderror">
    @error($key)
    <div class="label bg-danger">{{ $message }}</div>
    @enderror
    <select class="js-example-basic-multiple" style="width: 100%" name="{{ $key.'[]' }}" id="{{ $key }}" multiple="multiple">
      @foreach($value as $k => $v)
        @if($checked->count())
          @for($i = 0; $i < $checked->count(); $i++)
            <option {{ $checked->contains('id', $k) ? 'selected' : '' }} value="{{ $k }}"> {{ $v }} </option>
            @break
          @endfor
        @else
          <option value="{{ $k }}"> {{ $v }} </option>
        @endif
      @endforeach
    </select>
  </div>
</div>
<div class="line line-dashed line-lg pull-in"></div>
<script>$(document).ready(function () {
    $('#{{ $key }}').select2({
      placeholder: "{{ $title }}", language: "tr"
    });
  });</script>
