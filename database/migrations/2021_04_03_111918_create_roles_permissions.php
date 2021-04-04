<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRolesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleClient = Role::create(['name' => 'client']);
        $roleCoach = Role::create(['name' => 'coach']);

        $permission = Permission::create(['name' => 'view']);
        $permission = Permission::create(['name' => 'create']);
        $permission = Permission::create(['name' => 'update']);
        $permission = Permission::create(['name' => 'delete']);

        $permissionViewExercise = Permission::create(['name' => 'view exercise']);
        $permissionCreateExercise = Permission::create(['name' => 'create exercise']);
        $permissionUpdateExercise = Permission::create(['name' => 'update exercise']);
        $permissionDeleteExercise = Permission::create(['name' => 'delete exercise']);

        $permissionViewTraining = Permission::create(['name' => 'view training']);
        $permissionCreateTraining = Permission::create(['name' => 'create training']);
        $permissionUpdateTraining = Permission::create(['name' => 'update training']);
        $permissionDeleteTraining = Permission::create(['name' => 'delete training']);

        $permissionViewProgram = Permission::create(['name' => 'view program']);
        $permissionCreateProgram = Permission::create(['name' => 'create program']);
        $permissionUpdateProgram = Permission::create(['name' => 'update program']);
        $permissionDeleteProgram = Permission::create(['name' => 'delete program']);

        //Ajout des permissions aux roles.  Admin n'a aucune permission , dans les policy il est gérer comme tel dans les before l'admin retourne toujours TRUE pour une permisssion
        //La gestion par la bd , permet une meilleur flexibilité pour modifier rapidement les permissions
        $roleClient->givePermissionTo($permissionViewExercise);
        $roleClient->givePermissionTo($permissionViewTraining);
        $roleClient->givePermissionTo($permissionViewProgram);

        $roleCoach->givePermissionTo($permissionCreateExercise);
        $roleCoach->givePermissionTo($permissionUpdateExercise);
        $roleCoach->givePermissionTo($permissionDeleteExercise);
        $roleCoach->givePermissionTo($permissionViewExercise);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('roles_permissions');
    }
}
