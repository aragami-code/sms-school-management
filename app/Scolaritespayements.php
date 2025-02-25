<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scolaritespayements extends Model
{
    //
    protected $fillable = [
        'code_recu','matricule',
        'id_annee','id_classe','id_sco',
        'id_section','id_user_comptable','intitule_frais',
        'etat_solde','scolarite_cumul','scolarite_total',
        'montant_versement_jour','reste_scolarite','pourcentage',
        'erreur_saisi_solde','statu_erreur_saisie'
    ];
   
    
}
