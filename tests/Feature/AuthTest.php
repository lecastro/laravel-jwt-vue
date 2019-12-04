<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $user->password,
        ]);

        // $response->assertRedirect(route('home'));
        // $this->assertAuthenticatedAs($user);
    }
}
