<?php

namespace Tests\Feature;

use App\Helpers\DefaultDataTest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function test_user_register()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $document = Document::first();

        $document_id = $document->id;
        $name = 'User New';
        $email = 'usernew@gmail.com';
        $password = '1234';

        $response = $this->post('/api/auth/register', [
            'document_id' => $document_id,
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus(201);

        $response->assertJsonStructure(['message', 'user']);

        $this->assertDatabaseHas('users', [
            'document_id' => $document_id,
            'name' => $name,
            'email' => $email
        ]);

        $this->assertDatabaseCount('users', 2);
    }

    /** @test */
    public function test_user_login()
    {
        $this->withoutExceptionHandling();

        DefaultDataTest::data_seed();

        $user = User::first();

        $email = $user->email;
        $password = '1234';

        $response = $this->post('/api/auth/login', [
            'email' => $email,
            'password' => $password
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    /** @test */
    public function test_user_logout()
    {
        DefaultDataTest::data_seed();
        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/auth/logout');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'message' => 'Successfully logged out'
            ]);
    }

    /** @test */
    public function test_get_users()
    {
        DefaultDataTest::data_seed();

        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/auth/user');

        $response->assertStatus(200);
    }

    /** @test */
    public function test_user_refresh()
    {

        DefaultDataTest::data_seed();

        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/auth/refresh');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }
}
