<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Classes;
use App\Matieres;
use App\Gmatieres;
use App\Assmatiereas;
use DB;
use App\Parametres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssmatiereASController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);

        });
    }


    public function index()
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('assmatiereas.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            /*$data['matieres'] = Matieres::orderBy('id','desc')->get();
            $parametre = Parametres::first();
            return view('backend.pages.matieres.index', compact('parametre'),$data);
/*****************************************************test***********************************/

$gpmatiere = Gmatieres::all();
$matiere = Matieres::all();
$assmatiereas = Assmatiereas::all();
$data['classes'] = Classes::all(); 
// $data['montant_frais'] = Frais::orderBy('id','desc')->get();
/* $data['montant_frais'] = DB::table('montant_frais')
->join('frais','frais.id','=','montant_frais.id_frais')
->join('classes','classes.id','=','montant_frais.id_classe')
->select('classes.name_classes','frais.name_frais','montant_frais.id','montant_frais.montant')->orderBy('montant_frais.id','DESC')->get();*/
//  dd($Emplois_Postuler);

response()->json($data);//++ il est bon et peut etre utiliser//
//return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));







//$data['mfrais'] = Frais::orderBy('id','desc')->get();
$parametre = Parametres::first();
return view('backend.pages.assmatiereas.index', compact('parametre','gpmatiere','matiere','assmatiereas'),$data);


/*****************************************fin test***********************************************/









        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('assmatiereas.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{





        }

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


        }elseif(!$this->user->can('assmatiereas.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([


                    'id_classe'  =>  'required',
                    'id_matiere' => 'required|unique:assmatiereas,id_matiere',
                    'id_gmatiere'=>'required',
                    'note_max_auth' => 'required',
                    'note_el' => 'required',
                    'credits' => 'required',

                    ],

                    ['id_classe.required' => 'La classe est obligatoire',
                    'id_classe.unique' => 'La matiere que vous voulez ajouter à déja été alloué veuillez changer s\'il vous plait.',
                    'id_matiere.required' => 'matiere est obligatoire().',
                    'id_gmatiere.required' => 'le groupe est obligatoire().',
                    'note_max_auth.required' => 'la note de l\'examen est obligatoire().',
                    'note_el.required' => 'la note du controle est obligatoire().',
                    'credits.required' => 'le credit de la matiere est obligatoire().',
                
                ]);

               

                    $id_classe    = $request->id_classe;
                    $id_matiere  =  $request->id_matiere;
                    $id_gmatiere = $request->id_gmatiere;
                    $note_max_auth   = $request->note_max_auth;
                    $note_el   =  $request->note_el;
                    $credits      = $request->credits;
                


        
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
        /*
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
        $id = Crypt::decrypt($id);
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('assmatiereas.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            
$gpmatiere = Gmatieres::all();
$matiere = Matieres::all();
$assmatiereas = Assmatiereas::all();
$data['classes'] = Classes::all();
            $gmatieres = Gmatieres::all();
           
           //$infos_matiere = Matieres::find($id);
            //$mfrais = MontantFrais::find($id); 
            
            //$mfrais = MontantFrais::find($id);
           // $data['montant_frais'] = MontantFrais::find($id);
           $data['matiere'] = DB::table('assmatiereas')
              ->join('gmatieres','gmatieres.id','=','assmatiereas.id_gmatiere')
              ->join('matieres','matieres.id','=','assmatiereas.id_matiere')
              ->join('classes','classes.id','=','assmatiereas.id_classe')
              ->select('matieres.name_matiere','assmatiereas.id_matiere','matieres.code_matiere','assmatiereas.id')->where('assmatiereas.id_classe','=',$id)->get();/* */
         //  dd($Emplois_Postuler);
         $data['clas'] = DB::table('classes')
         ->select('classes.name_classes','classes.id')->where('classes.id','=',$id)->get();/* */
    //  dd($Emplois_Postuler);
    
        
         $data['infos_matiere'] = DB::table('assmatiereas')
         ->join('gmatieres','gmatieres.id','=','assmatiereas.id_gmatiere')
         ->join('matieres','matieres.id','=','assmatiereas.id_matiere')
         ->join('classes','classes.id','=','assmatiereas.id_classe')
         ->select('assmatiereas.id_classe','classes.name_classes','matieres.name_matiere','matieres.code_matiere','assmatiereas.id')->where('assmatiereas.id_classe','=',$id)->first();/* */
        
         response()->json($data);

            //  dd($Emplois_Postuler);
    
            //response()->json($matier); */







          //$data['mfrais'] = Frais::orderBy('id','desc')->get();
          $parametre = Parametres::first();
          return view('backend.pages.assmatiereas.edit', compact('parametre','gmatieres','gpmatiere'),$data);



        }
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


        }elseif(!$this->user->can('assmatiereas.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $where = array('id' => $id);
            $editMatiere  = Matieres::where($where)->first();
            return Response::json($editMatiere);



        }
    }

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


        }elseif(!$this->user->can('assmatiereas.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{




        }

    }

    public function assmatiereas($id)
{

          $assmatiereas = Matieres::where('id_gmatiere',$id)->pluck("name_matiere","id");
          return json_encode($assmatiereas);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        //$id = Crypt::decrypt($id);
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('assmatiereas.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Assmatiereas::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "Matiere assignéé a été supprimé avec succes";
        }
        else{
            $success = true;
            $message = "oups impossible de traiter votre demande";
        }
        return response()->json(['success' => $success,
                                'message' => $message,]);

        }
    }
}

