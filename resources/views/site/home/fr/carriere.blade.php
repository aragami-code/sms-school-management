@extends('site.home.fr.master')
@section('name')




        <section id="page-title" class="page-title-parallax page-title-dark include-header"  class="page-title-parallax page-title-dark include-header" style="padding: 250px 0; background-image: url('/site/img/about/parallax1.jpg'); background-size: cover; background-position: center center;" data-bottom-top="background-position:0px 400px;" data-top-bottom="background-position:0px -500px;">

			<div class="container clearfix text-center">
				<h1 style="color: aliceblue;">Carrière</h1>
				<span>Etablissez un cv et suivez nous</span>
				<h1 class="nott mb-5 mx-auto" style="max-width: 1000px; letter-spacing: -2px !important;">
					<span class="text-rotater nocolor" data-separator="|" data-rotate="fadeIn" data-speed="200" data-backdelay="1500" data-typed="true" data-shuffle="true" data-loop="true">
						<span class="t-rotate text-uppercase" style="font-weight: 500; font-size: 25pt; color: aliceblue;" >Emplois|CDI|CDD|Intérim|Alternance</span>
					</span>

				</h1>
			</div>

		</section><!-- #page-title end -->

        <div class="card-body">
            <center><h2 class="header-title">Chercher une offre</h2></center>

                <form action="{{route('resultatRecherche')}}" method="GET" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-11 col-sm-12">
                    <label for="name">Nom de l' offre ou titre de l'offre</label>
                    <input type="text" class="form-control" id="titre_post_emploi" name="titre_post_emploi"  placeholder="Enter le titre de l'offre" required="on">

                </div>


                <div class="form-group col-md-1 col-sm-12">

             <center>   <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Chercher</button></center>

                </div>

            </div>


            </form>
        </div>
		<!-- Page Sub Menu
		============================================= -->
		<div id="page-menu" class="no-sticky">
			<div id="page-menu-wrap">
				<div class="container">
					<div class="page-menu-row">
						<nav class="page-menu-nav">
							<ul class="page-menu-container custom-filter" data-container="#portfolio" data-active-class="current">
								<li class="page-menu-item current"><a href="#" data-filter="*"><div>Type de Contrat</div></a>
									<ul class="sub-menu-container">
										

									</ul></li>
							</ul>
						</nav>

						<div id="page-menu-trigger"><i class="icon-reorder"></i></div>

					</div>
				</div>
			</div>
		</div><!-- #page-menu end -->
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">

				<!-- <div class="content-wrap"> -->
					<div class="container clearfix">
                    	<div class="row col-mb-50">
                            @foreach ($PostEmplois as $Jb )
                            <div class="col-md-12">
								<div class="fancy-title title-bottom-border">
									<h3> {!!$Jb->titre_post_emploi!!} H/F</h3>
								</div>
                                <?php 
                                $diff = Carbon\Carbon::setLocale('fr');
                                $diff = Carbon\Carbon::parse($Jb->created_at)->diffForHumans();
                                ?>
                                
                                <p>{!!$Jb->description_post_emploi!!}</p>
                                <p class="card-text"><i class="ti-pencil-alt"></i> {{$diff}}
                                
                             </p>

                             <a href="{{route('carriereinfo',Crypt::encrypt($Jb->id))}}"  class="button button-3d button-black m-0">Postuler maintenant</a>
                             

                      </div>

                             @endforeach
                             {{$PostEmplois->links()}}
							
                        </div>





					</div>
				<!-- </div> -->
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


    jQuery('select[name="id_region_post_emploi"]').on('change',function(){

        var RegionID = $(this).val();

        if(RegionID){

            $.ajax({

                type:"GET",
                url: 'findRegion/'+RegionID,
                dataType: "json",
                success:function(data){


                if (data) {

                    jQuery('select[name="id_ville_post_emploi"]').empty();
                    jQuery.each(data,function(key,value){
                    $('select[name="id_ville_post_emploi"]').append('<option value="'+key+'">'+value+'</option>');
                    });

                }else{
                     $('select[name="id_ville_post_emploi"]').empty();
                }


                }
            });

        }

        else{

            $('select[name="id_ville_post_emploi"]').empty();

        }





    });









</script>


@endsection

