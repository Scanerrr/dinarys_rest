<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUsersAreCreatedCorrectly()
    {
        $user = factory(User::class)->create([
            'name' => 'Lorem',
            'email' => 'test@test.com',
            'password' => '123456',
        ]);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name' => 'Lorem1',
            'email' => 'test1@test.com',
            'password' => '123456',
        ];

        $this->json('POST', 'api/users', $payload, $headers)
            ->assertStatus(201)
            ->assertJson(['name' => 'Lorem1', 'email' => 'test1@test.com']);
    }

    public function testsUsersAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $user = factory(User::class)->create([
            'email' => 'test@test.com'
        ]);
        $payload = [
            'email' => 'test1@test.com'
        ];

        $response = $this->json('PUT', '/api/users/' . $user->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([

                'email' => 'test1@test.com'
            ]);
    }

    public function testsUsersAreDeletedCorrectly()
    {
        $user = factory(User::class)->create([
            'name' => 'Lorem2',
            'email' => 'test2@test.com'
        ]);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];


        $this->json('DELETE', 'api/users/' . $user->id, [], $headers)
            ->assertStatus(204);
    }

    public function testUsersAreListedCorrectly()
    {
        factory(User::class)->create([
            'name' => 'Administrator',
            'email' => 'admin@test.com'
        ]);

        factory(User::class)->create([
            'name' => 'Test',
            'email' => 'testuser1@test.com'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', 'api/users', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'name' => 'Administrator', 'email' => 'admin@test.com' ],
                [ 'name' => 'Test', 'email' => 'testuser1@test.com' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'email', 'created_at', 'updated_at'],
            ]);
    }
}
