<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Annees;
use App\Models\Etudiants;
use App\Promotions;
use App\Classes;
use App\Sections;
use DB;
use App\Parametres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PromotionController extends Controller
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


        }elseif(!$this->user->can('promotion.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{


            if(request()->ajax())
     {
      if(  !empty($request->id_class) && !empty($request->id_sectio) && !empty($request->id_anne))
      {
       $data = Promotions::join('classes','classes.id','=','promotions.id_classe')
         ->join('etudiants','etudiants.matricule','=','promotions.id_matricule_etudiant')
         ->join('sections','sections.id','=','promotions.id_section')
         ->join('annees','annees.id','=','promotions.id_annee')
         ->select('promotions.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom')
         ->where('promotions.id_classe', $request->id_class)
         ->where('promotions.id_section', $request->id_sectio)
         ->where('promotions.id_annee', $request->id_anne)
         ->get();/* */
        




      }
      else
      {
        $data = Promotions::join('classes','classes.id','=','promotions.id_classe')
         ->join('etudiants','etudiants.matricule','=','promotions.id_matricule_etudiant')
         ->join('sections','sections.id','=','promotions.id_section')
         ->join('annees','annees.id','=','promotions.id_annee')
         ->select('promotions.id','promotions.id_annee','promotions.id_classe','promotions.id_section','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom')
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
     
     return view('backend.pages.promotion.index');








           
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


    public function usersList(Request $request)
    {   
        $Emp = new Promotions;
        $Emp->id_annee = $request->id_annee; 
        $Emp->id_classe = $request->id_classe;
        $Emp->id_section = $request->id_section;

            if($Emp->id_annee!="" && $Emp->id_classe!="" && $Emp->id_section!=""){

            $data['pro'] =  Promotions::where('id_annee',$Emp->id_annee)
            ->where('id_classe',$Emp->id_classe)
            ->where('id_section',$Emp->id_section)
            ->orderBy('id','desc')->get();
          
        // return response()->json($data);
          view('backend.pages.promotion.rech');
            }
            
                
            
            //    return view('backend.pages.promotion.rech',$data);
           /* if(count($data=="0")){

                echo "pas de donnees";

            }else{
                
               // $t = view('backend.pages.promotion.rech',['usersList'=>$data])->render();
                //echo response()->json(['html'=> $t]);
            }*/
           // response()->json($data);
           
                
           
        


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


        }elseif(!$this->user->can('promotion.create')){
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


        }elseif(!$this->user->can('annee.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([


                        'id_matricule_etudiant' => 'required',
                        'id_classe' => 'required',
                        'id_section' => 'required',
                        'id_annee' => 'required',

                    ],

                    ['id_matricule_etudiant.required' => 'Le matricule que vous voulez ajouter à déja été alloué veuillez changer s\'il vous plait.',
                    'id_classe.required' => 'La classe est obligatoire().',
                    'id_section.required' => 'La section que vous voulez ajouter à déja été alloué veuillez changer s\'il vous plait.',
                    'id_annee.required' => 'L\'annee est obligatoire().']);

                $promo = $request->id;
                $post   =   Promotions::updateOrCreate(['id' => $promo],
                [
                'id_matricule_etudiant' => $request->id_matricule_etudiant,
                'id_classe' => $request->id_classe,
                'id_section' => $request->id_section,
                'id_annee' => $request->id_annee,
                ]);


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
        //
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('promotion.view')){
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


        }elseif(!$this->user->can('promotion.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            

            $where = array('id' => $id);
            //$edit  = Promotions::where($where)->first();
            $edit = Promotions::join('classes','classes.id','=','promotions.id_classe')
         ->join('etudiants','etudiants.matricule','=','promotions.id_matricule_etudiant')
         ->join('sections','sections.id','=','promotions.id_section')
         ->join('annees','annees.id','=','promotions.id_annee')
         ->select('promotions.id_section','promotions.id_classe','promotions.id_annee','promotions.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom')
         ->where('promotions.id', $id)->first();
            return Response::json($edit);



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


        }elseif(!$this->user->can('promotion.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{




        }

    }

    public function promotions($id)
    {
    
              $promotions = Sections::where('id_classe',$id)->pluck("nom_section","id");
              return json_encode($promotions);
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


        }elseif(!$this->user->can('promotion.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Promotions::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "Promotion supprimé avec succes";
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

