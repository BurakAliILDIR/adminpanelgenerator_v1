@if(session()->has('success'))
  <div class="alert alert-success" role="alert">
    <strong>{{session()->get('success')}}</strong>
  </div>
@endif
@if(session()->has('info'))
  <div class="alert alert-info" role="alert">
    <strong>{{session()->get('info')}}</strong>
  </div>
@endif
@if(session()->has('danger'))
  <div class="alert alert-danger" role="alert">
    <strong>{{session()->get('danger')}}</strong>
  </div>
@endif
