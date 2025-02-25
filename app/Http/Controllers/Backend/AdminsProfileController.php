<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsProfileController extends Controller
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


        }elseif(!$this->user->can('profile.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $adminProfile = Auth::user();
            $parametre = Parametres::first();

            return view('backend.pages.profile.index',compact('adminProfile','parametre'));


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


        }elseif(!$this->user->can('profile.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            //
        $admin = Admin::find($id);
        $parametre = Parametres::first();
        return view('backend.pages.profile.edit', compact('admin','parametre'));


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


        }elseif(!$this->user->can('profile.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
        // validation data

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,'.$id,
            'password' => 'nullable|between:8,255|confirmed',
           // 'password_confirmation' => 'required'
            ],

            ['name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\E-mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire commencez à partir de 8 caracteres.']);

          // creer un nouvel Utilisateur
          $admin = Admin::find($id);
          $admin->name = $request->name;
          $admin->email = $request->email;

          if($request->password){
            $admin->password = Hash::make($request->password);
          }

          $admin->save();


         session()->flash('success', 'Utilisateur modifié avec succes !');

         return view('backend.pages.profile.index');


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
