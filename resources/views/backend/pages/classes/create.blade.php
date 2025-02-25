@extends('backend.layouts.master')


@section('title')
Ajouter une classe | tableau de bords
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
                <h4 class="page-title pull-left">Classes</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('admin.dashboard')}}">Tableau de Bord</a></li>
                    <li><a href="{{route('admin.classes.index')}}">Toutes les Classes</a></li>
                    <li><span>Ajouter une  Classe</span></li>
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

                      @if (isset($editClasses))
                       <h4 class="header-title">Modifier une Classe</h4>


                        @else

                        <h4 class="header-title">Ajouter une Classe</h4>



                    @endif

                    @include('backend.layouts.partials.messages')
                <form action="{{(@$editClasses)?route('admin.classes.updat', $editClasses->id):route('admin.classes.store')}}" method="POST">
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Nom de la classes</label>
                            <input type="text" class="form-control" id="name" name="name_classes"  placeholder="Enter le nom d'une classe " required="on" value="{{@$editClasses->name_classes}}">
                            <font style="color: red">{{($errors->has('name_classes'))?($errors->first('name_classes')):''}}</font>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">slug (mot Clé)</label>
                            <input type="text" class="form-control" id="slug" name="slug_classes"  placeholder="le mot cle" required="on">

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


                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{(@$editClasses)?'Mettre à jour':'enregistrer'}}</button>
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
