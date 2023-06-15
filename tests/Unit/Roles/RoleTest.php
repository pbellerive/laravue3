<?php

namespace Tests\Unit\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Users\User;
use App\Roles\Role;
use App\Permissions\Permission;

class RoleTest extends TestCase
{
    public function test_role_assign_permission()
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();

        $role->assignPermission($permission);

        $this->assertDatabaseHas('permission_role', ['role_id' => $role->id, 'permission_id' => $permission->id]);
    }

    public function test_role_has_permission()
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();

        $role->assignPermission($permission);

        $this->assertTrue($role->hasPermission($permission->name));
    }

    public function test_role_remove_permission()
    {
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();

        $role->assignPermission($permission);
        $role->removePermission($permission);

        $this->assertDatabaseMissing('permission_role', ['role_id' => $role->id, 'permission_id' => $permission->id]);
    }
}
