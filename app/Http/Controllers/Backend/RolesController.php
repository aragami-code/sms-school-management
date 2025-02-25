<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Parametres;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
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


        }elseif(!$this->user->can('role.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $roles = Role::all();
            $parametre = Parametres::first();
        return view('backend.pages.roles.index', compact('roles','parametre'));


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


        }elseif(!$this->user->can('role.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        $parametre = Parametres::first();
       // dd( $permission_groups);
        return view('backend.pages.roles.create', compact('all_permissions','permission_groups','parametre'));

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


    }elseif(!$this->user->can('role.create')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{


        $request->validate([
            'name' => 'required:max50|unique:roles'],['name.required' => 'Donnez un rôle s\'il vous plait. ']);


            // process data

       $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
       //$role = DB::table('roles')->where('name', $request->name->firts());
       $permissions = $request->input('permissions');



       if(!empty($permissions)){
            $role->syncPermissions($permissions);

       }
       session()->flash('success', 'Rôle ajouté avec succes !');
       return back();

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


        }elseif(!$this->user->can('role.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
                    $role = Role::findById($id, 'admin');
       // $role = Role::findById($id, 'admin');
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        $parametre = Parametres::first();
       // dd( $permission_groups);
        return view('backend.pages.roles.edit', compact('role','all_permissions','permission_groups','parametre'));



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


    }elseif(!$this->user->can('role.edit')){
        abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


    }else{
$request->validate([
            'name' => 'required|max:50|unique:roles,name,'.$id],['name.required' => 'Donnez un rôle s\il vous plait. ']);


            // process data

       $role = Role::findById($id, 'admin');
       //$role = DB::table('roles')->where('name', $request->name->firts());
       $permissions = $request->input('permissions');



       if(!empty($permissions)){
            $role->syncPermissions($permissions);

       }
       session()->flash('success', ' Rôle modifié avec succes !');
       return back();

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


        }elseif(!$this->user->can('role.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{
        $role = Role::findById($id, 'admin');
        //$permissions = $request->input('permissions');

        if(!is_null($role)){
            $role->delete();
        }
        session()->flash('success', 'Rôle  supprimé avec succes !');
        return back();

        }
    }
}
