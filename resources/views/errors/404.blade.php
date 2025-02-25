@extends('errors.errors_layout')

@section('title')

erreur 404 page Non Trouvé

@endsection

@section('error-content')

<h2>404</h2>

<p class="mt-5">Page non Trouvé. !!</p>
<a href="{{route('admin.dashboard')}}">Retournez à la page d'acceuil</a> <h1>ou alors</h1>
<a href="{{route('admin.login')}}">reconnectez vous</a>

@endsection
