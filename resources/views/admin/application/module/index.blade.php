@extends('admin.layouts.master')
@section('title', 'Modüller')
@section('css')
@endsection
@section('content')
  <h3>Modüller</h3>
  <aside>
    <section class="vbox">
      <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
          <div class="col-sm-7 m-b-xs">
            <a href="{{ route('modules.create') }}"
               class="btn btn-sm btn-primary btn-rounded"><i class="fa fa-plus"></i> Yeni Kullanıcı</a>
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
                <th>Modül Adı</th>
                <th width="5"></th>
                <th width="5"></th>
                <th width="5"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($data as $row)
                <?php $module_name = $row->getName(); ?>
                <tr>
                  <td>{!! $row->getName() !!}</td>
                  <td>
                    <a class="btn btn-sm btn-icon btn-warning btn-rounded"
                       href="{{ route('modules.show', $module_name) }}">
                      <i class="fa fa-search"></i>
                    </a>
                  </td>
                  <td>
                    <a class="btn btn-sm btn-icon btn-info btn-rounded"
                       href="{{ route('modules.edit', $module_name) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                  <td>
                    <a class="btn btn-sm btn-icon btn-danger btn-rounded"
                       onclick="if(confirm('{{ $module_name }} modülünü silmek istediğinize emin misiniz?\nUYARI: Daha önce yaptığınız bütün çalışmalarınız kaybolacaktır.')){
                         event.preventDefault();document.getElementById('{{ 'delete'.$module_name }}').submit();}">
                      <i class="fa fa-trash"></i>
                    </a>
                    {{ Form::open(['route' => ['modules.destroy', $module_name], 'style' => 'display: none;', 'id' => 'delete'.$module_name, 'method' => 'delete']) }}
                    {!! Form::close() !!}
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
