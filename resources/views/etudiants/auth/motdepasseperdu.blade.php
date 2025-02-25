@extends('chercheur.auth.auth_master')



@section('auth_title')

mot de passe oublié | Utilisateur

@endsection



@section('auth-content')



<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="GET" action="{{ route('chercheur.password.reinitialiser') }}">
                @csrf


                <div class="login-form-head">
                    <h4> Mot de passe oublié</h4>
                    <p>Entrer votre adresse Email</p>
                </div>
                <div class="login-form-body">

                    @include('chercheur.layouts.partials.messages')
                    

                    <div class="form-gp">
                        <label for="exampleInputEmail1">Adresse Mail</label>
                        <input id="email" type="mail"  id="exampleInputEmail1" name="email">
                        

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">soumettre <i class="ti-arrow-right"></i></button>
                        <div class="login-other row mt-4">


                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



@endsection
