<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Permissions\Permission;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Permission::create([
            'name' => 'can_view_users',
        ]);

        Permission::create([
            'name' => 'can_create_users',
        ]);

        Permission::create([
            'name' => 'can_update_users',
        ]);

        Permission::create([
            'name' => 'can_update_permissions_users',
        ]);

        Permission::create([
            'name' => 'can_delete_users',
        ]);

        Permission::create([
            'name' => 'can_restore_users',
        ]);

        Permission::create([
            'name' => 'can_force_delete_users',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::table('permissions')->delete();
    }
};
