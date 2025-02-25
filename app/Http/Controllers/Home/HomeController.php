<?php

namespace App\Http\Controllers\Home;

use App\Articles;
use App\Http\Controllers\Controller;
use App\Parametres;
//use App\Post_Emploi;
//use App\Regions;
//use App\Villes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //

    public function Acceuil(){

        //dd('teest');
       //return view('welcome');
       //$art = Articles::paginate(2);
      $art = Articles::orderBy('id','desc')->paginate(3);
       return view('site.home.fr.acceuil', compact('art'));

    }
    public function Acceuil1(){

        //dd('teest');
       //return view('welcome');

       $art = Articles::orderBy('id','desc')->paginate(3);

       return view('site.home.fr.acceuil',compact('art'));

    }

    public function Actualite(){

        //dd('teest');
       //return view('welcome');

       $art = Articles::orderBy('id','desc')->paginate(3);

       return view('site.home.fr.actualite',compact('art'));

    }
    public function Faq(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.fr.faq');

    }

    public function Contact(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.fr.contact');

    }
    function send(Request $request){

        $this->validate($request,[
            'Name' => 'required',
            'Email' => 'required|email',
            'Services' => 'required',
            'Objet' => 'required',
            'Message' => 'required'
        ]);

        $data = array(
            'Name' => $request->Name,
            //'Email' => $request->Email,
            'Services' => $request->Services,
            'Objet' => $request->Objet,

            'Message' => $request->Message
                    );
//danielassoumou25@gmail.com
        Mail::to("fredytimothee@gmail.com")->send(new SendEmail($data));
        return back()->with('succes','Merci nous vous répondrons!');
    }

    public function About(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.fr.about');

    }

    public function preface(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.fr.preface');

    }

    public function Carriere(){

        //dd('teest');
       //return view('welcome');

  //     $Region = Regions::all();

    //    $PostEmplois = Post_Emploi::orderBy('id','desc')->paginate(5);
        $parametre = Parametres::first();

       return view('site.home.fr.carriere',compact('parametre'));
/*
       $PostEmplois = Post_Emploi::find($id);
       $Mat =  $PostEmplois->slug_post_emploi;
       $pars = explode(",",$Mat);
       foreach($pars as $part){
           echo"<li>";
           echo trim($part).",";
           echo"</li>";
*/
//dd('test');
    }



    public function Reg(){


        return view('chercheur.auth.login');

     }

     public function Connexion(){


        return view('chercheur.auth.login');

     }



/*
    public function Carriereinfo($id){

        //dd('teest');
        //return view('welcome');
        $id = Crypt::decrypt($id);

        $PostEmplois = DB::table('post__emplois')
->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
->select('post__emplois.titre_post_emploi','post__emplois.description_post_emploi','post__emplois.salaire_min_post_emploi','post__emplois.salaire_max_post_emploi','post__emplois.profil_post_emploi','post__emplois.tache_post_emploi', 'regions.nom_region', 'villes.nom_ville')
->where('post__emplois.id',$id)->first();


       // $PostEmplois = Post_Emploi::find($id);

        $art = Post_Emploi::orderBy('id','desc')->paginate(8);



       // $PostEmplois = Post_Emploi::find($id);
        /*$Mat =  $PostEmplois->slug_post_emploi;
        $pars = explode(",", $Mat);
        foreach ($pars as $part) {
            echo"<li>";
            echo trim($part).",";
            echo"</li>";
        }*/




    //    return view('site.home.fr.carriereDescription', compact('PostEmplois','art'));
  //  }
      /*

*/
//dd('test');

/*
public function resultatRecherche(Request $request){



    //$Region = Regions::all();
    //$Ville = Villes::all();
    $emplois = Post_Emploi::all();
    $Emp = new Post_Emploi;
    $Emp->titre_post_emploi = $request->titre_post_emploi;
     $Emp->id_region_post_emploi = $request->id_region_post_emploi;
    $Emp->id_ville_post_emploi = $request->id_ville_post_emploi;
//$PostEmplois->photo;


//$cher = DB::table('post__emplois')
//->join('regions','regions.id','=','post__emplois.id_region_post_emploi')
//->join('villes','villes.id','=','post__emplois.id_ville_post_emploi')
//->select('titre_post_emploi', 'id_region_post_emploi', 'id_ville_post_emploi')
//->where('titre_post_emploi',$Emp->titre_post_emploi,'id_region_post_emploi',$Emp->id_region_post_emploi,'id_ville_post_emploi',$Emp->id_ville_post_emploi)->get();

//$cher = DB::select("select * from post__emplois WHERE titre_post_emploi LIKE '%$Emp->titre_post_emploi%' AND id_region_post_emploi  = '$Emp->id_region_post_emploi' AND id_ville_post_emploi  = '$Emp->id_ville_post_emploi' limit 8");

//$cher = Post_Emploi::orderBy('id','desc')->where('titre_post_emploi','id_region_post_emploi','id_ville_post_emploi',$Emp->titre_post_emploi,$Emp->id_region_post_emploi,$Emp->id_ville_post_emploi)->paginate(8);
$cher = Post_Emploi::whereRaw('titre_post_emploi like ?',["%{$Emp->titre_post_emploi}%"])->paginate(8);
//$cher = Post_Emploi::whereRaw('titre_post_emploi like ? and id_region_post_emploi = ? and id_ville_post_emploi = ?',["%{$Emp->titre_post_emploi}%",$Emp->id_region_post_emploi,$Emp->id_ville_post_emploi])->paginate(2);
/*
    if ($cher == null) {

        # code...
    } else {
        # code...
    }

*/

//)->where('experience_pros.user_id',$id)->get();


       // $chercheur = Chercheur::select('drop table users');
      //$PostEmplois

     // $Emplois_Postuler = Emploi_Postuler::all();
 // $tet =   DB::select('select * from users where active = ?', [1]);


     // $Emplois_Postuler = Emploi_Postuler::all();

  /*   $art = Post_Emploi::orderBy('id','desc')->paginate(8);
     $parametre = Parametres::first();
     //return view('site.home.fr.search', compact('cher','Region','Ville','parametre'));
     return view('site.home.fr.search', compact('cher','parametre','art'));

}
*//*
public function findRegion($id)
{


          $ville = Villes::where('region_id',$id)->pluck("nom_ville","id");

            return json_encode($ville);


}


*/

    public function Home(){

        //dd('teest');
       //return view('welcome');
       return view('site.home.en.master');

    }


}
