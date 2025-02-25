<?php

namespace App\Http\Controllers\Etudiants;


use App\Http\Controllers\Controller;
use App\Models\Etudiants;
use App\Parametres;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EtudiantsRegisterController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $parametre = Parametres::first();
        return view('etudiants.auth.registration',compact('parametre'));


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



        // validation data

        $request->validate([
            'nom_famille' => 'required|max:50',
            'prenom' => 'required|max:50',
            'username' => 'required|max:50',
            'email' => 'required|max:100',
            'date_naiss' => 'required',
            'password' => 'nullable|between:8,255|confirmed',
            'resume_cv' => 'mimes: word,pdf'
           // 'password_confirmation' => 'required'
            ],

            [
            'nom_famille.required' => 'Le nom de famille est obligatoire.',
            'prenom.required' => 'Le prenom est obligatoire.',
            'username.required' => 'Nom utilisateur  est obligatoire.',
            'date_naiss' => 'Date de naissance obligatoire.',
            'email.required' => 'L\'E-mail est obligatoire.',
            'password.required' => 'Le mot de passe est obligatoire commencer à partir de 8 caracteres',
            'resume_cv' => 'Votre CV doit respecter les formats PDF ou Word.'
            ]);

          // creer un nouvel Utilisateur
          $user = new Etudiants();
          $user->nom_famille = $request->nom_famille;
          $user->prenom = $request->prenom;
          $user->username = $request->username;
          $user->email = $request->email;
          $user->photo = $request->photo;
          if($request->date_naiss!=""){
            $le_age = $request->date_naiss;
            $datage = Carbon::parse($le_age)->diff(Carbon::now())->format('%y ans');

          }
          $user->age =  $datage;




          if($request->password){

            $user->remember_token = Etudiants::where('remember_token',md5($request->password))->first();


          }

          if($request->password){
            $user->password = Hash::make($request->password);
          }


          if($request->hasfile('resume_cv')){
            $file = $request->file('resume_cv');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('user/images/Cv/', $filename);
            $user->resume_cv = $filename;
              }

          $user->save();


         session()->flash('success', 'Compte crée avec succes !');

         //return view('chercheur.pages.profile.',compact('user'));
         return redirect()->route('chercheur.login');






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
    public function destroy($id)
    {

    }
}
