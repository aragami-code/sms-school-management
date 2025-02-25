<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annees extends Model
{
    //
    protected $fillable = [
        'name_annee', 'slug_annee',
    ];
}
