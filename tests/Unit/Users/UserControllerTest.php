<?php

namespace Tests\Unit\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Users\User;
use App\Roles\Role;

class UserControllerTest extends TestCase
{
    public function testUpdateMyUserProfile()
    {
        $user = \App\Users\User::factory()->create();
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
        $user = \App\Users\User::factory()->create();
        $user2 = \App\Users\User::offset(1)->first();

        $params = [
            'first_name' => 'New first name not working',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user2->id, $params);

        $response->assertForbidden();
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name]);
    }

    public function testUpdateIllFormedEmailUserProfile()
    {
        $user = \App\Users\User::factory()->create();

        $params = [
            'email' => 't@',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdateEmptyEmailUserProfile()
    {
        $user = \App\Users\User::factory()->create();

        $params = [
            'email' => '',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdateWithDuplicateEmailFromOtherUserProfile()
    {
        $user = \App\Users\User::factory()->create();
        $user2 = \App\Users\User::offset(1)->first();

        $params = [
            'email' => $user2->email,
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdateWithMyEmailOtherUserProfile()
    {
        $user = \App\Users\User::factory()->create();

        $params = [
            'email' => $user->email,
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertOk();
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdatePasswordProfile()
    {
        $user = \App\Users\User::factory()->create();

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
        $user = \App\Users\User::factory()->create();

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
        $user = \App\Users\User::factory()->create();
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
        $superadmin->assignRole(Role::where('name', '=', 'superadmin')->first());

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

}
