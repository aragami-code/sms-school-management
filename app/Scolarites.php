<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scolarites extends Model
{
    //
    protected $fillable = [
        'code_recu','matricule',
        'id_annee','id_classe',
        'id_section','scolarite_total',
        'reduction_scolarite','majoration_scolarite',
        'scolarite_net_a_payer','reste_scolarite',
        'erreur_saisi_solde','statu_erreur_saisie'
    ];
   
    
}
