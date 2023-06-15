<?php

namespace Tests\Unit\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Users\User;
use App\Roles\Role;

class UserTest extends TestCase
{
    public function test_user_assign_user_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $user->assignRole($role);

        $this->assertDatabaseHas('role_user', ['role_id' => $role->id, 'user_id' => $user->id]);
    }

    public function test_user_has_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();

        $user->assignRole($role);

        print('*********************');
        print($role->name);
        $this->assertTrue($user->hasRole($role->name));
    }

    public function test_user_has_not_role()
    {
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $role2 = Role::factory()->create();

        $user->assignRole($role);

        print('*********************');
        print($role->name);
        $this->assertTrue(!$user->hasRole($role2->name));
    }

}
