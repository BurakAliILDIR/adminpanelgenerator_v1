@if(session()->has('success'))
  <div class="alert alert-success fade in" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{session()->get('success')}}</strong>
  </div>
@endif
@if(session()->has('info'))
  <div class="alert alert-info fade in" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{session()->get('info')}}</strong>
  </div>
@endif
@if(session()->has('danger'))
  <div class="alert alert-danger fade in" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>{{session()->get('danger')}}</strong>
  </div>
@endif
