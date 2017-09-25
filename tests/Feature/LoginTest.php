<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                    'errors' => [
                        'email' => [ 'The email field is required.' ],
                        'password' => [ 'The password field is required.' ]
                ]
            ]);
    }
    /*public function testUserLoginSuccessfully() {
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => '123456'
        ]);

        $payload = ['email' => 'testlogin@user.com','password' => '123456'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'authenticated',
                'api_token',
                'user_id'
            ]);
    }*/
}
