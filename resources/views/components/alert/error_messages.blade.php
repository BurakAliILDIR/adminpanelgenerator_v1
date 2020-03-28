@if ($errors->any())
  <div class="alert alert-danger">
    <strong>HOOOOP!</strong> Değerleri uygun girdiğinizden emin olunuz.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
