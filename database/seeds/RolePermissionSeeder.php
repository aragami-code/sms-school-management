<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'users']);

        $permissions = [


            [
                'group_name'=>'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dasboard.edit'
                    ]
            ],
            [
            'group_name'=>'blog',
            'permissions' => [
            //blog permission
        	'blog.create',
        	'blog.view',
        	'blog.edit',
        	'blog.delete',
        	'blog.approve',

                    ]
            ],


            [
                'group_name'=>'admin',
                'permissions' =>
                    [
                    //admin permission
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',

                    ]

            ],
            [
                'group_name'=>'promotion',
                'permissions' =>
                    [
                    //admin permission
                    'promotion.create',
                    'promotion.view',
                    'promotion.edit',
                    'promotion.delete',

                    ]

            ],

            [
                'group_name'=>'evaluations',
                'permissions' =>
                    [
                    //admin permission
                    'evaluations.create',
                    'evaluations.view',
                    'evaluations.edit',
                    'evaluations.delete',

                    ]

            ],

            
            [
                'group_name'=>'notes',
                'permissions' =>
                    [
                    //admin permission
                    'notes.create',
                    'notes.view',
                    'notes.edit',
                    'notes.delete',

                    ]

            ],


            [
                'group_name'=>'role',
                'permissions' =>
                    [
                    //role permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',

                    ]

            ],

            [
                'group_name'=>'bcategorie',
                'permissions' =>
                    [
                    //categorie blog permission
                    'bcategorie.create',
                    'bcategorie.view',
                    'bcategorie.edit',
                    'bcategorie.delete',


                    ]

            ],

            [
                'group_name'=>'article',
                'permissions' =>
                    [
                    //article permission
                    'article.create',
                    'article.view',
                    'article.edit',
                    'article.delete',


                    ]

            ],

            [
                'group_name'=>'classes_etu',
                'permissions' =>
                    [
                    //classes permission
                    'classes_etu.create',
                    'classes_etu.view',
                    'classes_etu.edit',
                    'classes_etu.delete',


                    ]

            ],

            [
                'group_name'=>'annee',
                'permissions' =>
                    [
                    //annee permission
                    'annee.create',
                    'annee.view',
                    'annee.edit',
                    'annee.delete',


                    ]

            ],

            [
                'group_name'=>'mention',
                'permissions' =>
                    [
                    //mention permission
                    'mention.create',
                    'mention.view',
                    'mention.edit',
                    'mention.delete',


                    ]

            ],

            [
                'group_name'=>'type_exams',
                'permissions' =>
                    [
                    //type examen permission
                    'type_exams.create',
                    'type_exams.view',
                    'type_exams.edit',
                    'type_exams.delete',


                    ]

            ],

            [
                'group_name'=>'gmatieres',
                'permissions' =>
                    [
                    //type examen permission
                    'gmatieres.create',
                    'gmatieres.view',
                    'gmatieres.edit',
                    'gmatieres.delete',


                    ]

            ],

            [
                'group_name'=>'matieres',
                'permissions' =>
                    [
                    //type examen permission
                    'matieres.create',
                    'matieres.view',
                    'matieres.edit',
                    'matieres.delete',


                    ]

            ],
            [
                'group_name'=>'type_formation',
                'permissions' =>
                    [
                    //type_formation permission
                    'type_formation.create',
                    'type_formation.view',
                    'type_formation.edit',
                    'type_formation.delete',


                    ]

            ],

            [
                'group_name'=>'section_classes',
                'permissions' =>
                    [
                    //section_classes
                    'section_classes.create',
                    'section_classes.view',
                    'section_classes.edit',
                    'section_classes.delete',


                    ]

            ],

            [
                'group_name'=>'secteur_activite',
                'permissions' =>
                    [
                    //role permission
                    'sectA.create',
                    'sectA.view',
                    'sectA.edit',
                    'sectA.delete',


                    ]

            ],

            [
                'group_name'=>'Etats',
                'permissions' =>
                    [
                    //role permission
                    'GLE.create',
                    'GLE.view',
                    'GLE.edit',
                    'GLE.delete',


                    ]

            ],

            [
                'group_name'=>'Regions',
                'permissions' =>
                    [
                    //role permission
                    'GLR.create',
                    'GLR.view',
                    'GLR.edit',
                    'GLR.delete',


                    ]

            ],

            [
                'group_name'=>'Villes',
                'permissions' =>
                    [
                    //role permission
                    'GLV.create',
                    'GLV.view',
                    'GLV.edit',
                    'GLV.delete',


                    ]

            ],

            [
                'group_name'=>'Emploi_Postuler',
                'permissions' =>
                    [
                    //role permission
                    'Emploi_Postuler.view',
                    'Emploi_Postuler.mail',
                    'Emploi_Postuler.interview',
                    'Emploi_Postuler.contacter',
                    'Emploi_Postuler.shortlist',


                    ]

            ],




            [
                'group_name'=>'profile',
                'permissions' =>
                    [
                    //profile permission
                    'profile.view',
                    'profile.edit',

                    ]

            ],

            [
                'group_name'=>'frais',
                'permissions' =>
                    [
                    //profile permission
                    'frais.view',
                    'frais.edit',
                    'frais.create',
                    'frais.delete',

                    ]

            ],

            [
                'group_name'=>'mfrais',
                'permissions' =>
                    [
                    //profile permission
                    'mfrais.view',
                    'mfrais.edit',
                    'mfrais.create',
                    'mfrais.delete',

                    ]

            ],

            [
                'group_name'=>'assmatiereas',
                'permissions' =>
                    [
                    //profile permission
                    'assmatiereas.view',
                    'assmatiereas.edit',
                    'assmatiereas.create',
                    'assmatiereas.delete',

                    ]

            ],

            [
                'group_name'=>'Parametre_Site',
                'permissions' =>
                    [
                    //profile permission
                    'Parametre.view',
                    'Parametre.edit',

                    ]

            ],



        ];

        //

        for($i=0; $i < count($permissions); $i++){

            // create permission

            $permissionGroup = $permissions[$i]['group_name'];

            for($j = 0; $j < count($permissions[$i]['permissions']); $j++){

                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }



        }
    }
}
