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
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>HOOOOP DELİKANLI!</strong> Değerleri uygun girdiğinizden emin olunuz.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
