<?php


namespace App\Http\Controllers\Chercheur\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Parametres;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Chercheur;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class ReinitialiserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME_USER;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }*/


    public function initialiser(Request $request)
    {

        return view('chercheur.auth.motdepasseperdu');

    }


    public function regen($email)
    {
        $email = Crypt::decrypt($email);

       // $C = Chercheur::first($email)->get();
        $C = DB::table('chercheurs')->where('email',$email)->first();




       // return view('chercheur.auth.regenpwd',Crypt::encrypt($email));

       $parametre = Parametres::first();

        return view('chercheur.auth.regenpwd',compact('C','parametre'));



    }

    public function update(Request $request, $id)
    {

        $request->validate([
          //  'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:chercheurs,email,'.$id,
            'password' => 'between:8,255|confirmed',
           // 'photo' => 'mimes:jpeg,bmp,png,jpg',

           // 'password_confirmation' => 'required'
            ],

            [
          //  'name.required' => 'Le nom est obligatoire.',
          //  'email.required' => 'L\'E-mail est obligatoire.',
            //'photo' => 'Une image est necessaire respectant les formats jpeg , png , jpg, ou bmp.',
            'password.required' => 'Le mot de passe est obligatoire et doit commencer à partir de 8 caracteres.']);

          // creer un nouvel Utilisateur
          $user = Chercheur::find($id);

          //$email = Crypt::decrypt($email);
          $user->email = $request->email;

          if($request->password){
            $user->password = Hash::make($request->password);
          }

          $user->save();


         session()->flash('success', 'Mot de passe Reinitialisé avec succes !');

         //return view('chercheur.pages.profile.',compact('user'));
         return redirect()->route('connexion');





    }




    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|max:50'
        ]);

        $req = new Chercheur();
        $req->email = $request->email;

        //$eTest = DB::select('select count(email) from chercheurs where email = ?', [$request->email]);
        $total_roles = count(Chercheur::select('email')->where('email','=',$req->email)->get());



//         dd($total_roles);

        if ($total_roles > 0) {

            //redirect to dashboard
            session()->flash('success', 'Email vérifié');

           // return view('');
         //  return redirect()->route('chercheur.password.request');

        // $parametre = Parametres::first();
          return redirect()->route('chercheur.password.regen',Crypt::encrypt($request->email));
        }
         else{

            session()->flash('error', 'Email  Invalide veuillez reéssayer');
            return redirect()->route('chercheur.password.request');

            # code...
        }



        }

    }


