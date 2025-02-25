@extends('site.home.fr.master')
@section('name')


<section id="page-title"   style="background-image: url(/site/img/team/1.jpg); background-repeat: no-repeat; background-size: cover;">

    <div class="container clearfix">
        <h1 style="color: aliceblue;">FAQs</h1>
        <span style="color:aliceblue">Trouvez une réponse à chacune <br> de vos questions</span>

    </div>

</section><!-- #page-title end -->

<!-- Content
============================================= -->
<section id="content">
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row gutter-40 col-mb-80">
                <!-- Post Content
                ============================================= -->
                <div class="postcontent col-lg-9">

                    <div class="grid-filter-wrap">
                        <ul class="grid-filter style-4 customjs">

                            <li class="activeFilter"><a href="#" data-filter="all">Toutes</a></li>
                            <li><a href="#" data-filter=".faq-marketplace">Catégorie 1</a></li>
                            <li><a href="#" data-filter=".faq-authors">Catégorie 2</a></li>
                            <li><a href="#" data-filter=".faq-legal">Catégorie 3</a></li>
                            <li><a href="#" data-filter=".faq-itemdiscussion">Catégorie 4</a></li>
                            <li><a href="#" data-filter=".faq-affiliates">Catégorie 5</a></li>

                        </ul>
                    </div>

                    <div class="clear"></div>

                    <div id="faqs" class="faqs">

                        <div class="toggle faq faq-marketplace faq-authors">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-question-sign"></i>
                                    <i class="toggle-open icon-question-sign"></i>
                                </div>
                                <div class="toggle-title">
                                    Comment Postuler?
                                </div>
                            </div>
                            <div class="toggle-content">Incrivez vous sur la page carrière.</div>
                        </div>

                        <div class="toggle faq faq-authors faq-miscellaneous">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-comments-alt"></i>
                                    <i class="toggle-open icon-comments-alt"></i>
                                </div>
                                <div class="toggle-title">
                                    Comment pourrais je publier des offres emplois?
                                </div>
                            </div>
                            <div class="toggle-content">Enregistrez vous dans la section employeurs.</div>
                        </div>



                        <div class="toggle faq faq-authors faq-legal faq-itemdiscussion">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-download-alt"></i>
                                    <i class="toggle-open icon-download-alt"></i>
                                </div>
                                <div class="toggle-title">
                                    J'ai un diplôme en Système et Réseaux, Pourrais-je postuler?
                                </div>
                            </div>
                            <div class="toggle-content">Si vous vous êtes spécialisés en sécurité informatique c'est possible</div>
                        </div>

                        <div class="toggle faq faq-marketplace faq-authors">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-ok"></i>
                                    <i class="toggle-open icon-ok"></i>
                                </div>
                                <div class="toggle-title">
                                    Comment faire pour rejoindre votre équipe?
                                </div>
                            </div>
                            <div class="toggle-content">Merci pour cette question. Vous serez informé via votre mail le moment venu avec les modalités y afférentes.</div>
                        </div>

                        <div class="toggle faq faq-affiliates faq-miscellaneous">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-money"></i>
                                    <i class="toggle-open icon-money"></i>
                                </div>
                                <div class="toggle-title">
                                Que demandez vous en contre partie lorsque notre période d'essai est concluant?
                                </div>
                            </div>
                            <div class="toggle-content">Le pourcentage que nous enlevons dans votre salaire est relatif</div>
                        </div>

                        <div class="toggle faq faq-legal faq-itemdiscussion">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-picture"></i>
                                    <i class="toggle-open icon-picture"></i>
                                </div>
                                <div class="toggle-title">
                                    Est-il possible d'inserer des image illustratifs ou une video démo de mes compétences?
                                </div>
                            </div>
                            <div class="toggle-content">C'est plutôt original,  éblouissez-nous😉</div>
                        </div>



                        <div class="toggle faq faq-authors faq-itemdiscussion">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-phone3"></i>
                                    <i class="toggle-open icon-phone3"></i>
                                </div>
                                <div class="toggle-title">
                                    Avez vous une adresse outlook ?
                                </div>
                            </div>
                            <div class="toggle-content">Pas encore</div>
                        </div>

                        <div class="toggle faq faq-marketplace faq-itemdiscussion">
                            <div class="toggle-header">
                                <div class="toggle-icon">
                                    <i class="toggle-closed icon-credit"></i>
                                    <i class="toggle-open icon-credit"></i>
                                </div>
                                <div class="toggle-title">
                                    Comment souscrire à votre pack premium lorsqu'il sera effectif?
                                </div>
                            </div>
                            <div class="toggle-content">Une docummentation sera mis à votre disposition le moment venu.</div>
                        </div>

                    </div>


                </div><!-- .postcontent end -->


            </div>

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

