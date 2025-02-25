<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Articles extends Model
{
    //
    protected $fillable = [
        'name_article',
        'mot_cle_article',
        'sommaire_article',
        'id_categorie',
        'image_article',
        'id_admin',
        'description_article',
    ];

}
