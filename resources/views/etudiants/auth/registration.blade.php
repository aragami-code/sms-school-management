@extends('site.home.fr.master2')
@section('name')





<div class="content-wrap py-0">

    <div class="section p-0 m-0 h-100 position-absolute" style="background: url('site/img/boss2.jpg') center center no-repeat; background-size: cover;"></div>

    <div class="section bg-transparent min-vh-100 p-0 m-0">
        <div class="vertical-middle">
            <div class="container-fluid py-5 mx-auto">
                <div class="center">
                    <a href="index.html"><img src="{{asset('site/img/ico.png')}}" alt="Logo"></a>
                </div>

                <div class="card mx-auto rounded-0 border-0" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
                    @include('chercheur.layouts.partials.messages')
                    <div class="card-body" style="padding: 40px;">
                        <form method="POST" action="{{ route('chercheur.register.create') }}" enctype="multipart/form-data">
                            @csrf  <h3 class="text-center">Enregistrement</h3>

                            <div class="row">
                                <div class="col-12 form-group">
                                    <?php
                                        $tof = "1604669854.jpeg"
                                        ?>
                                    <label for="">Nom</label>
                                    <input id="nom_famille" type="text"  name="nom_famille" class="form-control">
                                    <input id="photo" type="hidden"  name="photo" value="{{$tof}}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="text-danger"></div>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="">Prenom</label>
                                    <input id="prenom" type="text"  name="prenom" class="form-control">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="text-danger"></div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="">Date de naissance</label>
                                    <br><br>
                                    <input  type="date"  name="date_naiss" class="form-control">

                                    <div class="text-danger"></div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="">Nom d'Utilisateur</label>
                                    <input id="username" type="text"  id="exampleInputEmail1" name="username" class="form-control">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="text-danger"></div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="">E-Mail</label>
                                    <input id="email" type="mail"   name="email" class="form-control">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="text-danger"></div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="">mot de passe</label>
                                    <input type="password" id="" name="password" class="form-control">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    <div class="text-danger"></div>
                                </div>

                                <div class="col-12 form-group">
                                    <label for="">confirmer mot de passe</label>
                                    <input type="password"  name="password_confirmation" class="form-control">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    <div class="text-danger"></div>
                                </div>



                                <div class="col-12 form-group">
                                    <label for="">Télécharger votre Cv</label>
                                    <br>
                                    <input type="file" name="resume_cv" class="form-control">
                                    <i class="ti-file"></i>
                                    <div class="text-danger"></div>
                                </div>
                                <button class="button button-3d button-primary m-0" id="login-form-submit" name="login-form-submit" value="login">Creer un Compte</button>



















                            </div>
                        </form>

                        <div class="line line-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

