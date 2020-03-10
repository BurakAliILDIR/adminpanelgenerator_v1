@extends('sales::layouts.master')
@section('content')
    @include('layouts.partials.success_message')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('sales.index') }}"
               class="btn btn-secondary btn-default btn-sm mr-2">
                Satışlara geri dön
            </a>
            <h2>Müşteri : {{ $sale->user->name }}</h2>
        </div>
        <div class="card-body pt-4">
            <ul class="list-group list-group-flush mt-4">
                <li class="list-group-item">
                    <strong>Müşteri E-posta : </strong>{{ $sale->user->email }}
                </li>
                <li class="list-group-item">
                    <strong>Toplam Tutar : </strong> {{ number_format(($sale->total_price($sale->infos)), 2) }} ₺
                </li>
                <li class="list-group-item">
                    <strong>Satış Tarihi : </strong> {{ $sale->created_at }}
                </li>
            </ul>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Aldığı Ürünler</h2>
        </div>
        <div class="card-body pt-4">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <td>Adı</td>
                    <td>Resim</td>
                    <td>Birim Adeti</td>
                    <td>Birim Değeri</td>
                    <td>Satılan Adet</td>
                    <td>Satış Tutarı</td>
                    <td>Detay</td>
                    <td>Oluşturma Tarihi</td>
                </tr>
                </thead>
                <tbody>
                @foreach($sale->infos as $info)
                    <tr>
                        <td>{{ $info->product->name }}</td>
                        <td>
                            <input width="100" type="image" src="{{  $info->product->image_url }}">
                        </td>
                        <td>{{  $info->product->unit_count }}</td>
                        <td>{{  $info->product->unit_price }} ₺</td>
                        <td>{{ $info->count }}</td>
                        <td>{{ number_format( $info->buy_price, 2) }} ₺</td>
                        <td>{{  $info->product->unit_convert_view( $info->product->unit_key,  $info->product->unit_value) }}</td>
                        {{--<td>{{ $product->confirm ? "Yayında" : 'Yayında Değil' }}</td>--}}
                        <td>
                            <a class="btn btn-outline-warning"
                               href="{{ route('products.show', $info->product->id) }}"> <i
                                    class="mdi mdi-playlist-play"></i>Ürün Detayı
                            </a>
                        </td>
                        <td>{{  $info->product->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
