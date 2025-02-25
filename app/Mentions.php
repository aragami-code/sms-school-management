<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentions extends Model
{
    //
    protected $fillable = [
        'nom_mention', 'code_mention','valeur_mention','intervale_debut_mention','intervale_fin_mention',
    ];
}
