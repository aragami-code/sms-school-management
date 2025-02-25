@extends('backend.auth.auth_master')



@section('auth_title')

Login | Admin Panel

@endsection



@section('auth-content')



<div class="login-area login-bg">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf


                <div class="login-form-head">
                    <h4>Connexion Administrateur</h4>
                    <p>salut Bienvenue sur votre espace d'authentification veuillez entrer vos information s'il vous plait</p>
                </div>
                <div class="login-form-body">

                    @include('backend.layouts.partials.messages')
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Addresse Mail ou Nom d'Utilisateur</label>
                        <input id="email" type="text"  id="exampleInputEmail1" name="email">

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
                    <div class="row mb-4 rmber-area">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing" name="remember">
                                <label class="custom-control-label" for="customControlAutosizing">se souvenir de moi</label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <a href="#">Mot de passe oublié?</a>
                        </div>
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
