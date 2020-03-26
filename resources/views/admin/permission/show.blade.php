@extends('admin.layouts.master')
@section('title', 'İzin Detay')
@section('css')
@endsection
@section('content')
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <div class="row">
        <div class="col-md-6">
          <div class="m-t">
            <a class="btn btn-xs btn-default btn-rounded " href="{{ route('permission.index') }}">
              <i class="fa fa-arrow-left"></i>
              Tüm Kayıtlara Dön
            </a>
            <span class="m-l">{{ 'İzin Detay' }}</span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="m-t m-r pull-right">
            <a class="btn btn-xs btn-info btn-rounded "
               href="{{ route('permission.edit', $model['id']) }}">
              <i class="fa fa-edit"></i>
              Bu Kaydı Düzenle
            </a>
            <form action="{{ route('permission.destroy') }}" method="post"
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
                <div style="word-break: break-all">
                  <small class="text-uc text-muted">İzin Adı : </small>
                  <span>{!! $model['name'] !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Eklenme Tarihi : </small>
                  <span>{!! \Carbon\Carbon::parse($model['created_at'])->format('d/m/Y H:i:s') !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Son Düzenleme Tarihi : </small>
                  <span>{!! \Carbon\Carbon::parse($model['updated_at'])->format('d/m/Y H:i:s') !!}</span>
                  <div class="line"></div>
                </div>
              </div>
            </section>
          </section>
        </aside>
        <aside class="bg-white col-md-9">
          <section class="vbox">
            <header class="header bg-light bg-gradient">
              <ul class="nav nav-tabs nav-white">

                <li id="userLeaf">
                  <a href="#user" id="userA" data-toggle="tab"
                     onclick="setLeaf('user')">
                    Kullanıcılar
                  </a>
                </li>

                <li id="roleLeaf">
                  <a href="#role" id="roleA" data-toggle="tab"
                     onclick="setLeaf('role')">
                    Roller
                  </a>
                </li>
              </ul>
            </header>
            <section class="scrollable">
              <div class="tab-content">
                <div class="tab-pane" id="userPage">
                  <section class="scrollable wrapper-md w-f">
                    @if($users->count() > 0)
                      <section class="panel panel-default">
                        <div class="table-responsive">
                          <table class="table table-striped m-b-none">
                            <thead>
                            <tr>
                              <th>Ad</th>
                              <th>Soyad</th>
                              <th>E-Posta</th>
                              <th>Durum</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $row)
                              <tr>
                                <td>{!! $row->name !!}</td>
                                <td>{!! $row->surname !!}</td>
                                <td>{!! $row->email !!}</td>
                                <td>{!! $row->confirm ? 'Aktif' : 'Pasif' !!}</td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </section>
                      {{ $users->appends(['kullanicilar' => $users->currentPage()])->links() }}
                    @else
                      <small>Kullanıcı bulunmamaktadır.</small>
                    @endif
                  </section>
                </div>
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
                                <td>{!! $row->name !!}</td>
                              </tr>
                            @endforeach
                            </tbody>
                          </table>
                        </div>
                      </section>
                      {{ $roles->appends(['roller' => $roles->currentPage()])->links() }}
                    @else
                      <small>Rol bulunmamaktadır.</small>
                    @endif
                  </section>
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
