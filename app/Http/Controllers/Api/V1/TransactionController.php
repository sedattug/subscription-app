<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Services\SubscriptionService;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Carbon\Carbon;

class TransactionController extends Controller
{
    private TransactionService $transactionService;
    private SubscriptionService $subscriptionService;

    public function __construct(TransactionService $transactionService, SubscriptionService $subscriptionService)
    {
        $this->transactionService = $transactionService;
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
    public function store(StoreTransactionRequest $request)
    {
        $transaction = Subscription::where(['id' => $request->subscription_id, 'user_id' => $request->id])->first();

        if (!$transaction) {
            return response()->json(['message' => 'Matched Row Not Found!'], 404);
        }

        $transaction = $this->transactionService->store($request->validated());

        $subscriptionData = [
            'id' => $request->subscription_id,
            'user_id' => $request->id,
            'renewed_at' => Carbon::now(),
            'expired_at' => Carbon::now()->addMonth()->endOfDay()
        ];

        $this->subscriptionService->update($subscriptionData, $request->subscription_id);

        return TransactionResource::make($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }
}
