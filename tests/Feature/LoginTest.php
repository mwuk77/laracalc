<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Config;

class LoginTest extends TestCase
{
    /**
     * Test that Login endpoint requires both Email and Password field.
     *
     * @return void
     */
    public function testLoginRequiresEmailAndLogin() : void
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }
    
    /**
     * Test can login with valid credentials..
     *
     * @return void
     */
    public function testLoginSuccessfully() : void
    {
        $payload = [
            'email' => Config('user.front_email'), 
            'password' => Config('user.front_password')
        ];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);

    }
    
}
