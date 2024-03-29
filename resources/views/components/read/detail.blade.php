<?php
$fields = $settings['fields'];
$model = $settings['model'];
$route = $settings['route'];
$class_name = class_basename($model);
?>

<section class="vbox">
  <header class="header bg-white b-b b-light">
    <div class="row">
      <div class="col-md-6">
        {{--@can($class_name.'.index')--}}
        <div class="m-t">
          <a class="btn btn-xs btn-default btn-rounded " href="{{ route($route['index']) }}">
            <i class="fa fa-arrow-left"></i>
            Tüm Kayıtlara Dön
          </a>
          <span class="m-l">{{ $settings['title'] }}</span>
        </div>
        {{--@endcan--}}
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="m-t m-r pull-right">
          @can($class_name.'.update')

            <a class="btn btn-xs btn-info btn-rounded "
               href="{{ route($route['edit'], $model['id']) }}">
              <i class="fa fa-edit"></i>
              Bu Kaydı Düzenle
            </a>
          @endcan
          @can($class_name.'.delete')
            <form action="{{ route($route['delete']) }}" method="post" class="inline">
              @method('DELETE') @csrf
              <input type="hidden" name="id" value="{{ $model['id'] }}">
              <input type="hidden" name="back" value="{{ URL::previous() }}">
              <button type="submit" class="btn btn-xs btn-danger btn-rounded"
                      onclick="return confirm('Kaydı silmek istediğinize emin misiniz?')">
								<i class="fa fa-trash"></i>
								Bu Kaydı Sil
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
							<div class="clearfix m-b">
								@foreach($fields as $key => $val)
									@if($val['type'] === 'image' && (($image = $model->getFirstMediaUrl($key)) !== '' || @$val['value']))
										<span class="pull-left thumb m-r">
                    <img
											src="{{ $image !== '' ? $image : \Illuminate\Support\Facades\Storage::url('application/defaults/'.$val['value']) }}">
                    </span>
									@endif
								@endforeach
							</div>
							<div style="word-break: break-all">
								@foreach($fields as $key => $val)
									@if(!(@$val['multiple']))
										@switch($val['type'])
											@case('hidden')
											@case('text')
											@case('email')
											@case('number')
											@case('radio')
											@case('textarea')
											<small class="text-uc text-muted">{{ $val['title'] }} : </small>
											<span>{!! "$model[$key] " . @$val['unit'] !!}</span>
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
											<?php $relation_infos = @$val['relationship'] ?>
											@if(@$relation_infos['multiple'] ?? true)
												<small class="text-uc text-muted">{{ $val['title'] }} : </small>
												@if($relation_infos)
													{{--{{ dd($model->relation($relation_infos)->first()) }}--}}
													@if(($item = $model->relation($relation_infos)->first()))
														@foreach($relation_infos['fields'] as $v)
															{{ $item[$v] ?? '-' }}
															@if(!$loop->last)
																{{ ' - ' }}
															@endif
														@endforeach
													@endif
												@else
													<span>{{ $model[$key] }}</span>
												@endif
												<div class="line"></div>
											@endif
											@break
											@case('auth')
											<?php $relation_infos = @$val['relationship'] ?>
											@if(@$relation_infos['multiple'] ?? true)
												<small class="text-uc text-muted">{{ $val['title'] }} : </small>
												@if($relation_infos && ($item = $model->relation($relation_infos)->first()))
													@can('User.detail')
														@if ($item['id'] === \Illuminate\Support\Facades\Crypt::decryptString(config
														('my-config.super_admin_id')))
															{{ $item['name'] . ' ' . $item['surname'] }}
														@else
															<a href="{{ $item['id'] }}"><strong>{{ $item['name'] . ' ' . $item['surname']}}</strong></a>
														@endif
													@else
														{{ $item['name'] . ' ' . $item['surname'] }}
													@endcan
												@endif
											@endif
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
                @if((@$val['multiple']) && $val['type'] !== 'multi_image')
                  @can("$key.index")
                    <li id="{{ $key }}Leaf">
                      <a href="#{{ $key }}" id="{{ $key }}A" data-toggle="tab"
                         onclick="setLeaf('{{ $key }}')">
                        {{ $val['title'] }}
                      </a>
                    </li>
                  @endcan
                @endif
              @endforeach
            </ul>
          </header>
          <section class="scrollable">
            <section class="scrollable">
              <div class="tab-content">
                @foreach($fields as $key => $val)
                  @if((@$val['multiple']) && $val['type'] !== 'multi_image')
                    @can("$key.index")
                      <?php $relation_infos = $val['relationship'];
                      $data = $model->relation($relation_infos)->orderByDESC('id')->paginate($relation_infos['perPage'], $relation_infos['fields'], $key);
                      ?>
                      <div class="tab-pane" id="{{ $key }}Page">
                        <section class="scrollable wrapper-md w-f">
                          @if($data->count())
                            @php
                              $modelFields = $data->first()->getSettings('fields');
                              foreach ($relation_infos['fields'] as $item){
                                $resultFields[$item] = $modelFields[$item];
                              }
                            @endphp
                            <section class="panel panel-default">
                              <div class="table-responsive">
                                <table class="table table-striped m-b-none">
                                  <thead>
                                  <tr>
                                    @foreach($resultFields as $relation_key => $relation_val)
                                      <th>{{ $relation_val['title'] }}</th>
                                    @endforeach
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($data as $upper_val)
                                    <tr>
                                      @foreach($resultFields as $lower_key => $lower_val)
                                        @component('components.read.partials.td', ['lower_val'=> $lower_val, 'lower_key'=> $lower_key, 'upper_val'=> $upper_val])@endcomponent
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
                    @endcan
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
                @if($val['type'] === 'multi_image')
                  @can(class_basename($model) . '.imageUpload')
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
                    <?php if (auth()->check()) $imageDeletePermission = auth()->user()->can($class_name . '.imageDelete');?>
                    @component('components.alert.alert_messages')@endcomponent
                    @if($imageDeletePermission)
                      <form action="{{ route('imageDelete', $class_name) }}" method="post">
                        @Csrf @method('DELETE')
                        @endif
                        <p>
                          {{ $val['title'] }}
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
                                                           value="{{ $image->id }}">
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
<script src="{{ asset('/storage/admin-custom-template/detail/change-leaf.js') }}"></script>
