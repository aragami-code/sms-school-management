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
use App\MontantFrais;
use App\Scolaritespayements;
use DB;
use Carbon\Carbon;
use App\Parametres;
use Illuminate\Http\Request;
use PDF;
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
        ->select('scolarites.id','scolarites.id_annee','scolarites.reste_scolarite','scolarites.code_recu','scolarites.id_classe','scolarites.statu_erreur_saisie','scolarites.erreur_saisi_solde','scolarites.scolarite_net_a_payer','scolarites.majoration_scolarite','scolarites.reduction_scolarite','scolarites.id_section','scolarites.scolarite_total','classes.name_classes','sections.nom_section','scolarites.matricule','etudiants.nom_prenom')
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
        ->select('scolarites.id','scolarites.code_recu','classes.name_classes','sections.nom_section','scolarites.matricule','etudiants.nom_prenom')
        ->where('scolarites.id_annee','=', '0')
        ->get();
        
      }
      return datatables()->of($data)
      ->addIndexColumn()
      ->addColumn('action',function($data){

            if($data->reste_scolarite == 0){
               $btn ='  
                <a href="javascript:void(0)" id="edit-post" data-id="'.$data->id.'"  class="btn btn-info"><b><i class="fa fa-edit"></i></b><span>  <a href="javascript:void(0)" id="edit-list" data-id="'.$data->id.'"  class="btn btn-warning">  <b><i class="fa fa-list"></i></b><span>';
        
            }else{

                 $btn ='
                
                 
                <a href="javascript:void(0)" id="edit-post" data-id="'.$data->id.'"  class="btn btn-info">  <b><i class="fa fa-edit"></i></b><span> <a href="javascript:void(0)" id="edit-poste" data-id="'.$data->id.'"  class="btn btn-success">  <b><i class="fa fa-plus"></i></b><span>   <a href="javascript:void(0)" id="edit-list" data-id="'.$data->id.'"  class="btn btn-warning">  <b><i class="fa fa-list"></i></b><span>';
        
            }

          
      return $btn;})
      ->rawColumns(['action'])
      ->make(true);
     }
     
     $p = MontantFrais::where('id_classe','=',$request->id_class)->get();
     
     return view('backend.pages.scolarite.index',compact('p'));








           
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
        
            $sco_vide  = 0 ;
            $st        =  $request->scolarite_total ;
            $rs        =  $request->reduction_scolarite ;
            $as        =  $request->majoration_scolarite ;
           // $reduu_net = 0 ;
            if($rs == 0 && $as ==0){
               
                $reduu     = $st*$rs/100;
                $reduu_net = $st-$reduu;
                
            }elseif($rs > 0 && $as == 0){

                $reduu     = $st*$rs/100;
                $reduu_net = $st-$reduu;

            }
            elseif($as > 0 && $rs == 0){

                $reduu    = $st*$as/100;
                $reduu_net = $st+$reduu;

            };
            
           
           
            $post      =   Scolarites::updateOrCreate(
                ['id' => $request->id],
             [
                 'code_recu'                 =>  $request->code_recu,
                 'matricule'                 =>  $request->matricule,
                 'id_annee'                  =>  $request->id_annee,
                 'id_classe'                 =>  $request->id_classe,
                 'id_section'                =>  $request->id_section, 
                 'scolarite_total'           =>  $st ,
                 'reduction_scolarite'       =>  $rs ,
                 'majoration_scolarite'       =>  $as ,
                 'scolarite_net_a_payer'     =>  $reduu_net ,
                 'reste_scolarite'           =>  $sco_vide,
                 'erreur_saisi_solde'        =>  $sco_vide,
                 'statu_erreur_saisie'       =>  $sco_vide,
                
             ]);
             return Response::json($post);

            }

    }





    #payement store
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function p_store(Request $request)
    {
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('scolarites.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            request()->validate([

                'montant_versement_jour'  =>     'required',
               
                'montant_versement_jour'  =>     'required',
                'matriculee'  =>     'required',
        
                            ],
        
                            [
                 'montant_versement_jour.required'  =>     'le Montant est obligatoire',
               
                'matriculee.required'  =>     'le du payement est obligatoire',
                       
                        ]);


        
           // $sco_vide        = $request->matricule ;
            $sco_vid         = 0 ;
            $st              =  $request->scolarite_totale ;
          //  $rs              =   ;
           // $reduu           = $st*$rs/100;
           // $reduu_net       = $st-$reduu;
            
           $mont_vers_jr    = $request->montant_versement_jour ;
           $sco_cumul       = $request->scolarite_cumule ;
            $somme_deja_paye =  $sco_cumul + $mont_vers_jr ;
            $pc       = 100-(($st-$somme_deja_paye)/($st/100));
            $rst =   $st -  $somme_deja_paye;
            $id_user =   Auth::guard('admin')->id();
            $id =    $request->id;
            $id_class = $request->id_clas;
            $tr = count(MontantFrais::select('id_frais')->where('id_classe','=',$id_class)->get());
            $Pi = MontantFrais::select('montant')->where('id_classe','=',$id_class)->where('id_frais','=',1)->pluck('montant')->implode(',');
            $is = MontantFrais::select('montant')->where('id_classe','=',$id_class)->where('id_frais','=',2)->pluck('montant')->implode(',');
            $p1 = MontantFrais::select('montant')->where('id_classe','=',$id_class)->where('id_frais','=',3)->pluck('montant')->implode(',');
            $p2 = MontantFrais::select('montant')->where('id_classe','=',$id_class)->where('id_frais','=',4)->pluck('montant')->implode(',');
            $p3 = MontantFrais::select('montant')->where('id_classe','=',$id_class)->where('id_frais','=',5)->pluck('montant')->implode(',');
            $p4 = MontantFrais::select('montant')->where('id_classe','=',$id_class)->where('id_frais','=',6)->pluck('montant')->implode(',');
            
            if ($tr == 3) {
                # code...

                
            if($somme_deja_paye  <  $is ){

                
                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'  =>  $id_user ,
                     'intitule_frais'      =>   "Avance Inscription",
                     'reste_scolarite'         =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );
                }
    
                      elseif($somme_deja_paye  ==  $is ){
    
                                            
                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'  =>  $id_user ,
                     'intitule_frais'      =>   "Inscription",
                     'reste_scolarite'         =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );

                }
    
                 elseif ($somme_deja_paye  <  $is+$p1 ) {
    
                    $post            =   Scolaritespayements::updateOrCreate(
                        ['id' => $id],
                     [   
                         'code_recu'           =>  $request->code_rec,
                         'id_sco'              =>  $request->ide,
                         'matricule'           =>  $request->matriculee,
                         'id_annee'            =>  $request->id_ann,
                         'id_classe'           =>  $id_class,
                         'id_section'          =>  $request->id_sectione, 
                         'scolarite_total'     =>  $st ,
                         'etat_solde'          =>  $request->etat_solde  ,
                         'montant_versement_jour'  =>  $mont_vers_jr ,
                         'scolarite_cumul'     =>  $somme_deja_paye ,
                         'id_user_comptable'  =>  $id_user ,
                         'intitule_frais'      =>   "Inscription + Avance Premiere Tranche",
                         'reste_scolarite'         =>  $rst,
                         'pourcentage'         =>  $pc,
                         'erreur_saisi_solde'      =>  $sco_vid,
                         'statu_erreur_saisie'     =>  $sco_vid,
                        
                     ]);
                     $post            =   Scolarites::updateOrCreate(
        
                        ['id' => $request->ide],
                        ['reste_scolarite' => $rst],
                        
        
        
                     );
                    }
    
                     elseif ($somme_deja_paye  ==  $is+$p1 ) {
    
                        $post            =   Scolaritespayements::updateOrCreate(
                            ['id' => $id],
                         [   
                             'code_recu'           =>  $request->code_rec,
                             'id_sco'              =>  $request->ide,
                             'matricule'           =>  $request->matriculee,
                             'id_annee'            =>  $request->id_ann,
                             'id_classe'           =>  $id_class,
                             'id_section'          =>  $request->id_sectione, 
                             'scolarite_total'     =>  $st ,
                             'etat_solde'          =>  $request->etat_solde  ,
                             'montant_versement_jour'  =>  $mont_vers_jr ,
                             'scolarite_cumul'     =>  $somme_deja_paye ,
                             'id_user_comptable'  =>  $id_user ,
                             'intitule_frais'      =>   "Inscription + Premiere Tranche",
                             'reste_scolarite'         =>  $rst,
                             'pourcentage'         =>  $pc,
                             'erreur_saisi_solde'      =>  $sco_vid,
                             'statu_erreur_saisie'     =>  $sco_vid,
                            
                         ]);
                         $post            =   Scolarites::updateOrCreate(
            
                            ['id' => $request->ide],
                            ['reste_scolarite' => $rst],
                            
            
            
                         );
                        }
                         elseif ($somme_deja_paye  <  $is+$p1+$p2 ) {
    
                            $post            =   Scolaritespayements::updateOrCreate(
                                ['id' => $id],
                             [   
                                 'code_recu'           =>  $request->code_rec,
                                 'id_sco'              =>  $request->ide,
                                 'matricule'           =>  $request->matriculee,
                                 'id_annee'            =>  $request->id_ann,
                                 'id_classe'           =>  $id_class,
                                 'id_section'          =>  $request->id_sectione, 
                                 'scolarite_total'     =>  $st ,
                                 'etat_solde'          =>  $request->etat_solde  ,
                                 'montant_versement_jour'  =>  $mont_vers_jr ,
                                 'scolarite_cumul'     =>  $somme_deja_paye ,
                                 'id_user_comptable'  =>  $id_user ,
                                 'intitule_frais'      =>   "Inscription + Premiere Tranche + Avance Deuxieme Tranche",
                                 'reste_scolarite'         =>  $rst,
                                 'pourcentage'         =>  $pc,
                                 'erreur_saisi_solde'      =>  $sco_vid,
                                 'statu_erreur_saisie'     =>  $sco_vid,
                                
                             ]);
                             $post            =   Scolarites::updateOrCreate(
                
                                ['id' => $request->ide],
                                ['reste_scolarite' => $rst],
                                
                
                
                             );
                            }
                           elseif ($somme_deja_paye  ==  $is+$p1+$p2 ) {
    
                                $post            =   Scolaritespayements::updateOrCreate(
                                    ['id' => $id],
                                 [   
                                     'code_recu'           =>  $request->code_rec,
                                     'id_sco'              =>  $request->ide,
                                     'matricule'           =>  $request->matriculee,
                                     'id_annee'            =>  $request->id_ann,
                                     'id_classe'           =>  $id_class,
                                     'id_section'          =>  $request->id_sectione, 
                                     'scolarite_total'     =>  $st ,
                                     'etat_solde'          =>  $request->etat_solde  ,
                                     'montant_versement_jour'  =>  $mont_vers_jr ,
                                     'scolarite_cumul'     =>  $somme_deja_paye ,
                                     'id_user_comptable'   =>  $id_user ,
                                     'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche",
                                     'reste_scolarite'     =>  $rst,
                                     'pourcentage'         =>  $pc,
                                     'erreur_saisi_solde'      =>  $sco_vid,
                                     'statu_erreur_saisie'     =>  $sco_vid,
                                    
                                 ]);
                                 $post            =   Scolarites::updateOrCreate(
                    
                                    ['id' => $request->ide],
                                    ['reste_scolarite' => $rst],
                                    
                    
                    
                                 );
                    
                                # code...
                             }else {
                                
                                return Response::json($post);

                             }
                
                      
    
    
    
                    
                
            }
           
            



            elseif ($tr == 4) {
                # code...

                
             if($somme_deja_paye  <  $is ){

                
                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'  =>  $id_user ,
                     'intitule_frais'      =>   "Avance Inscription",
                     'reste_scolarite'         =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );
                }
    
                      elseif($somme_deja_paye  ==  $is ){
    
                                            
                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'  =>  $id_user ,
                     'intitule_frais'      =>   "Inscription",
                     'reste_scolarite'         =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );

                }
    
                 elseif ($somme_deja_paye  <  $is+$p1 ) {
    
                    $post            =   Scolaritespayements::updateOrCreate(
                        ['id' => $id],
                     [   
                         'code_recu'           =>  $request->code_rec,
                         'id_sco'              =>  $request->ide,
                         'matricule'           =>  $request->matriculee,
                         'id_annee'            =>  $request->id_ann,
                         'id_classe'           =>  $id_class,
                         'id_section'          =>  $request->id_sectione, 
                         'scolarite_total'     =>  $st ,
                         'etat_solde'          =>  $request->etat_solde  ,
                         'montant_versement_jour'  =>  $mont_vers_jr ,
                         'scolarite_cumul'     =>  $somme_deja_paye ,
                         'id_user_comptable'  =>  $id_user ,
                         'intitule_frais'      =>   "Inscription + Avance Premiere Tranche",
                         'reste_scolarite'         =>  $rst,
                         'pourcentage'         =>  $pc,
                         'erreur_saisi_solde'      =>  $sco_vid,
                         'statu_erreur_saisie'     =>  $sco_vid,
                        
                     ]);
                     $post            =   Scolarites::updateOrCreate(
        
                        ['id' => $request->ide],
                        ['reste_scolarite' => $rst],
                        
        
        
                     );
                    }
    
                     elseif ($somme_deja_paye  ==  $is+$p1 ) {
    
                        $post            =   Scolaritespayements::updateOrCreate(
                            ['id' => $id],
                         [   
                             'code_recu'           =>  $request->code_rec,
                             'id_sco'              =>  $request->ide,
                             'matricule'           =>  $request->matriculee,
                             'id_annee'            =>  $request->id_ann,
                             'id_classe'           =>  $id_class,
                             'id_section'          =>  $request->id_sectione, 
                             'scolarite_total'     =>  $st ,
                             'etat_solde'          =>  $request->etat_solde  ,
                             'montant_versement_jour'  =>  $mont_vers_jr ,
                             'scolarite_cumul'     =>  $somme_deja_paye ,
                             'id_user_comptable'  =>  $id_user ,
                             'intitule_frais'      =>   "Inscription + Premiere Tranche",
                             'reste_scolarite'         =>  $rst,
                             'pourcentage'         =>  $pc,
                             'erreur_saisi_solde'      =>  $sco_vid,
                             'statu_erreur_saisie'     =>  $sco_vid,
                            
                         ]);
                         $post            =   Scolarites::updateOrCreate(
            
                            ['id' => $request->ide],
                            ['reste_scolarite' => $rst],
                            
            
            
                         );
                        }
                         elseif ($somme_deja_paye  <  $is+$p1+$p2 ) {
    
                            $post            =   Scolaritespayements::updateOrCreate(
                                ['id' => $id],
                             [   
                                 'code_recu'           =>  $request->code_rec,
                                 'id_sco'              =>  $request->ide,
                                 'matricule'           =>  $request->matriculee,
                                 'id_annee'            =>  $request->id_ann,
                                 'id_classe'           =>  $id_class,
                                 'id_section'          =>  $request->id_sectione, 
                                 'scolarite_total'     =>  $st ,
                                 'etat_solde'          =>  $request->etat_solde  ,
                                 'montant_versement_jour'  =>  $mont_vers_jr ,
                                 'scolarite_cumul'     =>  $somme_deja_paye ,
                                 'id_user_comptable'  =>  $id_user ,
                                 'intitule_frais'      =>   "Inscription + Premiere Tranche + Avance Deuxieme Tranche",
                                 'reste_scolarite'         =>  $rst,
                                 'pourcentage'         =>  $pc,
                                 'erreur_saisi_solde'      =>  $sco_vid,
                                 'statu_erreur_saisie'     =>  $sco_vid,
                                
                             ]);
                             $post            =   Scolarites::updateOrCreate(
                
                                ['id' => $request->ide],
                                ['reste_scolarite' => $rst],
                                
                
                
                             );
                            }
                           elseif ($somme_deja_paye  ==  $is+$p1+$p2 ) {
    
                                $post            =   Scolaritespayements::updateOrCreate(
                                    ['id' => $id],
                                 [   
                                     'code_recu'           =>  $request->code_rec,
                                     'id_sco'              =>  $request->ide,
                                     'matricule'           =>  $request->matriculee,
                                     'id_annee'            =>  $request->id_ann,
                                     'id_classe'           =>  $id_class,
                                     'id_section'          =>  $request->id_sectione, 
                                     'scolarite_total'     =>  $st ,
                                     'etat_solde'          =>  $request->etat_solde  ,
                                     'montant_versement_jour'  =>  $mont_vers_jr ,
                                     'scolarite_cumul'     =>  $somme_deja_paye ,
                                     'id_user_comptable'   =>  $id_user ,
                                     'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche",
                                     'reste_scolarite'     =>  $rst,
                                     'pourcentage'         =>  $pc,
                                     'erreur_saisi_solde'      =>  $sco_vid,
                                     'statu_erreur_saisie'     =>  $sco_vid,
                                    
                                 ]);
                                 $post            =   Scolarites::updateOrCreate(
                    
                                    ['id' => $request->ide],
                                    ['reste_scolarite' => $rst],
                                    
                    
                    
                                 );
                    
                                # code...
                             }
                             
                             
                           elseif ($somme_deja_paye  <   $is+$p1+$p2+$p3 ) {
    
                            $post            =   Scolaritespayements::updateOrCreate(
                                ['id' => $id],
                             [   
                                 'code_recu'           =>  $request->code_rec,
                                 'id_sco'              =>  $request->ide,
                                 'matricule'           =>  $request->matriculee,
                                 'id_annee'            =>  $request->id_ann,
                                 'id_classe'           =>  $id_class,
                                 'id_section'          =>  $request->id_sectione, 
                                 'scolarite_total'     =>  $st ,
                                 'etat_solde'          =>  $request->etat_solde  ,
                                 'montant_versement_jour'  =>  $mont_vers_jr ,
                                 'scolarite_cumul'     =>  $somme_deja_paye ,
                                 'id_user_comptable'   =>  $id_user ,
                                 'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche  + Avance Troisieme Tranche",
                                 'reste_scolarite'     =>  $rst,
                                 'pourcentage'         =>  $pc,
                                 'erreur_saisi_solde'      =>  $sco_vid,
                                 'statu_erreur_saisie'     =>  $sco_vid,
                                
                             ]);
                             $post            =   Scolarites::updateOrCreate(
                
                                ['id' => $request->ide],
                                ['reste_scolarite' => $rst],
                                
                
                
                             );
                
                            # < code...
                         }
                         elseif ($somme_deja_paye  ==   $is+$p1+$p2+$p3 ) {
    
                            $post            =   Scolaritespayements::updateOrCreate(
                                ['id' => $id],
                             [   
                                 'code_recu'           =>  $request->code_rec,
                                 'id_sco'              =>  $request->ide,
                                 'matricule'           =>  $request->matriculee,
                                 'id_annee'            =>  $request->id_ann,
                                 'id_classe'           =>  $id_class,
                                 'id_section'          =>  $request->id_sectione, 
                                 'scolarite_total'     =>  $st ,
                                 'etat_solde'          =>  $request->etat_solde  ,
                                 'montant_versement_jour'  =>  $mont_vers_jr ,
                                 'scolarite_cumul'     =>  $somme_deja_paye ,
                                 'id_user_comptable'   =>  $id_user ,
                                 'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche  + Troisieme Tranche",
                                 'reste_scolarite'     =>  $rst,
                                 'pourcentage'         =>  $pc,
                                 'erreur_saisi_solde'      =>  $sco_vid,
                                 'statu_erreur_saisie'     =>  $sco_vid,
                                
                             ]);
                             $post            =   Scolarites::updateOrCreate(
                
                                ['id' => $request->ide],
                                ['reste_scolarite' => $rst],
                                
                
                
                             );
                
                            # < code...
                         }     
                             
                             else {
                                
                                return Response::json($post);

                             }
                
                      
    
    
    
                    
                
            }



 # code...    # inscription...    # premiere tranche...    # deuxieme tranche...    # troisieme tranche ...    # code...

 elseif ($tr == 5) {
    # code...

    
 if($somme_deja_paye  <  $is ){

    
    $post            =   Scolaritespayements::updateOrCreate(
        ['id' => $id],
     [   
         'code_recu'           =>  $request->code_rec,
         'id_sco'              =>  $request->ide,
         'matricule'           =>  $request->matriculee,
         'id_annee'            =>  $request->id_ann,
         'id_classe'           =>  $id_class,
         'id_section'          =>  $request->id_sectione, 
         'scolarite_total'     =>  $st ,
         'etat_solde'          =>  $request->etat_solde  ,
         'montant_versement_jour'  =>  $mont_vers_jr ,
         'scolarite_cumul'     =>  $somme_deja_paye ,
         'id_user_comptable'  =>  $id_user ,
         'intitule_frais'      =>   "Avance Inscription",
         'reste_scolarite'         =>  $rst,
         'pourcentage'         =>  $pc,
         'erreur_saisi_solde'      =>  $sco_vid,
         'statu_erreur_saisie'     =>  $sco_vid,
        
     ]);
     $post            =   Scolarites::updateOrCreate(

        ['id' => $request->ide],
        ['reste_scolarite' => $rst],
        


     );
    }

          elseif($somme_deja_paye  ==  $is ){

                                
    $post            =   Scolaritespayements::updateOrCreate(
        ['id' => $id],
     [   
         'code_recu'           =>  $request->code_rec,
         'id_sco'              =>  $request->ide,
         'matricule'           =>  $request->matriculee,
         'id_annee'            =>  $request->id_ann,
         'id_classe'           =>  $id_class,
         'id_section'          =>  $request->id_sectione, 
         'scolarite_total'     =>  $st ,
         'etat_solde'          =>  $request->etat_solde  ,
         'montant_versement_jour'  =>  $mont_vers_jr ,
         'scolarite_cumul'     =>  $somme_deja_paye ,
         'id_user_comptable'  =>  $id_user ,
         'intitule_frais'      =>   "Inscription",
         'reste_scolarite'         =>  $rst,
         'pourcentage'         =>  $pc,
         'erreur_saisi_solde'      =>  $sco_vid,
         'statu_erreur_saisie'     =>  $sco_vid,
        
     ]);
     $post            =   Scolarites::updateOrCreate(

        ['id' => $request->ide],
        ['reste_scolarite' => $rst],
        


     );

    }

     elseif ($somme_deja_paye  <  $is+$p1 ) {

        $post            =   Scolaritespayements::updateOrCreate(
            ['id' => $id],
         [   
             'code_recu'           =>  $request->code_rec,
             'id_sco'              =>  $request->ide,
             'matricule'           =>  $request->matriculee,
             'id_annee'            =>  $request->id_ann,
             'id_classe'           =>  $id_class,
             'id_section'          =>  $request->id_sectione, 
             'scolarite_total'     =>  $st ,
             'etat_solde'          =>  $request->etat_solde  ,
             'montant_versement_jour'  =>  $mont_vers_jr ,
             'scolarite_cumul'     =>  $somme_deja_paye ,
             'id_user_comptable'  =>  $id_user ,
             'intitule_frais'      =>   "Inscription + Avance Premiere Tranche",
             'reste_scolarite'         =>  $rst,
             'pourcentage'         =>  $pc,
             'erreur_saisi_solde'      =>  $sco_vid,
             'statu_erreur_saisie'     =>  $sco_vid,
            
         ]);
         $post            =   Scolarites::updateOrCreate(

            ['id' => $request->ide],
            ['reste_scolarite' => $rst],
            


         );
        }

         elseif ($somme_deja_paye  ==  $is+$p1 ) {

            $post            =   Scolaritespayements::updateOrCreate(
                ['id' => $id],
             [   
                 'code_recu'           =>  $request->code_rec,
                 'id_sco'              =>  $request->ide,
                 'matricule'           =>  $request->matriculee,
                 'id_annee'            =>  $request->id_ann,
                 'id_classe'           =>  $id_class,
                 'id_section'          =>  $request->id_sectione, 
                 'scolarite_total'     =>  $st ,
                 'etat_solde'          =>  $request->etat_solde  ,
                 'montant_versement_jour'  =>  $mont_vers_jr ,
                 'scolarite_cumul'     =>  $somme_deja_paye ,
                 'id_user_comptable'  =>  $id_user ,
                 'intitule_frais'      =>   "Inscription + Premiere Tranche",
                 'reste_scolarite'         =>  $rst,
                 'pourcentage'         =>  $pc,
                 'erreur_saisi_solde'      =>  $sco_vid,
                 'statu_erreur_saisie'     =>  $sco_vid,
                
             ]);
             $post            =   Scolarites::updateOrCreate(

                ['id' => $request->ide],
                ['reste_scolarite' => $rst],
                


             );
            }
             elseif ($somme_deja_paye  <  $is+$p1+$p2 ) {

                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'  =>  $id_user ,
                     'intitule_frais'      =>   "Inscription + Premiere Tranche + Avance Deuxieme Tranche",
                     'reste_scolarite'         =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );
                }
               elseif ($somme_deja_paye  ==  $is+$p1+$p2 ) {

                    $post            =   Scolaritespayements::updateOrCreate(
                        ['id' => $id],
                     [   
                         'code_recu'           =>  $request->code_rec,
                         'id_sco'              =>  $request->ide,
                         'matricule'           =>  $request->matriculee,
                         'id_annee'            =>  $request->id_ann,
                         'id_classe'           =>  $id_class,
                         'id_section'          =>  $request->id_sectione, 
                         'scolarite_total'     =>  $st ,
                         'etat_solde'          =>  $request->etat_solde  ,
                         'montant_versement_jour'  =>  $mont_vers_jr ,
                         'scolarite_cumul'     =>  $somme_deja_paye ,
                         'id_user_comptable'   =>  $id_user ,
                         'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche",
                         'reste_scolarite'     =>  $rst,
                         'pourcentage'         =>  $pc,
                         'erreur_saisi_solde'      =>  $sco_vid,
                         'statu_erreur_saisie'     =>  $sco_vid,
                        
                     ]);
                     $post            =   Scolarites::updateOrCreate(
        
                        ['id' => $request->ide],
                        ['reste_scolarite' => $rst],
                        
        
        
                     );
        
                    # code...
                 }
                 
                 
               elseif ($somme_deja_paye  <   $is+$p1+$p2+$p3 ) {

                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'   =>  $id_user ,
                     'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche  + Avance Troisieme Tranche",
                     'reste_scolarite'     =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );
    
                # < code...
             }
             elseif ($somme_deja_paye  ==   $is+$p1+$p2+$p3 ) {

                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'   =>  $id_user ,
                     'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche  + Troisieme Tranche",
                     'reste_scolarite'     =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );
    
                # < code...
             }
     
             elseif ($somme_deja_paye  <   $is+$p1+$p2+$p3+$p4 ) {

                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'   =>  $id_user ,
                     'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche  + Troisieme Tranche + Avanvce Quatrieme Tranche",
                     'reste_scolarite'     =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );
    
                # < code...
             }

             elseif ($somme_deja_paye  ==   $is+$p1+$p2+$p3+$p4 ) {

                $post            =   Scolaritespayements::updateOrCreate(
                    ['id' => $id],
                 [   
                     'code_recu'           =>  $request->code_rec,
                     'id_sco'              =>  $request->ide,
                     'matricule'           =>  $request->matriculee,
                     'id_annee'            =>  $request->id_ann,
                     'id_classe'           =>  $id_class,
                     'id_section'          =>  $request->id_sectione, 
                     'scolarite_total'     =>  $st ,
                     'etat_solde'          =>  $request->etat_solde  ,
                     'montant_versement_jour'  =>  $mont_vers_jr ,
                     'scolarite_cumul'     =>  $somme_deja_paye ,
                     'id_user_comptable'   =>  $id_user ,
                     'intitule_frais'      =>   "Inscription + Premiere Tranche + Deuxieme Tranche  + Troisieme Tranche + Quatrieme Tranche",
                     'reste_scolarite'     =>  $rst,
                     'pourcentage'         =>  $pc,
                     'erreur_saisi_solde'      =>  $sco_vid,
                     'statu_erreur_saisie'     =>  $sco_vid,
                    
                 ]);
                 $post            =   Scolarites::updateOrCreate(
    
                    ['id' => $request->ide],
                    ['reste_scolarite' => $rst],
                    
    
    
                 );
    
                # < code...
               
             }
             else {
                                
                return Response::json($post);

            }
        }
     

        

          // view()->share('backend.pages.scolarite.print',$post);
          return Response::json($post);

      //$totaletudiant = count(etudiants::select('id')->get());
      /*$to = Crypt::encrypt($id);
        return redirect()->action(
            [ScolaritesController::class, 'print'], ['id' => $to]
        );*/
    
            
                 
            

            }
 
           
            
         // 
         // return redirect()->action( [ScolaritesController::class, 'print'], ['id' => $id]);  
          //  $pdf = PDF::loadView('pdf_view',$post);
          //  return $pdf->download('pdf_file.pdf');
            

    }
    #FIN PAYEMENT STORE




    public function print($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('scolarites.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{



   //
   // $id = Crypt::decrypt($id);
     $id_user =   Auth::guard('admin')->id();
     $td = Carbon::now()->format('d/m/Y');
  //   $active=0;
  //   $etats = Etats::where('option',$active)->get();
  //   $cycles = Cycles::where('option',$active)->get();
   //  $annee = Annees::firstwhere('option',$active)->pluck('name_annee')->implode(' ');

  //   $ann = Annees::firstwhere('option',$active);

 //   $titi = etudiants::find($id);
  //  $Etudiant = $titi;
    //$periodes = Periodes::first();
    /**/
    $id_payement = Scolaritespayements::select('id','created_at','id_user_comptable')->where('id_user_comptable','=', $id_user)
    ->latest()->first();

    $Etudiant = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
    ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
    ->join('sections','sections.id','=','scolaritespayements.id_section')
    ->join('admins','admins.id','=','scolaritespayements.id_user_comptable')
    ->join('annees','annees.id','=','scolaritespayements.id_annee')
    ->select('scolaritespayements.id','annees.slug_annee','scolaritespayements.code_recu','scolaritespayements.etat_solde','scolaritespayements.scolarite_total','scolaritespayements.scolarite_cumul','scolaritespayements.montant_versement_jour','scolaritespayements.reste_scolarite','classes.name_classes','admins.name','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom','scolaritespayements.created_at')
    ->where('scolaritespayements.id','=',  $id_payement->id)
    ->where('scolaritespayements.id_user_comptable','=', $id_user)
    ->latest()->first();





    $parametre = Parametres::first();
        return view('backend.pages.scolarite.print',compact('Etudiant','td','parametre'));

        }


        }




        public function createPDF() {
            // retreive all records from db



            if(is_null($this->user)){
                return view('backend.auth.login');
    
    
            }elseif(!$this->user->can('scolarites.create')){
                abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');
    
    
            }else{


                $id_user =   Auth::guard('admin')->id();
                $td = Carbon::now()->format('d/m/Y');

               
       
                $id_payement = Scolaritespayements::select('id','created_at','id_user_comptable')->where('id_user_comptable','=', $id_user)
                ->latest()->first();
            
                $Etudiant = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
                ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
                ->join('sections','sections.id','=','scolaritespayements.id_section')
                ->join('admins','admins.id','=','scolaritespayements.id_user_comptable')
                ->join('annees','annees.id','=','scolaritespayements.id_annee')
                ->select('scolaritespayements.id','annees.slug_annee','scolaritespayements.code_recu','scolaritespayements.etat_solde','scolaritespayements.scolarite_total','scolaritespayements.scolarite_cumul','scolaritespayements.montant_versement_jour','scolaritespayements.reste_scolarite','classes.name_classes','admins.name','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom','scolaritespayements.created_at')
                ->where('scolaritespayements.id','=',  $id_payement->id)
                ->where('scolaritespayements.id_user_comptable','=', $id_user)
                ->latest()->first();
                $parametre = Parametres::first();
            
                
          view()->share('Etudiant', $Etudiant);
          $pdf = PDF::loadView('backend.pages.scolarite.print',compact('Etudiant','td','parametre'));
          
          return $pdf->download('recu_scolarite '.$Etudiant->nom_prenom.'.pdf');
                
            }
        
        
          //  $totalannee = count(Annees::select('id')->get());
          //  SELECT COUNT(id) FROM scolaritespayements WHERE id_user_comptable = 1 AND id_annee = 2;
         //   $active=0;
         //   $etats = Etats::where('option',$active)->get();
         //   $cycles = Cycles::where('option',$active)->get();
          //  $annee = Annees::firstwhere('option',$active)->pluck('name_annee')->implode(' ');
       
         //   $ann = Annees::firstwhere('option',$active);

         //  $Etudiant = $titi;
           //$periodes = Periodes::first();
       
          /* $data = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
           ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
           ->join('sections','sections.id','=','scolaritespayements.id_section')
           ->join('annees','annees.id','=','scolaritespayements.id_annee')
           ->select('scolaritespayements.id','scolaritespayements.code_recu','classes.name_classes','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom')
          // ->where('scolaritespayements.id_annee','=', $totalannee)
           //->where('scolaritespayements.id','=', $id)
           ->where('scolaritespayements.id_user_comptable','=', $id_user)
           ->first();*/

          // $id_payement = Scolaritespayements::select('id')->where('id_user_comptable','=', $id_user)
          // ->latest()->first();

      
         /*  $data = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
           ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
           ->join('sections','sections.id','=','scolaritespayements.id_section')
           ->join('annees','annees.id','=','scolaritespayements.id_annee')
           ->select('scolaritespayements.id','scolaritespayements.code_recu','classes.name_classes','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom','scolaritespayements.created_at')
          // ->where('scolaritespayements.id','=',$id_payement )
           ->where('scolaritespayements.id_user_comptable','=', $id_user)
           ->latest()->first();*/


          



        
           // $totaletudiant = count(Scolaritespayements::select('id')->get());
        
           // $data = etudiants::find($totaletudiant);
        
            // share data to view
          //  view()->share('scolaritespayements', $data);
          
          }
          public function createPDFI() {
            // retreive all records from db



            if(is_null($this->user)){
                return view('backend.auth.login');
    
    
            }elseif(!$this->user->can('scolarites.create')){
                abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');
    
    
            }else{


                $id_user =   Auth::guard('admin')->id();
                $td = Carbon::now()->format('d/m/Y');

               
       
                $id_payement = Scolaritespayements::select('id','created_at','id_user_comptable')->where('id_user_comptable','=', $id_user)
                ->latest()->first();
            
                $Etudiant = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
                ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
                ->join('sections','sections.id','=','scolaritespayements.id_section')
                ->join('admins','admins.id','=','scolaritespayements.id_user_comptable')
                ->join('annees','annees.id','=','scolaritespayements.id_annee')
                ->select('scolaritespayements.id','annees.slug_annee','scolaritespayements.code_recu','scolaritespayements.etat_solde','scolaritespayements.scolarite_total','scolaritespayements.scolarite_cumul','scolaritespayements.montant_versement_jour','scolaritespayements.reste_scolarite','classes.name_classes','admins.name','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom','scolaritespayements.created_at')
                ->where('scolaritespayements.id','=',  $id_payement->id)
                ->where('scolaritespayements.id_user_comptable','=', $id_user)
                ->latest()->first();
                $parametre = Parametres::first();
            
                
          view()->share('Etudiant', $Etudiant);
          $pdf = PDF::loadView('backend.pages.scolarite.printi',compact('Etudiant','td','parametre'));
          
          return $pdf->download('recu_scolarite '.$Etudiant->nom_prenom.'.pdf');
                
            }
        
        
          //  $totalannee = count(Annees::select('id')->get());
          //  SELECT COUNT(id) FROM scolaritespayements WHERE id_user_comptable = 1 AND id_annee = 2;
         //   $active=0;
         //   $etats = Etats::where('option',$active)->get();
         //   $cycles = Cycles::where('option',$active)->get();
          //  $annee = Annees::firstwhere('option',$active)->pluck('name_annee')->implode(' ');
       
         //   $ann = Annees::firstwhere('option',$active);

         //  $Etudiant = $titi;
           //$periodes = Periodes::first();
       
          /* $data = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
           ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
           ->join('sections','sections.id','=','scolaritespayements.id_section')
           ->join('annees','annees.id','=','scolaritespayements.id_annee')
           ->select('scolaritespayements.id','scolaritespayements.code_recu','classes.name_classes','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom')
          // ->where('scolaritespayements.id_annee','=', $totalannee)
           //->where('scolaritespayements.id','=', $id)
           ->where('scolaritespayements.id_user_comptable','=', $id_user)
           ->first();*/

          // $id_payement = Scolaritespayements::select('id')->where('id_user_comptable','=', $id_user)
          // ->latest()->first();

      
         /*  $data = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
           ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
           ->join('sections','sections.id','=','scolaritespayements.id_section')
           ->join('annees','annees.id','=','scolaritespayements.id_annee')
           ->select('scolaritespayements.id','scolaritespayements.code_recu','classes.name_classes','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom','scolaritespayements.created_at')
          // ->where('scolaritespayements.id','=',$id_payement )
           ->where('scolaritespayements.id_user_comptable','=', $id_user)
           ->latest()->first();*/


          



        
           // $totaletudiant = count(Scolaritespayements::select('id')->get());
        
           // $data = etudiants::find($totaletudiant);
        
            // share data to view
          //  view()->share('scolaritespayements', $data);
          
          }



          
        public function createPDFR($id) {
            // retreive all records from db



            if(is_null($this->user)){
                return view('backend.auth.login');
    
    
            }elseif(!$this->user->can('scolarites.create')){
                abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');
    
    
            }else{


                
                $td = Carbon::now()->format('d/m/Y');

               
                $Etudiant = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
                ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
                ->join('sections','sections.id','=','scolaritespayements.id_section')
                ->join('admins','admins.id','=','scolaritespayements.id_user_comptable')
                ->join('annees','annees.id','=','scolaritespayements.id_annee')
                ->select('scolaritespayements.id','annees.slug_annee','scolaritespayements.code_recu','scolaritespayements.etat_solde','scolaritespayements.scolarite_total','scolaritespayements.scolarite_cumul','scolaritespayements.montant_versement_jour','scolaritespayements.reste_scolarite','classes.name_classes','admins.name','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom','scolaritespayements.created_at')
                ->where('scolaritespayements.id','=',  $id)
                ->first();
                $parametre = Parametres::first();
            
                
          view()->share('Etudiant', $Etudiant);
          $pdf = PDF::loadView('backend.pages.scolarite.print_recu',compact('Etudiant','td','parametre'));
          
          return $pdf->download('recu_scolarite_payement '.$Etudiant->nom_prenom.'.pdf');
                
            }
        
        
          //  $totalannee = count(Annees::select('id')->get());
          //  SELECT COUNT(id) FROM scolaritespayements WHERE id_user_comptable = 1 AND id_annee = 2;
         //   $active=0;
         //   $etats = Etats::where('option',$active)->get();
         //   $cycles = Cycles::where('option',$active)->get();
          //  $annee = Annees::firstwhere('option',$active)->pluck('name_annee')->implode(' ');
       
         //   $ann = Annees::firstwhere('option',$active);

         //  $Etudiant = $titi;
           //$periodes = Periodes::first();
       
          /* $data = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
           ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
           ->join('sections','sections.id','=','scolaritespayements.id_section')
           ->join('annees','annees.id','=','scolaritespayements.id_annee')
           ->select('scolaritespayements.id','scolaritespayements.code_recu','classes.name_classes','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom')
          // ->where('scolaritespayements.id_annee','=', $totalannee)
           //->where('scolaritespayements.id','=', $id)
           ->where('scolaritespayements.id_user_comptable','=', $id_user)
           ->first();*/

          // $id_payement = Scolaritespayements::select('id')->where('id_user_comptable','=', $id_user)
          // ->latest()->first();

      
         /*  $data = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
           ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
           ->join('sections','sections.id','=','scolaritespayements.id_section')
           ->join('annees','annees.id','=','scolaritespayements.id_annee')
           ->select('scolaritespayements.id','scolaritespayements.code_recu','classes.name_classes','sections.nom_section','scolaritespayements.matricule','etudiants.nom_prenom','scolaritespayements.created_at')
          // ->where('scolaritespayements.id','=',$id_payement )
           ->where('scolaritespayements.id_user_comptable','=', $id_user)
           ->latest()->first();*/


          



        
           // $totaletudiant = count(Scolaritespayements::select('id')->get());
        
           // $data = etudiants::find($totaletudiant);
        
            // share data to view
          //  view()->share('scolaritespayements', $data);
          
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
            ->select('scolarites.id','scolarites.id_annee','scolarites.id_classe','scolarites.statu_erreur_saisie','scolarites.erreur_saisi_solde','scolarites.reste_scolarite','scolarites.scolarite_net_a_payer','scolarites.reduction_scolarite','scolarites.majoration_scolarite','scolarites.id_section','scolarites.scolarite_total','classes.name_classes','sections.nom_section','scolarites.matricule','scolarites.code_recu','etudiants.nom_prenom')
            ->where('scolarites.id','=', $where)->first();

            
          /* 
            $scolaritte  = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
            ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
            ->join('sections','sections.id','=','scolaritespayements.id_section')
            ->join('annees','annees.id','=','scolaritespayements.id_annee')
            ->select('scolaritespayements.id','scolaritespayements.id_annee','scolaritespayements.id_sco',)
            ->where('scolaritespayements.id_sco','=', $where)->first();
*/

            return Response::json($scolarite);

        }
    }


    public function edp($id)
    {
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('scolarites.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            
            $where = array('id' => $id);
            $scolaritte  = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
            ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
            ->join('sections','sections.id','=','scolaritespayements.id_section')
            ->join('annees','annees.id','=','scolaritespayements.id_annee')
            ->select('scolaritespayements.id','scolaritespayements.id_annee','scolaritespayements.reste_scolarite','scolaritespayements.id_sco','scolaritespayements.scolarite_cumul')
            ->where('scolaritespayements.id_sco','=', $where)->latest('scolaritespayements.created_at')->first();
            return Response::json($scolaritte);

        }
    }

    public function ed_p($id)
    {
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('scolarites.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            
            $where = array('id' => $id);
            $scolarit_te  = Scolaritespayements::join('classes','classes.id','=','scolaritespayements.id_classe')
            ->join('etudiants','etudiants.matricule','=','scolaritespayements.matricule')
            ->join('sections','sections.id','=','scolaritespayements.id_section')
            ->join('annees','annees.id','=','scolaritespayements.id_annee')
            ->select('scolaritespayements.id','scolaritespayements.code_recu','scolaritespayements.matricule','scolaritespayements.id_annee','scolaritespayements.reste_scolarite','scolaritespayements.id_sco','scolaritespayements.scolarite_total','scolaritespayements.montant_versement_jour','scolaritespayements.scolarite_cumul','scolaritespayements.created_at')
            ->where('scolaritespayements.id_sco','=', $where)
            ->latest('scolaritespayements.created_at')
            ->get();
            return Response::json($scolarit_te);

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