<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class SubscriptionService
{
    public function store(array $subscriptionData, int $user_id)
    {
        $subscriptionData["user_id"] = $user_id;

        $subscription = Subscription::create($subscriptionData);

        return $subscription;
    }

    public function update(array $subscriptionData, int $subscription_id)
    {
        return Subscription::where('id', $subscription_id)->update($subscriptionData);
    }

    public function destroy(int $subscription_id)
    {
        return Subscription::where('id', $subscription_id)->delete();
    }
}
