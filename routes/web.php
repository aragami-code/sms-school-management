<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('','Home\HomeController@Acceuil')->name('accueil');
//Route::get('/acceuil','Home\HomeController@Acceuil1')->name('accueil1');
//Route::get('/about','Home\HomeController@About')->name('about');
//Route::get('/faq','Home\HomeController@Faq')->name('faq');
//Route::get('/preface','Home\HomeController@preface')->name('preface');
//Route::get('/contact','Home\HomeController@Contact')->name('contact');
//Route::post('/contact/send','Home\HomeController@send');
//Route::get('/carriere','Home\HomeController@Carriere')->name('carriere');
//Route::get('/connexion','Home\HomeController@Connexion')->name('connexion');
//Route::get('/carriere/{id}','Home\HomeController@carriereinfo')->name('carriereinfo');
//Route::get('/Recherche','Home\HomeController@resultatRecherche')->name('resultatRecherche');
//Route::get('/actualite','Home\HomeController@Actualite')->name('actualite');
//Route::get('findRegion/{id}','Home\HomeController@findRegion')->name('findregions');

//Route::get('/password/reset','Chercheur\Auth\ReinitialiserController@initialiser')->name('chercheur.password.request');
//Route::get('/password/initaliserpass','Chercheur\Auth\ReinitialiserController@login')->name('chercheur.password.reinitialiser');
//Route::get('/password/initaliserpass1/{email}','Chercheur\Auth\ReinitialiserController@regen')->name('chercheur.password.regen');
//Route::put('/password/initaliserpass12/{id}','Chercheur\Auth\ReinitialiserController@update')->name('chercheur.password.update');
//Route::post('user/password/reset/submit','Chercheur\Auth\ForgotPasswordController@reset')->name('chercheur.password.update');


//Route::get('/home','Home\HomeController@Home')->name('home');

/*
* admin Routes
*/



//Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => 'nocache','prefix' => 'admin',], function () {
        Route::get('/dashboard', 'Backend\DashboardController@index')->name('admin.dashboard');
        Route::resource('/roles','Backend\RolesController', ['names' => 'admin.roles']);
        Route::resource('/users','Backend\UsersController', ['names' => 'admin.users']);
        Route::resource('/admins','Backend\AdminsController', ['names' => 'admin.admins']);
        Route::resource('/bcategories','Backend\BcategoryController', ['names' =>'admin.bcategories']);
        Route::resource('/articles','Backend\ArticlesController', ['names' =>'admin.articles']);

        Route::resource('/profile','Backend\AdminsProfileController', ['names' => 'admin.adminprofile']);
        Route::put('/user/{users} ','Backend\UsersController@blackl')->name('admin.users.blackl');
        Route::put('/uses/{users} ','Backend\UsersController@unblackl')->name('admin.users.unblackl');
        Route::get('/liste','Backend\UsersController@listblack')->name('admin.listblack');


        Route::resource('/parametres','Backend\ParametresController', ['names' =>'admin.parametres']);


        
/****************************************************Gerer les CYCLES**********************************************************************************/
Route::resource('/cycles','Backend\CyclesController', ['names' =>'admin.cycles']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/cycles/delete/{id}','Backend\CyclesController@delete')->name('admin.cycles.delete');


/****************************************************Gerer les niveaux**********************************************************************************/
Route::resource('/niveaux','Backend\LevelsController', ['names' =>'admin.niveaux']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/niveaux/delete/{id}','Backend\LevelsController@delete')->name('admin.niveaux.delete');


/****************************************************Gerer les Classes**********************************************************************************/
        Route::resource('/classes','Backend\ClassesController', ['names' =>'admin.classes']);
        //Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
        Route::post('/classes/delete/{id}','Backend\ClassesController@delete')->name('admin.classes.delete');





/******************************************************Gerer l'annee Academique********************************************************************************/
        Route::resource('/annee','Backend\AnneeController', ['names' =>'admin.annee']);
        //Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
        Route::post('/annee/delete/{id}','Backend\AnneeController@delete')->name('admin.annee.delete');


/******************************************************Gerer section de classes********************************************************************************/
Route::resource('/sections','Backend\SectionsController', ['names' =>'admin.sections']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::get('/sections_edit/{id}/edit','Backend\SectionsController@editsection')->name('admin.sections.editsection');

Route::post('/sections/delete/{id}','Backend\SectionsController@delete')->name('admin.sections.delete');

/******************************************************Gerer section de filieres********************************************************************************/
Route::resource('/filieres','Backend\FilieresController', ['names' =>'admin.filieres']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::get('/filieres_edit/{id}/edit','Backend\FilieresController@editfilieres')->name('admin.filieres.editfilieres');

Route::post('/filieres/delete/{id}','Backend\FilieresController@delete')->name('admin.filieres.delete');

/******************************************************Gerer specialite********************************************************************************/
Route::resource('/specialites','Backend\SpecialitesController', ['names' =>'admin.specialites']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::get('/specialites_edit/{id}/edit','Backend\SpecialitesController@editspecialite')->name('admin.specialites.editspecialite');

Route::post('/specialites/delete/{id}','Backend\SpecialitesController@delete')->name('admin.specialites.delete');


/******************************************************Gerer mention academique********************************************************************************/
Route::resource('/mention','Backend\MentionController', ['names' =>'admin.mention']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/mention/delete/{id}','Backend\MentionController@delete')->name('admin.mention.delete');


/******************************************************Gerer les categories de frais********************************************************************************/
Route::resource('/frais','Backend\FraisController', ['names' =>'admin.frais']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/frais/delete/{id}','Backend\FraisController@delete')->name('admin.frais.delete');


/******************************************************Gerer les montants des frais********************************************************************************/
Route::resource('/mfrais','Backend\MFraisController', ['names' =>'admin.mfrais']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/mfrais/delete/{id}','Backend\MFraisController@delete')->name('admin.mfrais.delete');


/******************************************************Gerer les Examens********************************************************************************/
Route::resource('/type_exams','Backend\TypeExamController', ['names' =>'admin.type_exams']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/type_exams/delete/{id}','Backend\TypeExamController@delete')->name('admin.type_exams.delete');


/******************************************************Gerer les Examens Semestre********************************************************************************/
Route::resource('/type_s_exams','Backend\Type_S_ExamController', ['names' =>'admin.type_s_exams']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/type_s_exams/delete/{id}','Backend\Type_S_ExamController@delete')->name('admin.type_s_exams.delete');


/******************************************************Gerer les Matieres********************************************************************************/
Route::resource('/matieres','Backend\MatiereController', ['names' =>'admin.matieres']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/matieres/delete/{id}','Backend\MatiereController@delete')->name('admin.matieres.delete');

/******************************************************Gerer les Groupe de matieres********************************************************************************/
Route::resource('/gmatieres','Backend\GMatiereController', ['names' =>'admin.gmatieres']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/gmatieres/delete/{id}','Backend\GMatiereController@delete')->name('admin.gmatieres.delete');

/******************************************************Gerer les Evaluations********************************************************************************/
Route::resource('/evaluations','Backend\EvaluationsController', ['names' =>'admin.evaluations']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/evaluations/delete/{id}','Backend\EvaluationsController@delete')->name('admin.evaluations.delete');

/******************************************************Gerer les droits scolaires********************************************************************************/
Route::resource('/scolarites','Backend\ScolaritesController', ['names' =>'admin.scolarites']);
Route::post('/scolarites/sco','Backend\ScolaritesController@p_store')->name('admin.scolarites.p_store');
Route::get('/scolarites/scol/{id}','Backend\ScolaritesController@scol')->name('admin.scol');
Route::get('/scolarites/pdf/{id}','Backend\ScolaritesController@print')->name('admin.scol.pdf');
Route::get('/recu_pdf','Backend\ScolaritesController@createPDFI')->name('admin.scolarite_recui');
Route::get('/reu_pdf','Backend\ScolaritesController@createPDF')->name('admin.scolarite_recu');
Route::get('/scolarites/{id}/reu_pdf','Backend\ScolaritesController@createPDFR')->name('admin.scolarite_recu_payement');
//Route::get('/scolarites/scol/{id}','Backend\ScolaritesController@scol')->name('admin.scol');
Route::get('/scolarites/{id}/sc','Backend\ScolaritesController@edp')->name('admin.scolp');
Route::get('/scolarites/{id}/s_c','Backend\ScolaritesController@ed_p')->name('admin.scol_p');
Route::post('/scolarites/delete/{id}','Backend\ScolaritesController@delete')->name('admin.scolarites.delete');

/******************************************************Gerer les Notess********************************************************************************/
Route::resource('notes','Backend\NotesController', ['names' =>'admin.notes']);
Route::resource('note_eds','Backend\Notes_EdController', ['names' =>'admin.note_eds']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('notes/delete/{id}','Backend\NotesController@delete')->name('admin.notes.delete');
Route::get('notes/assmatiereas/{id}','Backend\NotesController@assmatiereas')->name('admin.assmatiereas.note');
Route::get('notes/gassmatiereas/{id}','Backend\NotesController@gassmatiereas')->name('admin.gassmatiereas.note');
Route::get('notes/promotions/{id}','Backend\NotesController@promotions')->name('admin.promotion.note');
Route::get('notes/btn/{$id_annee}','Backend\NotesController@btn')->name('admin.btn.note');
Route::get('/Editer_Note','Backend\NotesController@NoteStudentEdit')->name('admin.notes.editnote');
//Route::post('/Editer_Note','Backend\NotesController@updatestud')->name('admin.notes.updatestud');


/******************************************************Gerer les Groupe de matieres********************************************************************************/
Route::resource('/assmatiereas','Backend\AssmatiereASController', ['names' =>'admin.assmatiereas']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/assmatiereas/delete/{id}','Backend\AssmatiereASController@delete')->name('admin.assmatiereas.delete');
Route::get('/assmatiereas/assmatiereas/{id}','Backend\AssmatiereASController@assmatiereas')->name('admin.assmatiereas');

/******************************************************Gerer les Etudiant********************************************************************************/
Route::resource('/etudiants','Backend\EtudiantsController', ['names' =>'admin.etudiants']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::post('/etudiants/delete/{id}','Backend\EtudiantsController@delete')->name('admin.etudiants.delete');
Route::get('/etudiants/etudiants/{id}','Backend\EtudiantsController@etudiants')->name('admin.etudiants');
Route::get('/etudiants/Recherche/{id_annee}{id_class}{id_section}','Backend\EtudiantsController@resultatRecherche')->name('admin.resultatRecherche');

/******************************************************Gerer Promotion********************************************************************************/
Route::resource('/promotion','Backend\PromotionController', ['names' =>'admin.promotion']);
//Route::post('admin/classes/{class}/update','Backend\ClassesController@updat')->name('admin.classes.updat');
Route::get('/promotion/users_list', 'Backend\PromotionController@usersList')->name('admin.promotion.userlist');
Route::get('/promotion/promotions/{id}','Backend\PromotionController@promotions')->name('admin.promotion');
//Route::get('/promotion/users_list/{id_annee}/{id_classe}/{id_section}','Backend\PromotionController@usersList')->name('admin.promotion.userlist');
Route::post('/promotion/delete/{id}','Backend\PromotionController@delete')->name('admin.promotion.delete');
//Route::get('/promotion/Recherche/{id_annee}{id_class}{id_section}','Backend\EtudiantsController@resultatRecherche')->name('admin.resultatRecherche');





        //login
        Route::get('/login','Backend\Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('/login/submit','Backend\Auth\LoginController@Login')->name('admin.login.submit');


        //logout
        Route::post('/logout/submit','Backend\Auth\LoginController@Logout')->name('admin.logout.submit');


        //forgot password
        Route::get('/password/reset','Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset/submit','Backend\Auth\ForgotPasswordController@reset')->name('admin.password.update');
        });
//});

//Route::get('/login','Etudiants\Auth\LoginController@index')->name('login');





//login
Route::get('/login','Etudiants\Auth\LoginController@showLoginForm')->name('etudiant.login');
Route::post('/login/submit','Etudiants\Auth\LoginController@Login')->name('etudiants.login.submit');

//Route::group(['prefix' => 'etudiant'], function(){
Route::group(['middleware' => 'nocache','prefix' => 'etudiant',], function () {
 //Route::group(['middleware' => 'nocache'], function () {
Route::get('user/dashboard', 'Etudiants\DashboardController@index')->name('etudiants.dashboard');


        //login
      //  Route::get('user/login','Chercheur\Auth\LoginController@showLoginForm')->name('chercheur.login');
      //  Route::post('user/login/submit','Chercheur\Auth\LoginController@Login')->name('chercheur.login.submit');


        // register

    //   Route::get('/Enregistrement','Chercheur\ChercheurRegisterController@index')->name('chercheur.register');
  //     Route::post('/Enregistrement/create','Chercheur\ChercheurRegisterController@store')->name('chercheur.register.create');



        //logout
//        Route::post('user/logout/submit','Chercheur\Auth\LoginController@Logout')->name('chercheur.logout.submit');

        //profile

      //  Route::resource('user/profile','Chercheur\ChercheursProfileController', ['names' => 'chercheur.profile']);
        //Route::post('user/profile/{profile}','Chercheur\ChercheursProfileController@upinfo')->name('chercheur.profile.upinfo');
        //Route::post('user/profil/{profile}','Chercheur\ChercheursProfileController@upinfocv')->name('chercheur.profile.upinfocv');

        //Route::get('user/profile/{profile}/edite','Chercheur\ChercheursProfileController@edite')->name('chercheur.profile.edite');






        //forgot password
        //Route::get('user/password/reset','Chercheur\Auth\ReinitialiserController@initialiser')->name('chercheur.password.request');
        //Route::get('user/password/initaliserpass','Chercheur\Auth\ReinitialiserController@login')->name('chercheur.password.reinitialiser');
        //Route::get('user/password/initaliserpass1/{email}','Chercheur\Auth\ReinitialiserController@regen')->name('chercheur.password.regen');
       // Route::post('user/password/reset/submit','Chercheur\Auth\ForgotPasswordController@reset')->name('chercheur.password.update');
       
});
