<?php

namespace Tests\Unit\Users;

use Tests\TestCase;

use App\Users\User;
use App\Roles\Role;
use App\Permissions\Permission;
use App\Users\UserRepository;
use Mockery;
use Mockery\MockInterface;

class UserControllerTest extends TestCase
{
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
    }

    public function testUpdateMyUserProfile()
    {
        $user = User::factory()->create();
        $params = [
            'first_name' => 'New first name',
            'last_name' => 'New last name',
            'email' => 'newemail@email.com'
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertOk();
        $this->assertDatabaseHas('users', $params);
    }

    public function testUpdateNotMyUserProfile()
    {
        $user = User::factory()->create();
        $user2 = User::offset(1)->first();

        $params = [
            'first_name' => 'New first name not working',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user2->id, $params);

        $response->assertForbidden();
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name]);
    }

    public function testUpdateIllFormedEmailUserProfile()
    {
        $user = User::factory()->create();

        $params = [
            'email' => 't@',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdateEmptyEmailUserProfile()
    {
        $user = User::factory()->create();

        $params = [
            'email' => '',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdateWithDuplicateEmailFromOtherUserProfile()
    {
        $user = User::factory()->create();
        $user2 = User::offset(1)->first();

        $params = [
            'email' => $user2->email,
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdateWithMyEmailOtherUserProfile()
    {
        $user = User::factory()->create();

        $params = [
            'email' => $user->email,
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertOk();
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdatePasswordProfile()
    {
        $user = User::factory()->create();

        $params = [
            'password' => 'newPassword',
            'password_confirmation' => 'newPassword',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertOk();

        $user->fresh();
    }

    public function testUpdateWrongPasswordConfirmationProfile()
    {
        $user = User::factory()->create();

        $params = [
            'password' => 'newPassword',
            'password_confirmation' => 'newPassword-wrong',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', $user->getAttributes());
    }

    public function testUpdateWithoutPassword_shouldNotChange()
    {
        $user = User::factory()->create();
        $currentHash = $user->password;

        $params = [
            'first_name' => 'test firstname',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertOk();

        $user->refresh();
        $this->assertDatabaseHas('users', $params);
        $this->assertTrue($user->password == $currentHash);
    }

    public function test_get_view_user_as_superAdmin()
    {
        $user = User::factory()->create();
        $superadmin = User::factory()->create();
        $this->userRepository->assignRole($superadmin, Role::where('name', '=', 'superadmin')->first());

        $response = $this->actingAs($superadmin)->json('get', '/api/users/' . $user->id);

        $response->assertOk();
        $this->assertTrue($user->id == $response->getData()->data->id);
    }

    public function test_get_view_user_as_user()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $response = $this->actingAs($user)->json('get', '/api/users/' . $user->id);

        $response->assertForbidden();
    }

    public function test_update_user_permissions_as_user_without_permission()
    {
        $user = User::factory()->create();

        $userToUpdate = User::factory()->create();

        $permission = Permission::factory()->create();

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $userToUpdate->id, [ 'permissions' => $permission->id]);

        $response->assertForbidden();
    }

    public function test_update_user_permissions_as_user_as_superadmin()
    {
        $user = User::factory()->create();
        $this->userRepository->assignRole($user, 'superadmin');

        $userToUpdate = User::factory()->create();

        $permission = Permission::factory()->create();

        $mock = $this->mock(UserRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('update')->once();
        });

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $userToUpdate->id, [ 'permissions' => $permission->id]);

        $response->assertOk();
    }

    public function test_update_user_permissions_as_user_having_permission()
    {
        $user = User::factory()->create();
        $user->assignPermission('can_update_users');
        $user->assignPermission('can_update_permissions_users');

        $userToUpdate = User::factory()->create();

        $permission = Permission::factory()->create();

        $mock = $this->mock(UserRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('update')->once();
        });

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $userToUpdate->id, [ 'permissions' => $permission->id]);

        $response->assertOk();
    }

    public function test_update_myself_permissions_as_user_having_permission()
    {
        $user = User::factory()->create();
        $user->assignPermission('can_update_users');
        $user->assignPermission('can_update_permissions_users');

        $permission = Permission::factory()->create();

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, [ 'permissions' => $permission->id]);

        $response->assertForbidden();
    }

    public function test_remove_user_role_has_myself()
    {

        $user = User::factory()->create();
        $role = Role::factory()->create();

        $this->userRepository->assignRole($user, $role);

        $response = $this->actingAs($user)->json('delete', '/api/users/'. $user->id .'/role/' . $role->id);

        $response->assertForbidden();
        $this->assertDatabasehas('role_user', ['role_id' => $role->id, 'user_id' => $user->id]);
    }
}
