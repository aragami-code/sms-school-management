@extends('site.home.fr.master2')
@section('name')


<section id="content">
    <div class="content-wrap">


<div class="card-body">
    
        </div>
        <!-- <div class="content-wrap"> -->
            <div class="container clearfix">
                <div class="row col-mb-50">
                    
                    <div class="col-md-12">
                        <div class="fancy-title title-bottom-border">
                            <h3> {!!$PostEmplois->titre_post_emploi!!} H/F</h3>
                        </div>

                        <p>{!!$PostEmplois->description_post_emploi!!}</p>

                        <div class="accordion accordion-bg">

                            <div class="accordion-header">
                               
                                <div class="accordion-title">
                                    Profil recherché
                                </div>
                            </div>
                            
                                {!!$PostEmplois->profil_post_emploi!!}
                            

                            <div class="accordion-header">
                                
                                <div class="accordion-title">
                                    Missions
                                </div>
                            </div>
                              
                                
                                {!!$PostEmplois->tache_post_emploi!!}
                            

                                <div class="accordion-header">
                                
                                    <div class="accordion-title">
                                        Salaire Brut
                                    </div>
                                </div>
                                
                              <p>Salaire annuel compris entre {{$PostEmplois->salaire_min_post_emploi}} € et {{$PostEmplois->salaire_max_post_emploi }}€ par an</p> 
                            <div class="accordion-header">
                                
                                <div class="accordion-title">
                                    Localisation
                                </div>
                            </div>
                            <?php 
                            
                            ?>
                               <p>{{$PostEmplois->nom_region}}  {{$PostEmplois->nom_ville}}</p>
                            
                            <div class="accordion-header">
                                
                                <div class="accordion-title">
                                    
                                </div>
                            </div>
                            </div>
                               
                            </div>
                                
                             
                            </div>
                             
                        </div>

                      <center>  <a href="{{route('connexion')}}"  class="button button-3d m-0">Postuler Maintenant</a>
                     </center>
                    </div>

                </div>

                




            </div>
        <!-- </div> -->
        <div class="container clearfix">

            <div id="section-specs" class="heading-block text-center page-section">
                <h2>Offres similaires</h2>
            </div>

            <div id="side-navigation" class="row col-mb-50" data-plugin="tabs">
                <div class="row posts-md col-mb-30">
                    @foreach ($art as $articles )
                         <div class="entry col-md-3">
                        <div class="grid-inner">
                            <div class="entry-image">
                            <a href="#"><img src="{{asset('backend/images/blog/1603139919.jpeg')}}" alt="Image" style="border-radius: 50%; width: 50px; height: 50px;"></a>
                            </div>
                            <div class="entry-title title-sm nott">
                            <h4>{{$articles->titre_post_emploi}}</h4>
                            </div>
                            <div class="entry-meta">
                                <?php 
                                $diff = Carbon\Carbon::setLocale('fr');
                                $diff = Carbon\Carbon::parse($articles->created_at)->diffForHumans();
                                ?>
                                <ul>
                                <li><i class="icon-calendar3"></i> {{$diff}}</li>
                                    </ul>
                            </div>
                            <div class="entry-content">
                                <p><a href="{{route('carriereinfo',Crypt::encrypt($articles->id))}}"> Consulter </a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="entry col-md-5"><center></center></div>
                    <div class="entry col-md-2"><center>{{$art->links()}}</center></div>
                    <div class="entry col-md-5"><center></center></div>

                    
                    
               


                </div>
           
            </div>
           
        </div>
 

 <div class="container clearfix col-12">

    <div id="section-specs" class="heading-block text-center page-section">
         

 
    </div>

    
</div>

<div class="container clearfix">

    <div id="section-specs" class="heading-block text-center page-section">
        <h2>Conseils pratiques</h2>
        <span>Rédigez votre CV étapes par étapes</span>
    </div>

    <div id="side-navigation" class="row col-mb-50" data-plugin="tabs">
        <div class="col-md-5 col-lg-4">
            <ul class="sidenav">
                <li class="ui-tabs-active"><a href="#snav-content1">1- Choisissez votre modèle préféré<i class="icon-chevron-right"></i></a></li>
                <li><a href="#snav-content2">2- Utilisez nos exemples pré-rédigés<i class="icon-chevron-right"></i></a></li>
                <li><a href="#snav-content3">3- Entrez vos coordonées et Compétences<i class="icon-chevron-right"></i></a></li>
                <li><a href="#snav-content4">4- Formations et Expérience<i class="icon-chevron-right"></i></a></li>
                <li><a href="#snav-content5">5- Informations additionnelles<i class="icon-chevron-right"></i></a></li>
            </ul>
        </div>

        <div class="col-md-7 col-lg-8">
            <div id="snav-content1">
                <h3>Modèle de CV</h3>
                <img class="alignleft img-responsive" src="{{asset('site/img/landing/landing5.jpg')}}" alt="Image">

            </div>

            <div id="snav-content2">
                <img class="alignleft img-responsive" src="{{asset('site/img/landing/landing4.jpg')}}" alt="Image">
                <h3>CV professionnel</h3>
            </div>

            <div id="snav-content3">
                <img class="alignleft img-responsive" src="{{asset('site/img/landing/landing3.jpg')}}" alt="Image">
                <h3>Informations personnelles et Compétences
                </h3>
            </div>

            <div id="snav-content4">
                <img class="alignleft img-responsive" src="{{asset('site/img/landing/landing6.jpg')}}" alt="Image">
                <h3>Formation Professionelle</h3>
            </div>

            <div id="snav-content5">
                <h3>Métiers</h3>
            </div>
        </div>

    </div>
</div>

        <div class="section footer-stick">

            <div class="container clearfix">

                <div id="section-buy" class="heading-block text-center border-bottom-0 page-section">
                    <h2>Déposez votre CV maintenant</h2>
                    <span>Qui es-tu ? /Que peux-tu apporter à l’entreprise ?</span>
                </div>

                <div class="center">

                <a href="{{route('connexion')}}" data-scrollto="#section-pricing" class="button button-3d button-red button-xlarge mb-0"><i class="icon-file-text"></i>Téléchargez votre CV</a>

                </div>

            </div>

        </div>
    </div>
</section><!-- #content end -->


@endsection

