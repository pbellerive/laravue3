<?php

namespace Tests\Unit\Users;

use Illuminate\Validation\ValidationException;

use Tests\TestCase;

use App\Users\User;
use App\Roles\Role;
use App\Permissions\Permission;

class UserRepositoryTest extends TestCase
{
    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = new \App\Users\UserRepository();
    }

    public function test_find_user()
    {
        $user = User::factory()->create();

        $result = $this->userRepository->find($user->id);

        $this->assertTrue($user->id == $result->id);
    }

    public function test_update_user_email()
    {
        $user = User::factory()->create();

        $params = [
            'email' => $this->faker->email()
        ];

        $this->userRepository->update($user, $params);

        $user->fresh();

        $this->assertTrue($params['email'] === $user->email);
    }

    public function test_update_user_with_duplicate_email()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $params = [
            'email' => $user2->email
        ];

        $this->userRepository->update($user, $params);
    }

    public function test_update_user_with_malform_email()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $params = [
            'email' => 'asdfasdf'
        ];

        $this->userRepository->update($user, $params);
    }

    public function test_update_user_withouth_email()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $params = [
            'email' => ''
        ];

        $this->userRepository->update($user, $params);
    }

    public function test_update_user_without_firstname()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();

        $params = [
            'first_name' => '',
            'email' => $this->faker->email
        ];

        $this->userRepository->update($user, $params);
    }

    public function test_update_user_permissions()
    {
        $user = User::factory()->create();
        $user->assignRole('superadmin');

        $userToUpdate = User::factory()->create();

        $permission = Permission::factory()->create();

        $this->userRepository->updatePermissions($userToUpdate, [$permission->id]);

        $this->assertDatabaseHas('permission_user', ['user_id' => $userToUpdate->id, 'permission_id' => $permission->id]);
    }
}
