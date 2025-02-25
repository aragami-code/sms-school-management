
@php
$usr = Auth::guard('admin')->user();
@endphp


<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
        <a href="{{route('admin.dashboard')}}"><h2 class="text-white">ADMIN</h2></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                        <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                            <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboad') ? 'active' : ''}}"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                            </ul>
                        </li>
                    @endif






                               {{--/////////////////////////////////////////////////gestion des types d'emplos////////////////////////////////////  --}}


                               @if ($usr->can('Post_Emploi.create') || $usr->can('Post_Emploi.view')  || $usr->can('Post_Emploi.edit') || $usr->can('Post_Emploi.delete') || $usr->can('Emploi_Postuler.view'))
                               <li>
                                   <a href="javascript:void(0)" aria-expanded="true"><i class="ti-new-window"></i><span>Poster un Emploi
                                       </span></a>

                                        <ul class="collapse {{ Route::is('admin.postemplois.create') || Route::is('admin.postemplois.index') ||  Route::is('admin.postemplois.edit') || Route::is('admin.postemplois.show')|| Route::is('admin.emploispostuler.index') ? 'in' : ''}}">


                                       @if ($usr->can('Post_Emploi.view'))
                                       <li class="{{ Route::is('admin.postemplois.index') || Route::is('admin.postemplois.edit') ? 'active' : ''}}"><a href="{{ route('admin.postemplois.index')}}">Liste D'emploi publié</a></li>
                                       @endif



                                       @if ($usr->can('Emploi_Postuler.view'))
                                       <li class="{{ Route::is('admin.emploispostuler.index') ? 'active' : ''  }}"><a href="{{route('admin.emploispostuler.index')}}">Personnes Ayant Postulé</a></li>
                                       @endif

                                       @if ($usr->can('Post_Emploi.create'))
                                       <li class="{{ Route::is('admin.postemplois.create') ? 'active' : ''  }}"><a href="{{route('admin.postemplois.create')}}">Matcher une Offre</a></li>
                                       @endif

                                       @if ($usr->can('Post_Emploi.create'))
                                       <li class="{{ Route::is('admin.postemplois.create') ? 'active' : ''  }}"><a href="{{route('admin.postemplois.create')}}">Publier une Offre</a></li>
                                       @endif


                                   </ul>
                               </li>
                               @endif


                            {{--/////////////////////////////////////////////////gestion des contrat de travail////////////////////////////////////  --}}


                            @if ($usr->can('type_contrat.create') || $usr->can('type_contrat.view')  || $usr->can('type_contrat.edit') || $usr->can('type_contrat.delete') )
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pencil-alt"></i><span>Gestion des Contrats
                                    </span></a>

                                     <ul class="collapse {{ Route::is('admin.contrats.create') || Route::is('admin.contrats.index') ||  Route::is('admin.contrats.edit') || Route::is('admin.contrats.show') ? 'in' : ''}}">


                                    @if ($usr->can('type_contrat.view'))
                                    <li class="{{ Route::is('admin.contrats.index') || Route::is('admin.contrats.edit') ? 'active' : ''}}"><a href="{{ route('admin.contrats.index')}}">Liste Des Contrats</a></li>
                                    @endif



                                    @if ($usr->can('type_contrat.create'))
                                    <li class="{{ Route::is('admin.contrats.create') ? 'active' : ''  }}"><a href="{{route('admin.contrats.create')}}">Creer Un Contrat</a></li>
                                    @endif


                                </ul>
                            </li>
                            @endif

                               {{--/////////////////////////////////////////////////gestion des types d'emplos////////////////////////////////////  --}}


                               @if ($usr->can('typemp.create') || $usr->can('typemp.view')  || $usr->can('typemp.edit') || $usr->can('typemp.delete') )
                               <li>
                                   <a href="javascript:void(0)" aria-expanded="true"><i class="ti-briefcase"></i><span>Gestion d'un Type de Travail
                                       </span></a>

                                        <ul class="collapse {{ Route::is('admin.typemplois.create') || Route::is('admin.typemplois.index') ||  Route::is('admin.typemplois.edit') || Route::is('admin.typemplois.show') ? 'in' : ''}}">


                                       @if ($usr->can('typemp.view'))
                                       <li class="{{ Route::is('admin.typemplois.index') || Route::is('admin.typemplois.edit') ? 'active' : ''}}"><a href="{{ route('admin.typemplois.index')}}">Liste Des types</a></li>
                                       @endif



                                       @if ($usr->can('typemp.create'))
                                       <li class="{{ Route::is('admin.typemplois.create') ? 'active' : ''  }}"><a href="{{route('admin.typemplois.create')}}">Creer Un type</a></li>
                                       @endif


                                   </ul>
                               </li>
                               @endif


                                            {{--/////////////////////////////////////////////////gestion des types de formation////////////////////////////////////  --}}


                                            @if ($usr->can('type_formation.create') || $usr->can('type_formation.view')  || $usr->can('type_formation.edit') || $usr->can('type_formation.delete') )
                                            <li>
                                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-bag"></i><span>Gestion des Formations
                                                    </span></a>

                                                     <ul class="collapse {{ Route::is('admin.formations.create') || Route::is('admin.formations.index') ||  Route::is('admin.formations.edit') || Route::is('admin.formations.show') ? 'in' : ''}}">


                                                    @if ($usr->can('type_formation.view'))
                                                    <li class="{{ Route::is('admin.formations.index') || Route::is('admin.formations.edit') ? 'active' : ''}}"><a href="{{ route('admin.formations.index')}}">Liste Des Formations</a></li>
                                                    @endif



                                                    @if ($usr->can('type_formation.create'))
                                                    <li class="{{ Route::is('admin.formations.create') ? 'active' : ''  }}"><a href="{{route('admin.formations.create')}}">Creer Une formation</a></li>
                                                    @endif


                                                </ul>
                                            </li>
                                            @endif




                           {{--/////////////////////////////////////////////////gestion des plage de salaires////////////////////////////////////  --}}


                           @if ($usr->can('salaire.create') || $usr->can('salaire.view')  || $usr->can('salaire.edit') || $usr->can('salaire.delete') )
                           <li>
                               <a href="javascript:void(0)" aria-expanded="true"><i class="ti-money"></i><span>Gestion des salaires
                                   </span></a>

                                    <ul class="collapse {{ Route::is('admin.salaires.create') || Route::is('admin.salaires.index') ||  Route::is('admin.salaires.edit') || Route::is('admin.salaires.show') ? 'in' : ''}}">


                                   @if ($usr->can('salaire.view'))
                                   <li class="{{ Route::is('admin.salaires.index') || Route::is('admin.salaires.edit') ? 'active' : ''}}"><a href="{{ route('admin.salaires.index')}}">Liste Des Marges salariales</a></li>
                                   @endif



                                   @if ($usr->can('salaire.create'))
                                   <li class="{{ Route::is('admin.salaires.create') ? 'active' : ''  }}"><a href="{{route('admin.salaires.create')}}">Creer Une marge salariale</a></li>
                                   @endif


                               </ul>
                           </li>
                           @endif



                           {{--/////////////////////////////////////////////////gestion des secteurs d'activite/////// dommaine d'activite/////////////////////////////  --}}


                           @if ($usr->can('sectA.create') || $usr->can('sectA.view')  || $usr->can('sectA.edit') || $usr->can('sectA.delete') )
                           <li>
                               <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i><span>Gestion des Secteurs d'Activités
                                   </span></a>

                                    <ul class="collapse {{ Route::is('admin.sectas.create') || Route::is('admin.sectas.index') ||  Route::is('admin.sectas.edit') || Route::is('admin.sectas.show') ? 'in' : ''}}">


                                   @if ($usr->can('sectA.view'))
                                   <li class="{{ Route::is('admin.sectas.index') || Route::is('admin.sectas.edit') ? 'active' : ''}}"><a href="{{ route('admin.sectas.index')}}">Liste Des Secteurs d'Activités</a></li>
                                   @endif



                                   @if ($usr->can('sectA.create'))
                                   <li class="{{ Route::is('admin.sectas.create') ? 'active' : ''  }}"><a href="{{route('admin.sectas.create')}}">Creer Un Secteur d'Activité</a></li>
                                   @endif


                               </ul>
                           </li>
                           @endif




                                          {{--/////////////////////////////////////////////////gestion de la localisation/////// dommaine d'activite/////////////////////////////  --}}


                                          @if ($usr->can('GLE.create') || $usr->can('GLE.view')  || $usr->can('GLE.edit') || $usr->can('GLE.delete') || $usr->can('GLR.create') || $usr->can('GLR.view') || $usr->can('GLR.edit') || $usr->can('GLR.delete') || $usr->can('GLV.create') || $usr->can('GLV.view')|| $usr->can('GLV.edit') || $usr->can('GLV.delete'))
                                          <li>
                                              <a href="javascript:void(0)" aria-expanded="true"><i class="ti-world"></i><span>Gestion de la localisation
                                                  </span></a>

                                                   <ul class="collapse {{ Route::is('admin.etats.create') || Route::is('admin.etats.index') ||  Route::is('admin.etats.edit') || Route::is('admin.etats.show') || Route::is('admin.regions.create') || Route::is('admin.regions.index') ||  Route::is('admin.regions.edit') || Route::is('admin.regions.show') || Route::is('admin.villes.create') || Route::is('admin.villes.index') ||  Route::is('admin.villes.edit') || Route::is('admin.villes.show') ? 'in' : ''}}">


                                                    @if ($usr->can('GLE.create') || $usr->can('GLE.view')  || $usr->can('GLE.edit') || $usr->can('GLE.delete'))
                                                    <li class="{{ Route::is('admin.etats.index') || Route::is('admin.etats.edit') ? 'active' : ''}}"><a href="{{ route('admin.etats.index')}}">Gerer les Etats</a></li>
                                                    @endif

                                                    @if ($usr->can('GLR.create') || $usr->can('GLR.view') || $usr->can('GLR.edit') || $usr->can('GLR.delete'))
                                                  <li class="{{ Route::is('admin.regions.index') || Route::is('admin.regions.edit') ? 'active' : ''}}"><a href="{{ route('admin.regions.index')}}">Gerer les Regions</a></li>
                                                  @endif


                                                  @if ($usr->can('GLV.create') || $usr->can('GLV.view')|| $usr->can('GLV.edit') || $usr->can('GLV.delete'))
                                                  <li class="{{ Route::is('admin.villes.index') || Route::is('admin.villes.edit') ? 'active' : ''}}"><a href="{{ route('admin.villes.index')}}">Gerer Des Villes</a></li>
                                                  @endif


                                              </ul>
                                          </li>
                                          @endif





                      {{--/////////////////////////////////////////////////gestion des categorie dans le blog////////////////////////////////////  --}}


                    @if ($usr->can('bcategorie.create') || $usr->can('bcategorie.view')  || $usr->can('bcategorie.edit') || $usr->can('bcategorie.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-book"></i><span>Gestion des Categories
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.bcategories.create') || Route::is('admin.bcategories.index') ||  Route::is('admin.bcategories.edit') || Route::is('admin.bcategories.show') ? 'in' : ''}}">


                            @if ($usr->can('bcategorie.view'))
                            <li class="{{ Route::is('admin.bcategories.index') || Route::is('admin.bcategories.edit') ? 'active' : ''}}"><a href="{{ route('admin.bcategories.index')}}">Liste Des Categories</a></li>
                            @endif



                            @if ($usr->can('bcategorie.create'))
                            <li class="{{ Route::is('admin.bcategories.create') ? 'active' : ''  }}"><a href="{{route('admin.bcategories.create')}}">Creer Une Categorie</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif


                      {{--/////////////////////////////////////////////////gestion des Articles////////////////////////////////////--}}


                    @if ($usr->can('article.create') || $usr->can('article.view')  || $usr->can('article.edit') || $usr->can('article.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-clipboard"></i><span>Gestion des Articles
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.articles.create') || Route::is('admin.articles.index') ||  Route::is('admin.articles.edit') || Route::is('admin.articles.show') ? 'in' : ''}}">


                            @if ($usr->can('article.view'))
                            <li class="{{ Route::is('admin.articles.index') || Route::is('admin.articles.edit') ? 'active' : ''}}"><a href="{{ route('admin.articles.index')}}">Liste Des Articles</a></li>
                            @endif



                            @if ($usr->can('article.create'))
                            <li class="{{ Route::is('admin.articles.create') ? 'active' : ''  }}"><a href="{{route('admin.articles.create')}}">Creer Un Article</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif



                      {{--/////////////////////////////////////////////////gestion des utilisateur////////////////////////////////////--}}


                    @if ($usr->can('user.create') || $usr->can('user.view')  || $usr->can('user.edit') || $usr->can('user.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Gestion des Utilisateurs
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.users.create') || Route::is('admin.users.index') ||  Route::is('admin.users.edit') || Route::is('admin.users.show') ? 'in' : ''}}">


                            @if ($usr->can('user.view'))
                            <li class="{{ Route::is('admin.users.index') || Route::is('admin.users.edit') ? 'active' : ''}}"><a href="{{ route('admin.users.index')}}">Liste Des Utilisateur</a></li>
                            @endif



                            @if ($usr->can('user.create'))
                            <li class="{{ Route::is('admin.users.create') ? 'active' : ''  }}"><a href="{{route('admin.users.create')}}">Creer Un Utilisateur</a></li>
                            @endif


                            @if ($usr->can('user.create'))
                            <li class="{{ Route::is('admin.users.create') ? 'active' : ''  }}"><a href="{{route('admin.users.create')}}">liste Noire</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif





{{--/////////////////////////////////////////////////gestion des roles et permissions////////////////////////////////////--}}

                    @if ($usr->can('role.create') || $usr->can('role.view')  || $usr->can('role.edit') || $usr->can('role.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-ruler"></i><span>Gestion des Roles & Permissions
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') ||  Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : ''}}">


                            @if ($usr->can('role.view'))
                            <li class="{{ Route::is('admin.roles.index') || Route::is('admin.roles.edit') ? 'active' : ''}}"><a href="{{ route('admin.roles.index')}}">Liste Des Roles</a></li>
                            @endif



                            @if ($usr->can('role.create'))
                            <li class="{{ Route::is('admin.roles.create') ? 'active' : ''  }}"><a href="{{route('admin.roles.create')}}">Creer Un Role</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif


                    {{--///////////////////////////////////////////gestion des Administrateur//////////////////////////////////////////--}}

                    @if ($usr->can('admin.create') || $usr->can('admin.view')  || $usr->can('admin.edit') || $usr->can('admin.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span> Gestion des Administrateurs
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') ||  Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : ''}}">


                            @if ($usr->can('admin.view'))
                       <li class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'active' : ''}}"><a href="{{ route('admin.admins.index')}}">Liste D'administrateurs</a></li>
                            @endif



                            @if ($usr->can('admin.create'))
                            <li class="{{ Route::is('admin.admins.create') ? 'active' : ''  }}"><a href="{{route('admin.admins.create')}}">Ajouter un Administrateur</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif

                    {{--///////////////////////////////////////////Parametre//////////////////////////////////////////--}}

                    @if ($usr->can('Parametre.view')  || $usr->can('Parametre.edit') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span> Parametre du site
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.parametres.index') ||  Route::is('admin.parametres.edit') ? 'in' : ''}}">


                            @if ($usr->can('Parametre.view'))
                       <li class="{{ Route::is('admin.parametres.index') || Route::is('admin.parametres.edit') ? 'active' : ''}}"><a href="{{ route('admin.parametres.index')}}">parametre du site</a></li>
                            @endif




                        </ul>
                    </li>
                    @endif









                </ul>
            </nav>
        </div>
    </div>
</div>
