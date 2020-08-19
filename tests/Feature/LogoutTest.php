<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * Test Logout endpoint nulls user token.
     *
     * @return void
     */
    public function testLogoutSuccessfully() : void
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $this->json('post', 'api/logout', [], $headers)->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    /**
     * Test guarded routes need valid auth token.
     *
     * @return void
     */    
    public function testGuardedRoutesNeedAuth() : void
    {
        // Simulating login
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        // Simulating logout
        $user->api_token = null;
        $user->save();

        $this->json('post', 'api/operation', ['expression' => '2+2'], $headers)->assertStatus(401);
    }
}
