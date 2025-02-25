@extends('backend.layouts.master')


@section('title')
Parametre du site | tableau de bords
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
                <h4 class="page-title pull-left">Parametre</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.parametres.index')}}">info du site</a></li>
                <li><span>Editer Mon profile</span></li>
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
                    <h4 class="header-title">Information du Site</h4>

                    @include('backend.layouts.partials.messages')

                <div class="form-row">
                    
                    <div class="form-row col-md-6 col-sm-6">


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name"><b> Nom du Site</b></label> : <h5>{{$parametre->nom_site}}</h5>

                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="text"><b> Devise</b></label> <h5> {{$parametre->devise_monetaire}}</h5>
                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <label for="copyright"><b>Copyright</b></label> <h5>{{$parametre->copyright}}</h5>
                        </div>

                    </div>
                    <br>
                    <div class="form-row col-md-6 col-sm-6">

                        <div class="form-group col-md-6 col-sm-6">
                            <label for="slug"><b>favicon logo</b></label>

                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label for="slug"></label>
                            <img src="{{asset("backend/images/parametres/$parametre->favicon_logo")}}" width="20%" >


                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label for="slug"><b>Logo du site</b></label>

                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label for="slug"></label>
                            <img src="{{asset("backend/images/parametres/$parametre->logo")}}" width="60%">

                        </div>


                    </div>
                    <div class="form-row col-md-12 col-sm-12">


                        <div class="form-group col-md-12 col-sm-12">
                            <label for="name"><b> Page Facebook</b></label> <h5> {{$parametre->facebook}}</h5>
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="text"><b> Page Tweeter</b></label> <h5> {{$parametre->tweeter}}</h5>
                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <label for="linkedin"><b>Page linkedin</b></label> <h5>  {{$parametre->linkedin}}</h5>
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="linkedin"><b>Annee</b></label> <h5>  {{$parametre->annee}}</h5>
                        </div>

                    </div>

                 </div>


                <a href="{{route('admin.parametres.edit',$parametre->id)}}">  <button class="btn btn-primary mt-4 pr-4 pl-4">Actualiser</button></a>

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
