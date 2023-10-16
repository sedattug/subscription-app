<?php

namespace Tests\Feature\Subscription;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Subscription;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriptionTest extends TestCase
{
    /**
     * Test successfull subscription
     */
    public function test_successful_subscription()
    {
        $user_id = Subscription::latest()->first()->user->id;
        $url = '/api/v1/user/' . $user_id . '/subscription';
        $subscription_data = [
            'renewed_at' => Carbon::now()->startOfDay(),
	        'expired_at' => Carbon::now()->addMonth()->endOfDay()
        ];

        $this->json('POST', $url, $subscription_data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'renewed_at',
                    'expired_at'
                ]
            ]);
    }
}
