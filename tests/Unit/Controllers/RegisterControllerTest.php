<?php

namespace Tests\Unit\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use WithFaker;

    public function testRegisterHappyPath()
    {

        $params = [
            'first_name' => $this->faker()->firstName(),
            'last_name' => $this->faker()->lastName(),
            'email' => $this->faker()->email(),
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->json('post', '/api/register', $params);
        $response->assertOk();

        unset($params['password']);
        unset($params['password_confirmation']);
        $this->assertDatabaseHas('users', $params);

        $user = \App\Users\User::where('email', $params['email'])->first();
        $this->assertTrue($user->hasRole('client'));
    }

    public function testRegisterWithoutFirstName_return422()
    {

        $params = [
            'last_name' => $this->faker()->lastName(),
            'email' => $this->faker()->email(),
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->json('post', '/api/register', $params);
        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
    }

    public function testRegisterWithoutLastName_return422()
    {

        $params = [
            'first_name' => $this->faker()->firstName(),
            'email' => $this->faker()->email(),
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->json('post', '/api/register', $params);
        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
    }

    public function testRegisterWithoutEmail_return422()
    {

        $params = [
            'first_name' => $this->faker()->firstName(),
            'last_name' => $this->faker()->lastName(),
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->json('post', '/api/register', $params);
        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
    }

    public function testRegisterWithInvalidEmail_return422()
    {

        $params = [
            'first_name' => $this->faker()->firstName(),
            'last_name' => $this->faker()->lastName(),
            'email' => 'test@',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->json('post', '/api/register', $params);
        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
    }

    public function testRegisterWithBirthDateGreaterThanToday_return422()
    {

        $params = [
            'first_name' => $this->faker()->firstName(),
            'last_name' => $this->faker()->lastName(),
            'birth_date' => $this->faker()->dateTimeInInterval('now', '+10 days'),
            'email' => $this->faker()->email(),
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->json('post', '/api/register', $params);
        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
    }

    public function testRegisterWithNotUniqueEmail_return422()
    {
        $existingUser = \App\Users\User::first();

        $params = [
            'first_name' => $this->faker()->firstName(),
            'last_name' => $this->faker()->lastName(),
            'email' => $existingUser->email,
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $response = $this->json('post', '/api/register', $params);
        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
    }


    public function testRegisterWithoutPasswordConfirmationValid_return422()
    {

        $params = [
            'first_name' => $this->faker()->firstName(),
            'last_name' => $this->faker()->lastName(),
            'email' => $this->faker()->email(),
            'password' => '123456',
            'password_confirmation' => 'Abcd'
        ];

        $response = $this->json('post', '/api/register', $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
    }

    public function testRegisterWithEmptyPasswordConfirmation_return422()
    {

        $params = [
            'first_name' => $this->faker()->firstName(),
            'last_name' => $this->faker()->lastName(),
            'email' => $this->faker()->email(),
            'password' => '123456',
            'password_confirmation' => ''
        ];

        $response = $this->json('post', '/api/register', $params);

        $response->assertStatus(self::UNPROCESSABLE_ENTITY);
    }
}
