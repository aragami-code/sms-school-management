@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success">
        <div>
        <p>{{ Session::get('success')}}</p>
        </div>
    </div>
@endif
@if (Session::has('warning'))
    <div class="alert alert-warning">
        <div>
        <b>{{ Session::get('warning')}}</b>
        </div>
    </div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">
    <div>
    <p>{{ Session::get('error')}}</p>
    </div>
</div>
@endif
@if (Session::has('login_succes'))
<div class="alert alert-success">
    <div>
    <p>{{ Session::get('login_success')}}</p>
    </div>
</div>
@endif
