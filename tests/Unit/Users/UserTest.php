<?php

namespace Tests\Unit\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Users\User;
use App\Roles\Role;
use App\Permissions\Permission;

class UserTest extends TestCase
{
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new \App\Users\UserRepository();
    }

    public function test_user_assign_user_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $this->userRepository->assignRole($user, $role);

        $this->assertDatabaseHas('role_user', ['role_id' => $role->id, 'user_id' => $user->id]);
    }

    public function test_user_assign_user_string_role()
    {
        $user = User::factory()->create();
        $role = 'user';

        $this->userRepository->assignRole($user, $role);

        $roleModel = Role::where('name', '=', 'user')->first();

        $this->assertDatabaseHas('role_user', ['role_id' => $roleModel->id, 'user_id' => $user->id]);
    }

    public function test_user_has_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $this->userRepository->assignRole($user, $role);

        $this->assertTrue($user->hasRole($role->name));
    }

    public function test_user_has_not_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $role2 = Role::factory()->create();

        $this->userRepository->assignRole($user, $role);

        $this->assertTrue(!$user->hasRole($role2->name));
    }

    public function test_user_has_permission_through_role()
    {

        $user = User::factory()->create();
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();

        $role->assignPermission($permission);

        $this->userRepository->assignRole($user, $role);

        $this->assertTrue($user->hasPermission($permission->name));
    }

    public function test_user_assign_permission()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $permission = Permission::factory()->create();

        $user->assignPermission($permission);

        $this->assertDatabaseHas('permission_user', ['permission_id' => $permission->id, 'user_id' => $user->id]);
    }

    public function test_user_has_permission()
    {
        $user = User::factory()->create();
        $permission = Permission::factory()->create();

        $user->assignPermission($permission);


        $this->assertTrue($user->hasPermission($permission->name));
    }

    public function test_user_remove_permission()
    {
        $user = User::factory()->create();
        $permission = Permission::factory()->create();

        $user->assignPermission($permission);
        $user->removePermission($permission);


        $this->assertDatabaseMissing('permission_user', ['permission_id' => $permission->id, 'user_id' => $user->id]);
    }

    public function test_user_remove_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $this->userRepository->assignRole($user, $role);

        $this->userRepository->removeRole($role);

        $this->assertDatabaseMissing('role_user', ['role_id' => $role->id, 'user_id' => $user->id]);
    }

}
