@extends('backend.layouts.master')


@section('title')
creer un Administrateur | tableau de bords
@endsection





@section('styles')


<link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">

@endsection



@section('admin-content')

  <!-- page title area start -->
  <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Administrateurs</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.parametres.index')}}">Tous les Administrateurs</a></li>
                    <li><span>Creer un Administrateur</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">

            @include('backend.layouts.partials.logout')


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
                    <h4 class="header-title">Parametres du site</h4>

                    @include('backend.layouts.partials.messages')
                    <form action="{{route('admin.parametres.update',$parametre->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-row col-md-6 col-sm-6">


                            <div class="form-group col-md-12 col-sm-12">
                                <label for="name"><b> Nom du Site</b></label>
                                <input type="text" class="form-control" id="nom_site" name="nom_site" value="{{$parametre->nom_site}}">
                            </div>
                            <div class="form-group col-md-3 col-sm-3">
                                <label for="text"><b> Devise</b></label>
                                <input type="Text" class="form-control" id="devise_monetaire" name="devise_monetaire" value="{{$parametre->devise_monetaire}}">
                            </div>

                            <div class="form-group col-md-8 col-sm-8">
                                <label for="copyright"><b>Copyright</b></label>
                                <input type="text" class="form-control" id="copyright" name="copyright" value="{{$parametre->copyright}}">
                            </div>

                        </div>
                        <br>
                        <div class="form-row col-md-6 col-sm-6">

                            <div class="form-group col-md-6 col-sm-6">
                                <label for="slug"><b>favicon logo</b></label>
                                <input type="file" class="form-control" id="favicon_logo" name="favicon_logo">

                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="slug"></label>
                                <img src="{{asset("backend/images/parametres/$parametre->favicon_logo")}}" width="20%" >
                                <input type="hidden" class="form-control" id="favicon_logo2" name="favicon_logo2" value="{{$parametre->favicon_logo}}">

                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="slug"><b>Logo du site</b></label>
                                <input type="file" class="form-control" id="logo" name="logo">

                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="slug"></label>
                                <img src="{{asset("backend/images/parametres/$parametre->logo")}}" width="30%">
                                <input type="hidden" class="form-control" id="logo2" name="logo2" value="{{$parametre->logo}}">

                            </div>


                        </div>
                        <div class="form-row col-md-12 col-sm-12">


                            <div class="form-group col-md-4 col-sm-4">
                                <label for="name"><b> Page Facebook</b></label>
                                <input type="text" class="form-control" id="facebook" name="facebook" value="{{$parametre->facebook}}">
                            </div>
                            <div class="form-group col-md-4 col-sm-4">
                                <label for="text"><b> Page Tweeter</b></label>
                                <input type="Text" class="form-control" id="tweeter" name="tweeter" value="{{$parametre->tweeter}}">
                            </div>

                            <div class="form-group col-md-4 col-sm-4">
                                <label for="linkedin"><b>Page linkedin</b></label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{$parametre->linkedin}}">
                            </div>
                             <div class="form-group col-md-4 col-sm-4">
                                <label for="linkedin"><b>Annee</b></label>
                                <input type="text" class="form-control" id="annee" name="annee" value="{{$parametre->annee}}">
                            </div>

                        </div>
                        {{--
                        <div class="form-row">


                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Privilege Utilisateur</label>
                                <select name="roles[]" id="roles" class="form-control select2" multiple>
                                    @foreach ($roles as $role)

                                <option value ="{{$role->name}}" {{$admin->hasRole($role->name) ? 'selected' : ''}}>{{$role->name}}</option>

                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="username">Nom d' Utilisateur(Pseudo)</label>
                                <input type="text" class="form-control" id="username" name="username"  placeholder="Enter votre Pseudonyme" required="on">

                            </div>


                        </div>--}}


                           <a href=""></a> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->

        <!-- Dark table end -->
    </div>
</div>



@endsection


@section('scripts')

   {{--@include('backend.pages.roles.partials.script')
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>--}}
   <script src="{{asset('backend/js/select2.min.js')}}"></script>

   <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
