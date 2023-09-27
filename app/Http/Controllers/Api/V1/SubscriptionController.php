<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use Illuminate\Http\Request;
use function Ramsey\Collection\Map\get;

class SubscriptionController extends Controller
{
    private SubscriptionService $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $user = User::where(['id' => $request->id])->first();

        if (!$user) {
            return response()->noContent("404");
        }

        $subscription = $this->subscriptionService->store($request->validated(), $request->id);

        return SubscriptionResource::make($subscription);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionRequest $request)
    {
        $subscription = Subscription::where(['id' => $request->subscription, 'user_id' => $request->id])->first();

        if (!$subscription) {
            return response()->noContent("404");
        }

        $this->subscriptionService->update($request->validated(), $subscription->id);

        return SubscriptionResource::make(Subscription::find($request->subscription));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $this->subscriptionService->destroy($request->subscription);
            return response()->json(['Successfully deleted.'], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getStatus());
        }
    }
}
