<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\Etudiants;
use App\Parametres;
use App\Annees;
use App\Classes;
use App\Sections;
use App\Promotions;
use App\MontantFrais;
use App\Scolarites;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EtudiantsController extends Controller
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
    public function index(Request $request)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('etudiants.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //  $user = Auth::user();
//        $diplome = FormationEmp::all();
      
        $data['parametre'] = Parametres::first();
        $data['classes'] = Classes::all();
       // $data['etudiant'] = Etudiants::all();
       
       $id_annee = $request->id_annee;//contrat
       $classe_admi = $request->classe_admi;//secteur d'activité
       $section_admi = $request->section_admi;//periode
        if(request()->ajax())
        {
           
            if(!empty($id_annee && $classe_admi && $section_admi)){
                $data['etudiants'] =  Etudiants::where('id_annee',$id_annee)
            ->where('classe_admi',$classe_admi)
            ->where('section_admi',$section_admi)
            ->orderBy('id','desc')->get();

            }
            

            return datatables()->of($data)->make(true);
          }
          $data['etudiants'] =  Etudiants::orderBy('id','desc')->get();
          
        $data['anns'] = Annees::orderBy('id','desc')->get();
       
        $data['anns_id'] = Annees::orderBy('id','desc')->first()->id;
        $data['classes_id'] = Classes::orderBy('id','asc')->first()->id;
        $data['section_id'] = Classes::orderBy('id','asc')->first()->id;

       /* $data['etudiantclass'] = Etudiants::where('id_annee',$data['anns_id'])
        ->where('classe_adm',$data['classes_id'])
        ->where('section_adm',$data['section_id'])->get();*/

        $data['annees'] = Annees::latest('id')->first();

















        response()->json($data);
       



        }

        return view('backend.pages.etudiants.index',$data);
      //  return view('backend.pages.emploipostuler.index', compact('Emplois_Postuler','parametre'));

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


        
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('etudiants.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([


                    
        
        'nom_prenom'  =>     'required',
        'date_naiss'  =>     'required',
        'lieux_naiss' =>     'required',
        'genre'       =>     'required',
        'nationalite' =>     'required',
        'classe_adm'  =>     'required',
        'section_adm' =>     'required',
        'email'       =>     'required',
        'photo'       =>     'image|mimes:jpeg,png,jpg,JPG,PNG,JPEG|max:2048',


                    ],

                    [
                        'nom_prenom.required'  =>     'Votre nom complet est obligatoire',
                        'date_naiss.required'  =>     'la Date de naissance est obligatoire',
                        'lieux_naiss.required' =>     'Le lieux de naissance est obligatoire',
                        'genre.required'       =>     'selectionnez le genre s\il vous plait',
                        'nationalite.required' =>     'Votre nationalité est obligatoire',
                        'classe_adm.required'  =>     'La classe d\'admission est obligatoire',
                        'section_adm.required' =>     'La section de classe est obligatoire',
                        'email.required'       =>     'L\'email est obligatoire et doit etre unique',
                        'photo.max'       =>     'La photo ne dois pas depasser 2MB',  
                      
                
                ]);

                
                

                    $etudiants = $request->id;
                    $username     = 'etudiant';
                    $password     = Hash::make($username);
                    $bl           = $request->bl;  ;
                    $sco_vide     = 0 ;
                    $annee = $request->id_annee;
                    $class   =  $request->classe_adm;
                    $section  =  $request->section_adm;
                    //$tof =  $request->photo  SELECT Sum(montant) from montant_frais WHERE id_classe = 3;;
                    $bl = 1;
                    $g      =  $request->genre ;
                    $ladatannee = Annees::select('name_annee')->where('id', '=' ,$annee)->pluck('name_annee')->implode(',');
                   // dd($ladatannee);
                    $total_annee = count(Promotions::select('id')->where('id_annee', '=' ,$annee)->get());
                    $total_pension = MontantFrais::where('id_classe','=',$class)->sum('montant');
                    $inscr = MontantFrais::select('montant')->where('id_classe','=',$class)->where('id_frais','=',1)->pluck('montant')->implode(',');
                    if($inscr == ""){
                        $inscr = 0;
                    }

                    if($total_annee == 0){
                        $lemat = $total_annee+1;
                        $lerec = $ladatannee;
                        $rec    = 'REC'.$lerec.'N°0000'.$lemat;
                        $mat    = $lerec.'M0000'.$lemat;
                        

                       
                        
                        $post   =   Etudiants::updateOrCreate(
                            ['id' => $etudiants],
                         [
                             
                         
                             'matricule'    =>  $mat,
                             'nom_prenom'   =>  $request->nom_prenom,
                             'date_naiss'   =>  $request->date_naiss,
                             'lieux_naiss'  =>  $request->lieux_naiss,
                             'telephone'    =>  $request->telephone,
                             'email'        =>  $request->email,
                             'nom_pere'     =>  $request->nom_pere,
                             'tel_pere'     =>  $request->tel_pere,
                             'nom_mere'     =>  $request->nom_mere,
                             'tel_mere'     =>  $request->tel_mere,
                             'genre'        =>  $g,
                             'nationalite'  =>  $request->nationalite,
                             'adresse'      =>  $request->adresse,
                             'classe_adm'   =>  $class,
                             'section_adm'  =>  $section,
                             'dossier_inscript'   => $request->dossier_inscript,
                             'photo'   => $request->photo, 
                             'id_annee'   => $annee,
                             'username'   =>   $username,
                             'password'   =>   $password,
                             'bl'   =>   $inscr,    
                       ]);
     
                     
                       $post   =   Promotions::updateOrCreate(
                         ['id' => $etudiants],
                      [
                          'id_matricule_etudiant'    =>  $mat,
                          'id_classe'   =>  $class,
                          'id_section'  =>  $section, 
                          'id_annee'   =>  $request->id_annee,
                    ]
                  
                );
                $post   =   Scolarites::updateOrCreate(
                    ['id' => $etudiants],
                 [
                     'code_recu'    =>  $rec,
                     'matricule'    =>  $mat,
                     'id_annee'   =>  $request->id_annee,
                     'id_classe'   =>  $class,
                     'id_section'  =>  $section, 
                     'id_etudiant'  =>  $etudiants,
                     'scolarite_total'  =>  $total_pension,
                     'reduction_scolarite'  =>  $sco_vide ,
                     'scolarite_net_a_payer'  =>  $total_pension,
                     'reste_scolarite'  =>   $total_pension ,
                     'erreur_saisi_solde'  =>  $sco_vide,
                     'statu_erreur_saisie'  =>  $sco_vide,
                    
                 ]);
                    
                    }else{

                        $lemat = $total_annee+1;
                        $lerec = $ladatannee;
                        if($lemat < 10 ){
                           // $mat    = '21M0000'.$lemat;
                            $mat    = $lerec.'M0000'.$lemat;
                            $rec    = 'REC'.$lerec.'N°0000'.$lemat;
                        }
                        elseif($lemat >=10 && $lemat < 100  ){
                           // $mat    = '21M000'.$lemat;
                            $mat    = $lerec.'M000'.$lemat;
                            $rec    = 'REC'.$lerec.'N°000'.$lemat;
                        }
                        elseif($lemat >=100 && $lemat < 1000  ){
                           // $mat    = '21M00'.$lemat;
                           $mat    = $lerec.'M00'.$lemat;
                           $rec    = 'REC'.$lerec.'N°00'.$lemat;
                        }
                        elseif($lemat >=1000 && $lemat < 10000  ){
                            //$mat    = '21M0'.$lemat;
                            $mat    = $lerec.'M0'.$lemat;
                            $rec    = 'REC'.$lerec.'N°0'.$lemat;
                        }
                        elseif($lemat >=10000 && $lemat < 100000  ){
                          //  $mat    = '21M'.$lemat;
                            $mat    = $lerec.'M'.$lemat;
                            $rec    = 'REC'.$lerec.'N°'.$lemat;
                        }
                        
                        
                        $post   =   Etudiants::updateOrCreate(
                            ['id' => $etudiants],
                         [
                             
                         
                             'matricule'    =>  $mat,
                             'nom_prenom'   =>  $request->nom_prenom,
                             'date_naiss'   =>  $request->date_naiss,
                             'lieux_naiss'  =>  $request->lieux_naiss,
                             'telephone'    =>  $request->telephone,
                             'email'        =>  $request->email,
                             'nom_pere'     =>  $request->nom_pere,
                             'tel_pere'     =>  $request->tel_pere,
                             'nom_mere'     =>  $request->nom_mere,
                             'tel_mere'     =>  $request->tel_mere,
                             'genre'        =>  $g,
                             'nationalite'  =>  $request->nationalite,
                             'adresse'      =>  $request->adresse,
                             'classe_adm'   =>  $class,
                             'section_adm'  =>  $section,
                             'dossier_inscript'   => $request->dossier_inscript,
                             'photo'   => $request->photo,
                             'id_annee'   => $annee,
                             'username'   =>   $username,
                             'password'   =>   $password,
                            'bl'   =>   $inscr,    
                       ]);     
                     
                       $post   =   Promotions::updateOrCreate(
                         ['id' => $etudiants],
                      [
                          'id_matricule_etudiant'    =>  $mat,
                          'id_classe'   =>  $class,
                          'id_section'  =>  $section, 
                          'id_annee'   =>  $request->id_annee,
                    ]);

                    $post   =   Scolarites::updateOrCreate(
                        ['id' => $etudiants],
                     [
                         'code_recu'    =>  $rec,
                         'matricule'    =>  $mat,
                         'id_annee'   =>  $request->id_annee,
                         'id_classe'   =>  $class,
                         'id_section'  =>  $section, 
                         'scolarite_total'  =>  $total_pension,
                         'reduction_scolarite'  => $sco_vide ,
                         'scolarite_net_a_payer'=> $total_pension,
                         'reste_scolarite'      =>   $total_pension,
                         'erreur_saisi_solde'  =>  $sco_vide,
                         'statu_erreur_saisie'  =>  $sco_vide,
                        
                     ]);


                    }
                    
                    //$photo = $request->photo;
                    ///if($request->hasfile('photo')){
                      //  $file = $request->file('photo');
                      //  $extension = $file->getClientOriginalExtension();
                      //  $filename = time() . '.' . $extension;
                      //  $file->move('backend/images/etudiants/', $filename);
                      //  $request->photo = $filename;
                      //  }
                    
    
    
      /*              return Response::json($post)










        
        for ($i=0; $i < count($id_matiere) ; $i++) { 
            # code...
         $datasave = [
            'id_classe'  => $id_classe,
            'id_gmatiere' => $id_gmatiere,
            'id_matiere' => $id_matiere[$i],
            'note_max_auth' => $note_max_auth[$i],
            'note_el' => $note_el[$i],
            'credits' => $credits[$i],
         ];
            $post =  DB::table('assmatiereas')->insert($datasave);
        }
        
        $montant_frais = $request->id;
        $post   =   MontantFrais::updateOrCreate(['id' => $montant_frais],
        ['id_frais' => $request->id_frais,
        'id_classe' => $request->id_classe,
        'montant' => $request->montant,
    ]);*/


        return Response::json($post);

             
               
               
               
               
               
               /*     $matiere = $request->id;
                $post   =   Matieres::updateOrCreate(['id' => $matiere],
                ['name_matiere' => $request->name_matiere,
                'code_matiere' => $request->code_matiere,
                'id_gmatiere' => $request->id_gmatiere]);


                return Response::json($post);
*/
            }






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

            $where = array('id' => $id);
            $editClasses  = Etudiants::where($where)->first();
            $parametre = Parametres::first();
        
            return Response::json($editClasses);

/**/
      //  $user = DB::table('etudiants')->where('id',$id)->first();
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

        
       // return view('backend.pages.emplo.voircv', compact('parametre'));


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


        }elseif(!$this->user->can('etudiants.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
        // validation data

        $request->validate([
            'username' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,'.$id,
            'password' => 'nullable|between:8,255|confirmed',
            'photo' => 'mimes:jpeg,bmp,png,jpg',

           // 'password_confirmation' => 'required'
            ],

            [
            'username.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'E-mail est obligatoire.',
            'photo' => 'Une image est necessaire respectant les formats jpeg , png , jpg, ou bmp.',
            'password.required' => 'Le mot de passe est obligatoire commencer à partir de 8 caracteres.']);

          // creer un nouvel Utilisateur
          $user = Etudiants::find($id);
          $user->name = $request->name;
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


         session()->flash('success', 'etudiants modifié avec succes !');

         //return view('chercheur.pages.profile.',compact('user'));
         return redirect()->route('backende.etudiants.index');


        }

    }

    public function updateinfo(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('etudiants.edit')){
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
          $user = Etudiants::find($id);
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
    public function resultatRecherche($id_annee,$id_class,$id_section){
       
        
                  dd('test');
      $data['etudiant'] =  Etudiants::whereRaw('id_annee',$id_annee)
      ->whereRaw('class_adm',$id_class)
      ->whereRaw('section_adm',$id_section)
      ->orderBy('etudiants.id','desc');
        return Response::json($data);
}

    public function etudiants($id)
    {
    
              $etudiants = Sections::where('id_classe',$id)->pluck("nom_section","id");
              return json_encode($etudiants);
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
