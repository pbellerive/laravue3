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

        $permissionView = Permission::create(['name' => 'view']);
        $permissionCreate = Permission::create(['name' => 'create']);
        $permissionUpdate = Permission::create(['name' => 'update']);
        $permissionDelete = Permission::create(['name' => 'delete']);

        $roleAdmin->givePermissionTo($permissionView);
        $roleAdmin->givePermissionTo($permissionCreate);
        $roleAdmin->givePermissionTo($permissionUpdate);
        $roleAdmin->givePermissionTo($permissionDelete);
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
