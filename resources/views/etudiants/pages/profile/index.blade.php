@extends('chercheur.layouts.master')


@section('title')
Profile | tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('user/css/select2.min.css')}}">

@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Utilisateurs</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('chercheur.dashboard')}}">Tableau de Bord</a></li>
                   <li><span>Information Generale</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">

            @include('chercheur.layouts.partials.logout')


        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Information du Profil</h4>

                    @include('chercheur.layouts.partials.messages')

                <div class="form-row">

                    <div class="form-row col-md-4 col-sm-4">

                        <h4>Information Generale</h4>
                        <br>
                        <div>
                        <img src="{{asset("user/images/Chercheur")}}/{{Auth::guard('chercheur')->user()->photo}}" width="30%">


                        </div>


                        <br>


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name"><b> Nom de l'utilisateur:</b></label>{{Auth::guard('chercheur')->user()->name}}
                            <br>
                            <label for="email"><b> Email:</b></label> {{Auth::guard('chercheur')->user()->email}}
                            <br>
                            <label for="name"><b>Nom de Famille:</b></label>{{Auth::guard('chercheur')->user()->nom_famille}}
                            <br>
                            <label for="slug"><b>Prenom:</b></label>{{Auth::guard('chercheur')->user()->prenom}}
                            <br>
                            <label for="date_naiss"><b>Date de naissance:</b></label> {{Auth::guard('chercheur')->user()->date_naiss}}
                            <br>
                            <label for="telephone"><b>Mobile :</b></label>{{Auth::guard('chercheur')->user()->telephone}}
                            <br>
                            <label for="name"><b>Diplome :</b></label>{{Auth::guard('chercheur')->user()->niveau_ecole}}
                            <br>
                             <label for="name"><b>Profession:</b></label> {{Auth::guard('chercheur')->user()->metier}}
                            <br>

                            <label for="name"><b>Années d'experience:</b></label>{{Auth::guard('chercheur')->user()->experience}}
                            <br>

                             <label for="name"><b>Region d'origine :</b></label> {{Auth::guard('chercheur')->user()->region}}
                            <br>
                            <label for="name"><b>Département :</b></label> {{Auth::guard('chercheur')->user()->ville}}
                            <br>

                        </div>





                    </div>
                    <div class="form-row col-md-4 col-sm-4">
                        <h4>Formations/Ecoles</h4>


                    </div>
                    <div class="form-row col-md-4 col-sm-4">
                        <h4>Competence(s)</h4>


                    </div>

                    <div class="form-row col-md-4 col-sm-4">
                        <h4>Langue(s)</h4>


                    </div>

                     <div class="form-row col-md-4 col-sm-4">
                        <h4>Experience(s) Professionnel(les)</h4>


                    </div>


                </div>

                   <a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}">  <button class="btn btn-primary mt-4 pr-4 pl-4">mettre a jour mes informations</button></a>

                </div>
            </div>
        </div>
        <!-- data table end  -->

        <!-- Dark table end -->
    </div>
</div>



@endsection


@section('scripts')

   {{--@include('backend.pages.roles.partials.script')
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>--}}
   <script src="{{asset('user/js/select2.min.js')}}"></script>

   <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
