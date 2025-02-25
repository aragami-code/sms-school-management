<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametres extends Model
{
    //
    protected $fillable = [
        'nom_site', 'logo', 'favicon_logo', 'devise_monetaire', 'copyright', 'facebook', 'tweeter', 'linkedin'
    ];
}

