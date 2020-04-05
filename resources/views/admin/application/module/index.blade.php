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
               class="btn btn-sm btn-primary btn-rounded"><i class="fa fa-plus"></i> Yeni Modül</a>
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
                    <a class="btn btn-sm btn-warning btn-rounded"
                       href="{{ route('modules.show', $module_name) }}">
                      <i class="fa fa-search"></i> Alanlar
                    </a>
                  </td>
                  <td>
                    <a class="btn btn-sm btn-icon btn-info btn-rounded"
                       href="{{ route('modules.edit', $module_name) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
                  <td>
                    <form action="{{ route('modules.destroy', $module_name) }}" method="post" class="inline">
                      @method('DELETE') @csrf
                      <button type="submit" class="btn btn-sm btn-danger btn-rounded"
                              onclick="return confirm('{{ $module_name }} modülünü silmek istediğinize emin misiniz?\n\nUYARI: Daha önce yaptığınız bütün çalışmalarınız kaybolacaktır.')">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
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
