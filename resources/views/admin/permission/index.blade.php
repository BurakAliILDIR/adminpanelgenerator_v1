@extends('admin.layouts.master')
@section('title', 'İzinler')
@section('css')
@endsection
@section('content')
  <h3>İzinler</h3>
  <style>.checkbox-custom > i.checked:before {
      color: #fb6b5b;
    }</style>
  <aside>
    <section class="vbox">
      <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
          <div class="col-sm-7 m-b-xs">
            {{--<a href="{{ route('permission.create') }}"
               class="btn btn-sm btn-primary btn-rounded"><i class="fa fa-plus"></i> Yeni İzin</a>--}}
          </div>
          <div class="col-sm-5 m-b-xs">
            <?php $ara = \request()->input('ara'); ?>
            <form>
              <div class="input-group">
                @if($ara)
                  <span class="input-group-btn">
                <a href="{{ route('permission.index') }}" class="btn btn-sm btn-default btn-rounded pull-left"
                   type="button">
                  <i class="fa fa-list"></i>
                  Tüm İzinleri Listele
                </a>
              </span>
                @endif
                <input type="text" name="ara" class="input-sm form-control rounded" autocomplete="off"
                       placeholder="İzinler içinde ara"
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
                {{--<th width="5">
                  <button type="button" id="multiple_delete"
                          data-url="{{ route('permission.destroy') }}"
                          class="btn btn-xs btn-danger btn-rounded"
                          title="Seçili Kayıtları Sil"><i class="fa fa-trash-o"></i>
                  </button>
                </th>--}}
                <th>İzin Adı</th>
                <th>Düzenlenme Tarihi</th>
                <th width="5"></th>
                <th width="5"></th>
              </tr>
              </thead>
              <tbody>
              @foreach($data as $row)
                <tr>
                  {{--<td>
                    <div class="checkbox">
                      <label class="checkbox-custom" id="{{ $row['id'] }}">
                        <input type="checkbox" name="checked[]"
                               value="{{ $row['id'] }}"
                               data-val="delete">
                        <i class="fa fa-fw fa-square-o"></i>
                      </label>
                    </div>
                  </td>--}}
                  <td>{{ $row->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y H:i:s') }}</td>
                  <td>
                    <a class="btn btn-sm btn-icon btn-warning btn-rounded"
                       href="{{ route('permission.show', $row['id']) }}">
                      <i class="fa fa-search"></i>
                    </a>
                  </td>
                  <td>
                    <a class="btn btn-sm btn-icon btn-info btn-rounded"
                       href="{{ route('permission.edit', $row['id']) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                  </td>
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
              {{ ($total = $data->total()) !== 0 ? 'Toplam kayıt: '. $total : 'Kayıt bulunmamaktadır.' }}</p>
          </div>
        </div>
      </footer>
    </section>
  </aside>
@endsection
@section('js')
  <script src="/admin-custom-template/table/table-delete.js"></script>
@endsection
