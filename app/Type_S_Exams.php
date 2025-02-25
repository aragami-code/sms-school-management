<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_s_exams extends Model
{
    //
    protected $fillable = [
        'name_s_type_exam','id_cycle','id_niveau',
    ];
}
