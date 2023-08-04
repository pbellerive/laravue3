<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Roles\Role;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create([
            'name' => 'superadmin',
        ]);

        $admin = Role::create([
            'name' => 'admin',
        ]);

        $admin->assignPermission('can_view_users');
        $admin->assignPermission('can_create_users');
        $admin->assignPermission('can_update_users');
        $admin->assignPermission('can_update_permissions_users');
        $admin->assignPermission('can_update_roles_users');
        $admin->assignPermission('can_delete_users');
        $admin->assignPermission('can_restore_users');
        $admin->assignPermission('can_force_delete_users');

        Role::create([
            'name' => 'user',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('roles')->delete();

    }
};
