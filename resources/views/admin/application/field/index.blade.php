<?php $module_name = $module->getName(); ?>
@extends('admin.layouts.master')
@section('title', "$module_name Alanları")
@section('css')
@endsection
@section('content')
  <div class="m-t">
    <a class="btn btn-sm btn-default btn-rounded" href="{{ route('modules.index') }}">
      <i class="fa fa-arrow-left"></i>
      Tüm Modüllere Dön
    </a>
    <h3>{{ $module_name }} Alanları</h3>
  </div>
  <aside>
    <section class="vbox">
      <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
          <div class="col-sm-7 m-b-xs">
            <a href="{{ route('fields.create', $module_name) }}"
               class="btn btn-sm btn-primary btn-rounded"><i class="fa fa-plus"></i> Alan Ekle</a>
            <a href="{{ route('fields.create', [$module_name, true]) }}"
               class="btn btn-sm btn-primary btn-rounded"><i class="fa fa-plus"></i> İlişkili Alan Ekle</a>
          </div>
        </div>
      </header>
      <section class="scrollable wrapper-sm w-f">
        @component('components.alert.alert_messages')@endcomponent
        <section class="panel panel-default">
          <div class="table-responsive">
            <table class="table table-striped m-b-none">
              <thead>
              <tr>
                <th>Başlık</th>
                <th>Tip</th>
                <th>Key</th>
                <th width="50">Listeleme Sayfası</th>
                <th width="50">Detay Sayfası</th>
                <th width="50">Ekleme Sayfası</th>
                <th width="50">Düzenleme Sayfası</th>
                <th width="5"></th>
                <th width="5"></th>
                <th width="5"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($fields as $key => $val)
                <tr>
                  <td>{!! $val['title'] !!}</td>
                  <td>{!! $val['type'] !!}</td>
                  <td>{!! $key !!}</td>
                  <td>
                    <div class="checkbox">
                      <label class="checkbox-custom">
                        <input type="checkbox"
                               {{ $val['list'] ? 'checked' : '' }} onclick="this.checked=!this.checked;">
                        <i class="fa fa-fw fa-square-o"></i>
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="checkbox">
                      <label class="checkbox-custom">
                        <input type="checkbox"
                               {{ $val['detail'] ? 'checked' : '' }} onclick="this.checked=!this.checked;">
                        <i class="fa fa-fw fa-square-o"></i>
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="checkbox">
                      <label class="checkbox-custom">
                        <input type="checkbox"
                               {{ $val['create'] ? 'checked' : '' }} onclick="this.checked=!this.checked;">
                        <i class="fa fa-fw fa-square-o"></i>
                      </label>
                    </div>
                  </td>
                  <td>
                    <div class="checkbox">
                      <label class="checkbox-custom">
                          <input type="checkbox"
                                 {{ $val['update'] ? 'checked' : '' }} onclick="this.checked=!this.checked;">
                          <i class="fa fa-fw fa-square-o"></i>
                      </label>
                    </div>
                  </td>
                  <td>
                    <a class="btn btn-sm btn-icon btn-warning btn-rounded"
                       href="{{ route('fields.show', [$module_name, $key]) }}">
                      <i class="fa fa-search"></i>
                    </a>
                  </td>
                  <td>
                    <a class="btn btn-sm btn-icon btn-info btn-rounded"
                       href="{{ route('fields.edit', [$module_name, $key]) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                  <td>
                    @if($key !== 'id' && $key !== 'created_at' && $key !== 'updated_at')
                      <form action="{{ route('fields.destroy', [$module_name, $key]) }}" method="post" class="inline">
                        @method('DELETE') @csrf
                        <button type="submit" class="btn btn-sm btn-danger btn-rounded"
                                onclick="return confirm('{{ $val['title'] }} alanını silmek istediğinize emin misiniz?')">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    @endif
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </section>
      </section>
    </section>
  </aside>
@endsection
@section('js')
@endsection
