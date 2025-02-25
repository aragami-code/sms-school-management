<?php

namespace App\Http\Controllers\Etudiants;

//use App\Etats;
use Carbon\Carbon;
use App\FormationEmp;
use App\Http\Controllers\Controller;
use App\Models\Etudiants;
//use App\NiveauEtude;
use App\Parametres;
use App\TypEmp;
use App\ContratEmp;
use App\Regions;
use App\Villes;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EtudiantsProfileController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('Etudiants')->user();
            return $next($request);

        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (is_null($this->user)) {
            $parametre = Parametres::first();
            return view('etudiants.auth.login',compact('parametre'));
        }else{

            $user = Auth::user();
  //      $diplome = FormationEmp::all();
    //    $Region = Regions::all();
        $parametre = Parametres::first();
        return view('etudiants.pages.profile.index', compact('user','parametre'));



        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom_famille' => 'required|max:50',
            'prenom' => 'required|max:50',
            'date_naiss' => 'required|max:50',
            'telephone' => 'required|max:50',
            'metier' => 'required|max:50',
            //'description' => 'required|min:50',
            'genre' => 'required|max:50',
            'statut_marital' => 'required|max:50',
         'type_emploi_sollicite' => 'required|max:50',
         'type_contrat_sollicite' => 'required|max:50',
        'distance_minimum' => 'required|max:50',
            'region' => 'required|max:50',
            'ville' => 'required|max:50',
            //'post_code' => 'required|max:50',
            //'adresse' => 'required|max:50',
            'experience' => 'required|max:50',
            'niveau_ecole' => 'required|max:50',
            'email' => 'required|max:100|email,',
           // 'password_confirmation' => 'required'
            ],

            [
            'nom_famille.required' => 'Le nom de famille est obligatoire.',
            'prenom.required' => 'Le prenom est obligatoire.',
            'date_naiss.required' => 'La date de naissance est obligatoire.',
            'telephone.required' => 'Le numéro télephone est obligatoire.',
             'metier.required' => 'Votre métier est obligatoire.',
            //'description.required' => 'Description nom est obligatoire',
            //'genre.required' => 'sexe est obligatoire',
            //'statut_marital.required' => 'le statut  est obligatoire',
            'type_emploi_sollicite' => 'Type de travail sollicité  est obligatoire.',
            'type_contrat_sollicite' => 'Type de contrat sollicité  est obligatoire.',
            'distance_minimum' => 'Une distance minumium  est obligatoire.',
             'region.required' => 'Votre région est obligatoire.',
            'ville.required' => 'Votre  Département est  obligatoire.',
            //'post_code.required' => 'le code postale est obligatoire',
           // 'adresse.required' => 'votre addresse est obligatoire',
            'experience.required' => 'Votre experience est obligatoire.',
           'niveau_ecole.required' => 'Votre niveau scolaire actuel est obligatoire.']);

          // creer un nouvel Utilisateur
          $user = new Etudiants();
          $user->nom_famille = $request->nom_famille;
          $user->prenom = $request->prenom;
          $user->date_naiss = $request->date_naiss;
          $user->telephone = $request->telephone;
          $user->metier = $request->metier;
          //$user->description = $request->description;
          //$user->genre = $request->genre;
           if($request->date_naiss!=""){
            $le_age = $request->date_naiss;
            $datage = Carbon::parse($le_age)->diff(Carbon::now())->format('%y years,%m months and %d days');

          }
          $user->age =  $datage;
         // $user->statut_marital = $request->statu_marital;
          $user->type_emploi_sollicite = $request->type_emploi_sollicite;
          $user->type_contrat_sollicite = $request->type_contrat_sollicite;
          $user->distance_minimum = $request->distance_minimum;
          $user->region = $request->region;
          $user->ville = $request->ville;
          //$user->post_code = $request->post_code;
         // $user->adresse = $request->adresse;
          $user->experience = $request->experience;
          $user->niveau_ecole = $request->niveau_ecole;

          if($request->hasfile('resume_cv')){
            $file = $request->file('resume_cv');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('user/images/Cv/', $filename);
            $user->resume_cv = $filename;
              }/*else{
                $img = $request->input('resume_cv2');
                DB::update('update chercheurs set resume_cv = ? where id = ?', [$img,$id]);
              }*/


          $user->save();


         session()->flash('success', 'Votre profil a été modifié avec succès !');
         $parametre = Parametres::first();

         return view('etudiants.auth.registration',compact('user','parametre'));
       // return redirect()->route('chercheur.profile.index');



    }


    public function show($id)
    {

        $emploispost = DB::select('select post_emploi_id from emploi__postulers where user_id = ?', [$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if(is_null($this->user)){
            $parametre = Parametres::first();
            return view('etudiants.auth.login',compact('parametre'));


        }else{

            //
        $id = Crypt::decrypt($id);
        $user = Etudiants::find($id);
      //  $diplome = FormationEmp::all();
        //$Region = Regions::all();

        //$typem = TypEmp::all();
       //$typecontr = ContratEmp::all();

        //$titi = Chercheur::wherePassword()
        $parametre = Parametres::first();
        return view('etudiants.pages.profile.edit', compact('user','parametre'));


        }

    }

    public function edite($id)
    {

        if(is_null($this->user)){
            return view('etudiants.auth.login');


        }else{

            //
        $id = Crypt::decrypt($id);
        $user = Etudiants::find($id);
       // $diplome = FormationEmp::all();
        //$Region = Regions::all();

        //$titi = Chercheur::wherePassword()
        $parametre = Parametres::first();
        return view('chercheur.pages.profile.profil', compact('user','parametre'));


        }

    }

/*
    public function findEtat($id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{
            $region = Regions::where('etat_id',$id)->pluck("nom_region","id");


            return json_encode($region);



        }


    }*/



/*
    public function findRegion($id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

              $ville = Villes::where('region_id',$id)->pluck("nom_ville","id");

                return json_encode($ville);



        }


    }
*/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(is_null($this->user)){
            $parametre = Parametres::first();
            return view('etudiants.auth.login',compact('parametre'));


        }else{
        // validation data

       // $id = Crypt::decrypt($id);

        $request->validate([
            'username' => 'required|max:50',
            'email' => 'required|max:100|email|unique:chercheurs,email,'.$id,
            'password' => 'nullable|between:8,255|confirmed',
            'photo' => 'mimes:jpeg,bmp,png,jpg',

           // 'password_confirmation' => 'required'
            ],

            [
            'username.required' => 'Le nom utilisateur est obligatoire.',
            'email.required' => 'L\'E-mail est obligatoire.',
            'photo' => 'Une image est necessaire respectant les formats jpeg , png , jpg, ou bmp.',
            'password.required' => 'Le mot de passe est obligatoire commencer à partir de 8 caracteres.']);

          // creer un nouvel Utilisateur
          $user = Etudiants::find($id);
          $user->username = $request->username;
          $user->email = $request->email;

          if($request->password){
            $user->password = Hash::make($request->password);
          }


            if($request->hasfile('photo')){
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('user/images/Etudiants/', $filename);
                $user->photo = $filename;
                  }else{
                    $img = $request->input('photo2');
                    DB::update('update etudiants set photo = ? where id = ?', [$img,$id]);
                  }

          $user->save();


         session()->flash('success', 'Etudiant  modifié avec succès !');

         //return view('chercheur.pages.profile.',compact('user'));
         $parametre = Parametres::first();
         return redirect()->route('etudiants.profile.index',compact('parametre'));


        }

    }

    public function upinfo(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('etudiants.auth.login');


        }else{
        // validation data
        //$typem = TypEmp::all();
        //$typecontr = ContratEmp::all();
        $request->validate([
            'nom_famille' => 'required|max:50',
            'prenom' => 'required|max:50',
            'date_naiss' => 'required|max:50',
            'telephone' => 'required|max:50',
           // 'nationalite' => 'required|max:50',
            'metier' => 'required|max:50',
            'description' => 'required|min:50',
            //'genre' => 'required|max:50',
            //'statut_marital' => 'required|max:50',
            'type_emploi_sollicite' => 'required|max:50',
            'type_contrat_sollicite' => 'required|max:50',
            'distance_minimum' => 'required|max:50',
            //'pays' => 'required|max:50',
            'region' => 'required|max:50',
            'ville' => 'required|max:50',
            //'post_code' => 'required|max:50',
            //'adresse' => 'required|max:50',
            'experience' => 'required|max:50',
            'niveau_ecole' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,'.$id,
            'resume_cv' => 'mimes: word,pdf',
           // 'password_confirmation' => 'required'
            ],

            [
            'nom_famille.required' => 'Le nom de famille est obligatoire.',
            'prenom.required' => 'Le prenom est obligatoire.',
            'date_naiss.required' => 'La date de naissance est obligatoire.',
            'telephone.required' => 'Le téléphone est obligatoire.',
            //'nationalite.required' => 'la nationalité est obligatoire',
            'metier.required' => 'Votre métier est obligatoire.',
           // 'description.required' => 'Description nom est obligatoire.',
            //'genre.required' => 'sexe est obligatoire',
            //'statut_marital.required' => 'le statut  est obligatoire',
            'type_emploi_sollicite' => 'Type de travail sollicité  est obligatoire.',
            'type_contrat_sollicite' => 'Type de contrat sollicité  est obligatoire.',
            'distance_minimum' => 'Distance minumium  est obligatoire.',
            //'pays.required' => 'votre pays  est obligatoire',
            'region.required' => 'Votre region obligatoire.',
            'ville.required' => 'Département obligatoire.',
            //'post_code.required' => 'le code postale est obligatoire',
            //'adresse.required' => 'votre addresse est obligatoire',
            'experience.required' => 'Votre experience est obligatoire.',
           'niveau_ecole.required' => 'Votre niveau scolaire nom est obligatoire.',
           'resume_cv' => 'Votre CV doit respecter les formats PDF ou Word.'
           ]);

          // creer un nouvel Utilisateur
          $user = Etudiants::find($id);
          $user->nom_famille = $request->nom_famille;
          $user->prenom = $request->prenom;
          $user->date_naiss = $request->date_naiss;
          $user->telephone = $request->telephone;
          $user->metier = $request->metier;
          $user->description = $request->description;
          //$user->genre = $request->genre;
         // $user->age = $request->age;

          if($request->date_naiss!=""){
            $le_age = $request->date_naiss;
            $datage = Carbon::parse($le_age)->diff(Carbon::now())->format('%y ans');

          }
          $user->age =  $datage;



          //$user->statut_marital = $request->statu_marital;
          $user->type_emploi_sollicite = $request->type_emploi_sollicite;
          $user->type_contrat_sollicite = $request->type_contrat_sollicite;
          $user->distance_minimum = $request->distance_minimum;
          //$user->pays = $request->pays;
          $user->region = $request->region;
          $user->ville = $request->ville;
          //$user->post_code = $request->post_code;
          //$user->adresse = $request->adresse;
          $user->experience = $request->experience;
          $user->niveau_ecole = $request->niveau_ecole;
/*
          if($request->hasfile('resume_cv')){
            $file = $request->file('resume_cv');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('user/images/Cv/', $filename);
            $user->resume_cv = $filename;
              }else{
                $img = $request->input('resume_cv2');
                DB::update('update chercheurs set resume_cv = ? where id = ?', [$img,$id]);
              }

*/

          $user->save();


         session()->flash('success', 'Profil modifié avec succès !');

        // return view('chercheur.pages.profile.index',compact('user'));
        $parametre = Parametres::first();
        return redirect()->route('etudiants.profile.index',compact('parametre'));


        }

    }


    public function upinfocv(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('etudiants.auth.login');


        }else{
        // validation data

        $request->validate([
            'resume_cv' => 'mimes: word,pdf',
           // 'password_confirmation' => 'required'
            ],

            [
           'resume_cv' => 'Votre CV doit respecter les formats PDF ou Word.'
           ]);

          // creer un nouvel Utilisateur
          $user = Etudiants::find($id);
          if($request->hasfile('resume_cv')){
            $file = $request->file('resume_cv');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('user/images/Cv/', $filename);
            $user->resume_cv = $filename;
              }else{
                $img = $request->input('resume_cv2');
                DB::update('update etudiants set resume_cv = ? where id = ?', [$img,$id]);
              }



          $user->save();


         session()->flash('success', 'Cv téléchargé avec succès !');

        // return view('chercheur.pages.profile.index',compact('user'));
        $parametre = Parametres::first();
        return redirect()->route('etudiants.profile.index',compact('parametre'));


        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
