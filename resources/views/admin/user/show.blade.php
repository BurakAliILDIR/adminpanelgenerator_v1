@extends('admin.layouts.master')
@section('title', 'Kullanıcı Detay')
@section('css')
  {{--Gallery CSS--}}
  <link type="text/css" rel="stylesheet" href="/admin-custom-template/gallery/gallery.css">
  {{--Gallery Plugins CSS--}}
  <link type="text/css" rel="stylesheet" href="/plugins/baguettebox/baguettebox.min.css">
  {{-- Dropzone CSS--}}
  <link type="text/css" rel="stylesheet" href="/plugins/dropzone/dropzone.min.css">
@endsection
@section('content')
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <div class="row">
        <div class="col-md-6">
          <div class="m-t">
            <a class="btn btn-xs btn-default btn-rounded " href="{{ route('user.index') }}">
              <i class="fa fa-arrow-left"></i>
              Tüm Kayıtlara Dön
            </a>
            <span class="m-l">{{ 'Kullanıcı Detay' }}</span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="m-t m-r pull-right">
            <a class="btn btn-xs btn-info btn-rounded "
               href="{{ route('user.edit', $model['id']) }}">
              <i class="fa fa-edit"></i>
              Bu Kaydı Düzenle
            </a>
            <form action="{{ route('user.destroy') }}" method="post"
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
                  <span class="pull-left thumb m-r">
                    <img
                      src="{{ $model->getFirstMediaUrl('profile') === '' ? \Illuminate\Support\Facades\Storage::url('/application/defaults/avatar.jpg') : $model->getFirstMediaUrl('profile') }}">
                  </span>
                </div>
                <div style="word-break: break-all">
                  <small class="text-uc text-muted">Ad : </small>
                  <span>{!! $model['name'] ?? '-' !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Soyad : </small>
                  <span>{!! $model['surname'] ?? '-' !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">E-posta : </small>
                  <span>{!! $model['email'] !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Telefon : </small>
                  <span>{!! $model['phone'] ?? '-' !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Cinsiyet : </small>
                  <span>{!! $model['gender'] ?? '-' !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Doğum Tarihi : </small>
                  <span>{!! $model['date_of_birth'] ? \Carbon\Carbon::parse($model['date_of_birth'])->format('d/m/Y') : '-' !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Durum : </small>
                  <span>{!! $model['confirm'] ? 'Aktif' : 'Pasif' !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">E-posta Onayı : </small>
                  <span>{!! $model['email_verified_at'] ? \Carbon\Carbon::parse($model['email_verified_at'])->format('d/m/Y H:i:s') : '-' !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Kayıt Tarihi : </small>
                  <span>{!! \Carbon\Carbon::parse($model['created_at'])->format('d/m/Y H:i:s') !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Son Düzenleme Tarihi : </small>
                  <span>{!! \Carbon\Carbon::parse($model['updated_at'])->format('d/m/Y H:i:s') !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Hakkımda : </small>
                  <span>{!! $model['bio'] ?? '-' !!}</span>
                  <div class="line"></div>
                </div>
              </div>
            </section>
          </section>
        </aside>
        <aside class="bg-white col-md-6">
          <section class="vbox">
            <header class="header bg-light bg-gradient">
              <ul class="nav nav-tabs nav-white">

                <li id="roleLeaf">
                  <a href="#role" id="roleA" data-toggle="tab"
                     onclick="setLeaf('role')">
                    Roller
                  </a>
                </li>

                <li id="permissionLeaf">
                  <a href="#permission" id="permissionA" data-toggle="tab"
                     onclick="setLeaf('permission')">
                    İzinler
                  </a>
                </li>
                @foreach($fields as $key => $val)
                  @if(($val['detail']) && @$val['multiple'] && $val['type'] !== 'multi_image')
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
              <div class="tab-content">
                <div class="tab-pane" id="rolePage">
                  <section class="scrollable wrapper-md w-f">
                    @if($roles->count() > 0)
                      <section class="panel panel-default">
                        <div class="table-responsive">
                          <table class="table table-striped m-b-none">
                            <thead>
                            <tr>
                              <th>Rol Adı</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $row)
                              <tr>
                                <td>{!! $row !!}</td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </section>
                    @else
                      <small>Rol bulunmamaktadır.</small>
                    @endif
                  </section>
                </div>
                <div class="tab-pane" id="permissionPage">
                  <section class="scrollable wrapper-md w-f">
                    @if($permissions->count() > 0)
                      <section class="panel panel-default">
                        <div class="table-responsive">
                          <table class="table table-striped m-b-none">
                            <thead>
                            <tr>
                              <th>İzin Adı</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $row)
                              <tr>
                                <td>{!! $row->name !!}</td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </section>
                    @else
                      <small>İzin bulunmamaktadır.</small>
                    @endif
                  </section>
                </div>
                @foreach($fields as $key => $val)
                  @if(($val['detail']) && @$val['multiple'] && $val['type'] !== 'multi_image')
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
        </aside>
        <aside class="col-md-3 b-l">

          <section class="vbox">
            <section class="scrollable">
              <div class="wrapper-md">
                @foreach($fields as $key => $val)
                  @if($val['detail'] && @$val['multiple'] && $val['type'] === 'multi_image')
                    @can('User.imageUpload')
                      <p>{{ $val['title'] . ' : Yükleme Alanı' }}</p>
                      <section class="panel panel-default">
                        <form
                          action="{{ route('imageUpload', [$model->id, $key, str_replace('\\', '-', get_class($model))]) }}"
                          class="dropzone">
                          @csrf
                        </form>
                      </section>
                    @endcan
                    @if(($images = $model->getMedia($key))->count())
                      @component('components.alert.alert_messages')@endcomponent
                      <?php $imageDeletePermission = auth()->user()->can('User.imageDelete'); ?>
                      @if($imageDeletePermission)
                        <form action="{{ route('imageDelete', 'User') }}" method="post">
                          @Csrf @method('DELETE')
                          @endif
                          <p>{{ $val['title'] }}
                            @if($imageDeletePermission)
                              <button class="btn btn-danger pull-right btn-xs btn-rounded"
                                      onclick="return confirm('Seçili resimleri silmek istediğinize emin misiniz?');">
                                <i class="fa fa-trash"></i> Seçili Resimleri Sil
                              </button>
                            @endif
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
                                        @if($imageDeletePermission)
                                          <div class="row">
                                            <div class="col-md-12">
                                              <footer class="bg-light lter">
                                                <ul class="nav nav-pills nav-sm">
                                                  <div class="checkbox m-l">
                                                    <label class="checkbox-custom center-block">
                                                      <input type="checkbox" name='mediaTodelete[]'
                                                             value="{{$image->id}}">
                                                      <i class="fa fa-fw fa-square-o"></i>
                                                      Sil
                                                    </label>
                                                  </div>
                                                </ul>
                                              </footer>
                                            </div>
                                          </div>
                                        @endif
                                      </section>
                                    </div>
                                    @if($order % 2)
                                  </div>
                                @endif
                              @endforeach
                            </div>
                          </section>
                          @if($imageDeletePermission)
                        </form>
                      @endif
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
@endsection
@section('js')
  {{-- Gallery JS--}}
  <script type="text/javascript" src="/plugins/baguettebox/baguettebox.min.js"></script>
  {{-- Gallery Plugins JS--}}
  <script type="text/javascript" src="/admin-custom-template/gallery/gallery.js"></script>
  {{-- Dropzone JS--}}
  <script type="text/javascript" src="/plugins/dropzone/dropzone.min.js"></script>
@endsection
