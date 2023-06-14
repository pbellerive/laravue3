<?php

namespace Tests\Unit\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testUpdateMyUserProfile()
    {
        $user = \App\Users\User::first();
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
        $user = \App\Users\User::first();
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
        $user = \App\Users\User::first();

        $params = [
            'email' => 't@',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdateEmptyEmailUserProfile()
    {
        $user = \App\Users\User::first();

        $params = [
            'email' => '',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdateWithDuplicateEmailFromOtherUserProfile()
    {
        $user = \App\Users\User::first();
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
        $user = \App\Users\User::first();

        $params = [
            'email' => $user->email,
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertOk();
        $this->assertDatabaseHas('users', ['first_name' => $user->first_name, 'email' => $user->email]);
    }

    public function testUpdatePasswordProfile()
    {
        $user = \App\Users\User::first();

        $params = [
            'password' => 'newPassword',
            'password_confirmation' => 'newPassword',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $response->assertOk();

        $user->refresh();
        $this->assertTrue(password_verify($params['password'], $user->password));
    }

    public function testUpdateWrongPasswordConfirmationProfile()
    {
        $user = \App\Users\User::first();

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
        $user = \App\Users\User::first();
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

    public function testUpdateBirthDate()
    {
        $user = \App\Users\User::first();

        $params = [
            'birth_date' => '1978-02-02',
        ];

        $response = $this->actingAs($user)->json('patch', '/api/users/' . $user->id, $params);

        $params['id'] = $user->id;

        $response->assertOk();
        $this->assertDatabaseHas('users', $params);
    }

}
