@extends('chercheur.auth.auth_master')



@section('auth_title')

Login | User

@endsection



@section('auth-content')



<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('chercheur.register.create') }}">
                @csrf


                <div class="login-form-head">
                    <h4> CREER UN COMPTE</h4>
                    <p>salut Bienvenue sur votre espace d'authentification veuillez entrer vos information s'il vous plait</p>
                </div>
                <div class="login-form-body">

                    @include('chercheur.layouts.partials.messages')
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Nom</label>
                        <input id="nom_famille" type="text"  id="exampleInputEmail1" name="nom_famille">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <i class="ti-user"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Prenom</label>
                        <input id="prenom" type="text"  id="exampleInputEmail1" name="prenom">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <i class="ti-user"></i>
                        <div class="text-danger"></div>
                    </div>

                    <div class="form-gp">
                        <label for="exampleInputEmail1">Nom d'Utilisateur</label>
                        <input id="username" type="text"  id="exampleInputEmail1" name="username">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <i class="ti-user"></i>
                        <div class="text-danger"></div>
                    </div>

                    <div class="form-gp">
                        <label for="exampleInputEmail1">Addresse Mail</label>
                        <input id="email" type="mail"  id="exampleInputEmail1" name="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>

                    <div class="form-gp">
                        <label for="exampleInputPassword1">mot de passe</label>
                        <input type="password" id="exampleInputPassword1" name="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>

                    <div class="form-gp">
                        <label for="exampleInputPassword1">confirmer mot de passe</label>
                        <input type="password" id="exampleInputPassword1" name="password_confirmation">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <i class="ti-lock"></i>
                        <div class="text-danger"></div>
                    </div>

                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">connecter <i class="ti-arrow-right"></i></button>
                        <div class="login-other row mt-4">


                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



@endsection
