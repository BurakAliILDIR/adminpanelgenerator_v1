<?php
$fields = $settings['fields'];
$model = $settings['model'];
$route = $settings['route'];
$data = $settings['data'];
$model_name = class_basename($model);
?>
<h3>{{ $settings['title'] }}</h3>
<style>.checkbox-custom > i.checked:before {
    color: #fb6b5b;
  }</style>
<aside>
  <section class="vbox">
    <header class="header bg-white b-b clearfix">
      <div class="row m-t-sm">
        <div class="col-sm-7 m-b-xs col-xs-4">
          @can("$model_name.create")
            <a href="{{ route($route['create']) }}"
               class="btn btn-sm btn-primary btn-rounded"><i class="fa fa-plus"></i> Yeni Kayıt</a>
          @endcan
        </div>
        <div class="col-sm-5 m-b-xs col-xs-8">
          <?php $ara = request()->input('ara'); ?>
          <form>
            <div class="input-group">
              @if($ara)
                <span class="input-group-btn">
                <a href="{{ route($route['index']) }}" class="btn btn-sm btn-default btn-rounded pull-left"
                   type="button">
                  <i class="fa fa-list"></i>
                  Tüm Kayıtları Listele
                </a>
              </span>
              @endif
              <input type="text" name="ara" class="input-sm form-control rounded" autocomplete="off"
                     placeholder="{{ $settings['title'] }} içinde ara" value="{{ $ara }}">
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
              @can("$model_name.delete")
                <th width="5">
                  <button type="button" id="multiple_delete"
                          data-url="{{ route($route['delete']) }}"
                          class="btn btn-xs btn-danger btn-rounded"
                          title="Seçili Kayıtları Sil"><i class="fa fa-trash-o"></i>
                  </button>
                </th>
              @endcan
              @foreach($fields as $key => $val)
                  <th>{{ $val['title'] }}</th>
              @endforeach
              @can("$model_name.detail")
                <th width="5"></th>
              @endcan
              @can("$model_name.update")
                <th width="5"></th>
              @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($data as $upper_val)
              <tr>
                @can("$model_name.delete")
                  <td>
                    <div class="checkbox">
                      <label class="checkbox-custom" id="{{ $upper_val['id'] }}">
                        <input type="checkbox" name="checked[]" value="{{ $upper_val['id'] }}" data-val="delete">
                        <i class="fa fa-fw fa-square-o"></i>
                      </label>
                    </div>
                  </td>
                @endcan
                @foreach($fields as $lower_key => $lower_val)
                    @component('components.read.partials.td', ['lower_val'=> $lower_val, 'lower_key'=> $lower_key, 'upper_val'=> $upper_val])@endcomponent
                @endforeach
                @can("$model_name.detail")
                  <td>
                    <a class="btn btn-sm btn-icon btn-warning btn-rounded"
                       href="{{ route($route['show'], ((string)$upper_val['id'])) }}">
                      <i class="fa fa-search"></i>
                    </a>
                  </td>
                @endcan
                @can("$model_name.update")
                  <td>
                    <a class="btn btn-sm btn-icon btn-info btn-rounded"
                       href="{{ route($route['edit'], $upper_val['id']) }}">
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
            {{ ($total = $data->total()) !== 0 ? 'Toplam kayıt: '. $total : 'Kayıt bulunmamaktadır.' }}</p>
        </div>
      </div>
    </footer>
  </section>
</aside>
<script src="{{ asset('/storage/admin-custom-template/table/table-delete.js') }}"></script>
