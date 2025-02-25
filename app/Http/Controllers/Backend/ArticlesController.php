<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\BCategory;
use App\Articles;
use App\Parametres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class ArticlesController extends Controller
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


        }elseif(!$this->user->can('article.view')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

            $Article = Articles::all();
            $parametre = Parametres::first();
        return view('backend.pages.articles.index', compact('Article','parametre'));


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


        }elseif(!$this->user->can('article.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $Bcategory = BCategory::all();
            $parametre = Parametres::first();
            return view('backend.pages.articles.create', compact('Bcategory','parametre'));


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


        }elseif(!$this->user->can('article.create')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{

        $request->validate([

            'name_article' => 'required|max:100',
            'mot_cle_article' => 'required|max:300',
            'sommaire_article' => 'required',
            'id_categorie' => 'required',
            'image_article' => 'required|mimes:jpeg,bmp,png,jpg',
            'description_article' => 'required|min:100'

            ],

            ['name_article.required' => 'Le nom est obligatoire.',
            'mot_cle_article.required' => 'Le nom de la categorie du obligatoire.',
            'sommaire_article.required' => 'Le slug est obligatoire(mot clé).',
            'id_categorie.required' => 'Le nom de la categorie du obligatoire.',
            'image_article.required' => 'Une image est necessaire respectant les formats jpeg , png , jpg, ou bmp.',
            'description_article.required' => 'Veuillez atteindre le quota minimun de 100 caractères pour valider votre article.']);



            // creer un nouvel Utilisateur
            $Article = new Articles();
            $Article->name_article = $request->name_article;
            $Article->mot_cle_article = $request->mot_cle_article;
            $Article->sommaire_article = $request->sommaire_article;
            $Article->id_categorie = $request->id_categorie;
            $Article->image_article = $request->image_article;
            $Article->id_admin = $request->id_admin;
            $Article->description_article = $request->description_article;

            if($request->hasfile('image_article')){
                $file = $request->file('image_article');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('backend/images/blog/', $filename);
                $Article->image_article = $filename;
                }else{
                    return $request;
                    $Article->image_article ='';
                }

            $Article->save();


        session()->flash('success', 'Article ajouté avec succès.');
        return redirect()->route('admin.articles.index');

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


        }elseif(!$this->user->can('article.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $Article = Articles::find($id);
        $Bcategory = BCategory::all();
        $parametre = Parametres::first();
        return view('backend.pages.articles.edit', compact('Article','Bcategory','parametre'));

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


        }elseif(!$this->user->can('article.edit')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


            $request->validate([

    'name_article' => 'required|max:100',
    'mot_cle_article' => 'required|max:300',
    'sommaire_article' => 'required',
    'id_categorie' => 'required',
    'image_article' => 'mimes:jpeg,bmp,png,jpg',
    'description_article' => 'required|min:100'

    ],

    ['name_article.required' => 'Le nom est obligatoire.',
    'mot_cle_article.required' => 'Le nom de la categorie du obligatoire.',
    'sommaire_article.required' => 'Le slug est obligatoire(mot clé).',
    'id_categorie.required' => 'Le nom de la categorie du obligatoire.',
    'image_article.required' => 'Une image est necessaire respectant les formats jpeg , png , jpg, ou bmp.',
    'description_article.required' => 'Veuillez atteindre le quota minimun de 100 caracteres pour valider votre article.']);


        // creer un nouvel Utilisateur
        $Article = Articles::find($id);
        $Article->name_article = $request->name_article;
        $Article->mot_cle_article = $request->mot_cle_article;
        $Article->sommaire_article = $request->sommaire_article;
        $Article->id_categorie = $request->id_categorie;
       //$Article->image_article = $request->image_article;
        $Article->id_admin = $request->id_admin;
        $Article->description_article = $request->description_article;

        if($request->hasfile('image_article')){
            $file = $request->file('image_article');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/images/blog/', $filename);
            $Article->image_article = $filename;
              }else{
                $img = $request->input('image_article2');
                DB::update('update articles set image_article = ? where id = ?', [$img,$id]);
              }

        $Article->save();

         session()->flash('success', 'Article  modifié avec succes.');
         return redirect()->route('admin.articles.index');

        }



/*
*/




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


        }elseif(!$this->user->can('article.delete')){
            abort(403, 'Access interdit !! Vous n\'êtes pas authorisé à éffectuer cette action veuillez contacter votre administrateur.');


        }else{


        $Article = Articles::find($id);

        if(!is_null($Article)){
            $Article->delete();
        }
        session()->flash('success', 'Article  supprimé avec succès.');
        return back();

        }

    }
}
