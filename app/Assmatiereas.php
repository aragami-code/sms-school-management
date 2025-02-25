<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assmatiereas extends Model
{
    /**/
    public function Mt(){
        return $this->belongsTo(GMatieres::class,'id_gmatiere','id');
    }
    protected $fillable = [
        'id_classe', 'id_gmatiere','id_matiere','note_max_auth','note_el','credits',
    ];
}
