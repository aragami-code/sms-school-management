<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ParametresController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);

        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('Parametre.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

           $parametre = Parametres::first();

            return view('backend.pages.parametres.index',compact('parametre'));


        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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


        }elseif(!$this->user->can('Parametre.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            //
        $parametre = Parametres::find($id);
        return view('backend.pages.parametres.edit', compact('parametre'));


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


        }elseif(!$this->user->can('Parametre.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{
        // validation data

        $request->validate([
            'nom_site' => 'required|max:100,'.$id,
            'devise_monetaire' => 'required|max:100',
            'copyright' => 'required|max:100',
            'facebook' => 'required|max:100',
            'tweeter' => 'required|max:100',
            'linkedin' => 'required|max:100',
           // 'password_confirmation' => 'required'
            ],

            [
                'nom_site' => 'Le nom du site est obligatoire.',
                'devise_monetaire' => 'La devise monetaire est obligatoire.',
                'copyright' => 'Le copyright est obligatoire.',
                'facebook' => 'Adresse facebook est necessaire.',
                'tweeter' => 'Adresse tweeter est obligatoire.',
                'linkedin' => 'Adresse linkedin est obligatoire.']);

          // creer un nouvel Utilisateur
          $parametre = Parametres::find($id);
          $parametre->nom_site = $request->nom_site;
          $parametre->annee = $request->annee;
         // $parametre->favicon_logo = $request->favicon_logo;
          $parametre->devise_monetaire = $request->devise_monetaire;
          $parametre->copyright = $request->copyright;
          $parametre->facebook = $request->facebook;
          $parametre->tweeter = $request->tweeter;
          $parametre->linkedin = $request->linkedin;

          if($request->hasfile('logo')){
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/images/parametres/', $filename);
            $parametre->logo = $filename;
              }else{
                $img = $request->input('logo2');
                DB::update('update parametres set logo = ? where id = ?', [$img,$id]);
              }


              if($request->hasfile('favicon_logo')){
                $file = $request->file('favicon_logo');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('backend/images/parametres/', $filename);
                $parametre->logo = $filename;
                  }else{
                    $img = $request->input('favicon_logo2');
                    DB::update('update parametres set favicon_logo = ? where id = ?', [$img,$id]);
                  }

          $parametre->save();


         session()->flash('success', 'Parametre modifié avec succes !');

         $parametre = Parametres::first();

            return view('backend.pages.parametres.index',compact('parametre'));


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

    }
}
