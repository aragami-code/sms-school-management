<?php

namespace App\Http\Controllers\Backend;

use App\Articles;
use App\Http\Controllers\Controller;
use App\Models\Admin;

use App\Models\Chercheur;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('admin')->user();
            return $next($request);

        });
    }


    //
    public function index()
    {

        if(is_null($this->user)){
            return view('backend.auth.login');


        }elseif(!$this->user->can('dashboard.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $total_roles = count(Role::select('id')->get());
        
        $total_admins = count(Admin::select('id')->get());
       // $total_users = count(Chercheur::select('id')->get());
        $total_permissions = count(Permission::select('id')->get());
        $total_articles = count(Articles::select('id')->get());
        //$total_emplois = count(Post_Emploi::select('id')->get());
        $parametre = Parametres::first();

       // return view('Backend.pages.dashboard.index',compact('total_admins','total_roles','total_permissions','total_users','total_articles','parametre'));

        return view('Backend.pages.dashboard.index',compact('total_admins','total_roles','total_permissions','total_articles','parametre'));

        }

    }



}
