@extends('errors.errors_layout')

@section('title')

erreur 403 Acces Refusé

@endsection

@section('error-content')

<h2>403</h2>
<p>Accès Refusé</p>
<p class="mt-5">{{$exception->getMessage()}}</p>
<a href="{{route('admin.dashboard')}}">Retournez à la page d'acceuil</a> <h1>ou alors</h1>
<a href="{{route('admin.login')}}">reconnectez vous</a>

@endsection
