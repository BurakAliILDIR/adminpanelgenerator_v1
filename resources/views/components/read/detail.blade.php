<?php
$fields = $settings['fields'];
$model = $settings['model'];
$route = $settings['route'];
?>

<section class="vbox">
  <header class="header bg-white b-b b-light">
    <div class="row">
      <div class="col-md-6">
        <div class="m-t">
          <a class="btn btn-xs btn-default btn-rounded " href="{{ route($route['index']) }}">
            <i class="fa fa-arrow-left"></i>
            Tüm Kayıtlara Dön
          </a>
          <span class="m-l">{{ $settings['title'] }}</span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="m-t m-r pull-right">
          <a class="btn btn-xs btn-info btn-rounded "
             href="{{ route($route['edit'], $model['id']) }}">
            <i class="fa fa-edit"></i>
            Bu Kaydı Düzenle
          </a>
          <form action="{{ route($route['delete']) }}" method="post"
                style="display: inline-block;">
            @method('DELETE') @csrf
            <input type="hidden" name="id" value="{{ $model['id'] }}">
            <input type="hidden" name="back" value="{{ URL::previous() }}">
            <button type="submit" class="btn btn-xs btn-danger btn-rounded"
                    onclick="confirm('Kaydı silmek istediğinize emin misiniz?')">
              <i class="fa fa-trash"></i>
              Bu Kaydı Sil
            </button>
          </form>
        </div>
      </div>
    </div>
  </header>
  <section class="scrollable">
    <section class="hbox stretch row">
      <aside class="bg-light lter b-r col-md-3">
        <section class="vbox">
          <section class="scrollable">
            <div class="wrapper-lg">
              <div class="clearfix m-b">
                @foreach($fields as $key => $val)
                  @if($val[$settings['operation']] && $val['type'] === 'image')
                    <span class="pull-left thumb m-r">
                    <img
                      src="{{ $model->getFirstMediaUrl($key) === '' ? \Illuminate\Support\Facades\Storage::url('/application/defaults/' . $val['value']) : $model->getFirstMediaUrl($key) }}">
                    </span>
                  @endif
                @endforeach
              </div>
              <div style="word-break: break-all">
                @foreach($fields as $key => $val)
                  @if($val[$settings['operation']] && !(@$val['multiple'] ?? true))
                    @switch($val['type'])
                      @case('text')
                      @case('email')
                      @case('number')
                      @case('radio')
                      @case('textarea')
                      <small class="text-uc text-muted">{{ $val['title'] }} : </small>
                      <span>{!! $model[$key] !!}</span>
                      <div class="line"></div>
                      @break
                      @case('file')
                      <small class="text-uc text-muted">{{ $val['title'] }} : </small>
                      @if(($file = $model->getFirstMediaUrl($key)) !== '')
                        <a class="btn btn-default btn-xs btn-rounded"
                           href="{{ $file }}" target="_blank">
                          {{ $val['title'] }}
                          Görüntüle
                        </a>
                      @else
                        -
                      @endif
                      <div class="line"></div>
                      @break
                      @case('select')
                      <?php $relation_infos = $val['relationship'] ?>
                      <small class="text-uc text-muted">{{ $val['title'] }} : </small>
                      @foreach($relation_infos['fields'] as $v)
                        {{ $model->relation($relation_infos)->first()[$v] }}
                        @if(!$loop->last)
                          {{ ' - ' }}
                        @endif
                      @endforeach
                      <div class="line"></div>
                      @break
                      @case('date')
                      <small class="text-uc text-muted">{{ $val['title'] }} : </small>
                      {{ \Carbon\Carbon::parse($model[$key])->format('d/m/Y') }}
                      <div class="line"></div>
                      @break
                      @case('datetime')
                      <small class="text-uc text-muted">{{ $val['title'] }} : </small>
                      {{ \Carbon\Carbon::parse($model[$key])->format('d/m/Y H:i:s') }}
                      <div class="line"></div>
                      @break
                    @endswitch
                  @endif
                @endforeach
              </div>
            </div>
          </section>
        </section>
      </aside>
      <aside class="bg-white col-md-6">
        <section class="vbox">
          <header class="header bg-light bg-gradient">
            <ul class="nav nav-tabs nav-white">
              @foreach($fields as $key => $val)
                @if(($val[$settings['operation']]) && @$val['multiple'] && $val['type'] !== 'multi_image')
                  <li id="{{ $key }}Leaf">
                    <a href="#{{ $key }}" id="{{ $key }}A" data-toggle="tab"
                       onclick="setLeaf('{{ $key }}')">
                      {{ $val['title'] }}
                    </a>
                  </li>
                @endif
              @endforeach
            </ul>
          </header>
          <section class="scrollable">
            <section class="scrollable">
              <div class="tab-content">
                @foreach($fields as $key => $val)
                  @if(($val[$settings['operation']]) && @$val['multiple'] && $val['type'] !== 'multi_image')
                    <?php $relation_infos = $val['relationship'] ?>
                    <div class="tab-pane" id="{{ $key }}Page">
                      <section class="scrollable wrapper-md w-f">
                        @php
                          $data = $model->relation($relation_infos)->orderByDESC('id')->paginate($relation_infos['perPage'], ['*'], $key);
                        @endphp
                        @if($data->count() > 0)
                          <section class="panel panel-default">
                            <div class="table-responsive">
                              <table class="table table-striped m-b-none">
                                <thead>
                                <tr>
                                  @foreach($data[0]->getSettings('fields') as $relation_key => $relation_val)
                                    @foreach($relation_infos['fields'] as $field)
                                      @if($relation_key === $field)
                                        <th>{{ $relation_val['title'] }}</th>
                                      @endif
                                    @endforeach
                                  @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $upper_val)
                                  <tr>
                                    @foreach($upper_val->getSettings('fields') as $lower_key => $lower_val)
                                      @if(array_search($lower_key, $relation_infos['fields']) !== false)
                                        @component('components.read.partials.td', ['lower_val'=> $lower_val, 'lower_key'=> $lower_key, 'upper_val'=> $upper_val])@endcomponent
                                      @endif
                                    @endforeach
                                  </tr>
                                @endforeach
                                </tbody>
                              </table>
                            </div>
                          </section>
                          {{ $data->appends([$key => $data->currentPage()])->links() }}
                        @else
                          <small>Kayıt bulunmamaktadır.</small>
                        @endif
                      </section>
                    </div>
                  @endif
                @endforeach
              </div>
            </section>
          </section>
        </section>
      </aside>
      <aside class="col-md-3 b-l">
        <section class="vbox">
          <section class="scrollable">
            <div class="wrapper-md">
              @foreach($fields as $key => $val)
                @if($val[$settings['operation']] && @$val['multiple'] && $val['type'] === 'multi_image')
                  <p>{{ $val['title'] . ' : Yükleme Alanı' }}</p>
                  <section class="panel panel-default">
                    <form
                      action="{{ route('imageUpload', [$model->id, $key, str_replace('\\', '-', get_class($model))]) }}"
                      class="dropzone">
                      @csrf
                    </form>
                  </section>
                  @if(($images = $model->getMedia($key))->count())
                    @component('components.alert.alert_messages')@endcomponent
                    <form action="{{ route('deleteImage') }}" method="post">
                      @Csrf @method('DELETE')
                      <p>{{ $val['title'] }}
                        <button class="btn btn-danger pull-right btn-xs btn-rounded"
                                onclick="return confirm('Seçili resimleri silmek istediğinize emin misiniz?');">
                          <i class="fa fa-trash"></i> Seçili Resimleri Sil
                        </button>
                      </p>
                      <section class="panel panel-default">
                        <div class="tz-gallery">
                          <style>.checkbox-custom > i.checked:before {
                              color: #fb6b5b;
                            }</style>
                          @foreach($images as $order => $image)
                            @if(!($order % 2))
                              <div class="row">
                                @endif
                                <div class="col-sm-12 col-md-6">
                                  <section class="panel panel-default m-t">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <a class="lightbox"
                                           href="{{ $image->getUrl('big') }}">
                                          <img src="{{ $image->getUrl('card') }}" alt="{{ $image->name }}">
                                        </a>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <footer class="bg-light lter">
                                          <ul class="nav nav-pills nav-sm">
                                            <div class="checkbox m-l">
                                              <label class="checkbox-custom center-block">
                                                <input type="checkbox" name='mediaTodelete[]' value="{{$image->id}}">
                                                <i class="fa fa-fw fa-square-o"></i>
                                                Sil
                                              </label>
                                            </div>
                                          </ul>
                                        </footer>
                                      </div>
                                    </div>
                                  </section>
                                </div>
                                @if($order % 2)
                              </div>
                            @endif
                          @endforeach
                        </div>
                      </section>
                    </form>
                  @endif
                @endif
              @endforeach
            </div>
          </section>
        </section>
      </aside>
    </section>
  </section>
</section>
<script src="/admin-custom-template/detail/change-leaf.js"></script>
