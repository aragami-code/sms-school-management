@extends('errors.errors_layout')

@section('title')

erreur 500 erreur interne dans le serveur

@endsection

@section('error-content')

<h2>500</h2>

<p class="mt-5">ERREUR INTERNE DANS LE SERVEUR</p>
<a href="{{route('admin.dashboard')}}">Retournez à la page d'acceuil</a> <h1>ou alors</h1>
<a href="{{route('admin.login')}}">reconnectez vous</a>

@endsection
