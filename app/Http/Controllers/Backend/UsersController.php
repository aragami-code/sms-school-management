<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Chercheur;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
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


        }elseif(!$this->user->can('user.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
            $actif = 0;
        $users = Chercheur::all()->where('bl',$actif);
        $parametre = Parametres::first();
        return view('backend.pages.users.index', compact('users','parametre'));

        }
    }






    public function unblackl(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

          // activer
          $user = Chercheur::find($id);
          DB::update('update chercheurs set bl = 0 where id = ?',[$id]);
          $user->save();

         session()->flash('success', 'Utilisateur décoché avec succès !');

         //return view('chercheur.pages.profile.',compact('user'));
        // return redirect()->route('backend.pages.postemplois.edit');
         return back();

        }

    }


    public function listblack()
    {


        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('user.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
           // $users = DB::statement('select * from  chercheurs  where bl= ?',[1]);

          // $users = Chercheur::all();
          $parametre = Parametres::first();

           $users = DB::select('select * from  chercheurs  where bl = ?', [1]);


            return view('backend.pages.users.listnoire',compact('users','parametre'));
           // return view('backend.pages.users.index', compact('users'));


        }

    }



    public function blackl(Request $request, $id)
    {

        if(is_null($this->user)){
            return view('chercheur.auth.login');


        }else{

          // activer
          $user = Chercheur::find($id);
          DB::update('update chercheurs set bl = 1 where id = ?',[$id]);
          $user->save();

         session()->flash('success', 'Bloquer avec succès !');

         //return view('chercheur.pages.profile.',compact('user'));
        // return redirect()->route('backend.pages.postemplois.edit');
         return back();

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


    }elseif(!$this->user->can('user.view')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{
  $roles = Role::all();
  $parametre = Parametres::first();
      return view('backend.pages.users.create', compact('roles','parametre'));


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


    }elseif(!$this->user->can('user.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{




       $request->validate([
        'username' => 'required|max:50',
        'email' => 'required|max:100',
        'password' => 'nullable|between:8,255|confirmed',
       // 'password_confirmation' => 'required'
        ],

        [
        'username.required' => 'Nom utilisateur obligatoire.',
        'email.required' => 'L\'E-mail est obligatoire.',
        'password.required' => 'Le mot de passe est obligatoire commencez à partir de 8 caracteres.']);

      // creer un nouvel Utilisateur
      $user = new Chercheur();
      $user->username = $request->username;
      $user->email = $request->email;
     $test = md5($request->password);

     $user->remember_token = $test;

      if($request->password){
        $user->password = Hash::make($request->password);

      }




      $user->save();



      session()->flash('success', 'Le nouvel utilisateur a été ajouté avec succès !');
      return redirect()->route('admin.users.index');












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


        }elseif(!$this->user->can('user.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
        $user = Chercheur::find($id);
       // $roles = Role::all();
       $parametre = Parametres::first();


        return view('backend.pages.users.edit', compact('user','parametre'));


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


        }elseif(!$this->user->can('user.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:users,email,'.$id,
            'password' => 'nullable|between:8,255|confirmed',
           // 'password_confirmation' => 'required'
            ],

            ['name.required' => 'Le nom est obligatoire.',
            'email.required' => 'l\'E-mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire commencez à partir de 8 caracteres.']);

          // creer un nouvel Utilisateur
          $user = Chercheur::find($id);
          $user->name = $request->name;
          $user->email = $request->email;
          $test = md5($request->password);

     $user->remember_token = $test;
          if($request->password){
            $user->password = Hash::make($request->password);
          }

          $user->save();


/**/
          $user->roles()->detach();
          if($request->roles){
              $user->assignRole($request->roles);
          }

         session()->flash('success', 'Le nouvel utilisateur a été modifié avec succès !');
         return redirect()->route('admin.users.index');
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


        }elseif(!$this->user->can('user.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

          $user = Chercheur::find($id);
        //$permissions = $request->input('permissions');

        if(!is_null($user)){
            $user->delete();
        }
        session()->flash('success', 'Utilisateur supprimer avec succès !');
        return back();
        }

    }
}
