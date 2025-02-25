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
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Information Generale</a>
                            <a href="{{route('chercheur.niveau.index')}}" class="nav-link"  role="tab"  aria-selected="false">Formations / Diplomes</a>
                            <a href="{{route('chercheur.sommaire.index')}}"class="nav-link"  role="tab" aria-selected="false">Competences</a>
                            
                             <a href="{{route('chercheur.langue.index')}}" class="nav-link"   role="tab" aria-selected="true">Langues parlées</a>  
                            <a href="{{route('chercheur.experience.index')}}"class="nav-link"  role="tab" aria-selected="false">Experiences</a>
                            <a href="{{route('chercheur.profile.edite',Crypt::encrypt(Auth::guard('chercheur')->user()->id))}}" class="nav-link"  role="tab"  aria-selected="false">Profil</a>
                            
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">


                                    <form action="{{route('chercheur.profile.upinfo',Auth::guard('chercheur')->user()->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-row">
                                            <input type="hidden" class="form-control" id="name" name="username"  placeholder="Enter le nom d'un utilisateur" readonly value="{{Auth::guard('chercheur')->user()->username}}">
                                            <input type="hidden" class="form-control" id="email" name="email"  placeholder="Enter un email" readonly value="{{Auth::guard('chercheur')->user()->email}}">
                                            <input type="hidden" class="form-control" id="password" name="password"  placeholder="Enter le nom de passe" readonly value="{{Auth::guard('chercheur')->user()->password}}">

                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="name"><b>Nom de Famille</b></label>
                                                <input type="text" class="form-control" id="nom_famille" name="nom_famille"  placeholder="votre Nom" required="on"value="{{Auth::guard('chercheur')->user()->nom_famille}}">
                                            </div>

                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="slug"><b>Prenom</b></label>
                                                <input type="text" class="form-control" id="prenom" name="prenom"  placeholder="prenom" required="on" value="{{Auth::guard('chercheur')->user()->prenom}}">
                                            </div>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-2 col-sm-12">
                                                <label for="date_naiss"><b>Date de naissance</b></label>
                                                <input type="date" class="form-control" id="date_naiss" name="date_naiss"  placeholder="date de naissance" required="on" value="{{Auth::guard('chercheur')->user()->date_naiss}}">
                                            </div>


                                            <div class="form-group col-md-3 col-sm-12">
                                                <label for="telephone"><b>Numero de telephone</b></label>
                                                <input type="number" class="form-control" id="telephone" name="telephone"  placeholder="veuillez entrer votre numero de telephone suivi de l'indicatif de votre pays ex: +33" required="on" value="{{Auth::guard('chercheur')->user()->telephone}}">
                                            </div>

                                            <div class="form-group col-md-3 col-sm-12">
                                                    <label for="name"><b>Diplôme</b></label>
                                                    <select name="niveau_ecole" id="niveau_ecole" class="form-control" required='on' value="{{Auth::guard('chercheur')->user()->niveau_ecole}}">
                                                        @foreach ($diplome as $dip)
                                                            <option value="{{$dip->id}}">{{$dip->formation_empl}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group col-md-3 col-sm-12">
                                                <label for="name"><b>Profession</b></label>
                                                <input type="text" class="form-control" id="metier" name="metier"  placeholder="veuillez entrer votre profession" required="on" value="{{Auth::guard('chercheur')->user()->metier}}">
                                            </div>
                                            <div class="form-group col-md-3 col-sm-12">
                                                <label for="name"><b>Emploi sollicité</b></label>
                                               <select name="type_emploi_sollicite" id="type_emploi_sollicite" class="form-control" required='on' value="{{Auth::guard('chercheur')->user()->niveau_ecole}}">
                                                        @foreach ($typem as $dip)
                                                            <option value="{{$dip->id}}">{{$dip->type_empl}}</option>
                                                        @endforeach
                                                    </select>  </div>
                                            <div class="form-group col-md-3 col-sm-12">
                                                <label for="name"><b>Contrat Recherché</b></label>
                                                    <select name="type_contrat_sollicite" id="type_contrat_sollicite" class="form-control" required='on' value="{{Auth::guard('chercheur')->user()->niveau_ecole}}">
                                                        @foreach ($typecontr as $dip)
                                                            <option value="{{$dip->id}}">{{$dip->contrat_empl}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>

                                        <div class="form-row">







                                            <div class="form-group col-md-2 col-sm-6">
                                                <label for="name"><b>Experiences</b></label>
                                                <select name="experience" id="experience" class="form-control" value="{{Auth::guard('chercheur')->user()->experience}}">
                                                    <option value ="1 an">1 an</option>
                                                    <option value ="2 ans">2 ans</option>
                                                    <option value ="3 ans">3 ans</option>
                                                    <option value ="4 ans">4 ans</option>
                                                    <option value ="5 ans">5 ans</option>
                                                    <option value ="6 ans">6 ans</option>
                                                    <option value ="7 ans">7 ans</option>
                                                    <option value ="8 ans">8 ans</option>
                                                    <option value ="9 ans">9 ans</option>
                                                    <option value ="plus de 10 ans">10 ans</option>
                                                </select>
                                            </div>


                                            <div class="form-group col-md-3 col-sm-6">
                                                <label for="name">Rayon sollicité</label>
                                                <select name="distance_minimum" id="distance_minimum" class="form-control">
                                                        <option value ="Peu importe">Peu importe</option>
                                                        <option value ="0 km">0 km</option>
                                                        <option value ="5 km">5 km</option>
                                                        <option value ="10 km">10 km</option>
                                                        <option value ="15 km">15 km</option>
                                                        <option value ="20 km">20 km</option>
                                                        <option value ="25 km">25 km</option>
                                                        <option value ="30 km">30 km</option>
                                                        <option value ="35 km">35 km</option>
                                                        <option value ="40 km">40 km</option>
                                                        <option value ="45 km">45 km</option>
                                                        <option value ="50 km">50 km</option>
                                                        <option value ="+ de 50 km">+ de 50 km</option>
                                                        
                                                </select>

                                            </div>




                                            <div class="form-group col-md-2 col-sm-12">
                                                <label for="name">Votre région</label>
                                                <select name="region" id="region" class="form-control" required='on'>
                                                    
                                                    @foreach ($Region as $region)

                                                <option value ="{{$region->id}}">{{$region->nom_region}}</option>

                                                    @endforeach
                                                </select>

                                            </div>

                                            <div class="form-group col-md-2 col-sm-12">
                                                <label for="name">Votre département</label>
                                                <select name="ville" id="ville" class="form-control" required='on'>

                                                </select>

                                            </div>
                                        
                                            


                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="slug"><b>A propos de vous</b></label>

                                                <textarea class="form-control" id=descrpition name="description" class="form-group col-md-12 col-sm-12" style="width: 100%; height: 200px; font-size: 14px;  border: 1px solid #dddddd;">
                                                    {{Auth::guard('chercheur')->user()->description}}
                                                </textarea>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="slug"> <label for="name"><b>votre CV</b></label>
                                            </label>
                                            <a href="{{asset("user/images/Cv")}}/{{Auth::guard('chercheur')->user()->resume_cv}}" target="_blank">voir Mon CV</a>


                                            </div>
                                            <center> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Mettre à jour mes informations</button></center>
                                    </form> 


                                    <form action="{{route('chercheur.profile.upinfocv',Auth::guard('chercheur')->user()->id)}}" method="POST" enctype="multipart/form-data">
                            
                                         @csrf
                                            <div class="form-row">
                                           
                                            
                                                <div class="form-group col-md-12 col-sm-12">
                                                        <label for="slug"> <label for="name"><b>Télécharger un nouveau CV</b></label>
                                                        </label>
                                                        <input type="hidden" class="form-control" id="resume_cv2" name="resume_cv2" value="{{Auth::guard('chercheur')->user()->resume_cv}}">
                                                        <input type="file" class="form-control" id="resume_cv" name="resume_cv" value="{{Auth::guard('chercheur')->user()->resume_cv}}">

                                                </div>
                                                    <center> <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Mettre à jour mon cv</button></center>
    
                                           
                                           
                                           </div>
                                           
                                    </form>
                                           
                                        

                                    
                                
                                </div>
                                     

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


