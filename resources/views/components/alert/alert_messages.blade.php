@if(session()->has('success'))
  <div class="alert alert-success fade in" role="alert">
    <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {!! session()->get('success') !!}
  </div>
@endif
@if(session()->has('info'))
  <div class="alert alert-info fade in" role="alert">
    <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session()->get('info')}}
  </div>
@endif
@if(session()->has('danger'))
  <div class="alert alert-danger fade in" role="alert">
    <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session()->get('danger')}}
  </div>
@endif
