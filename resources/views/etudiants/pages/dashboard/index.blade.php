@extends('etudiants.layouts.master')


@section('title')

TABLEAU DE BORD
@endsection


@section('admin-content')


<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Acceuil</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{route('etudiants.dashboard')}}">Acceuil</a></li>
                    <li><span>Statistiques</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">

            @include('etudiants.layouts.partials.logout')


        </div>
    </div>



</div>

@include('etudiants.layouts.partials.messages')



<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">

            </div>
        </div>


        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Liste des  offres</h4>
                    <div class="clearfix"></div>
                    <br>

                             <div class="row">
                             {{--   @foreach ($Emplois_Postuler as $Emploi_Postuler)


                              <div class="col-lg-12 mt-5"{{$loop->index+1}}>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="media mb-5">
                                            <img class="card-img-top img-fluid" src="{{asset('backend/images/job/1603139919.jpeg')}}" alt="image" style="border-radius: 50%; width: 50px; height: 50px;">
                                            <div class="media-body">
                                                <h4 class="mb-3">Titre de l'offre:{{$Emploi_Postuler->titre_post_emploi}}
                                                    <p><i class="ti-new-window"></i>{{$Emploi_Postuler->type_empl}}
                                                    </p>
                                                    <p class="card-text"><i class="ti-pencil-alt"></i>{{$Emploi_Postuler->contrat_empl}}
                                                    </p>

                                                    <?php
                                //$diff = Carbon\Carbon::setLocale('fr');
                                //$diff = Carbon\Carbon::parse($Emploi_Postuler->created_at)->diffForHumans();
                                ?>

                                                       <p class="card-text"><i class="ti-pencil-alt"></i> {{$diff}}
                                                    </p>


                                                 <a href="{{route('etudiants.postemplois.edit',Crypt::encrypt($Emploi_Postuler->id))}}" class="btn btn-primary"><i class="ti-eye"></i> Consulter l'offre</a>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                                @endforeach
                           <center> {{$Emplois_Postuler->links()}}</center> </div>
  --}}




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
<script type="text/javascript">




</script>


@endsection
