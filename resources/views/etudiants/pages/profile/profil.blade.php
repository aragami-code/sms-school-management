@extends('chercheur.layouts.master')


@section('title')
Actualiser mes informations | tableau de bords
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
                <h4 class="page-title pull-left">Mon Profile</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('chercheur.dashboard')}}">Tableau de Bord</a></li>
                    <li><span>mettre à jour mes informations</span></li>
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
                    <h4 class="header-title">Actualiser mes informations</h4>

                    @include('chercheur.layouts.partials.messages')
                    <div class="d-md-flex">
                        <div class="nav flex-column nav-pills mr-4 mb-3 mb-sm-0" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a href="{{route('chercheur.profile.edit',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" class="nav-link"  role="tab"  aria-selected="false">Information Generale</a>
                            <a href="{{route('chercheur.niveau.index')}}" class="nav-link"  role="tab"  aria-selected="false">Formations / Diplomes</a>
                            <a href="{{route('chercheur.sommaire.index')}}"class="nav-link"  role="tab" aria-selected="false">Competences</a>
                             <a href="{{route('chercheur.langue.index')}}" class="nav-link"   role="tab" aria-selected="true">Langues parlées</a> 
                           
                            <a href="{{route('chercheur.experience.index')}}"class="nav-link"  role="tab" aria-selected="false">Experiences</a>
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Profil</a>

                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">



                                <form action="{{route('chercheur.profile.update',Auth::guard('chercheur')->user()->id)}}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf

                                        <div class="form-row">
                                            @php

                                           // $hasP = Auth::guard('chercheur')->user()->password;

                                             @endphp
                                            <div class="form-group col-md-8 col-sm-12">
                                            <label for="name">Nom de l'utilisateur</label>
                                            <input type="text" class="form-control" id="name" name="username"  placeholder="Enter le nom d'un utilisateur" required="on" value="{{$user->username}}">
                                             <label for="email">Email</label>
                                             <input type="email" class="form-control" id="email" name="email"  placeholder="Enter un email" required="on" value="{{$user->email}}">
                                            <label for="password">Mot de passe Utilisateur</label>
                                            <input type="password" class="form-control" id="password" name="password"  placeholder="Enter le nom de passe">
                                            <label for="password_confirmation">Confirmer le Mot de passe</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  placeholder="confirmer le  mot de passe">

                                            </div>
                                            <div class="form-group col-md-4 col-sm-12">
                                                <br><br><br>
                                                <label for="slug"></label>
                                               <center> <img src="{{asset("user/images/Chercheur/$user->photo")}}" width="30%">
                                               </center> <br>
                                                <input type="hidden" class="form-control" id="photo2" name="photo2" value="{{$user->photo}}">
                                                <label for="slug"><b>Photo de Profil</b></label>
                                                <input type="file" class="form-control" id="photo" name="photo">

                                            </div>




                                        </div>
                                        <center> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Mettre à jour</button></center>
                                    </form>









                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat blanditiis eaque ab qui accusamus laudantium perspiciatis sint quibusdam at eius consequatur quos possimus aspernatur debitis deleniti sed odit provident repudiandae suscipit officiis, tempora voluptas, excepturi perferendis. Quasi delectus tempora temporibus ipsa soluta mollitia, doloremque corrupti labore, quae voluptatem obcaecati consequuntur ad ipsum fugit impedit cum. Facere, ea? Eveniet quisquam ratione voluptate rerum tempora, consectetur assumenda. Porro temporibus suscipit corporis nulla?</p>
                                <div class="row">






                            </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugiat blanditiis eaque ab qui accusamus laudantium perspiciatis sint quibusdam at eius consequatur quos possimus aspernatur debitis deleniti sed odit provident repudiandae suscipit officiis, tempora voluptas, excepturi perferendis. Quasi delectus tempora temporibus ipsa soluta mollitia, doloremque corrupti labore, quae voluptatem obcaecati consequuntur ad ipsum fugit impedit cum. Facere, ea? Eveniet quisquam ratione voluptate rerum tempora, consectetur assumenda. Porro temporibus suscipit corporis nulla?</p>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                             </div>
                        </div>
                    </div>
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
   <script src="{{asset('user/js/select2.min.js')}}"></script>

   <script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>


<script type="text/javascript">


    jQuery('select[name="region"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: "{{ url('findRegion')}}"+'/'+RegionID,
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="ville"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="ville"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="ville"]').empty();
                }


                }
            });

        }

        else{

            $('select[name="ville"]').empty();

        }





    });









</script>





@endsection


