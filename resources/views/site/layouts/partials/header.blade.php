<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="{{Route('accueil1')}}" class="standard-logo" data-dark-logo="{{asset('site/img/logo2.png')}}"><img src="{{asset('site/img/logo2.png')}}" alt="CYBER-CURE Logo"></a>
                    <a href="{{Route('accueil1')}}" class="retina-logo" data-dark-logo="{{asset('site/img/logo2.png')}}"><img src="{{asset('site/img/logo2.png')}}" alt="CYBER-CURE Logo"></a>
                </div><!-- #logo end -->

                <div class="header-misc">

                </div>

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                </div>

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu">

                    <ul class="menu-container">
                        <li class="menu-item">
                            <a class="menu-link" href="{{Route('accueil1')}}"><div>Accueil</div></a>
                            <ul class="sub-menu-container">
                                <li class="menu-item">
                                    <a class="menu-link" href="{{Route('preface')}}"><div><i class="icon-wpforms"></i>PREFACE</div></a>
                                </li><li class="menu-item">
                                    <a class="menu-link" href="{{Route('about')}}"><div><i class="icon-info"></i>A propos de nous</div></a>
                                </li>
                                <!-- <li class="menu-item">
                                    <a class="menu-link" href="intro.html#section-onepage"><div><i class="icon-archive"></i>Activités</div></a>
                                </li> -->

                            </ul>
                        </li>
                        <!-- <li class="menu-item">
                            <a class="menu-link" href="actu.html"><div>Actualités</div></a>
                            <ul class="sub-menu-container">
                                <li class="menu-item">
                                    <a class="menu-link" href="#"><div><i class="icon-calendar3"></i>Evènements</div></a>

                            </ul>
                        </li> -->
                        <!----> <li class="menu-item">
                            <a class="menu-link" href="{{Route('carriere')}}"><div>Carrière</div></a>
                            <!--<ul class="sub-menu-container">
                                <li class="menu-item">
                                    <a class="menu-link" href="#"><div><i class="icon-male"></i>Déposez un CV</div></a>

                                </li>

                            </ul>-->
                        </li>
                        <li class="menu-item mega-menu">
                            <a class="menu-link" href="{{Route('faq')}}"><div>FAQ</div></a>
                        </li>
                        <li class="menu-item mega-menu">
                            <a class="menu-link" href="{{Route('contact')}}"><div>Contacts</div></a>
                        </li>



                        <li class="menu-item">
                            <a class="menu-link" href="{{Route('connexion')}}"><div>Connexion</div></a>
                            <ul class="sub-menu-container">
                                <li class="menu-item mega-menu">
                                    <a class="menu-link" href="{{--Route('chercheur.auth.registration')--}}"><div>S'Enregistrer</div></a>
                                </li>

                            </ul>
                        </li>


                    </ul>

                </nav><!-- #primary-menu end -->



            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header><!-- #header end -->
