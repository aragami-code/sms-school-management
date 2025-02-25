@extends('chercheur.auth.auth_master')



@section('auth_title')

mot de passe oublié | Utilisateur

@endsection



@section('auth-content')



<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">

            <form action="{{route('chercheur.password.update',$C->id)}}" method="POST" enctype="multipart/form-data">
                         @method('PUT')
                         @csrf


                <div class="login-form-head">
                    <h4> Reinitialiser votre mot de passe</h4>
                   

                </div>
                <div class="login-form-body">

                    @include('chercheur.layouts.partials.messages')
                    
                    <p><b>Monsieur :</b> {{$C->prenom}} {{$C->nom_famille}}</p>
                      <p><b>Votre adresse Email:</b> {{$C->email}}</p>
                       <input  type="hidden"  name="email" value="{{$C->email}}">

                      

                      <br>
                       
                    <div class="form-gp">
                     <label for="exampleInputEmail1">Nouveau mot de passe</label>
                        <input id="password" type="password"  id="exampleInputEmail1" name="password">

                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="form-gp">
                        <label for="exampleInputEmail1">Confirmer mot de passe</label>
                        <input id="password_confirmation" type="password"  id="exampleInputEmail1" name="password_confirmation">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <i class="ti-email"></i>
                        <div class="text-danger"></div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">initialiser <i class="ti-arrow-right"></i></button>
                        <div class="login-other row mt-4">


                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>



@endsection
