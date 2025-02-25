<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Annees;
use Session;
use App\Classes;
use App\Sections;
use App\Gmatieres;
use App\Matieres;
use App\Evaluations;
use App\Assmatiereas;
use App\Models\Etudiants;
use App\Promotions;
use Yajra\Datatables\Services\Datatable;
use App\Notes;
use DB;
use Carbon\Carbon;
use App\Parametres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class NotesController extends Controller
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


        }elseif(!$this->user->can('notes.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            if(request()->ajax())
     {
       if(  !empty($request->id_classe) && !empty($request->id_section) && !empty($request->id_annee) && !empty($request->id_gmatiere) && !empty($request->id_matiere) && !empty($request->id_type_exams) && !empty($request->id_evaluation))
 
      {
        /*
        if(  !empty($request->id_classe) && !empty($request->id_section) && !empty($request->id_annee) && !empty($request->id_gmatiere) && !empty($request->id_matiere) && !empty($request->id_type_exams) && !empty($request->id_evaluation))
       $data = Notes::join('classes','classes.id','=','notes.id_classe')
         ->join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
         ->join('sections','sections.id','=','notes.id_section')
         ->join('annees','annees.id','=','notes.id_annee')
         ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
         ->join('type_exams','type_exams.id','=','notes.id_type_exams')
         ->select('notes.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom','notes.note_etudiant')
         ->where('notes.id_classe', $request->id_classe)
         ->where('notes.id_section', $request->id_section)
         ->where('notes.id_annee', $request->id_annee)
         ->where('notes.id_gmatiere', $request->id_gmatiere)
         ->where('notes.id_matiere', $request->id_matiere)
         ->where('notes.id_type_exams', $request->id_type_exams)
         ->where('notes.id_evaluation', $request->id_evaluation)
         ->get(); 
        

           if($data!= null){


            $total_notes = count(Notes::select('notes.id','notes.id_classe','notes.id_section','notes.id_annee','notes.id_matiere','notes.id_type_exams','notes.id_evaluation')
         ->where('notes.id_classe', $request->id_classe)
         ->where('notes.id_section', $request->id_section)
         ->where('notes.id_annee', $request->id_annee)
         ->where('notes.id_matiere', $request->id_matiere)
         ->where('notes.id_type_exams', $request->id_type_exams)
         ->where('notes.id_evaluation', $request->id_evaluation)
         ->get());
         }*/

        $total_notes = count(Notes::select('notes.id','notes.id_classe','notes.id_section','notes.id_annee','notes.id_matiere','notes.id_type_exams','notes.id_evaluation')
         ->where('notes.id_classe', $request->id_classe)
         ->where('notes.id_section', $request->id_section)
         ->where('notes.id_annee', $request->id_annee)
         ->where('notes.id_matiere', $request->id_matiere)
         ->where('notes.id_gmatiere', $request->id_gmatiere)
         ->where('notes.id_type_exams', $request->id_type_exams)
         ->where('notes.id_evaluation', $request->id_evaluation)
         ->get());

         if($total_notes <= 0){
            
         $data = Promotions::join('classes','classes.id','=','promotions.id_classe')
         ->join('etudiants','etudiants.matricule','=','promotions.id_matricule_etudiant')
         ->join('sections','sections.id','=','promotions.id_section')
         ->join('annees','annees.id','=','promotions.id_annee')
         ->select('promotions.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.id','etudiants.nom_prenom')
         ->where('promotions.id_classe', $request->id_classe)
         ->where('promotions.id_section', $request->id_section)
         ->where('promotions.id_annee', $request->id_annee)
         ->distinct()->get();

         return datatables()->of($data)
         ->addIndexColumn()
         ->addColumn('action',function($data){
             
             $input =' <input class="form-control" type="number" inputmode="decimal" Value="0"id="note_etudiant" name="note_etudiant[]" /><input type="hidden"  id="id_matricule_etudiant" name="id_matricule_etudiant[]" value="'.$data->matricule.'"  /><input type="hidden"  id="id_etudiant" name="id_etudiant[]" value="'.$data->id.'"  />';
             
         return $input;})
         ->rawColumns(['action'])
         ->make(true);
        // return json_encode($total_notes);
        // return json_encode($promotions);
              
         }
         else{
                
        $data = Notes::join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
        ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
        ->join('type_exams','type_exams.id','=','notes.id_type_exams')
        ->join('promotions','promotions.id_matricule_etudiant','=','notes.id_matricule_etudiant')
        ->select('notes.id','etudiants.matricule','etudiants.nom_prenom','etudiants.id','notes.note_etudiant','promotions.id_matricule_etudiant','notes.id_matricule_etudiant')
        ->where('notes.id_annee','=','0')
        ->get(); 
        return datatables()->of($data)
        ->make(true) ;
            
         }

      }
      else
      {
        $data = Notes::join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
        ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
        ->join('type_exams','type_exams.id','=','notes.id_type_exams')
        ->join('promotions','promotions.id_matricule_etudiant','=','notes.id_matricule_etudiant')
        ->select('notes.id','etudiants.matricule','etudiants.nom_prenom','notes.note_etudiant','promotions.id_matricule_etudiant','etudiants.id','notes.id_matricule_etudiant')
        ->where('notes.id_annee','=','0')
        ->get(); 
        return datatables()->of($data)
        ->make(true) ;
       

       
        /*
        $data = Notes::join('classes','classes.id','=','notes.id_classe')
        ->join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
        ->join('sections','sections.id','=','notes.id_section')
        ->join('annees','annees.id','=','notes.id_annee')
        ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
        ->join('type_exams','type_exams.id','=','notes.id_type_exams')
        ->select('notes.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom','notes.note_etudiant')
       ->get();*/

      }
  
     }
     return view('backend.pages.notes.index');








           
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

    public function NoteStudentEdit(Request $request)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('notes.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            if(request()->ajax())
     {
       if(  !empty($request->id_classe) && !empty($request->id_section) && !empty($request->id_annee) && !empty($request->id_gmatiere) && !empty($request->id_matiere) && !empty($request->id_type_exams) && !empty($request->id_evaluation))
 
      {
        /*
        if(  !empty($request->id_classe) && !empty($request->id_section) && !empty($request->id_annee) && !empty($request->id_gmatiere) && !empty($request->id_matiere) && !empty($request->id_type_exams) && !empty($request->id_evaluation))
       $data = Notes::join('classes','classes.id','=','notes.id_classe')
         ->join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
         ->join('sections','sections.id','=','notes.id_section')
         ->join('annees','annees.id','=','notes.id_annee')
         ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
         ->join('type_exams','type_exams.id','=','notes.id_type_exams')
         ->select('notes.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom','notes.note_etudiant')
         ->where('notes.id_classe', $request->id_classe)
         ->where('notes.id_section', $request->id_section)
         ->where('notes.id_annee', $request->id_annee)
         ->where('notes.id_gmatiere', $request->id_gmatiere)
         ->where('notes.id_matiere', $request->id_matiere)
         ->where('notes.id_type_exams', $request->id_type_exams)
         ->where('notes.id_evaluation', $request->id_evaluation)
         ->get(); 
        

           if($data!= null){


            $total_notes = count(Notes::select('notes.id','notes.id_classe','notes.id_section','notes.id_annee','notes.id_matiere','notes.id_type_exams','notes.id_evaluation')
         ->where('notes.id_classe', $request->id_classe)
         ->where('notes.id_section', $request->id_section)
         ->where('notes.id_annee', $request->id_annee)
         ->where('notes.id_matiere', $request->id_matiere)
         ->where('notes.id_type_exams', $request->id_type_exams)
         ->where('notes.id_evaluation', $request->id_evaluation)
         ->get());
         }*/

        $total_notes = count(Notes::select('notes.id','notes.id_classe','notes.id_section','notes.id_annee','notes.id_matiere','notes.id_type_exams','notes.id_evaluation')
         ->where('notes.id_classe', $request->id_classe)
         ->where('notes.id_section', $request->id_section)
         ->where('notes.id_annee', $request->id_annee)
         ->where('notes.id_matiere', $request->id_matiere)
         ->where('notes.id_gmatiere', $request->id_gmatiere)
         ->where('notes.id_type_exams', $request->id_type_exams)
         ->where('notes.id_evaluation', $request->id_evaluation)
         ->get());

         if($total_notes <= 0){

            $data = Notes::join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
            ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
            ->join('type_exams','type_exams.id','=','notes.id_type_exams')
            ->join('promotions','promotions.id_matricule_etudiant','=','notes.id_matricule_etudiant')
            ->select('notes.id','etudiants.matricule','etudiants.id','etudiants.nom_prenom','notes.note_etudiant','promotions.id_matricule_etudiant','notes.id_matricule_etudiant')
            ->where('notes.id_annee','=','0')
            ->get(); 
            return datatables()->of($data)
            ->make(true) ;
            
              
         }
         else{



            
            $data = Notes::join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
            ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
            ->join('type_exams','type_exams.id','=','notes.id_type_exams')
            ->join('classes','classes.id','=','notes.id_classe')
            ->join('promotions','promotions.id_matricule_etudiant','=','notes.id_matricule_etudiant')
            ->select('notes.id','etudiants.matricule','etudiants.id','etudiants.nom_prenom','notes.note_etudiant','promotions.id_matricule_etudiant','notes.id_matricule_etudiant','notes.id_classe')
            ->where('notes.id_classe', $request->id_classe)
            ->where('notes.id_section', $request->id_section)
            ->where('notes.id_annee', $request->id_annee)
            ->where('notes.id_matiere', $request->id_matiere)
            ->where('notes.id_gmatiere', $request->id_gmatiere)
            ->where('notes.id_type_exams', $request->id_type_exams)
            ->where('notes.id_evaluation', $request->id_evaluation)
             ->distinct()->get();

         return datatables()->of($data)
         ->addIndexColumn()
         ->addColumn('action',function($data){
    
           // <div class="input-group-append"><a href="javascript:void(0)" id="edit-post" data-id="'.$data->id.'"  class="btn btn-info"> <b><i class="fa fa-edit"></i></b></a></div>            <input class="form-control" type="number" inputmode="decimal" id="note_etudiant" name="note_etudiant[]" value="'.$data->note_etudiant.'"  />
            
            $input ='<div class="input-group mb-2">
            <input class="form-control" type="number" inputmode="decimal" id="note_etudiant" name="note_etudiant[]" value="'.$data->note_etudiant.'"  />
               
           <input   type="hidden"  id="id_matricule_etudiant" name="id_matricule_etudiant[]" value="'.$data->matricule.'" /> 
           <input   type="hidden"  id="id_etudiant" name="id_etudiant[]" value="'.$data->id.'" /> 
           
</div> ';
            
        return $input;})
         ->rawColumns(['action'])
         ->make(true);
        // return json_encode($total_notes);
        // return json_encode($promotions);















                
       
            
         }

      }
      else
      {
        $data = Notes::join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
        ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
        ->join('type_exams','type_exams.id','=','notes.id_type_exams')
        ->join('promotions','promotions.id_matricule_etudiant','=','notes.id_matricule_etudiant')
        ->select('notes.id','etudiants.matricule','etudiants.id','etudiants.nom_prenom','notes.note_etudiant','promotions.id_matricule_etudiant','notes.id_matricule_etudiant')
        ->where('notes.id_annee','=','0')
        ->get(); 
        return datatables()->of($data)
        ->make(true) ;
       

       
        /*
        $data = Notes::join('classes','classes.id','=','notes.id_classe')
        ->join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
        ->join('sections','sections.id','=','notes.id_section')
        ->join('annees','annees.id','=','notes.id_annee')
        ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
        ->join('type_exams','type_exams.id','=','notes.id_type_exams')
        ->select('notes.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom','notes.note_etudiant')
       ->get();*/

      }
  
     }
     return view('backend.pages.notes.edit');

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


        }elseif(!$this->user->can('notes.create')){
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


        }elseif(!$this->user->can('notes.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([


                     'note_etudiant' => 'required',


                    ],

                    [
                        'note_etudiant.required' => 'La note est obligatoire().',
                ]);

                    $note = $request->id;
                    $id_annee = $request->id_annee;
                    $id_classe =  $request->id_classe;
                    $id_section = $request->id_section;
                    $id_gmatiere = $request->id_gmatiere;
                    $id_matiere =  $request->id_matiere;
                    $credit = Assmatiereas::select('credits')
                    ->where('id_classe','=',$id_classe )
                    ->where('id_matiere','=',$id_matiere)
                    ->where('id_gmatiere','=',$id_gmatiere)
                    ->pluck('credits');
                    $id_type_exams = $request->id_type_exams;
                    $id_evaluation = $request->id_evaluation;
                    $eval = Evaluations::select('pourcentage')
                    ->where('id','=',$id_evaluation )
                    ->pluck('pourcentage');
                    $id_matricule_etudiant =  $request->id_matricule_etudiant;
                    $id_etudiant =  $request->id_etudiant;
                    $note_etudiant = $request->note_etudiant;
                    $note_poid = $eval;
                    $date_ed =  Carbon::now()->format('Y-m-d H:i:s');
                    $date_upd = Carbon::now()->format('Y-m-d H:i:s');
    
                for ($i=0; $i < count($id_matricule_etudiant) ; $i++) { 
                                 /* 
------------------------------bon code---------------------------------------  # code...-----------------------------------------fin boncode-----------------------------------------
:!*/
                 $datasave = [
                    'id_annee' => $id_annee,
                    'id_classe' => $id_classe,
                    'id_section' => $id_section,
                    'id_matiere' => $id_matiere,
                    'id_gmatiere' => $id_gmatiere,
                    'id_type_exams' => $id_type_exams,
                    'id_evaluation' => $id_evaluation,
                    'id_matricule_etudiant' => $id_matricule_etudiant[$i],
                    'id_etudiant' => $id_etudiant[$i],
                    'note_etudiant' => $note_etudiant[$i],
                    'note_poid' => (($note_poid[$i]*$note_etudiant[$i])/100),
                    'created_at' => $date_ed,
                    'updated_at' => $date_upd,
                 ];
                    $post =  DB::table('notes')->insert($datasave);
                   /* $post =  DB::table('notes')->update($datasave)->where('id',$note);


                  $post   =   Notes::updateOrCreate(['id' => $no],
                [
                    'id_annee' => $id_annee,
                    'id_classe' => $id_classe,
                    'id_section' => $id_section,
                    'id_matiere' => $id_matiere,
                    'id_gmatiere' => $id_gmatiere,
                    'id_type_exams' => $id_type_exams,
                    'id_evaluation' => $id_evaluation,
                    'id_matricule_etudiant' => $id_matricule_etudiant[$i],
                    'note_etudiant' => $note_etudiant[$i],
                    'note_poid' => $note_poid[$i],
                 ]);*/
                   
                }


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


        }elseif(!$this->user->can('notes.view')){
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


        }elseif(!$this->user->can('notes.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

           

            $where = array('id' => $id);
            //$edit  = Promotions::where($where)->first();
           // $edit = Promotions::join('classes','classes.id','=','promotions.id_classe')
            $data = Notes::join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
            ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
            ->join('type_exams','type_exams.id','=','notes.id_type_exams')
            ->join('promotions','promotions.id_matricule_etudiant','=','notes.id_matricule_etudiant')
            ->select('notes.id_annee','notes.id','etudiants.matricule','etudiants.id','etudiants.nom_prenom','notes.note_etudiant','promotions.id_matricule_etudiant','notes.id_matricule_etudiant')
           ->where('notes.id', $id)->first();
            return Response::json($data);
/* */














            

/*
            if(request()->ajax())
     {
      if(  !empty($request->id_classe) && !empty($request->id_section) && !empty($request->id_annee))
      {
        
        if(  !empty($request->id_classe) && !empty($request->id_section) && !empty($request->id_annee) && !empty($request->id_gmatiere) && !empty($request->id_matiere) && !empty($request->id_type_exams) && !empty($request->id_evaluation))
       $data = Notes::join('classes','classes.id','=','notes.id_classe')
         ->join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
         ->join('sections','sections.id','=','notes.id_section')
         ->join('annees','annees.id','=','notes.id_annee')
         ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
         ->join('type_exams','type_exams.id','=','notes.id_type_exams')
         ->select('notes.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom','notes.note_etudiant')
         ->where('notes.id_classe', $request->id_classe)
         ->where('notes.id_section', $request->id_section)
         ->where('notes.id_annee', $request->id_annee)
         ->where('notes.id_gmatiere', $request->id_gmatiere)
         ->where('notes.id_matiere', $request->id_matiere)
         ->where('notes.id_type_exams', $request->id_type_exams)
         ->where('notes.id_evaluation', $request->id_evaluation)
         ->get(); */
        


/*



         $data = Promotions::join('classes','classes.id','=','promotions.id_classe')
         ->join('etudiants','etudiants.matricule','=','promotions.id_matricule_etudiant')
         ->join('sections','sections.id','=','promotions.id_section')
         ->join('annees','annees.id','=','promotions.id_annee')
         ->select('promotions.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom')
         ->where('promotions.id_classe', $request->id_classe)
         ->where('promotions.id_section', $request->id_section)
         ->where('promotions.id_annee', $request->id_annee)
         ->get();



      }
      else
      {
          echo "veuillez selectionnez la classe que vous souhaitez saisir les notes";
        
        $data = Notes::join('classes','classes.id','=','notes.id_classe')
        ->join('etudiants','etudiants.matricule','=','notes.id_matricule_etudiant')
        ->join('sections','sections.id','=','notes.id_section')
        ->join('annees','annees.id','=','notes.id_annee')
        ->join('assmatiereas','assmatiereas.id_gmatiere','=','notes.id_gmatiere')
        ->join('type_exams','type_exams.id','=','notes.id_type_exams')
        ->select('notes.id','classes.name_classes','sections.nom_section','etudiants.matricule','etudiants.nom_prenom','notes.note_etudiant')
       ->get();

      }
      return datatables()->of($data)
      ->addIndexColumn()
      ->addColumn('action',function($data){
          $input =' <input type="text" id="note_etudiant" name="note_etudiant"/>';
      return $input;})
      ->rawColumns(['action'])
      ->make(true);
     }
     */
     return view('backend.pages.notes.index');





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


        }elseif(!$this->user->can('notes.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{



            request()->validate([


                'note_etudiant' => 'required',


               ],

               [
                   'note_etudiant.required' => 'La note est obligatoire().',
           ]);

           
           $data = Notes::where('notes.id_classe', $request->id_classe)
            ->where('notes.id_section', $request->id_section)
            ->where('notes.id_annee', $request->id_annee)
            ->where('notes.id_gmatiere', $request->id_gmatiere)
            ->where('notes.id_matiere', $request->id_matiere)
            ->where('notes.id_type_exams', $request->id_type_exams)
            ->where('notes.id_evaluation', $request->id_evaluation)->delete();
               $note = $request->id;
               $id_annee = $request->id_annee;
               $id_classe =  $request->id_classe;
               $id_section = $request->id_section;
               $id_gmatiere = $request->id_gmatiere;
               $id_matiere =  $request->id_matiere;
               $id_type_exams = $request->id_type_exams;
               $id_evaluation = $request->id_evaluation;
               $id_matricule_etudiant =  $request->id_matricule_etudiant;
               $id_etudiant =  $request->id_etudiant;
               $note_etudiant = $request->note_etudiant;
               $note_poid = $note_etudiant;

           for ($i=0; $i < count($id_matricule_etudiant) ; $i++) { 
                            /* 
------------------------------bon code---------------------------------------  # code...-----------------------------------------fin boncode-----------------------------------------
:!*/
            $datasave = [
               'id_annee' => $id_annee,
               'id_classe' => $id_classe,
               'id_section' => $id_section,
               'id_matiere' => $id_matiere,
               'id_gmatiere' => $id_gmatiere,
               'id_type_exams' => $id_type_exams,
               'id_evaluation' => $id_evaluation,
               'id_matricule_etudiant' => $id_matricule_etudiant[$i],
               'id_etudiant' => $id_etudiant[$i],
               'note_etudiant' => $note_etudiant[$i],
               'note_poid' => $note_poid[$i],
            ];
                 $post =  DB::table('notes')->insert($datasave);
                 /*$post =  DB::table('notes')->update($datasave)->where('id',$note);

             

             $post   =   Notes::updateOrCreate(['id' => $no],
           [
               'id_annee' => $id_annee,
               'id_classe' => $id_classe,
               'id_section' => $id_section,
               'id_matiere' => $id_matiere,
               'id_gmatiere' => $id_gmatiere,
               'id_type_exams' => $id_type_exams,
               'id_evaluation' => $id_evaluation,
               'id_matricule_etudiant' => $id_matricule_etudiant[$i],
               'note_etudiant' => $note_etudiant[$i],
               'note_poid' => $note_poid[$i],
            ]);*/
              
           }


           return Response::json($post);




        }

    }


       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatestud(Request $request)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('notes.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            request()->validate([


                'note_etudiant' => 'required',


               ],

               [
                   'note_etudiant.required' => 'La note est obligatoire().',
           ]);


           $data = Notes::where('notes.id_classe', $request->id_classe)
            ->where('notes.id_section', $request->id_section)
            ->where('notes.id_annee', $request->id_annee)
            ->where('notes.id_gmatiere', $request->id_gmatiere)
            ->where('notes.id_matiere', $request->id_matiere)
            ->where('notes.id_type_exams', $request->id_type_exams)
            ->where('notes.id_evaluation', $request->id_evaluation)->delete(); 

               $note = $request->id;
               $id_annee = $request->id_annee;
               $id_classe =  $request->id_classe;
               $id_section = $request->id_section;
               $id_gmatiere = $request->id_gmatiere;
               $id_matiere =  $request->id_matiere;
               $id_type_exams = $request->id_type_exams;
               $id_evaluation = $request->id_evaluation;
               $id_matricule_etudiant =  $request->id_matricule_etudiant;
               $id_etudiant =  $request->id_etudiant;
               $note_etudiant = $request->note_etudiant;
               $note_poid = $note_etudiant;

           for ($i=0; $i < count($id_matricule_etudiant) ; $i++) { 
                            /* 
------------------------------bon code---------------------------------------  # code...-----------------------------------------fin boncode-----------------------------------------
:!*/
            $datasave = [
               'id_annee' => $id_annee,
               'id_classe' => $id_classe,
               'id_section' => $id_section,
               'id_matiere' => $id_matiere,
               'id_gmatiere' => $id_gmatiere,
               'id_type_exams' => $id_type_exams,
               'id_evaluation' => $id_evaluation,
               'id_matricule_etudiant' => $id_matricule_etudiant[$i],
               'id_etudiant' => $id_etudiant[$i],
               'note_etudiant' => $note_etudiant[$i],
               'note_poid' => $note_poid[$i],
            ];
                 $post =  DB::table('notes')->insert($datasave);
                 /*$post =  DB::table('notes')->update($datasave)->where('id',$note);

             

             $post   =   Notes::updateOrCreate(['id' => $no],
           [
               'id_annee' => $id_annee,
               'id_classe' => $id_classe,
               'id_section' => $id_section,
               'id_matiere' => $id_matiere,
               'id_gmatiere' => $id_gmatiere,
               'id_type_exams' => $id_type_exams,
               'id_evaluation' => $id_evaluation,
               'id_matricule_etudiant' => $id_matricule_etudiant[$i],
               'note_etudiant' => $note_etudiant[$i],
               'note_poid' => $note_poid[$i],
            ]);*/
              
           }


           return Response::json($post);







        }

    }

    public function promotions($id)
    {
    
              $promotions = Sections::where('id_classe',$id)->pluck("nom_section","id");
              return json_encode($promotions);
    }
    public function assmatiereas($id)
    {
    
              $assmatiereas =   Assmatiereas::join('classes','classes.id','=','assmatiereas.id_classe')
                                           ->join('gmatieres','gmatieres.id','=','assmatiereas.id_gmatiere')
                                           ->join('matieres','matieres.id','=','assmatiereas.id_matiere')
                                           ->where('assmatiereas.id_classe', $id)->pluck('matieres.name_matiere','matieres.id');
             return json_encode($assmatiereas);

    }
    public function gassmatiereas($id)
    {
    
              $assmatiereas =   Assmatiereas::join('classes','classes.id','=','assmatiereas.id_classe')
                                           ->join('gmatieres','gmatieres.id','=','assmatiereas.id_gmatiere')
                                           ->join('matieres','matieres.id','=','assmatiereas.id_matiere')
                                           ->where('assmatiereas.id_matiere', $id)->pluck('gmatieres.name_gmatiere','gmatieres.id');
             return json_encode($assmatiereas);

    }
    public function btn($id_annee)
    {
    
        $total_notes = count(Notes::select('notes.id','notes.id_classe','notes.id_section','notes.id_annee','notes.id_matiere','notes.id_type_exams','notes.id_evaluation')
     
        ->where('notes.id_annee', $id_annee)
        ->get());
         return json_encode($total_notes);

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


        }elseif(!$this->user->can('notes.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Notes::where('id', $id)->delete();
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

