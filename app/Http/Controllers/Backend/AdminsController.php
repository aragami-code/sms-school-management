<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
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


        }elseif(!$this->user->can('admin.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $admins = Admin::all();
            $parametre = Parametres::first();
            return view('backend.pages.admins.index', compact('admins','parametre'));

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


        }elseif(!$this->user->can('admin.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            //
        $roles = Role::all();
        $parametre = Parametres::first();
       return view('backend.pages.admins.create', compact('roles','parametre'));
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


        }elseif(!$this->user->can('admin.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{



        // validation data

        $request->validate([
            'name' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
            ],

            ['name.required' => 'Le nom est obligatoire.',
            'username.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'e-mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire commencez à partir de 8 caracteres.']);


        // creer un nouvel Utilisateur
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        if($request->roles){
            $admin->assignRole($request->roles);
        }

       session()->flash('success', 'Utilisateur ajouté avec succès.');
       return redirect()->route('admin.admins.index');

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


        }elseif(!$this->user->can('admin.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');

        }else{


        $admin = Admin::find($id);
        $roles = Role::all();
        $parametre = Parametres::first();
       return view('backend.pages.admins.edit', compact('admin','roles','parametre'));

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


        }elseif(!$this->user->can('admin.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{



        // validation data

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,'.$id,
            'password' => 'nullable|between:8,255|confirmed',

        ],

            ['name.required' => 'Le nom est obligatoire.',
            'email.required' => 'Le mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire commencez à partir de 8 caracteres.']);

          // creer un nouvel Utilisateur
          $admin = Admin::find($id);
          $admin->name = $request->name;
          $admin->email = $request->email;

          if($request->password){
            $admin->password = Hash::make($request->password);
          }

          $admin->save();
          $admin->roles()->detach();

          if($request->roles){

              $admin->assignRole($request->roles);
          }

         session()->flash('success', 'Utilisateur  modifié avec succès.');
         return redirect()->route('admin.admins.index');

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


        }elseif(!$this->user->can('admin.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $admin = Admin::find($id);

            if(!is_null($admin)){
                $admin->delete();
            }
            session()->flash('success', 'Role supprimé avec succès.');
            return back();
        }


    }
}
