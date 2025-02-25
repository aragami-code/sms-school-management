<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filieres extends Model
{
    //
     public function Sn(){
        return $this->belongsTo(Levels::class,'id_niveau','id');
    }
    protected $fillable = [
       'nom_filiere','id_niveau'
    ];
   
}
