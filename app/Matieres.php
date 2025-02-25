<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matieres extends Model
{
    /**/ 
    public function Mt(){
        return $this->belongsTo(GMatieres::class,'id_gmatiere','id');
    }
    protected $fillable = [
        'name_matiere', 'code_matiere','id_gmatiere',
    ];
}
