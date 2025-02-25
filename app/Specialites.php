<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialites extends Model
{
    //
     public function sf(){
        return $this->belongsTo(Filieres::class,'id_filiere','id');
    }
    protected $fillable = [
        'id', 'id_filiere', 'nom_specialite',
    ];

   
}
