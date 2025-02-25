<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluations extends Model
{
    //
    
    protected $fillable = [
        'nom_evaluation', 'code_evaluation', 'pourcentage',
    ];
}
