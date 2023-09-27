<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class RenewSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        renew:subscription
        {user_id}
        {subscription_id}
        {price=250}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renew subscription by given parameters';

    /**
     * Execute the console command.
     */
    public function renew_subscription()
    {
        $user_id = $this->argument('user_id');

        $request_params = [
            'subscription_id' => $this->argument('subscription_id'),
            'price' => $this->argument('price')
        ];

        $request = Request::create('api/v1/user/' . $user_id . '/transaction', 'POST', $request_params);

        $response = app()->handle($request);

        $responseBody = $response->getContent();

        echo "Process result: \n\n" . $responseBody . "\n";

    }

    /**
     * @throws Exception
     */
    public function handle(): bool
    {
        $this->info("\nUpdating subscription for price: " . $this->argument('price') . "\n");
        $this->renew_subscription();
        $this->info("\nSuccessfully updated.");

        return true;
    }
}
