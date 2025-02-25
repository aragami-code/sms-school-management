<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{
    //
    protected $fillable = [
        'id_matricule_etudiant','id_classe','id_section','id_annee',
    ];
   
    
}
