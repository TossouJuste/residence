<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Créer les permissions
        $permissions = [
            'manage_users',
            'create_year',
            'planification_create',
            'consult_demands',
            'launch_distribution',
            'view_classement',
            'create_permission'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Créer les rôles
        $adminRole = Role::create(['name' => 'Admin']);
        $intendantRole = Role::create(['name' => 'Intendant']);
        $caissiereRole = Role::create(['name' => 'Caissière']);

        // Attribuer des permissions aux rôles
        $adminRole->givePermissionTo(Permission::all()); // Admin a toutes les permissions

        $intendantRole->givePermissionTo([
            'consult_demands',
            'launch_distribution',
            'view_classement',
            'create_year',
            'planification_create',
        ]);

        $caissiereRole->givePermissionTo(['view_classement']);
    }
}




