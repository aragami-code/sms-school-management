@extends('site.home.fr.master')

@section('name')

<style>

    .revo-slider-emphasis-text {
        font-size: 64px;
        font-weight: 700;
        letter-spacing: -1px;
        font-family: 'Poppins', sans-serif;
        padding: 15px 20px;
        border-top: 2px solid #FFF;
        border-bottom: 2px solid #FFF;
    }

    .revo-slider-desc-text {
        font-size: 20px;
        font-family: 'Lato', sans-serif;
        width: 650px;
        text-align: center;
        line-height: 1.5;
    }

    .revo-slider-caps-text {
        font-size: 16px;
        font-weight: 400;
        letter-spacing: 3px;
        font-family: 'Poppins', sans-serif;
    }

    .tp-video-play-button { display: none !important; }

    .tp-caption { white-space: nowrap; }

</style>
@include('site.layouts.partials.slider')

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="container clearfix">

                    <div class="row align-items-center gutter-40 col-mb-50">
                        <div class="col-md-5">
                            <img data-animate="fadeInLeftBig" src="{{asset('site/img/services/macbook.png')}}" alt="Imac">
                        </div>

                        <div class="col-md-7">
                            <div class="heading-block text-center">
                                <h1>CYBER-CURE</h1>
                                <span>LE MEILLEUR SOIN C'EST LA PREVENTION</span>
                            </div>
                                <div class="text-center">
                            <p >Cyber-cure est un bureau de recrutement spécialisé dans les métiers de cybersécurité.  Il propose de prendre soin de tous les besoins liés à la sécurité informatique des entreprises dès l’étape naissante à l’étape finale en passant par l’entretien et la surveillance des activités.</p>

                            <a href="{{Route('about')}}" class="button button-border button-rounded button-large">voir plus</a>
                        </div>
                    </div>

                    <div class="divider divider divider-center" style="color: #d5b505;"><i class="icon-circle"></i></div>

                </div>


                <div class="heading-block center">
                    <h2>Profils <span>pour lesquels nous recrutons</span></h2>
                    <span>Cybersécurité vs Cybercriminalité</span>
                </div>
                <div class="row justify-content-center col-mb-50">

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-effect" data-animate="fadeIn" data-delay="400">
                            <div class="fbox-icon">
                                <a href="{{Route('about')}}#mpc"><i class="icon-file-alt i-alt"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Management des projets et cycle de vie (MPC)</h3>
                                <a href="{{Route('about')}}#mpc">
                                    Voirs plus ...

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-effect" data-animate="fadeIn" data-delay="400">
                            <div class="fbox-icon">

                                <a href="{{Route('about')}}#omco"><i class="icon-cogs i-alt"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Opération et maintien en condition opérationnelle (OMCO)</h3>
                                <a href="{{Route('about')}}#omco">Voirs plus ...

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-effect" data-animate="fadeIn" data-delay="400">
                            <div class="fbox-icon">
                                <a href="{{Route('about')}}#sgi"><i class="icon-shield i-alt"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Support et gestion des incidents</h3>
                                <a href="{{Route('about')}}#sgi">Voirs plus ...
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-effect" data-animate="fadeIn" data-delay="400">
                            <div class="fbox-icon">
                                <a href="{{Route('about')}}#cae"><i class="icon-bulb i-alt"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Conseil, audit, expertise (CAE)</h3>
                                <a href="{{Route('about')}}#cae">Voirs plus ...

                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="feature-box fbox-effect" data-animate="fadeIn" data-delay="400">
                            <div class="fbox-icon">
                                <a href="{{Route('about')}}#pog"><i class="icon-group i-alt"></i></a>
                            </div>
                            <div class="fbox-content">
                                <h3>Pilotage, organisation et gestion des risques (POG) </h3>
                                <a href="{{Route('about')}}sl#pog">Voirs plus ...


                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="clear"></div>

            </div>
            <div class="line"></div>

            <!-- <div class="section dark parallax " style="background-image: url('images/about/parallax2.jpg'); background-size: cover;" data-top-bottom="background-position:center">

                    <div class="row col-mb-50">
                        <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn">
                            <i class="i-plain i-xlarge mx-auto mb-0 icon-shield"></i>
                            <div class="counter counter-lined"><span data-from="100" data-to="146" data-refresh-interval="50" data-speed="2000"></span>K+</div>
                            <h5>S G I</h5>
                        </div>

                        <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="200">
                            <i class="i-plain i-xlarge mx-auto mb-0 icon-bulb"></i>
                            <div class="counter counter-lined"><span data-from="3000" data-to="360" data-refresh-interval="100" data-speed="2500"></span>+</div>
                            <h5>C A E</h5>
                        </div>

                        <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="400">
                            <i class="i-plain i-xlarge mx-auto mb-0 icon-file-text"></i>
                            <div class="counter counter-lined"><span data-from="10" data-to="386" data-refresh-interval="25" data-speed="3500"></span>*</div>
                            <h5>M P C</h5>
                        </div>

                        <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="600">
                            <i class="i-plain i-xlarge mx-auto mb-0 icon-cogs"></i>
                            <div class="counter counter-lined"><span data-from="60" data-to="200" data-refresh-interval="30" data-speed="2700"></span>+</div>
                            <h5>O M C O</h5>
                        </div>
                    </div>

            </div>

            <div class="divider divider divider-center" style="color: #d5b505;"><i class="icon-circle"></i></div>


            <div class="container mx-auto clearfix">


                <div class="heading-block center">
                    <h2>CYBER-CURE  : La solution à vos problèmes de cybersécurité</h2>
                    <span>« Pure player » du recrutement en cybersécurité, notre service consiste à aller dénicher les meilleurs profils pour les besoins de nos clients.</span>
                </div>


                <div style="position: relative;" data-height-xl="624" data-height-lg="518" data-height-md="397" data-height-sm="242" data-height-xs="154">

                    <img src="images/services/fbrowser9.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeIn" data-delay="1200" alt="iPad">
                </div>
            </div> -->


            <div class="row bottommargin-lg align-items-stretch text-center">

                <div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #d5b505;">
                    <div>
                        <h3 class="text-uppercase" style="font-weight: 600;">Nos valeurs</h3>
                        <p style="line-height: 1.8; font-size: 15pt;  text-align: center;">Fiabilité, Ethique et Service</p>
                        <!-- <a href="#" class="button button-border button-light button-rounded text-uppercase m-0">Lire plus</a> -->
                        <i class="icon-bulb bgicon"></i>
                    </div>
                </div>

                <div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #485868;">
                    <div>
                        <h3 class="text-uppercase" style="font-weight: 600;">Notre Mission</h3>
                        <p style="line-height: 1.8; font-size: 15pt; text-align: center;">Trouver pour vous, des profils de cybersécurité fiables pour pallier aux risques des cyberattaques.</p>
                        <!-- <a href="#" class="button button-border button-light button-rounded text-uppercase m-0">Lire plus</a> -->
                        <i class="icon-cog bgicon"></i>
                    </div>
                </div>

                <div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #0f417e;">
                    <div>
                        <h3 class="text-uppercase" style="font-weight: 600;  text-align: center;">Notre vision</h3>
                        <p style="line-height: 1.8; font-size: 15pt;">Protéger les PME et collectivités territoriales contre les cyberattaques, en anticipant sur les potentiels risques.</p>
                        <!-- <a href="#" class="button button-border button-light button-rounded text-uppercase m-0">Lire plus</a> -->
                        <i class="icon-eye bgicon"></i>
                    </div>
                </div>

                <div class="clear"></div>

            </div>


            <div class="container clearfix">

                <div class="heading-block topmargin-lg center">
                    <h2>Pourquoi faire confiance à Cyber-cure?</h2>
                </div>

                <div class="row col-mb-50 mb-4">
                    <div class="col-lg-4 col-md-6">

                        <div class="feature-box flex-md-row-reverse text-md-right" data-animate="fadeIn">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-line-paper i-alt"></i></a>
                            </div>
                            <div class="fbox-content text-center">
                                <p>1. Parce que nous sommes un " pure-player" du recrutement cybersécurité.</p>
                            </div>
                        </div>

                        <div class="feature-box flex-md-row-reverse text-md-right mt-5" data-animate="fadeIn" data-delay="200">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-group i-alt"></i></a>
                            </div>
                            <div class="fbox-content text-center">
                                <p>2. Parce que nous évaluons techniquement nos profils et assurons le contrôle de références sans aucune complaisance éthique.</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-3 d-md-none d-lg-block text-center">
                        <img src=" {{asset('site/img/services/iphone7.gif')}}" alt="iphone 2">
                    </div>

                    <div class="col-lg-5 col-md-6">

                        <div class="feature-box" data-animate="fadeIn">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-time i-alt"></i></a>
                            </div>
                            <div class="fbox-content text-center">
                                <p>3. Parce que nous proposons des candidats pertinents dans des délais très courts.</p>
                            </div>
                        </div>

                        <div class="feature-box mt-5" data-animate="fadeIn" data-delay="200">
                            <div class="fbox-icon">
                                <a href="#"><i class="icon-health i-alt"></i></a>
                            </div>
                            <div class="fbox-content text-center">
                                <p>4. Parce qu’un Système Informatique en bonne santé est un malade qui s’ignore, alors chez CYBER-CURE</p>
                                    <p style="font-style: italic;">« le meilleur soin c’est la prévention »</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="container clearfix">

                <div class="row col-mb-50">
                    <div class="col-lg-8">
                        <div class="fancy-title title-border">
                            <h4>Publications Récentes</h4>
                        </div>
                        {{--
                        <div class="row posts-md col-mb-30">
                            @foreach ($art as $articles )
                                 <div class="entry col-md-3">
                                <div class="grid-inner">
                                    <div class="entry-image">
                                    <a href="#"><img src="{{asset('backend/images/blog')}}/{{$articles->image_article}}" alt="Image"></a>
                                    </div>
                                    <div class="entry-title title-sm nott">
                                    <h3><a href="{{route('actualite')}}">{{$articles->name_article}}</a></h3>
                                    </div>
                                    <div class="entry-meta">
                                        <ul>
                                            <li><i class="icon-calendar3"></i> date</li>
                                            </ul>
                                    </div>
                                    <div class="entry-content">
                                        <p>lire plus</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{$art->links()}}


                        </div>--}}
                    </div>

                    <div class="col-lg-4">
                        <div class="fancy-title title-border">
                            <h4>Ils nous ont fais confiance</h4>
                        </div>

                        <!-- <div class="fslider testimonial p-0 border-0 shadow-none" data-animation="slide" data-arrows="false">
                            <div class="flexslider">
                                <div class="slider-wrap">
                                    <div class="slide">
                                        <div class="testi-image">
                                            <a href="#"><img src="images/testimonials/3.jpg" alt="Customer Testimonails"></a>
                                        </div>
                                        <div class="testi-content">
                                            <p>Les profils proposés par CYBER-CURE sont pro et fiables</p>
                                            <div class="testi-meta">
                                                Yvan fury
                                                <span>personnel</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide">
                                        <div class="testi-image">
                                            <a href="#"><img src="images/testimonials/2.jpg" alt="Customer Testimonails"></a>
                                        </div>
                                        <div class="testi-content">
                                            <p>La sécurité est toujours au rendez-vous avec CYBER-CURE</p>
                                            <div class="testi-meta">
                                                Bernard renard
                                                <span>Entrepreneur</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide">
                                        <div class="testi-image">
                                            <a href="#"><img src="images/testimonials/1.jpg" alt="Customer Testimonails"></a>
                                        </div>
                                        <div class="testi-content">
                                            <p>J'ai été recommandé par la plateforme CYBER-CURE à une entreprise et actuellement je finalise ma prériode d'essai qui sera sans doute concluant</p>
                                            <div class="testi-meta">
                                                Philips
                                                <span>stagiaire</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="card topmargin overflow-hidden">
                            <div class="card-body">
                                <h4>Heures d'ouverture</h4>

                                <p>Nous sommes à votre écoute 24h/24h</p>

                                <ul class="iconlist mb-0">
                                    <li><i class="icon-time color"></i> <strong>Lundi-Vendredi:</strong> 8h30-17h30</li>
                                </ul>

                                <i class="icon-time bgicon"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div id="oc-clients" class="text-center">


                <div class="oc-item"><a href="#"><img src="{{asset('site/img/clients/3.png')}}" alt="Clients"></a></div>


            </div>


        </div>
    </section><!-- #content end -->
 @endsection

 @section('scripts')

 <script type="text/javascript">
    document.addEventListener('mousemove',parallax);
    function parallax(e){
        this.querySelectorAll('.layer').forEach(layer => {
            var speed = layer.getAttribute('data-speed')
            var x = (window.innerWidth - e.pageX*speed)/250;
            var y = (window.innerWidth - e.pageX*speed)/250
            layer.style.transform = `translate(${-x}px) translateY(${y}px)`
        })
    }

    </script>
        <script>

            var tpj = jQuery;
            var revapi202;
            var $ = jQuery.noConflict();

            tpj(document).ready(function() {
                if (tpj("#rev_slider_579_1").revolution == undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_579_1");
                } else {
                    revapi202 = tpj("#rev_slider_579_1").show().revolution({
                        sliderType: "standard",
                        jsFileLocation: "site/include/rs-plugin/js/",
                        sliderLayout: "fullscreen",
                        dottedOverlay: "none",
                        delay: 9000,
                        responsiveLevels: [1140, 1024, 778, 480],
                        visibilityLevels: [1140, 1024, 778, 480],
                        gridwidth: [1140, 1024, 778, 480],
                        gridheight: [728, 768, 960, 720],
                        lazyType: "none",
                        shadow: 0,
                        spinner: "off",
                        stopLoop: "on",
                        stopAfterLoops: 0,
                        stopAtSlide: 1,
                        shuffle: "off",
                        autoHeight: "off",
                        fullScreenAutoWidth: "off",
                        fullScreenAlignForce: "off",
                        fullScreenOffsetContainer: "",
                        fullScreenOffset: "",
                        disableProgressBar: "on",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll:"off",
                            disableFocusListener:false,
                        },
                        parallax: {
                            type:"mouse",
                            origo:"slidercenter",
                            speed:300,
                            levels:[2,4,6,8,10,12,14,16,18,20,22,24,49,50,51,55],
                        },
                        navigation: {
                            keyboardNavigation:"off",
                            keyboard_direction: "horizontal",
                            mouseScrollNavigation:"off",
                            onHoverStop:"off",
                            touch:{
                                touchenabled:"on",
                                swipe_threshold: 75,
                                swipe_min_touches: 1,
                                swipe_direction: "horizontal",
                                drag_block_vertical: false
                            },
                            arrows: {
                                style: "hermes",
                                enable: true,
                                hide_onmobile: false,
                                hide_onleave: false,
                                tmp: '<div class="tp-arr-allwrapper">	<div class="tp-arr-imgholder"></div>	<div class="tp-arr-titleholder"></div>	</div>',
                                left: {
                                    h_align: "left",
                                    v_align: "center",
                                    h_offset: 10,
                                    v_offset: 0
                                },
                                right: {
                                    h_align: "right",
                                    v_align: "center",
                                    h_offset: 10,
                                    v_offset: 0
                                }
                            }
                        }
                    });
                    revapi202.on("revolution.slide.onloaded",function (e) {
                        setTimeout( function(){ SEMICOLON.slider.sliderDimensions(); }, 200 );
                    });

                    revapi202.on("revolution.slide.onchange",function (e,data) {
                        SEMICOLON.slider.revolutionSliderMenu();
                    });
                }
            }); /*ready*/

        </script>
            <script>

    $(function(){
      $('nav a[href^="#"]').click(function(){
        var the_id = $(this).attr("href");
        if(the_id ==='#'){
          return;
        }

        var posCible = $(the_id).offset().top -65;
        $('html, body').animate({scrollTop: posCible}, 'slow');
        return false;
      });
    })

        </script>



 @endsection

