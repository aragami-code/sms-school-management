
@php
$usr = Auth::guard('admin')->user();
@endphp


<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
        <a href="{{route('admin.dashboard')}}"><h2 class="text-white">Admin</h2></a>
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
                                   <a href="javascript:void(0)" aria-expanded="true"><i class="ti-new-window"></i><span>Poster un emploi
                                       </span></a>

                                        <ul class="collapse {{--Route::is('admin.postemplois.create') || Route::is('admin.postemplois.index') ||  Route::is('admin.postemplois.edit') || Route::is('admin.postemplois.show')|| Route::is('admin.emploispostuler.index') || Route::is('admin.chercheurprofile.edit') ||  Route::is('admin.postemplois.matcher') || Route::is('admin.emploispostuler.show')? 'in' : ''}}">

                                          @if ($usr->can('Post_Emploi.create'))
                                       <li class="{{ Route::is('admin.postemplois.create') ? 'active' : ''  }}"><a href="{{route('admin.postemplois.create')}}">Publier une offre</a></li>
                                       @endif

                                       @if ($usr->can('Post_Emploi.view'))
                                       <li class="{{ Route::is('admin.postemplois.index') || Route::is('admin.postemplois.edit') ? 'active' : ''}}"><a href="{{ route('admin.postemplois.index')}}">Liste des offres publiées</a></li>
                                       @endif



                                       @if ($usr->can('Emploi_Postuler.view'))
                                       <li class="{{ Route::is('admin.emploispostuler.index') || Route::is('admin.chercheurprofile.edit')|| Route::is('admin.emploispostuler.create')|| Route::is('admin.emploispostuler.edit') || Route::is('admin.emploispostuler.show') ? 'active' : ''  }}"><a href="{{route('admin.emploispostuler.index')}}">Personnes ayant postulé</a></li>
                                       @endif

                                       @if ($usr->can('Post_Emploi.create'))
                                       <li class="{{ Route::is('admin.postemplois.matcher') ? 'active' : ''  }}"><a href="{{route('admin.postemplois.matcher')--}}">Rechercher profil</a></li>
                                      {{-- @endif--}}




                                   </ul>
                               </li>
                               @endif


                            {{--/////////////////////////////////////////////////gestion des contrat de travail////////////////////////////////////


                            @if ($usr->can('type_contrat.create') || $usr->can('type_contrat.view')  || $usr->can('type_contrat.edit') || $usr->can('type_contrat.delete') )
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pencil-alt"></i><span>Gerer contrat
                                    </span></a>

                                     <ul class="collapse {{ Route::is('admin.contrats.create') || Route::is('admin.contrats.index') ||  Route::is('admin.contrats.edit') || Route::is('admin.contrats.show') ? 'in' : ''}}">


                                    @if ($usr->can('type_contrat.view'))
                                    <li class="{{ Route::is('admin.contrats.index') || Route::is('admin.contrats.edit') ? 'active' : ''}}"><a href="{{ route('admin.contrats.index')}}">Liste contrats</a></li>
                                    @endif



                                    @if ($usr->can('type_contrat.create'))
                                    <li class="{{ Route::is('admin.contrats.create') ? 'active' : ''  }}"><a href="{{route('admin.contrats.create')}}">Creer contrat</a></li>
                                    @endif


                                </ul>
                            </li>
                            @endif--}}

                               {{--/////////////////////////////////////////////////gestion des types d'emplos////////////////////////////////////


                               @if ($usr->can('typemp.create') || $usr->can('typemp.view')  || $usr->can('typemp.edit') || $usr->can('typemp.delete') )
                               <li>
                                   <a href="javascript:void(0)" aria-expanded="true"><i class="ti-briefcase"></i><span>Gestion type de travail
                                       </span></a>

                                        <ul class="collapse {{ Route::is('admin.typemplois.create') || Route::is('admin.typemplois.index') ||  Route::is('admin.typemplois.edit') || Route::is('admin.typemplois.show') ? 'in' : ''}}">


                                       @if ($usr->can('typemp.view'))
                                       <li class="{{ Route::is('admin.typemplois.index') || Route::is('admin.typemplois.edit') ? 'active' : ''}}"><a href="{{ route('admin.typemplois.index')}}">Lister</a></li>
                                       @endif



                                       @if ($usr->can('typemp.create'))
                                       <li class="{{ Route::is('admin.typemplois.create') ? 'active' : ''  }}"><a href="{{route('admin.typemplois.create')}}">Ajouter un type</a></li>
                                       @endif


                                   </ul>
                               </li>
                               @endif--}}


                                            {{--/////////////////////////////////////////////////gestion des types de formation////////////////////////////////////


                                            @if ($usr->can('type_formation.create') || $usr->can('type_formation.view')  || $usr->can('type_formation.edit') || $usr->can('type_formation.delete') )
                                            <li>
                                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-bag"></i><span>Gestion des diplômes
                                                    </span></a>

                                                     <ul class="collapse {{ Route::is('admin.formations.create') || Route::is('admin.formations.index') ||  Route::is('admin.formations.edit') || Route::is('admin.formations.show') ? 'in' : ''}}">


                                                    @if ($usr->can('type_formation.view'))
                                                    <li class="{{ Route::is('admin.formations.index') || Route::is('admin.formations.edit') ? 'active' : ''}}"><a href="{{ route('admin.formations.index')}}">Liste des diplômes</a></li>
                                                    @endif



                                                    @if ($usr->can('type_formation.create'))
                                                    <li class="{{ Route::is('admin.formations.create') ? 'active' : ''  }}"><a href="{{route('admin.formations.create')}}">Ajouter un diplôme</a></li>
                                                    @endif


                                                </ul>
                                            </li>
                                            @endif--}}




                           {{--/////////////////////////////////////////////////gestion des plage de salaires////////////////////////////////////


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
                           @endif--}}



                           {{--/////////////////////////////////////////////////gestion des secteurs d'activite/////// dommaine d'activite/////////////////////////////


                           @if ($usr->can('sectA.create') || $usr->can('sectA.view')  || $usr->can('sectA.edit') || $usr->can('sectA.delete') )
                           <li>
                               <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i><span>Gestion des Secteurs d'activités
                                   </span></a>

                                    <ul class="collapse {{ Route::is('admin.sectas.create') || Route::is('admin.sectas.index') ||  Route::is('admin.sectas.edit') || Route::is('admin.sectas.show') ? 'in' : ''}}">


                                   @if ($usr->can('sectA.view'))
                                   <li class="{{ Route::is('admin.sectas.index') || Route::is('admin.sectas.edit') ? 'active' : ''}}"><a href="{{ route('admin.sectas.index')}}">Liste des secteurs</a></li>
                                   @endif



                                   @if ($usr->can('sectA.create'))
                                   <li class="{{ Route::is('admin.sectas.create') ? 'active' : ''  }}"><a href="{{route('admin.sectas.create')}}">Ajouter un Secteur d'activité</a></li>
                                   @endif


                               </ul>
                           </li>
                           @endif --}}




                                          {{--/////////////////////////////////////////////////gestion de la localisation/////// dommaine d'activite/////////////////////////////


                                          @if ($usr->can('GLE.create') || $usr->can('GLE.view')  || $usr->can('GLE.edit') || $usr->can('GLE.delete') || $usr->can('GLR.create') || $usr->can('GLR.view') || $usr->can('GLR.edit') || $usr->can('GLR.delete') || $usr->can('GLV.create') || $usr->can('GLV.view')|| $usr->can('GLV.edit') || $usr->can('GLV.delete'))
                                          <li>
                                              <a href="javascript:void(0)" aria-expanded="true"><i class="ti-world"></i><span>Gestion de la localisation
                                                  </span></a>

                                                   <ul class="collapse {{ Route::is('admin.etats.create') || Route::is('admin.etats.index') ||  Route::is('admin.etats.edit') || Route::is('admin.etats.show') || Route::is('admin.regions.create') || Route::is('admin.regions.index') ||  Route::is('admin.regions.edit') || Route::is('admin.regions.show') || Route::is('admin.villes.create') || Route::is('admin.villes.index') ||  Route::is('admin.villes.edit') || Route::is('admin.villes.show') ? 'in' : ''}}">


                                                    @if ($usr->can('GLE.create') || $usr->can('GLE.view')  || $usr->can('GLE.edit') || $usr->can('GLE.delete'))
                                                    <li class="{{ Route::is('admin.etats.index') || Route::is('admin.etats.edit') ? 'active' : ''}}"><a href="{{ route('admin.etats.index')}}">Gerer Etats</a></li>
                                                    @endif

                                                    @if ($usr->can('GLR.create') || $usr->can('GLR.view') || $usr->can('GLR.edit') || $usr->can('GLR.delete'))
                                                  <li class="{{ Route::is('admin.regions.index') || Route::is('admin.regions.edit') ? 'active' : ''}}"><a href="{{ route('admin.regions.index')}}">Gerer  Regions</a></li>
                                                  @endif


                                                  @if ($usr->can('GLV.create') || $usr->can('GLV.view')|| $usr->can('GLV.edit') || $usr->can('GLV.delete'))
                                                  <li class="{{ Route::is('admin.villes.index') || Route::is('admin.villes.edit') ? 'active' : ''}}"><a href="{{ route('admin.villes.index')}}">Gerer Département</a></li>
                                                  @endif


                                              </ul>
                                          </li>
                                          @endif--}}





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
                            <li class="{{ Route::is('admin.bcategories.create') ? 'active' : ''  }}"><a href="{{route('admin.bcategories.create')}}">Ajouter Une Categorie</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif


                      {{--/////////////////////////////////////////////////gestion des Articles////////////////////////////////////--}}


                    @if ($usr->can('article.create') || $usr->can('article.view')  || $usr->can('article.edit') || $usr->can('article.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-clipboard"></i><span>Gestion des REQUETES
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.articles.create') || Route::is('admin.articles.index') ||  Route::is('admin.articles.edit') || Route::is('admin.articles.show') ? 'in' : ''}}">


                            @if ($usr->can('article.view'))
                            <li class="{{ Route::is('admin.articles.index') || Route::is('admin.articles.edit') ? 'active' : ''}}"><a href="{{ route('admin.articles.index')}}">Liste Des Articles</a></li>
                            @endif



                            @if ($usr->can('article.create'))
                            <li class="{{ Route::is('admin.articles.create') ? 'active' : ''  }}"><a href="{{route('admin.articles.create')}}">Ajouter Un Article</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif

                    
                      {{--/////////////////////////////////////////////////gestion de la Scolarite////////////////////////////////////--}}


                      @if ($usr->can('scolarites.create') || $usr->can('scolarites.view')  || $usr->can('scolarites.edit') || $usr->can('scolarites.delete') )
                      <li>
                          <a href="javascript:void(0)" aria-expanded="true"><i class="ti-clipboard"></i><span>Gestion de la scolarité
                              </span></a>
  
                               <ul class="collapse {{ Route::is('admin.scolarites.create') || Route::is('admin.scolarites.index') ||  Route::is('admin.scolarites.edit') || Route::is('admin.scolarites.show') ? 'in' : ''}}">
  
  
                              @if ($usr->can('scolarites.view'))
                              <li class="{{ Route::is('admin.scolarites.index') || Route::is('admin.scolarites.edit') ? 'active' : ''}}"><a href="{{ route('admin.scolarites.index')}}">Etat de solde</a></li>
                              @endif
  
  
  
  
                          </ul>
                      </li>
                      @endif



                      {{--/////////////////////////////////////////////////gestion des utilisateurs////////////////////////////////////--}}


                    @if ($usr->can('user.create') || $usr->can('user.view')  || $usr->can('user.edit') || $usr->can('user.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Gestion des Utilisateurs
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.users.create') || Route::is('admin.users.index') ||  Route::is('admin.users.edit') ||  Route::is('admin.listblack') || Route::is('admin.users.show') ? 'in' : ''}}">


                            @if ($usr->can('user.view'))
                            <li class="{{ Route::is('admin.users.index') || Route::is('admin.users.edit') ? 'active' : ''}}"><a href="{{ route('admin.users.index')}}">Liste Des Utilisateurs</a></li>
                            @endif



                            @if ($usr->can('user.create'))
                            <li class="{{ Route::is('admin.users.create') ? 'active' : ''  }}"><a href="{{route('admin.users.create')}}">Creer Un Utilisateur</a></li>
                            @endif
                        {{-- --}}

                            @if ($usr->can('user.view'))
                            <li class="{{ Route::is('admin.listblack') ? 'active' : ''  }}"><a href="{{route('admin.listblack')}}">liste Noire</a></li>
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
                            <li class="{{ Route::is('admin.roles.create') ? 'active' : ''  }}"><a href="{{route('admin.roles.create')}}">Ajouter Un Role</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif


                    {{--///////////////////////////////////////////gestion des Etudiants//////////////////////////////////////////--}}

                    @if ($usr->can('etudiants.create') || $usr->can('etudiants.view')  || $usr->can('etudiants.edit') || $usr->can('etudiants.delete') || $usr->can('promotion.create') || $usr->can('promotion.view')  || $usr->can('promotion.edit') || $usr->can('promotion.delete') )
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span> Gestion des Etudiants
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.etudiants.create') || Route::is('admin.etudiants.index') ||  Route::is('admin.etudiants.edit') || Route::is('admin.etudiants.show') ? 'in' : ''}}">


                            @if ($usr->can('etudiants.view'))
                            <li class="{{ Route::is('admin.etudiants.index') || Route::is('admin.etudiants.edit') ? 'active' : ''}}"><a href="{{ route('admin.etudiants.index')}}">Liste Des etudians</a></li>
                            @endif



                           {{-- @if ($usr->can('etudiants.create'))
                            <li class="{{ Route::is('admin.etudiants.create') ? 'active' : ''  }}"><a href="javascript:void(0)" id="create-new-post">Ajouter un Etudiant</a></li>
                            @endif--}}
                            

                          


                        </ul>
                    </li>
                    @endif
                    




                    {{--///////////////////////////////////////////gestion des Inscriptions//////////////////////////////////////////--}}

@if ($usr->can('etudiants.create') || $usr->can('etudiants.view')  || $usr->can('etudiants.edit') || $usr->can('etudiants.delete') || $usr->can('promotion.create') || $usr->can('promotion.view')  || $usr->can('promotion.edit') || $usr->can('promotion.delete') )
<li>
    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span> Gestion des Inscriptions
        </span></a>

         <ul class="collapse {{ Route::is('admin.etudiants.create') || Route::is('admin.etudiants.index') ||  Route::is('admin.etudiants.edit') || Route::is('admin.etudiants.show') ? 'in' : ''}}">


        @if ($usr->can('etudiants.view'))
        <li class="{{ Route::is('admin.etudiants.index') || Route::is('admin.etudiants.edit') ? 'active' : ''}}"><a href="{{ route('admin.etudiants.index')}}">inscrire un etudiant</a></li>
        @endif



       @if ($usr->can('etudiants.create'))
        <li class="{{ Route::is('admin.etudiants.create') ? 'active' : ''  }}"><a href="" id="">Importer fichier d'inscription</a></li>
        @endif
        

      


    </ul>
</li>
@endif








{{--///////////////////////////////////////////gestion des Promotions//////////////////////////////////////////--}}

@if ( $usr->can('promotion.create') || $usr->can('promotion.view')  || $usr->can('promotion.edit') || $usr->can('promotion.delete') )
<li>
    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span> Gestion des Promotion
        </span></a>

         <ul class="collapse {{ Route::is('admin.promotion.create') || Route::is('admin.promotion.index') ||  Route::is('admin.promotion.edit') || Route::is('admin.promotion.show') ? 'in' : ''}}">


        @if ($usr->can('promotion.create')||$usr->can('promotion.view'))
        <li class="{{ Route::is('admin.promotion.index') ? 'active' : ''  }}"><a href="{{route('admin.promotion.index')}}">Gerer Promotion</a></li>
        @endif


    </ul>
</li>
@endif

{{--///////////////////////////////////////////gestion des Notes//////////////////////////////////////////--}}

@if ( $usr->can('notes.create') || $usr->can('notes.view')  || $usr->can('notes.edit') || $usr->can('notes.delete') )
<li>
    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span> Gestion des Notes
        </span></a>

         <ul class="collapse {{ Route::is('admin.notes.create') || Route::is('admin.notes.index') ||  Route::is('admin.notes.edit')||  Route::is('admin.notes.editnote') || Route::is('admin.notes.show') ? 'in' : ''}}">


        @if ($usr->can('notes.create')||$usr->can('notes.view'))
        <li class="{{ Route::is('admin.notes.index') ? 'active' : ''  }}"><a href="{{route('admin.notes.index')}}">Ajouter notes</a></li>
        @endif
        @if ($usr->can('notes.edit')||$usr->can('notes.edit'))
        <li><a href="#" data-toggle="modal" data-target="#editnoteModal">Editer notes</a></li>
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
                       <li class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'active' : ''}}"><a href="{{ route('admin.admins.index')}}">Liste Des administrateurs</a></li>
                            @endif



                            @if ($usr->can('admin.create'))
                            <li class="{{ Route::is('admin.admins.create') ? 'active' : ''  }}"><a href="{{route('admin.admins.create')}}">Ajouter un Administrateur</a></li>
                            @endif


                        </ul>
                    </li>
                    @endif












                    {{--///////////////////////////////////////////Parametre//////////////////////////////////////////--}}

                    @if ($usr->can('Parametre.view')|| $usr->can('Parametre.edit')||
                         $usr->can('cycle.edit')||     $usr->can('cycle.view')||
                         $usr->can('niveau.view')||    $usr->can('niveau.edit') || 
                         $usr->can('classes_etu.view')|| $usr->can('classes_etu.edit')||
                         $usr->can('gmatieres.view')|| $usr->can('gmatieres.edit')||
                         $usr->can('matieres.view')||  $usr->can('matiere.edit')|| 
                         $usr->can('section_classes.view')|| $usr->can('section_classes.edit')|| 
                         $usr->can('annee.view')||        $usr->can('annee.edit')|| 
                         $usr->can('mention.view')||      $usr->can('mention.edit')|| 
                         $usr->can('frais.view')||        $usr->can('frais.edit') || 
                         $usr->can('mfrais.view')||       $usr->can('mfrais.edit')|| 
                         $usr->can('type_exams.view')||   $usr->can('type_exams.edit')|| 
                         $usr->can('type_s_exams.view')|| $usr->can('type_s_exams.edit')|| 
                         $usr->can('filieres.view')|| $usr->can('filieres.edit')|| 
                         $usr->can('specialites.view')|| $usr->can('specialites.edit')|| 
                         $usr->can('evaluations.view')||  $usr->can('evaluations.edit'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span> Parametres de Configuration
                            </span></a>

                             <ul class="collapse {{ Route::is('admin.parametres.index') ||  Route::is('admin.parametres.edit')||
                                                    Route::is('admin.matieres.index') ||    Route::is('admin.matieres.edit')|| 
                                                    Route::is('admin.gmatieres.index') ||   Route::is('admin.gmatieres.edit')|| 
                                                    Route::is('admin.mfrais.index') ||      Route::is('admin.mfrais.edit')||
                                                    Route::is('admin.type_exams.index') ||  Route::is('admin.type_exams.edit') ||  
                                                    Route::is('admin.classes.edit') ||      Route::is('admin.classes.index')||
                                                    Route::is('admin.mention.edit') ||      Route::is('admin.mention.index')||  
                                                    Route::is('admin.sections.edit') ||     Route::is('admin.sections.index')||  
                                                    Route::is('admin.evaluations.edit') ||  Route::is('admin.evaluations.index')||
                                                    Route::is('admin.filieres.edit') ||  Route::is('admin.filieres.index')|| 
                                                    Route::is('admin.specialites.edit') ||  Route::is('admin.specialites.index')|| 
                                                    Route::is('admin.type_s_exams.index') ||Route::is('admin.type_s_exams.edit') ? 'in' : ''}}">


                             @if ($usr->can('annee.view'))
                                <li class="{{ Route::is('admin.annee.index')|| Route::is('admin.annee.create') || Route::is('admin.annee.edit') ? 'active' : ''}}"><a href="{{ route('admin.annee.index')}}">Gerer l'année scolaire</a></li>
                                @endif

                                <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>configuration cycle superieur</span></a>
                            <ul class="collapse">
                            @if ($usr->can('cycle.edit')||  $usr->can('cycle.view')|| $usr->can('niveau.view')||    $usr->can('niveau.edit'))
                                <li class="{{ Route::is('admin.cycles.index')|| Route::is('admin.cycles.create') || Route::is('admin.cycles.edit') ? 'active' : ''}}"><a href="{{ route('admin.cycles.index')}}">Gerer cycle</a></li>
                            @endif
                            @if ($usr->can('niveau.view'))
                                <li class="{{ Route::is('admin.niveaux.index')|| Route::is('admin.niveaux.create') || Route::is('admin.niveaux.edit') ? 'active' : ''}}"><a href="{{ route('admin.niveaux.index')}}">Gerer niveaux</a></li>
                            @endif

                            @if ($usr->can('filieres.view'))
                                <li class="{{ Route::is('admin.filieres.index')|| Route::is('admin.filieres.create') || Route::is('admin.filieres.edit') ? 'active' : ''}}"><a href="{{ route('admin.filieres.index')}}">Gerer les filieres</a></li>
                                @endif

                                @if ($usr->can('specialites.view'))
                                <li class="{{ Route::is('admin.specialites.index')|| Route::is('admin.specialites.create') || Route::is('admin.specialites.edit') ? 'active' : ''}}"><a href="{{ route('admin.specialites.index')}}">Gerer les specialites</a></li>
                                @endif
                               </ul>
                        </li>

                        @if ( $usr->can('classes_etu.view')|| $usr->can('classes_etu.edit')||$usr->can('section_classes.view')|| $usr->can('section_classes.edit')
                       )
                        <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>configuration cycle secondaire</span></a>
                            <ul class="collapse">
                            @if ($usr->can('classes_etu.view'))
                                <li class="{{ Route::is('admin.classes.index')|| Route::is('admin.classes.create') || Route::is('admin.classes.edit') ? 'active' : ''}}"><a href="{{ route('admin.classes.index')}}">Gerer les Classes</a></li>
                                @endif

                                @if ($usr->can('section_classes.view'))
                                <li class="{{ Route::is('admin.sections.index')|| Route::is('admin.sections.create') || Route::is('admin.sections.edit') ? 'active' : ''}}"><a href="{{ route('admin.sections.index')}}">Gerer Section de classes</a></li>
                                @endif
 </ul>
                        </li>
                    @endif

                    @if ( $usr->can('frais.view')||        $usr->can('frais.edit') || 
                         $usr->can('mfrais.view')||       $usr->can('mfrais.edit'))
                        <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>configuration des frais</span></a>
                            <ul class="collapse">
                            @if ($usr->can('frais.view'))
                                <li class="{{ Route::is('admin.frais.index')|| Route::is('admin.frais.create') || Route::is('admin.frais.edit') ? 'active' : ''}}"><a href="{{ route('admin.frais.index')}}">Gerer les categories de Frais de scolarité</a></li>
                                @endif

                                @if ($usr->can('mfrais.view'))
                                <li class="{{ Route::is('admin.mfrais.index')|| Route::is('admin.mfrais.create') || Route::is('admin.mfrais.edit') ? 'active' : ''}}"><a href="{{ route('admin.mfrais.index')}}">Gerer les montants des Frais de scolarité </a></li>
                                @endif </ul>
                        </li>
                    @endif

                    @if ( $usr->can('type_exams.view')||   $usr->can('type_exams.edit')|| 
                         $usr->can('type_s_exams.view')|| $usr->can('type_s_exams.edit')|| 
                         $usr->can('evaluations.view')||  $usr->can('evaluations.edit'))
                        <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>configuration des evaluations</span></a>
                            <ul class="collapse">
                            @if ($usr->can('type_exams.view'))
                                <li class="{{ Route::is('admin.type_exams.index')|| Route::is('admin.type_exams.create') || Route::is('admin.type_exams.edit') ? 'active' : ''}}"><a href="{{ route('admin.type_exams.index')}}">Gerer les Examens</a></li>
                                @endif
                                @if ($usr->can('type_s_exams.view'))
                                <li class="{{ Route::is('admin.type_s_exams.index')|| Route::is('admin.type_s_exams.create') || Route::is('admin.type_s_exams.edit') ? 'active' : ''}}"><a href="{{ route('admin.type_s_exams.index')}}">Gerer les Semestres</a></li>
                                @endif
                                @if ($usr->can('evaluations.view'))
                                <li class="{{ Route::is('admin.evaluations.index')|| Route::is('admin.evaluations.create') || Route::is('admin.evaluations.edit') ? 'active' : ''}}"><a href="{{ route('admin.evaluations.index')}}">Gerer les Evaluations</a></li>
                                @endif

                                @if ($usr->can('mention.view'))
                                <li class="{{ Route::is('admin.mention.index')|| Route::is('admin.mention.create') || Route::is('admin.mention.edit') ? 'active' : ''}}"><a href="{{ route('admin.mention.index')}}">Gerer Mentions scolaires</a></li>
                                @endif

                            </ul>
                        </li>
                    @endif

                    
                    @if (  $usr->can('gmatieres.view')|| $usr->can('gmatieres.edit')||
                         $usr->can('matieres.view')||  $usr->can('matiere.edit'))
                        <li class="active">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>configuration des cours</span></a>
                            <ul class="collapse">
                            @if ($usr->can('gmatieres.view'))
                                <li class="{{ Route::is('admin.gmatieres.index')|| Route::is('admin.gmatieres.create') || Route::is('admin.gmatieres.edit') ? 'active' : ''}}"><a href="{{ route('admin.gmatieres.index')}}">Gerer les matieres par groupe</a></li>
                                @endif

                                @if ($usr->can('matieres.view'))
                                <li class="{{ Route::is('admin.matieres.index')|| Route::is('admin.matieres.create') || Route::is('admin.matieres.edit') ? 'active' : ''}}"><a href="{{ route('admin.matieres.index')}}">Gerer les Matieres</a></li>
                                @endif
                                
                                @if ($usr->can('assmatiereas.view'))
                                <li class="{{ Route::is('admin.assmatiereas.index')|| Route::is('admin.assmatiereas.create') || Route::is('admin.assmatiereas.edit') ? 'active' : ''}}"><a href="{{ route('admin.assmatiereas.index')}}" data-toggle="modal" data-target="#exampleModal">Configuration des Matieres par classe</a></li>
                                @endif

                            </ul>
                        </li>
                    @endif

                                
                              
                              

                               
                                
                                                                                                                                                                                                                                                                            
                                @if ($usr->can('Parametre.view'))
                                <li class="{{ Route::is('admin.parametres.index') || Route::is('admin.parametres.edit') ? 'active' : ''}}"><a href="{{ route('admin.parametres.index')}}">Gerer Parametre du site</a></li>
                                @endif

                               


                        </ul>
                    </li>
                    @endif









                </ul>
            </nav>
        </div>
    </div>
</div>
