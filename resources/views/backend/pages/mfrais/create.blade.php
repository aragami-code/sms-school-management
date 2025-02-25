@extends('backend.layouts.master')


@section('title')
Ajouter une section de classes | tableau de bords
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
                <h4 class="page-title pull-left">Section de Classe</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.classes.index')}}">Toutes les sections de classes</a></li>
                    <li><span>Ajouter une  section de classe</span></li>
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

                      @if (isset($editSectionClasses))
                       <h4 class="header-title">Modifier une Section de Classe</h4>


                        @else

                        <h4 class="header-title">Ajouter une Section de Classe</h4>



                    @endif

                    @include('backend.layouts.partials.messages')
                <form action="{{(@$editSectionClasses)?route('adminsection.updat', $editClasses->id):route('admin.section.store')}}" method="POST">
                    @csrf

                    <div class="form-row">

                        <input type="hidden" name="id" id="id">

                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Nom de la classe</label>
                                <select name="id_classe" id="id_classe" class="form-control" required='on'>
                                    @foreach ($classe as $classes)

                                        <option value ="{{$classes->id}}">{{$classes->name}}</option>

                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="slug">Nom section <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nom_section" name="nom_section"  placeholder="nom section ex: 6eme A" required="on" value="">
                                <div class="alert-message" ></div>

                            </div>

                        </div>
                    {{--<div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="password">Mot de passe Utilisateur</label>
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Enter le nom de passe" required="on">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="password_confirmation">Confirmer le Mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  placeholder="confirmer le  mot de passe" required="on">
                        </div>

                    </div>


                        <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Privilege Utilisateur</label>
                            <select name="roles[]" id="roles" class="form-control select2" multiple>
                                @foreach ($roles as $role)

                            <option value ="{{$role->name}}">{{$role->name}}</option>

                                @endforeach
                            </select>

                        </div>


                    </div>--}}


                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{(@$editSectionClasses)?'Mettre à jour':'enregistrer'}}</button>
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
