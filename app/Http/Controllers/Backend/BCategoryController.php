<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\BCategory;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class BCategoryController extends Controller
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


        }elseif(!$this->user->can('bcategorie.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{

        $Bcategories = BCategory::all();
        $parametre = Parametres::first();
        return view('backend.pages.bcategories.index', compact('Bcategories','parametre'));

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


        }elseif(!$this->user->can('bcategorie.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
             $parametre = Parametres::first();


            return view('backend.pages.bcategories.create', compact('parametre'));


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


        }elseif(!$this->user->can('bcategorie.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $request->validate([

            'name' => 'required',
            'slug' => 'required'

            ],

            ['name.required' => 'Le nom est obligatoire.',
            'slug.required' => 'Le slug est obligatoire(mot clé).']);


        // creer un nouvel Utilisateur
        $Bcategory = new BCategory();
        $Bcategory->name = $request->name;
        $Bcategory->slug = $request->slug;
        $Bcategory->save();


       session()->flash('success', 'Utilisateur ajouté avec succes.');
       return redirect()->route('admin.bcategories.index');


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


        }elseif(!$this->user->can('bcategorie.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $Bcategory = BCategory::find($id);
        $parametre = Parametres::first();
         return view('backend.pages.bcategories.edit', compact('Bcategory','parametre'));

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


        }elseif(!$this->user->can('bcategorie.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $request->validate([

            'name' => 'required|max:100,'.$id,
            'slug' => 'required|max:50',
            ],

            ['name.required' => 'Le nom est obligatoire.',
            'slug.required' => 'Le slug est obligatoire (mot clé).']);
            //'password.required' => 'le mot de passe est obligatoire commencer à partir de 8 caracteres'

          // creer un nouvel Utilisateur
          $Bcategory = BCategory::find($id);
          $Bcategory->name = $request->name;
          $Bcategory->slug = $request->slug; 
          $Bcategory->save();

         session()->flash('success', 'Categorie du blog modifié avec succès.');
         return redirect()->route('admin.bcategories.index');
        //return back();



        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('bcategorie.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $Bcategory = BCategory::find($id);

        if(!is_null($Bcategory)){
            $Bcategory->delete();
        }
        session()->flash('success', 'Categorie du blog supprimé avec succes.');
        return back();

        }
    }
}
