@extends('admin.layouts.master')
@section('title', 'Rol Detay')
@section('css')
@endsection
@section('content')
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <div class="row">
        <div class="col-md-6 col-xs-6">
          <div class="m-t">
            <a class="btn btn-xs btn-default btn-rounded " href="{{ route('role.index') }}">
              <i class="fa fa-arrow-left"></i>
              Tüm Rollere Dön
            </a>
            <span class="m-l">Rol Detay</span>
          </div>
        </div>
        <div class="col-md-6">
          @can('Role.update')
            <div class="m-t m-r pull-right">
              <a class="btn btn-xs btn-info btn-rounded "
                 href="{{ route('role.edit', $model['id']) }}">
                <i class="fa fa-edit"></i>
                Bu Rolü Düzenle
              </a>
              @endcan
              @can('Role.delete')
                <form action="{{ route('role.destroy') }}" method="post" class="inline">
                  @method('DELETE') @csrf
                  <input type="hidden" name="id" value="{{ $model['id'] }}">
                  <input type="hidden" name="back" value="{{ URL::previous() }}">
                  <button type="submit" class="btn btn-xs btn-danger btn-rounded"
                          onclick="return confirm('Rolü silmek istediğinize emin misiniz?')">
                    <i class="fa fa-trash"></i>
                    Bu Rolü Sil
                  </button>
                </form>
              @endcan
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
                  <small class="text-uc text-muted">Rol Adı : </small>
                  <span>{!! $model['name'] !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Eklenme Tarihi : </small>
                  <span>{!! \Carbon\Carbon::parse($model['created_at'])->format('d/m/Y H:i:s') !!}</span>
                  <div class="line"></div>
                  <small class="text-uc text-muted">Düzenleme Tarihi : </small>
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
                @can('User.index')
                  <li id="userLeaf">
                    <a href="#user" id="userA" data-toggle="tab"
                       onclick="setLeaf('user')">
                      Kullanıcılar
                    </a>
                  </li>
                @endcan
                @can('Permission.index')
                  <li id="permissionLeaf">
                    <a href="#permission" id="permissionA" data-toggle="tab"
                       onclick="setLeaf('permission')">
                      İzinler
                    </a>
                  </li>
                @endcan
              </ul>
            </header>
            <section class="scrollable">
              <div class="tab-content">
                @can('User.index')
                  <div class="tab-pane" id="userPage">
                    <section class="scrollable wrapper-md w-f">
                      @if($users->count() > 0)
                        <section class="panel panel-default">
                          <div class="table-responsive">
                            <table class="table table-striped m-b-none">
                              <thead>
                              <tr>
                                <th>ID</th>
                                <th>Ad</th>
                                <th>Soyad</th>
                                <th>E-Posta</th>
                                <th>Durum</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($users as $row)
                                <tr>
                                  <td>{{ $row->id }}</td>
                                  <td>{!! $row->name !!}</td>
                                  <td>{!! $row->surname !!}</td>
                                  <td>{!! $row->email !!}</td>
                                  <td>{{ $row->confirm ? 'Aktif' : 'Pasif' }}</td>
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
                @endcan
                @can('Permission.index')
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
                        {{ $permissions->appends(['izinler' => $permissions->currentPage()])->links() }}
                      @else
                        <small>İzin bulunmamaktadır.</small>
                      @endif
                    </section>
                  </div>
                  @endcan
              </div>
            </section>
          </section>
        </aside>
      </section>
    </section>
  </section>
@endsection
@section('js')
  <script src="{{ asset('/storage/admin-custom-template/detail/change-leaf.js') }}"></script>
@endsection
