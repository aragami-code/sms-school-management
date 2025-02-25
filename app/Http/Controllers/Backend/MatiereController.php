<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Matieres;
use App\Gmatieres;
use DB;
use App\Parametres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MatiereController extends Controller
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


        }elseif(!$this->user->can('matieres.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            /*$data['matieres'] = Matieres::orderBy('id','desc')->get();
            $parametre = Parametres::first();
            return view('backend.pages.matieres.index', compact('parametre'),$data);
/*****************************************************test***********************************/

$gpmatiere = Gmatieres::all();
$data['matieres'] = Matieres::select('id_gmatiere')->groupBy('id_gmatiere')->get(); 
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
return view('backend.pages.matieres.index', compact('parametre','gpmatiere'),$data);


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


        }elseif(!$this->user->can('matieres.create')){
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


        }elseif(!$this->user->can('matieres.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([


                    'name_matiere' => 'max:100|unique:matieres,name_matiere',
                    'code_matiere' => 'required|max:10',
                    'id_gmatiere' => 'required|max:100',

                    ],

                    ['name_matiere.unique' => 'La matiere que vous voulez ajouter a déja été alloué veuillez changer s\'il vous plait.',
                    'code_matiere.required' => 'Code matiere est obligatoire().',
                    'id_gmatiere.required' => 'selectionnez le groupe au quel votre matirere depend s\'il vous plait().',]);

               

                    $matiere = $request->id;
                    $name_matiere = $request->name_matiere;
                    $code_matiere =  $request->code_matiere;
                    $id_gmatiere = $request->id_gmatiere;
            




        for ($i=0; $i < count($name_matiere) ; $i++) { 
            # code...
        
        $post  =   Matieres::updateOrCreate(
        ['id' => $matiere],
        ['name_matiere' => $name_matiere[$i],
        'code_matiere' => $code_matiere[$i],
        'id_gmatiere' => $id_gmatiere[$i]
         ]);
    
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


        }elseif(!$this->user->can('matieres.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            
            $gmatieres = Gmatieres::all();
           
           // $infos_matiere = Matieres::find($id);
            //$mfrais = MontantFrais::find($id); 
            
            //$mfrais = MontantFrais::find($id);
           // $data['montant_frais'] = MontantFrais::find($id);
           $data['matiere'] = DB::table('matieres')
              ->join('gmatieres','gmatieres.id','=','matieres.id_gmatiere')
              ->select('matieres.name_matiere','matieres.code_matiere','matieres.id')->where('matieres.id_gmatiere','=',$id)->get();/* */
         //  dd($Emplois_Postuler);
         
         response()->json($data);
         $infos_matiere  = DB::table('matieres')
         ->join('gmatieres','gmatieres.id','=','matieres.id_gmatiere')
         ->select('matieres.name_matiere','matieres.code_matiere','gmatieres.name_gmatiere','matieres.id')->where('matieres.id_gmatiere','=',$id)->first();/*/* */
    
            //  dd($Emplois_Postuler);
    
            //response()->json($matier); */







          //$data['mfrais'] = Frais::orderBy('id','desc')->get();
          $parametre = Parametres::first();
          return view('backend.pages.matieres.edit', compact('parametre','gmatieres','infos_matiere'),$data);



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


        }elseif(!$this->user->can('matieres.edit')){
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


        }elseif(!$this->user->can('matieres.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{




        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('matieres.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Matieres::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "Matiere supprimée avec succes";
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

