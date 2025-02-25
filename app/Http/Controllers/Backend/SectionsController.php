<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Sections;
use DB;
use App\Parametres;
use App\Classes;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SectionsController extends Controller
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


        }elseif(!$this->user->can('section_classes.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

            $classe = Classes::all();
          // $data['sections'] = Sections::orderBy('id','desc')->get();
            $parametre = Parametres::first();


            /*$data['sections'] = DB::table('sections')
            ->join('classes','classes.id','=','sections.id_classe')
            ->select('classes.name_classes','sections.id','sections.nom_section')->orderBy('sections.id','DESC')->get();*/
         
         
            $data['sections'] = Sections::select('id_classe')->groupBy('id_classe')->get();
         //   ->join('classes','classes.id','=','sections.id_classe')
           // ->select('classes.name_classes','sections.id','sections.nom_section')->orderBy('sections.id','DESC')->get();
         
            //  dd($Emplois_Postuler);
          response()->json($data);
           //return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));















            return view('backend.pages.sections.index', compact('parametre','classe'),$data);

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


        }elseif(!$this->user->can('section_classes.create')){
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


        }elseif(!$this->user->can('section_classes.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([

                    'id_classe' => 'required',
                    'nom_section' => 'max:15|unique:sections,nom_section',


                    ],

                    ['nom_section.unique' => 'Le nom de la section à déja été alloué veuillez changer s\'il vous plait.',
                    'id_classe.required' => 'La classe est obligatoire s\'il vous plait.']);

                $section = $request->id;
                $post   =   Sections::updateOrCreate(['id' => $section],
                ['id_classe' => $request->id_classe,
                'nom_section' => $request->nom_section]);


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


        }elseif(!$this->user->can('section_classes.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //$editClasses = Classes::find($id);
        //$parametre = Parametres::first();
         //return view('backend.pages.classes.create', compact('editClasses','parametre'));

        // $classes =    Crypt::decrypt($request->id);
        // $id = Crypt::decrypt($id);
    $where = array('id' => $id);
    $editSectionClasses  = Sections::where($where)->first();

    return Response::json($editSectionClasses);



        }
    }

    public function editsection($id)
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('section_classes.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $where = array('id_classe' => $id);
        $SClasses = Sections::where($where)->get();
        $SClasse = Sections::where($where)->first();
        $parametre = Parametres::first();
        return view('backend.pages.sections.edit', compact('SClasses','SClasse','parametre'));

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


        }elseif(!$this->user->can('section_classes.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //$editClasses = Classes::find($id);
        //$parametre = Parametres::first();
         //return view('backend.pages.classes.create', compact('editClasses','parametre'));

        // $classes =    Crypt::decrypt($request->id);
        // $id = Crypt::decrypt($id);
    $where = array('id' => $id);
    $editSectionClasses  = Sections::where($where)->first();

    return Response::json($editSectionClasses);



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


        }elseif(!$this->user->can('section_classes.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Sections::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "la section de la classe à été supprimé avec succes";
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
