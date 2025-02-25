<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Specialites;
use DB;
use App\Parametres;
use App\Filieres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SpecialitesController extends Controller
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


        }elseif(!$this->user->can('specialites.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            $filieres = Filieres::all();
          // $data['sections'] = Sections::orderBy('id','desc')->get();
            $parametre = Parametres::first();


            /*$data['sections'] = DB::table('sections')
            ->join('classes','classes.id','=','sections.id_classe')
            ->select('classes.name_classes','sections.id','sections.nom_section')->orderBy('sections.id','DESC')->get();*/
         
         
            $data['_specialites'] = Specialites::select('id_filiere')->groupBy('id_filiere')->get();
         //   ->join('classes','classes.id','=','sections.id_classe')
           // ->select('classes.name_classes','sections.id','sections.nom_section')->orderBy('sections.id','DESC')->get();
         
            //  dd($Emplois_Postuler);
          response()->json($data);
           //return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));















            return view('backend.pages.specialites.index', compact('parametre','filieres'),$data);

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


        }elseif(!$this->user->can('specialites.create')){
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


        }elseif(!$this->user->can('specialites.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([

                    'id_filiere' => 'required',
                    'nom_specialite' => 'max:100|unique:specialites,nom_specialite',


                    ],

                    ['nom_specialite.unique' => 'Le nom de la specialite à déja été alloué veuillez changer s\'il vous plait.',
                    'id_filiere.required' => 'La filiere est obligatoire s\'il vous plait.']);

                $section = $request->id;
                $post   =   Specialites::updateOrCreate(['id' => $section],
                ['id_filiere' => $request->id_filiere,
                'nom_specialite' => $request->nom_specialite]);


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


        }elseif(!$this->user->can('specialites.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //$editClasses = Classes::find($id);
        //$parametre = Parametres::first();
         //return view('backend.pages.classes.create', compact('editClasses','parametre'));

        // $classes =    Crypt::decrypt($request->id);
        // $id = Crypt::decrypt($id);
    $where = array('id' => $id);
    $editSectionClasses  = Specialites::where($where)->first();

    return Response::json($editSectionClasses);



        }
    }

    public function editspecialite($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('specialites.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
        $data['_specialites'] = Specialites::select('id_filiere')->groupBy('id_filiere')->first();

        $where = array('id_filiere' => $id);
        $SSpecialites = Specialites::where($where)->get();
        $SSpecialite = Specialites::where($where)->first();
        $parametre = Parametres::first();
        return view('backend.pages.specialites.edit', compact('SSpecialites','SSpecialite','parametre'),$data);

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


        }elseif(!$this->user->can('specialites.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //$editClasses = Classes::find($id);
        //$parametre = Parametres::first();
         //return view('backend.pages.classes.create', compact('editClasses','parametre'));

        // $classes =    Crypt::decrypt($request->id);
        // $id = Crypt::decrypt($id);
    $where = array('id' => $id);
    $editSpecialite = Specialites::where($where)->first();

    return Response::json($editSpecialite);



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


        }elseif(!$this->user->can('specialites.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Specialites::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "la specialite de la classe à été supprimé avec succes";
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
