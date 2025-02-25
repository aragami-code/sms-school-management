<?php

namespace App\Models;

//use App\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Etudiants extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password','matricule','telephone','username','nom_prenom','date_naiss',
        'lieux_naiss','nom_pere','tel_pere','nom_mere','tel_mere','genre','nationalite',
        'adresse','classe_adm','section_adm','dossier_inscript','photo', 'email','id_annee','bl',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
/*
    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')
        ->select('group_name as name')
        ->groupBy('group_name')
        ->get();
        return $permission_groups;

    }
    public static function getpermissionsByGroupName($group_name){

        $permissions = DB::table('permissions')
        ->select('name', 'id')
        ->where('group_name', $group_name)
        ->get();
        return $permissions;
    }
    public static function roleHasPermissions($role, $permissions){

        $hasPermission = true;
        foreach ($permissions as $permission) {
            # code...
            if(!$role->hasPermissionTo($permission->name)){
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }
*//*
    public function scopeSearch($query, $q, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9)
    {
        if($q == null) return $query; if($q1 == null) return $query; if($q2 == null) return $query;
        if($q3 == null) return $query; if($q4 == null) return $query; if($q5 == null) return $query;
        if($q6 == null) return $query; if($q7 == null) return $query; if($q8 == null) return $query;
        if($q9 == null) return $query;
        return $query->where('metier', 'LIKE', "%{$q}")
                     ->orWhere('age', '<', "%{$q1}")
                     ->orWhere('type_emploi_sollicite', 'LIKE', "%{$q2}")
                     ->orWhere('type_contrat_sollicite', 'LIKE', "%{$q3}")
                     ->orWhere('distance_minimum', 'LIKE', "%{$q4}")
                     ->orWhere('region', 'LIKE', "%{$q5}")
                     ->orWhere('ville', 'LIKE', "%{$q6}")
                     ->orWhere('genre', 'LIKE', "%{$q7}")
                     ->orWhere('diplome', 'LIKE', "%{$q8}")
                     ->orWhere('experience', 'LIKE', "%{$q9}");
    }*/
}
