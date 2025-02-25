<?php

namespace App\Http\Controllers\Backend;

use App\Filieres;
use App\Http\Controllers\Controller;
use App\Sections;
use DB;
use App\Parametres;
use App\Levels;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class FilieresController extends Controller
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


        }elseif(!$this->user->can('filieres.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            $levels = Levels::all();
          // $data['sections'] = Sections::orderBy('id','desc')->get();
            $parametre = Parametres::first();


            /*$data['sections'] = DB::table('sections')
            ->join('classes','classes.id','=','sections.id_classe')
            ->select('classes.name_classes','sections.id','sections.nom_section')->orderBy('sections.id','DESC')->get();*/
         
         
            $data['filieres'] = Filieres::select('id_niveau')->groupBy('id_niveau')->get();
           // $data['matieres'] = Matieres::select('id_gmatiere')->groupBy('id_gmatiere')->get(); -       
         //   ->join('classes','classes.id','=','sections.id_classe')
           // ->select('classes.name_classes','sections.id','sections.nom_section')->orderBy('sections.id','DESC')->get();
         
            //  dd($Emplois_Postuler);
          response()->json($data);
           //return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));















            return view('backend.pages.filieres.index', compact('parametre','levels'),$data);

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


        }elseif(!$this->user->can('filieres.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
             $parametre = Parametres::first();




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


        }elseif(!$this->user->can('filieres.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([

                    'id_niveau' => 'required',
                    'nom_filiere' => 'max:100|required',


                    ],

                    ['nom_filiere.required' => 'Le nom de la filiere est obligatoire s\'il vous plait.',
                     'id_niveau.required' => 'Le niveau est obligatoire s\'il vous plait.']);

                $filiere = $request->id;
                $post   =   Filieres::updateOrCreate(['id' => $filiere],
                ['id_niveau' => $request->id_niveau,
                'nom_filiere' => $request->nom_filiere]);


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


        }elseif(!$this->user->can('filieres.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //$editClasses = Classes::find($id);
        //$parametre = Parametres::first();
         //return view('backend.pages.classes.create', compact('editClasses','parametre'));

        // $classes =    Crypt::decrypt($request->id);
        // $id = Crypt::decrypt($id);
    $where = array('id' => $id);
    $editFiliere  = Filieres::where($where)->first();

    return Response::json($editFiliere);



        }
    }

    public function editfilieres($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('filieres.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $where = array('id_niveau' => $id);
        $SFilieres = Filieres::where($where)->get();
        $SFiliere  = Filieres::where($where)->first();
        
       
        $parametre = Parametres::first();
        return view('backend.pages.filieres.edit', compact('SFilieres','SFiliere','parametre'));

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id_classe, $id)
    {
        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('filieres.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //$editClasses = Classes::find($id);
        //$parametre = Parametres::first();
         //return view('backend.pages.classes.create', compact('editClasses','parametre'));

        // $classes =    Crypt::decrypt($request->id);
        // $id = Crypt::decrypt($id);
    $where = array('id' => $id);
    $editFiliere  = Filieres::where($where)->first();

    return Response::json($editFiliere);



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


        }elseif(!$this->user->can('filieres.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Filieres::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "la Filiere à été supprimé avec succes";
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
