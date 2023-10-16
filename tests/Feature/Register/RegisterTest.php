<?php

namespace Tests\Feature\Register;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * Test Successful Registration
     */
    public function test_successful_registration()
    {
        $user = User::factory()->make();

        $user_data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ];

        $this->json('POST', '/api/v1/register', $user_data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                    "data" => [
                        'id',
                        'name',
                        'email'
                    ]
            ]);
    }
}
