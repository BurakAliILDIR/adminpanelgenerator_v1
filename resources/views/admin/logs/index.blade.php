@extends('admin.layouts.master')
@section('title', 'Kullanıcı Etkinlikleri')
@section('css')
@endsection
@section('content')
  <h3>Kullanıcı Etkinlikleri</h3>
  <aside>
    <section class="vbox">
      <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
          <div class="col-sm-7 m-b-xs">
          </div>
          <div class="col-sm-5 m-b-xs">
            <?php $ara = \request()->input('ara'); ?>
            <form>
              <div class="input-group">
                @if($ara)
                  <span class="input-group-btn">
                <a href="{{ route('Logs') }}" class="btn btn-sm btn-default btn-rounded pull-left"
                   type="button">
                  <i class="fa fa-list"></i>
                  Tüm Etkinlikleri Listele
                </a>
              </span>
                @endif
                <input type="text" name="ara" class="input-sm form-control rounded" autocomplete="off"
                       placeholder="Etkinlikler içinde ara"
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
        <section class="panel panel-default">
          <div class="table-responsive">
            <table class="table table-striped m-b-none">
              <thead>
              <tr>
                <th>ID</th>
                <th>Tip</th>
                <th>Yapan Hesap</th>
                <th>Yer</th>
                <th>Eski Değerler</th>
                <th>Yeni Değerler</th>
                <th>Tarih</th>
              </tr>
              </thead>
              <tbody>
              @foreach($data as $row)
                @php $log_model_name = explode("\\", $row->subject_type); 
                     $log_model_name = end($log_model_name);
                @endphp
                <tr>
                  <td>{{ $row->id }}</td>
                  <td>{{ $row->description }}</td>
                  <td>
                    @can("User.index")
                      <a href="{{ route("user.show", $row->causer_id) }}"><strong>{!! $row->causer_id !!}</strong></a>
                    @else
                      {!! $row->causer_id !!}
                    @endcan
                  </td>
                  <td>
                    @if(\Illuminate\Support\Facades\Auth::user()->can("$log_model_name.show") && $row->description !== 'deleted')
                      <a
                        href="{{ route(strtolower($log_model_name).".show", $row->subject_id) }}"><strong>{!! $log_model_name !!}</strong></a>
                    @else
                      {{ $log_model_name }}
                    @endif
                  </td>
                  <td>@foreach($row->properties['old'] ?? [] as $key => $val)
                      {{ "$key: $val" }}
                      @if(!$loop->last)
                        <br>
                      @endif
                    @endforeach</td>
                  <td>@foreach($row->properties['attributes'] ?? [] as $key => $val)
                      {{ "$key: $val" }}
                      @if(!$loop->last)
                        <br>
                      @endif
                    @endforeach</td>
                  <td>{{ $row->created_at }}</td>
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
              {{ ($total = $data->total()) !== 0 ? 'Toplam etkinlik: '. $total : 'Etkinlik bulunmamaktadır.' }}</p>
          </div>
        </div>
      </footer>
    </section>
  </aside>
@endsection
@section('js')
@endsection
