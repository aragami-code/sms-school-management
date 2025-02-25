<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    //
     public function sclass(){
        return $this->belongsTo(Classes::class,'id_classe','id');
    }
    protected $fillable = [
        'id', 'id_classe', 'nom_section',
    ];

   
}
