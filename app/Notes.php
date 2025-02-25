<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    //
    protected $fillable = [
        'id_annee','id_classe','id_section','id_gmatiere','id_matiere','id_type_exams','id_evaluation','id_matricule_etudiant','id_etudiant','id_note_etudiant','note_poid','note_etudiant','created_at','updated_at'
    ];
   
    
}
