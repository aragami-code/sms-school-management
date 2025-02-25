<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Annees;
use Session;
use App\Classes;
use App\Sections;
use App\Models\Etudiants;
use App\Promotions;
use Yajra\Datatables\Services\Datatable;
use App\Scolarites;
use DB;
use App\Parametres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ScolaritesController extends Controller
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


    public function index(Request $request)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('scolarites.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{


            if(request()->ajax())
     {
      if(  !empty($request->id_class) && !empty($request->id_sectio) && !empty($request->id_anne))
      {
        $data = Scolarites::join('classes','classes.id','=','scolarites.id_classe')
        ->join('etudiants','etudiants.matricule','=','scolarites.matricule')
        ->join('sections','sections.id','=','scolarites.id_section')
        ->join('annees','annees.id','=','scolarites.id_annee')
        ->select('scolarites.id','scolarites.id_annee','scolarites.id_classe','scolarites.statu_erreur_saisie','scolarites.erreur_saisi_solde','scolarites.reste_scolarite','scolarites.scolarite_net_a_payer','scolarites.reduction_scolarite','scolarites.id_section','scolarites.scolarite_total','classes.name_classes','sections.nom_section','scolarites.matricule','etudiants.nom_prenom')
        ->where('scolarites.id_annee', $request->id_anne)
        ->where('scolarites.id_classe', $request->id_class)
        ->where('scolarites.id_section', $request->id_sectio)
        ->distinct()->get();
       //'scolarites.scolarite_total',
      }
      else
      {
        $data = Scolarites::join('classes','classes.id','=','scolarites.id_classe')
        ->join('etudiants','etudiants.matricule','=','scolarites.matricule')
        ->join('sections','sections.id','=','scolarites.id_section')
        ->join('annees','annees.id','=','scolarites.id_annee')
        ->select('scolarites.id','classes.name_classes','sections.nom_section','scolarites.matricule','etudiants.nom_prenom')
        ->where('scolarites.id_annee','=', '0')
        ->get();
      }
      return datatables()->of($data)
      ->addIndexColumn()
      ->addColumn('action',function($data){
          $btn =' <a href="javascript:void(0)" id="edit-post" data-id="'.$data->id.'"  class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span>';
      return $btn;})
      ->rawColumns(['action'])
      ->make(true);
     }
     
     return view('backend.pages.scolarite.index');








           
            //$data['pro'] = Promotions::orderBy('id','desc')->get();

            /*$data['promotions'] =  Promotions::where('id_annee',$id_annee)
            ->where('id_classe',$classe_admi)
            ->where('section_admi',$section_admi)
            ->orderBy('id','desc')->get();*/
            /*if(request()->ajax())
            {  
                
                    if(empty($request->id_annee) && empty($request->id_classe) && empty($request->id_section))
                    {
            
                        $data['promotions'] =  Promotions::select('id_matricule_etudiant','id_classe','id_section','id_annee');
                 
                    }
                    else{
                        $data['promotions'] =  Promotions::where('id_classe',$id_classe)
            ->where('id_section',$id_section)
            ->where('id_annee',$id_annee)
            ->get();
                          }
                    return datatables()->of($data)->make(true);
            }*/
           // $data['promotions'] =  Promotions::select('id_matricule_etudiant','id_classe','id_section','id_annee');

            
           // return view('backend.pages.promotion.index');
            //return view('parametre','anns','classes',$data);

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


        }elseif(!$this->user->can('scolarites.create')){
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


        }elseif(!$this->user->can('scolarites.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            request()->validate([

                'reduction_scolarite'  =>     'required',
        
        
                            ],
        
                            [
                                'reduction_scolarite.required'  =>     'le Pourcentage est obligatoire',
                                  
                              
                        
                        ]);
        
            $sco_vide     = 0 ;
            $st =  $request->scolarite_total ;
            $rs =  $request->reduction_scolarite ;
            $reduu  = $st*$rs/100;
            $reduu_net = $st-$reduu;
            $post   =   Scolarites::updateOrCreate(
                ['id' => $request->id],
             [
                 'code_recu'    =>  $request->code_recu,
                 'matricule'    =>  $request->matricule,
                 'id_annee'   =>  $request->id_annee,
                 'id_classe'   =>  $request->id_classe,
                 'id_section'  =>  $request->id_section, 
                 'scolarite_total'  =>  $st ,
                 'reduction_scolarite'  =>  $rs ,
                 'scolarite_net_a_payer'  =>  $reduu_net ,
                 'reste_scolarite'  =>  $sco_vide,
                 'erreur_saisi_solde'  =>  $sco_vide,
                 'statu_erreur_saisie'  =>  $sco_vide,
                
             ]);
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
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('scolarites.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{



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


        }elseif(!$this->user->can('scolarites.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $where = array('id' => $id);
            $scolarite  = Scolarites::join('classes','classes.id','=','scolarites.id_classe')
            ->join('etudiants','etudiants.matricule','=','scolarites.matricule')
            ->join('sections','sections.id','=','scolarites.id_section')
            ->join('annees','annees.id','=','scolarites.id_annee')
            ->select('scolarites.id','scolarites.id_annee','scolarites.id_classe','scolarites.statu_erreur_saisie','scolarites.erreur_saisi_solde','scolarites.reste_scolarite','scolarites.scolarite_net_a_payer','scolarites.reduction_scolarite','scolarites.id_section','scolarites.scolarite_total','classes.name_classes','sections.nom_section','scolarites.matricule','etudiants.nom_prenom')
            ->where('scolarites.id','=', $where)->first();
            return Response::json($scolarite);

            



            




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


        }elseif(!$this->user->can('scolarites.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
              
           }





    }

    


       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 


   
    public function scol($id)
    {
    
              $scols = Sections::where('id_classe',$id)->pluck("nom_section","id");
              return json_encode($scols);
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


        }elseif(!$this->user->can('scolarite.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        }
    }
}