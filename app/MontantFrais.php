<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MontantFrais extends Model
{
    /**/
    public function MFrais(){
        return $this->belongsTo(Frais::class,'id_frais','id');
    }
    public function Cycles(){
        return $this->belongsTo(Cycles::class,'id_cycle','id');
    }
    public function Levels(){
        return $this->belongsTo(Levels::class,'id_niveau','id');
    }
    protected $fillable = [
        'id_frais', 'id_classe', 'id_cycle', 'id_niveau', 'montant',
    ];

 
}
