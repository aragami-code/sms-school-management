@extends('site.home.fr.master')
@section('name')

<section id="page-title"   style="background-image: url(images/slider/rev/main/s21.jpg); background-size: cover; background-repeat: no-repeat;" >

    <div class="container clearfix" >
        <h1 style="color: aliceblue;">Contacts</h1>
        <span style="color: rgb(0, 0, 0);">Rejoignez-nous</span>

    </div>

</section><!-- #page-title end -->

<!-- Page Sub Menu
============================================= -->
<div id="page-menu">
    <div id="page-menu-wrap">
        <div class="container">
            <div class="page-menu-row">

                <div class="page-menu-title mx-auto">CONTACTEZ-NOUS</div>

                <div id="page-menu-trigger"><i class="icon-reorder"></i></div>

            </div>
        </div>
    </div>
</div><!-- #page-menu end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row align-items-stretch col-mb-50 mb-0">
                <!-- Contact Form
                ============================================= -->
                <div class="col-lg-6">

                    <div class="fancy-title title-border">
                        <h3>MAIL</h3>
                    </div>

                    <div class="form-widget">

                        <div class="form-result"></div>

                        @if (count($errors)>0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">x

                            </button>
                            <ul>
                                @foreach($errors->all() as $error )

                            <li>{{$error}}</li>

                                @endforeach
                            </ul>

                        </div>

                        @endif

                        @if ($message = Session::get('success'))

                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">x

                            </button>

                        <strong>{{$message}}</strong>

                        </div>

                        @endif
                    <form class="mb-0" action="{{url('contact/send')}}" method="post">
                            {{ csrf_field()}}
                            <div class="form-process">
                                <div class="css3-spinner">
                                    <div class="css3-spinner-scaler"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="template-contactform-name">Noms <small>*</small></label>
                                    <input type="text"  name="Name" class="sm-form-control required" />
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="template-contactform-email">Email <small>*</small></label>
                                    <input type="email"  name="Email" class="required email sm-form-control" />
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="template-contactform-phone">Téléphone</label>
                                    <input type="text"  name="Telephone" class="sm-form-control" />
                                </div>

                                <div class="w-100"></div>

                                <div class="col-md-8 form-group">
                                    <label for="template-contactform-subject">Objet <small>*</small></label>
                                    <input type="text"  name="Objet" class="required sm-form-control" />
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="template-contactform-service">Services</label>
                                    <select id="template-contactform-service" name="Services" class="sm-form-control">
                                        <option>--  --</option>
                                        <option value="POG">POG</option>
                                        <option value="SGI">SGI</option>
                                        <option value="OMCO">OMCO</option>
                                        <option value="CAE">CAE</option>
                                    </select>
                                </div>

                                <div class="w-100"></div>

                                <div class="col-12 form-group">
                                    <label for="template-contactform-message">Message <small>*</small></label>
                                    <textarea class="required sm-form-control" id="template-contactform-message" name="Message" rows="6" cols="30"></textarea>
                                </div>

                                <div class="col-12 form-group d-none">
                                    <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
                                </div>

                                <div class="col-12 form-group">
                                    <button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0">Soumettre</button>
                                </div>
                            </div>

                            <input type="hidden" name="prefix" value="template-contactform-">

                        </form>
                    </div>

                </div><!-- Contact Form End -->

                <!-- Google Map
                ============================================= -->
                <div class="col-lg-6 min-vh-50">
                    <!-- <div class="gmap h-100" data-latitude="-37.813629" data-longitude="144.963058" data-markers='[{latitude:-37.813629, longitude:144.963058, html: "<div class=\"p-2\" style=\"width: 300px;\"><h4 class=\"mb-2\">Hi! We are <span>Envato!</span></h4><p class=\"mb-0\" style=\"font-size:1rem;\">Our mission is to help people to <strong>earn</strong> and to <strong>learn</strong> online. We operate <strong>marketplaces</strong> where hundreds of thousands of people buy and sell digital goods every day.</p></div>", icon:{ image: "images/icons/map-icon-red.png", iconsize: [32, 39], iconanchor: [32,39] } }]'></div> -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3709.878270200801!2d2.238545034667258!3d48.890999181546334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6650212ba5589%3A0x13c2355d9d166ee5!2s4%20Place%20de%20la%20D%C3%A9fense%2C%2094974%20Paris%2C%20France!5e0!3m2!1sfr!2scm!4v1606769237941!5m2!1sfr!2scm" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </div><!-- Google Map End -->
            </div>

            <!-- Contact Info
            ============================================= -->
            <div class="row col-mb-50">
                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box fbox-center fbox-bg fbox-plain">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-map-marker2"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h3>Localisation<span class="subtitle">4 Place de la Défense 92974 Paris La Défense</span></h3>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box fbox-center fbox-bg fbox-plain">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-phone3"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h3>Téléphone<span class="subtitle"> +33753732409</span></h3>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box fbox-center fbox-bg fbox-plain">
                        <div class="fbox-icon">
                            <a href="https://www.linkedin.com/company/cyber-cure"><i class="icon-linkedin"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h3>Postulez<span class="subtitle">cyber-cure</span></h3>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="feature-box fbox-center fbox-bg fbox-plain">
                        <div class="fbox-icon">
                            <a href="https://www.facebook.com/Cybercure.fr"><i class="icon-facebook"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h3>suivez-nous<span class="subtitle">cyber-cure</span></h3>
                        </div>
                    </div>
                </div>
            </div><!-- Contact Info End -->

        </div>
    </div>
</section><!-- #content end -->


@endsection
@section('scripts')

<script>
test.....................
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

