<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frais extends Model
{
    //
    protected $fillable = [
        'name_frais', 'slug_frais',
    ];
}
