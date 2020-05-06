@extends('admin.layouts.master')
@section('title', 'Anasayfa')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
@endsection
@section('content')
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      {!! $userCountChart->container() !!}
      {!! $userCountChart->script() !!}
    </div>
  </div>  
@endsection
@section('js')
@endsection
