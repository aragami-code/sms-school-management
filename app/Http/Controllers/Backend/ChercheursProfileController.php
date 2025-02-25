<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Chercheur;
use App\Parametres;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ChercheursProfileController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
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

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('admin.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //  $user = Auth::user();
//        $diplome = FormationEmp::all();
  //      $pays = Etats::all();

        $parametre = Parametres::first();
        return view('chercheur.pages.profile.index', compact('parametre'));



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
    public function store(Request $request)
    {



        // validation data

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            return view('backend.auth.login');


        }else{

/**/
        $user = DB::table('chercheurs')->where('id',$id)->first();
        //->join('regions','regions.id','=','chercheurs.region')
        //->join('villes','villes.id','=','chercheurs.ville')
        /*->select('chercheurs.name','chercheurs.nom_famille','chercheurs.prenom','chercheurs.date_naiss','chercheurs.telephone','chercheurs.metier','chercheurs.description',
        'chercheurs.genre','chercheurs.statut_marital','chercheurs.post_code','chercheurs.adresse','chercheurs.experience',
        'chercheurs.niveau_ecole','chercheurs.email','chercheurs.photo',
        )*///->where('chercheurs.id',$id)->get();
        /*

        $diplome = DB::table('niveau_etudes')
        ->join('chercheurs','chercheurs.id','=','niveau_etudes.user_id')
         ->select('niveau_etudes.titre_niveau','niveau_etudes.option','niveau_etudes.institution','niveau_etudes.annee',
        )->where('niveau_etudes.user_id',$id)->get();

        $Exp = DB::table('experience_pros')
        ->join('chercheurs','chercheurs.id','=','experience_pros.user_id')
         ->select('experience_pros.titre_job','experience_pros.entreprise','experience_pros.date_debut','experience_pros.date_fin','experience_pros.mission',
        )->where('experience_pros.user_id',$id)->get();

        $Compe = DB::table('competences')
        ->join('chercheurs','chercheurs.id','=','competences.user_id')
         ->select('competences.competences_user','competences.niveau',
        )->where('competences.user_id',$id)->get();*/




        //$parametre = Parametres::first();
       // return view('backend.pages.emploipostuler.index', compact('Emplois_Postuler','parametre'));

            //
       // $user = Chercheur::find($id);
       // $diplome = FormationEmp::all();

        $parametre = Parametres::first();
        return view('backend.pages.emploipostuler.voircv', compact('parametre'));


        }

    }


  /*  public function findEtat($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('admin.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            $region = Regions::where('etat_id',$id)->pluck("nom_region","id");


            return json_encode($region);



        }


    }
*/



 /*   public function findRegion($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('admin.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

              $ville = Villes::where('region_id',$id)->pluck("nom_ville","id");

                return json_encode($ville);



        }


    }*/

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
            return view('backend.auth.login');


        }elseif(!$this->user->can('admin.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
        // validation data

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,'.$id,
            'password' => 'nullable|between:8,255|confirmed',
            'photo' => 'mimes:jpeg,bmp,png,jpg',

           // 'password_confirmation' => 'required'
            ],

            [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'E-mail est obligatoire.',
            'photo' => 'Une image est necessaire respectant les formats jpeg , png , jpg, ou bmp.',
            'password.required' => 'Le mot de passe est obligatoire commencer à partir de 8 caracteres.']);

          // creer un nouvel Utilisateur
          $user = Chercheur::find($id);
          $user->name = $request->name;
          $user->email = $request->email;

          if($request->password){
            $user->password = Hash::make($request->password);
          }


            if($request->hasfile('photo')){
                $file = $request->file('photo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('user/images/Chercheur/', $filename);
                $user->photo = $filename;
                  }else{
                    $img = $request->input('photo2');
                    DB::update('update chercheurs set photo = ? where id = ?', [$img,$id]);
                  }

          $user->save();


         session()->flash('success', 'Utilisateur modifié avec succes !');

         //return view('chercheur.pages.profile.',compact('user'));
         return redirect()->route('chercheur.profile.index');


        }

    }

    public function updateinfo(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('admin.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
        // validation data

        $request->validate([
            'name' => 'required|max:50',
            'nom_famille' => 'required|max:50',
            'prenom' => 'required|max:50',
            'date_naiss' => 'required|max:50',
            'telephone' => 'required|max:50',
            //'nationalite' => 'required|max:50',
            'metier' => 'required|max:50',
            //'description' => 'required|min:50',
            //'genre' => 'required|max:50',
            //'statut_marital' => 'required|max:50',
            //'pays' => 'required|max:50',
            'region' => 'required|max:50',
            'ville' => 'required|max:50',
            'type_emploi_sollicite' => 'required|max:50',
            'type_contrat_sollicite' => 'required|max:50',
            'experience' => 'required|max:50',
            'niveau_ecole' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,'.$id,
           // 'password_confirmation' => 'required'
            ],

            ['name.required' => 'Le nom est obligatoire.',

            'nom_famille.required' => 'Le nom de famille est obligatoire.',
            'prenom.required' => 'Le prenom est obligatoire.',
            'date_naiss.required' => 'La date de naissance est obligatoire.',
            'telephone.required' => 'Le numéro de telephone est obligatoire.',
            //'nationalite.required' => 'la nationalité est obligatoire',
            'metier.required' => 'Votre profession est obligatoire.',
            //'description.required' => ' nom est obligatoire.',
            //'genre.required' => 'sexe est obligatoire',
            //'statut_marital.required' => 'le statut  est obligatoire',
            //'pays.required' => 'votre pays  est obligatoire',
            'region.required' => 'votre etat obligatoire',
            'ville.required' => 'la ville obligatoire',
            'type_emploi_sollicite.required' => 'le code postale est obligatoire',
            'type_contrat_sollicite.required' => 'votre addresse est obligatoire',
            'experience.required' => 'votre experience est obligatoire',
           'niveau_ecole.required' => 'votre niveau scolaire nom est obligatoire']);

          // creer un nouvel Utilisateur
          $user = Chercheur::find($id);
          $user->nom_famille = $request->nom_famille;
          $user->prenom = $request->prenom;
          $user->date_naiss = $request->date_naiss;
          $user->telephone = $request->telephone;
          $user->metier = $request->metier;
          //$user->description = $request->description;
          //$user->genre = $request->genre;
          //$user->statut_marital = $request->statu_marital;
          //$user->pays = $request->pays;
          $user->region = $request->region;
          $user->ville = $request->ville;
          $user->type_emploi_sollicite = $request->type_emploi_sollicte;
          $user->type_contrat_sollicite = $request->type_contrat_sollicite;
          $user->experience = $request->experience;
          $user->niveau_ecole = $request->niveau_ecole;


          $user->save();


         session()->flash('success', ' Utilisateur modifié avec succes !');

        // return view('chercheur.pages.profile.index',compact('user'));
        return redirect()->route('chercheur.profile.index');


        }

    }


//
  //  public function resultatRecherche(Request $request){


       // $us = new Chercheur;
    //    $us->getEmailForPasswordReset() = $request->titre_post_emploi;
//$PostEmplois->photo;


//$cher = DB::table('post__emplois')
//->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
//->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
//->select('titre_post_emploi', 'id_region_post_emploi', 'id_ville_post_emploi')
//->where('titre_post_emploi',$Emp->titre_post_emploi,'id_region_post_emploi',$Emp->id_region_post_emploi,'id_ville_post_emploi',$Emp->id_ville_post_emploi)->get();

//$cher = DB::select("select * from post__emplois WHERE titre_post_emploi LIKE '%$Emp->titre_post_emploi%' AND id_region_post_emploi  = '$Emp->id_region_post_emploi' AND id_ville_post_emploi  = '$Emp->id_ville_post_emploi' limit 8");

//$cher = Post_Emploi::orderBy('id','desc')->where('titre_post_emploi','id_region_post_emploi','id_ville_post_emploi',$Emp->titre_post_emploi,$Emp->id_region_post_emploi,$Emp->id_ville_post_emploi)->paginate(8);
// le bon $cher = Chercheur::whereRaw('titre_post_emploi like ? and id_region_post_emploi = ? and id_ville_post_emploi = ?',["%{$Emp->titre_post_emploi}%",$Emp->id_region_post_emploi,$Emp->id_ville_post_emploi])->paginate(2);
//)->where('experience_pros.user_id',$id)->get();


           // $chercheur = Chercheur::select('drop table users');
          //$PostEmplois

         // $Emplois_Postuler = Emploi_Postuler::all();
     // $tet =   DB::select('select * from users where active = ?', [1]);


         // $Emplois_Postuler = Emploi_Postuler::all();
      //   $parametre = Parametres::first();
        //  return view('chercheur.pages.dashboard.search', compact('parametre'));






    //}


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
