@extends('sales::layouts.master')

@section('content')
    <h1>{!! config('sales.name') !!}</h1>
    <div class="card-body table-responsive p-0">
        @include('layouts.partials.success_message')
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <td>Müşteri Adı</td>
                <td>Toplam Tutar</td>
                <td>Detay</td>
                <td>Satış Tarihi</td>
            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->user->name }}</td>
                    <td>{{ number_format(($sale->total_price($sale->infos)), 2) }} ₺</td>
                    {{--
                        <td>{{ $sale->confirm ? "Yayında" : 'Yayında Değil' }}</td>
                    --}}
                    <td>
                        <a class="btn btn-outline-warning"
                           href="{{ route('sales.show', $sale->id) }}"> <i
                                class="mdi mdi-playlist-play"></i> Detay
                        </a>
                    </td>
                    <td>{{ $sale->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $sales->links() }}</div>
@endsection
