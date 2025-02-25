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
                    @include('etudiants.layouts.partials.messages')
                    <div class="card-body" style="padding: 40px;">
                        <form id="login-form" name="login-form" class="mb-0" method="POST" action="{{ route('etudiants.login.submit') }}">
                          
                            @csrf
                              <h3 class="text-center">CONNEXION</h3>

                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="login-form-username">LOGIN:</label>
                                    
                                    <input type="text" id="login-form-username" name="email"  class="form-control not-dark" />
                                </div>

                                <div class="col-12 form-group">
                                    <label for="login-form-password">PASSWORD:</label>
                                    <input type="password" id="login-form-password" name="password"  class="form-control not-dark" />
                                </div>
                                <div class="col-12 form-group">
                                    <button class="button button-3d button-primary m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>
                                    <a href="{{ route('etudiants.password.request')}}" class="float-right">Mot de passe oublié?</a>
                                </div>
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

