<h3>{{ $settings['title'] }}</h3>
<style>.checkbox-custom > i.checked:before {color: #fb6b5b;}</style>
<aside>
    <section class="vbox">
        <header class="header bg-white b-b clearfix">
            <div class="row m-t-sm">
                <div class="col-sm-4 m-b-xs">
                    <form>
                        <div class="input-group">
                            <input type="text" name="ara" class="input-sm form-control rounded"
                                   placeholder="{{ $settings['title'] }} İçinde Ara (Tümü için boş bırakınız)">
                            <span class="input-group-btn">
                          <button class="btn btn-sm btn-default btn-rounded" type="submit">
                              <i class="fa fa-search"></i>
                              Ara
                          </button>
                        </span>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8 m-b-xs">
                    <a href="{{ route($settings['route']['create']) }}" class="btn btn-sm btn-primary btn-rounded"
                       style="float: right;"><i class="fa fa-plus"></i> Ekle</a>
                </div>
            </div>
        </header>
        <section class="scrollable wrapper w-f">
            <section class="panel panel-default">
                <div class="table-responsive">
                    <table class="table table-striped m-b-none">
                        <thead>
                        <tr>
                            <th width="5">
                                <button type="button" id="multiple_delete"
                                        data-url="{{ route($settings['route']['delete']) }}"
                                        class="btn btn-xs btn-danger btn-rounded"
                                        title="Seçili Kayıtları Sil"><i class="fa fa-trash-o"></i>
                                </button>
                            </th>
                            @foreach($settings['fields'] as $key => $val)
                                @if($val[$settings['operation']])
                                    <th>{{ $val['title'] }}</th>
                                @endif
                            @endforeach
                            <th width="5"><i class="fa fa-search"></i></th>
                            <th width="5"><i class="fa fa-edit"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($settings['data'] as $upper_val)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <label class="checkbox-custom" id="{{ $upper_val['id'] }}">
                                            <input type="checkbox" name="checked[]"
                                                   value="{{ $upper_val['id'] }}"
                                                   data-val="delete">
                                            <i class="fa fa-fw fa-square-o"></i>
                                        </label>
                                    </div>
                                </td>

                                @foreach($settings['fields'] as $lower_key => $lower_val)

                                    @if($lower_val[$settings['operation']] )

                                        @component('components.table.td', ['lower_val'=> $lower_val, 'lower_key'=> $lower_key, 'upper_val'=> $upper_val])@endcomponent
                                    @endif
                                @endforeach
                                <td>
                                    <a class="btn btn-sm btn-icon btn-warning btn-rounded"
                                       href="{{ route($settings['route']['show'], $upper_val['id']) }}">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-icon btn-info btn-rounded"
                                       href="{{ route($settings['route']['edit'], $upper_val['id']) }}">
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
                <div class="col-md-6 hidden-sm">
                    <p class="text-muted m-t">
                        Gösterimde
                        olan: {{ $settings['data']->currentPage() * $settings['data']->perPage() - $settings['data']->perPage() }}
                        - {{ $settings['data']->currentPage() != $settings['data']->lastPage() ? $settings['data']->currentPage() * $settings['data']->perPage() : $settings['data']->total() }}
                        | Toplam kayıt: {{ $settings['data']->total() }}</p>
                </div>
                <div class="col-md-6 col-sm-12 text-right text-center-xs">
                    {{ $settings['data']->links() }}
                </div>
            </div>
        </footer>
    </section>
</aside>
<script src="/admin-custom-template/table/table-delete.js">
</script>
