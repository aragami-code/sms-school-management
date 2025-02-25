<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Frais;
use App\Classes;

use App\Cycles;

use App\Levels;
use App\MontantFrais;
use DB;
use App\Parametres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MFraisController extends Controller
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


        }elseif(!$this->user->can('mfrais.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            $classe = Classes::all();
            $levels = Levels::all();
            $cycles = Cycles::all();
              $frais = Frais::all(); 
             $data['montant_frais'] = MontantFrais::select('id_frais')->groupBy('id_frais')->get(); 
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
            return view('backend.pages.mfrais.index', compact('parametre','classe','levels','cycles','frais'),$data);

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


        }elseif(!$this->user->can('mfrais.create')){
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


        }elseif(!$this->user->can('mfrais.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


           
                    request()->validate([


                    'id_frais' => 'required|max:60',
                    'id_classe' => 'required|max:60',
                    'id_cycle' => 'required|max:60',
                    'id_niveau' => 'required|max:60',
                    'montant' => 'required|max:60',

                    ],

                    ['id_frais.required' => 'L\'intitulé du frais de scolarité est obligatoire()',
                    'id_classe.required' => 'La classe à la quelle le montant du frais doit etre alloué est obligatoire().',
                    'id_cycle.required' => 'Le cycle auquel le montant du frais doit etre alloué est obligatoire().',
                    'id_niveau.required' => 'Le niveau auquel le montant du frais doit etre alloué est obligatoire().',
                    'montant.required' => 'le montant du frais est obligatoire().',
                ]);

                

                            $frais = $request->id;
                            $id_frais = $request->id_frais;
                            $id_classe =  $request->id_classe;
                            $id_cycle =  $request->id_cycle;
                            $id_niveau =  $request->id_niveau;
                            $montant = $request->montant;

                
                

                

                
                for ($i=0; $i < count($id_classe) ; $i++) { 
                    # code...
                
                $post  =   MontantFrais::updateOrCreate(
                ['id' => $frais],
                ['id_frais' => $id_frais,
                'id_classe' => $id_classe[$i],
                'id_cycle' => $id_cycle[$i],
                'id_niveau' => $id_niveau[$i],
                'montant' => $montant[$i]
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
        $id = Crypt::decrypt($id);
        //
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('mfrais.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            
            $classe = Classes::all();
            $cycles= Cycles::all();
            $levels = Levels::all();
            $frais = Frais::find($id);
            //$mfrais = MontantFrais::find($id); 
            
            //$mfrais = MontantFrais::find($id);
           // $data['montant_frais'] = MontantFrais::find($id);
           $data['montant_frais'] = DB::table('montant_frais')
              ->join('frais','frais.id','=','montant_frais.id_frais')
              ->join('classes','classes.id','=','montant_frais.id_classe')
              ->join('cycles','cycles.id','=','montant_frais.id_cycle')
              ->join('levels','levels.id','=','montant_frais.id_niveau')
              ->select('classes.name_classes','frais.name_frais','montant_frais.id_niveau','montant_frais.id_cycle','montant_frais.id','montant_frais.montant')->where('montant_frais.id_frais','=',$id)->get();/* */
         //  dd($Emplois_Postuler);
         
         response()->json($data);
         $mfrais = DB::table('montant_frais')
         ->join('frais','frais.id','=','montant_frais.id_frais')
         ->join('classes','classes.id','=','montant_frais.id_classe')
         ->join('cycles','cycles.id','=','montant_frais.id_cycle')
         ->join('levels','levels.id','=','montant_frais.id_niveau')
       
         ->select('classes.name_classes','frais.name_frais','montant_frais.id','montant_frais.id_niveau','montant_frais.id_cycle','montant_frais.montant')->where('montant_frais.id_frais','=',$id)->first();/* */
            //  dd($Emplois_Postuler);
    
            response()->json($mfrais);







          //$data['mfrais'] = Frais::orderBy('id','desc')->get();
          $parametre = Parametres::first();
          return view('backend.pages.mfrais.edit', compact('parametre','classe','cycles','levels','frais','mfrais'),$data);



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


        }elseif(!$this->user->can('mfrais.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $where = array('id' => $id);
            $editMFrais  = MontantFrais::where($where)->first();
            return Response::json($editMFrais);



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


        }elseif(!$this->user->can('mfrais.edit')){
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


        }elseif(!$this->user->can('mfrais.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = MontantFrais::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "le Montant du Frais supprimé avec succes";
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

