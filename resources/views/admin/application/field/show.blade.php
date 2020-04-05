@extends('admin.layouts.master')
@section('title', 'Rol Detay')
@section('css')
@endsection
@section('content')
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <div class="row">
        <div class="col-md-6">
          <div class="m-t">
            <a class="btn btn-xs btn-default btn-rounded " href="{{ route('modules.show', $module_name) }}">
              <i class="fa fa-arrow-left"></i>
              Tüm Alanlara Dön
            </a>
            <span class="m-l">Alan Detay</span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="m-t m-r pull-right">
            <a class="btn btn-xs btn-info btn-rounded "
               href="{{ route('fields.edit', [$module_name, $key]) }}">
              <i class="fa fa-edit"></i>
              Bu Alanı Düzenle
            </a>
            @if($key !== 'id' && $key !== 'created_at' && $key !== 'updated_at')
              <form action="{{ route('fields.destroy', [$module_name, $key]) }}" method="post" class="inline">
                @method('DELETE') @csrf
                <button type="submit" class="btn btn-xs btn-danger btn-rounded"
                        onclick="return confirm('Alanı silmek istediğinize emin misiniz?')">
                  <i class="fa fa-trash"></i>
                  Bu Alanı Sil
                </button>
              </form>
            @endif
          </div>
        </div>
      </div>
    </header>
    <section class="scrollable">
      <section class="hbox stretch row">
        <aside class="bg-light lter b-r col-md-12">
          <section class="vbox">
            <section class="scrollable">
              <div class="wrapper-lg">
                <div style="word-break: break-all">
                  @foreach($field as $field_key => $field_val)
                    <small class="text-uc text-muted">{{ $field_key }} : </small>
                    @if($field_val === false || $field_val === true)
                      <div class="checkbox inline">
                        <label class="checkbox-custom">
                          <input type="checkbox"
                                 {{ $field_val ? 'checked' : '' }} onclick="this.checked=!this.checked;">
                          <i class="fa fa-fw fa-square-o"></i>
                        </label>
                      </div>
                    @elseif(is_array($field_val))
                      @foreach($field_val as $lower_key => $lower_val)
                        @if(is_array($lower_val))
                          <br>
                          - - ) <small class="text-uc text-muted">{{ $lower_key }} : </small>_____
                          @foreach($lower_val as $l_key => $l_val)

                            <small class=" text-muted">{{ $l_key }} : </small>
                            <span>{!! $l_val !!}</span> _____
                          @endforeach

                        @else
                          <br>
                          - ) <small class="text-uc text-muted">{{ $lower_key }} : </small> _____
                          <span>{!! $lower_val !!}</span> _____
                        @endif
                      @endforeach
                    @else
                      <span>{!! $field_val !!}</span>
                    @endif
                    <div class="line"></div>
                  @endforeach
                  {{--  <small class="text-uc text-muted">Eklenme Tarihi : </small>
                    <span>{!! \Carbon\Carbon::parse($model['created_at'])->format('d/m/Y H:i:s') !!}</span>
                    <div class="line"></div>
                    <small class="text-uc text-muted">Son Düzenleme Tarihi : </small>
                    <span>{!! \Carbon\Carbon::parse($model['updated_at'])->format('d/m/Y H:i:s') !!}</span>
                    <div class="line"></div>--}}
                </div>
              </div>
            </section>
          </section>
        </aside>
      </section>
    </section>
  </section>
@endsection
@section('js')
  <script src="/admin-custom-template/detail/change-leaf.js"></script>
@endsection
