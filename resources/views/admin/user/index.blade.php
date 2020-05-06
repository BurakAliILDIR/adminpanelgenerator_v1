@extends('admin.layouts.master')
@section('title', 'Kullanıcılar')
@section('css')
@endsection
@section('content')
  <h3>Kullanıcılar</h3>
  <style>.checkbox-custom > i.checked:before {
      color: #fb6b5b;
    }</style>
  <aside>
    <section class="vbox">
      <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
          <div class="col-sm-7 m-b-xs">
            @can('User.create')
              <a href="{{ route('user.create') }}"
                 class="btn btn-sm btn-primary btn-rounded"><i class="fa fa-plus"></i> Yeni Kullanıcı</a>
            @endcan
          </div>
          <div class="col-sm-5 m-b-xs">
            <?php $ara = \request()->input('ara'); ?>
            <form>
              <div class="input-group">
                @if($ara)
                  <span class="input-group-btn">
                <a href="{{ route('user.index') }}" class="btn btn-sm btn-default btn-rounded pull-left"
                   type="button">
                  <i class="fa fa-list"></i>
                  Tüm Kullanıcıları Listele
                </a>
              </span>
                @endif
                <input type="text" name="ara" class="input-sm form-control rounded" autocomplete="off"
                       placeholder="Kullanıcılar içinde ara"
                       value="{{ $ara }}">
                <span class="input-group-btn">
                <button class="btn btn-sm btn-default btn-rounded" type="submit">
                  <i class="fa fa-search"></i>
                  Ara
                </button>
              </span>
              </div>
            </form>
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
                @can('User.delete')
                  <th width="5">
                    <button type="button" id="multiple_delete"
                            data-url="{{ route('user.destroy') }}"
                            class="btn btn-xs btn-danger btn-rounded"
                            title="Seçili Kullanıcıları Sil"><i class="fa fa-trash-o"></i>
                    </button>
                  </th>
                @endcan
                <th width="20%">ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>E-posta</th>
                @can('User.detail')
                  <th width="5"></th>
                @endcan
                @can('User.update')
                  <th width="5"></th>
                @endcan
              </tr>
              </thead>
              <tbody>
              @foreach($data as $row)
                <tr>
                  @can('User.delete')
                    <td>
                      <div class="checkbox">
                        <label class="checkbox-custom" id="{{ $row['id'] }}">
                          <input type="checkbox" name="checked[]" value="{{ $row['id'] }}" data-val="delete">
                          <i class="fa fa-fw fa-square-o"></i>
                        </label>
                      </div>
                    </td>
                  @endcan
                  <td>{!! $row->id !!}</td>
                  <td>{!! $row->name !!}</td>
                  <td>{!! $row->surname !!}</td>
                  <td>{!! $row->email !!}</td>
                  @can('User.detail')
                    <td>
                      <a class="btn btn-sm btn-icon btn-warning btn-rounded"
                         href="{{ route('user.show', $row['id']) }}">
                        <i class="fa fa-search"></i>
                      </a>
                    </td>
                  @endcan
                  @can('User.update')
                    <td>
                      <a class="btn btn-sm btn-icon btn-info btn-rounded"
                         href="{{ route('user.edit', $row['id']) }}">
                        <i class="fa fa-edit"></i>
                      </a>
                    </td>
                  @endcan
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </section>
      </section>
      <footer class="footer bg-white b-t">
        <div class="row text-center-xs">
          <div class="col-md-9 col-sm-12 text-center-xs">
            {{ $data->links() }}
          </div>
          <div class="col-md-3 hidden-sm">
            <p class="text-muted m-t text-right">
              {{$data->firstItem() ? 'Gösterimde olan: ' . $data->firstItem() . ' - ' . $data->lastItem() . ' |' : '' }}
              {{ ($total = $data->total()) !== 0 ? 'Toplam kullanıcı: '. $total : 'Kullanıcı bulunmamaktadır.' }}</p>
          </div>
        </div>
      </footer>
    </section>
  </aside>
@endsection
@section('js')
  <script src="{{ asset('/storage/admin-custom-template/table/table-delete.js') }}"></script>
@endsection
