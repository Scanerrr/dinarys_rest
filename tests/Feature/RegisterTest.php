<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegistersSuccessfully()
    {
        $payload = [
            'name' => 'Diggle',
            'email' => 'diggle@gm.test',
            'password' => '123456',
            'password_confirmation' => '123456'
        ];

        $this->json('POST', 'api/register', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token'
                ]
            ]);
    }

    public function testRequirePasswordAndEmail() {
        $this->json('POST', 'api/register')
            ->assertStatus(422)
            ->assertJson([
                    'errors' => [
                    'name' => [ 'The name field is required.' ],
                    'email' => [ 'The email field is required.' ],
                    'password' => [ 'The password field is required.' ]
                ]
            ]);
    }

    public function testRequirePasswordConfirmation() {
        $payload = [
            'name' => 'Diggle',
            'email' => 'diggle@gm.test',
            'password' => '123456'
        ];
        $this->json('POST', 'api/register', $payload)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'password' => [ 'The password confirmation does not match.' ],
                ]
            ]);
    }
}
