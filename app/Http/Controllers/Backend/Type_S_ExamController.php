<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Type_S_Exams;
use App\Cycles;
use App\Levels;
use DB;
use App\Parametres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Type_S_ExamController extends Controller
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


        }elseif(!$this->user->can('type_s_exams.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            $data['type_s_exams'] = Type_S_Exams::orderBy('id','desc')->get();
            $parametre = Parametres::first();
            $cycles = Cycles::all();
            $levels = Levels::all();
            return view('backend.pages.type_s_exams.index', compact('parametre','cycles','levels'),$data);

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


        }elseif(!$this->user->can('type_s_exams.create')){
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


        }elseif(!$this->user->can('type_s_exams.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([


                    'name_s_type_exam' => 'max:100|unique:type_s_exams,name_s_type_exam',
                    'id_niveau' => 'max:100|required',
                    'id_cycle' => 'max:100|required',

                    ],

                    ['name_s_type_exam.unique' => 'L\'examen que vous voulez ajouter à déja été alloué veuillez changer s\'il vous plait.',
                    'id_niveau.required' => 'Le niveau est obligatoire',
                    'id_cycle.required' => 'le cycle est obligatoire',
                   ]);

                $type_exams = $request->id;
                $post   =   Type_S_Exams::updateOrCreate(['id' => $type_exams],
                ['name_s_type_exam' => $request->name_s_type_exam],
                ['id_niveau' => $request->id_niveau],
                ['id_cycle' => $request->id_cycle],
            
                    
            );


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


        }elseif(!$this->user->can('type_exams.view')){
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


        }elseif(!$this->user->can('type_exams.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $where = array('id' => $id);
            $editType_Exams  = Type_S_Exams::where($where)->first();
            return Response::json($editType_Exams);



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


        }elseif(!$this->user->can('type_exams.edit')){
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


        }elseif(!$this->user->can('type_exams.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Type_S_Exams::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "Examen supprimé avec succes";
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

