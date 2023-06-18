<?php

namespace Tests\Feature\Users;

use Tests\TestCase;

use App\Users\User;
use App\Roles\Role;
use App\Permissions\Permission;
use App\Users\UserRepository;

class UserControllerTest extends TestCase
{
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
    }

    public function test_update_user_permissions_as_superadmin()
    {
        $user = User::factory()->create();
        $user->assignRole('superadmin');

        $userToUpdate = User::factory()->create();

        $permission = Permission::factory()->create();


        $response = $this->actingAs($user)->json('patch', '/api/users/' . $userToUpdate->id, [ 'permissions' => $permission->id]);

        $response->assertOk();

        $this->assertDatabaseHas('permission_user', ['user_id' => $userToUpdate->id, 'permission_id' => $permission->id]);
    }

}
