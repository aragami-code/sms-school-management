<?php

namespace App\Http\Controllers\Backend;

use App\Cycles;
use App\Http\Controllers\Controller;
use DB;
use App\Parametres;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CyclesController extends Controller
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


        }elseif(!$this->user->can('cycle.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

           // $cycles = Cycles::all();
          // $data['sections'] = Sections::orderBy('id','desc')->get();
            $parametre = Parametres::first();

           /* $option=0;
            $data['specialites'] = DB::table('specialites')
            ->join('classes','classes.id','=','specialites.id_filiere')
            ->select('classes.name_classes','specialites.id','specialites.nom_specialite')
            ->where('specialites.option',$option)
            ->orderBy('specialites.id','DESC')->get();
         response()->json($data);

         */
         $data['cycles'] = DB::table('cycles')
         ->select('cycles.nom_cycle','cycles.id')
          ->orderBy('cycles.id','DESC')->get();
      response()->json($data);
           //return view('chercheur.pages.dashboard.ofr', compact('Emplois_Postuler'));
 //  dd($Emplois_Postuler);















            return view('backend.pages.cycles.index', compact('parametre'),$data);

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


        }elseif(!$this->user->can('cycle.create')){
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


        }elseif(!$this->user->can('cycle.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


                    request()->validate([

                        'nom_cycle' => 'max:15|unique:cycles,nom_cycle',
                  
                    ],

                    ['nom_cycle.unique' => 'Le cycle à déja été alloué veuillez changer s\'il vous plait.']);

                $cycle = $request->id;
                $post   =   Cycles::updateOrCreate(['id' => $cycle],
                [
                'nom_cycle' => $request->nom_cycle,]);


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


        }elseif(!$this->user->can('cycle.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        //$editClasses = Classes::find($id);
        //$parametre = Parametres::first();
         //return view('backend.pages.classes.create', compact('editClasses','parametre'));

        // $classes =    Crypt::decrypt($request->id);
        // $id = Crypt::decrypt($id);
    $where = array('id' => $id);
    $editCycles  = Cycles::where($where)->first();

    return Response::json($editCycles);



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


        }elseif(!$this->user->can('cycle.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $delete = Cycles::where('id', $id)->delete();
        if($delete == 1){
            $success = true;
            $message = "niveau supprimé avec succes";
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
