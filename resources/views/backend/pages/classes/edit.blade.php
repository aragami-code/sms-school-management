@extends('backend.layouts.master')


@section('title')
Modifier une Classe | tableau de bords
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
                    <li><a href="{{route('admin.classes.index')}}">Toutes les classes</a></li>
                <li><span>Modifier la Classe {{$Classes->name_classes}}</span></li>
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
                    <h4 class="header-title">Modifier la Classe</h4>

                    @include('backend.layouts.partials.messages')
                <form action="{{route('admin.classes.update', $Classes->id)}}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Nom de la classe</label>
                        <input type="text" class="form-control" id="name" name="name_classes"  placeholder="Enter le nom de le classe" required="on" value="{{$Classes->name_classes}}">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="slug">Slug (Mot Clé)</label>
                            <input type="text" class="form-control" id="slug" name="slug_classes"  placeholder="modifier le mot clé" required="on" value="{{$Classes->slug_classes}}">

                        </div>

                    </div>
                     {{--<div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="password">Mot de passe Utilisateur</label>
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Enter le nom de passe">

                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="password_confirmation">Confirmer le Mot de passe</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  placeholder="confirmer le  mot de passe">
                        </div>

                    </div>

                    <div class="form-row">


                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name">Privilege Utilisateur</label>
                            <select name="roles[]" id="roles" class="form-control select2" multiple>
                                @foreach ($roles as $role)

                            <option value ="{{$role->name}}" {{$user->hasRole($role->name) ? 'selected' : ''}}>{{$role->name}}</option>

                                @endforeach
                            </select>

                        </div>



                    </div>
 --}}

                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Modifier</button>
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
