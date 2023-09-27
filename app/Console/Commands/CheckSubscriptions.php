<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:subscriptions {price=250}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all subscriptions. If exists expired subscriptions, renew its by default price.';

    /**
     * Execute the console command.
     */

    public function check_subscriptions()
    {
        $today_start = Carbon::now()->startOfDay();
        $today_end = Carbon::now()->endOfDay();

        $expired_subscriptions = Subscription::whereDate('expired_at', '>=', $today_start)->whereDate('expired_at', '<=', $today_end)->get();

        foreach ($expired_subscriptions as $subscription) {

            $transaction_data = [
                'subscription_id' => $subscription->id,
                'price' => $this->argument('price')
            ];

            $transaction = Transaction::create($transaction_data);

            if($transaction->id > 0) {
                echo "\nPayment successfull for subscription id : " . $subscription->id . "\n";

                $subscription_data = [
                    'renewed_at' => Carbon::now(),
                    'expired_at' => Carbon::now()->addMonth()->endOfDay()
                ];

                $update_subscription = Subscription::where('id', $subscription->id)->update($subscription_data);

                if($update_subscription) {
                    echo "\nRenewed and set expired for subscription id : " . $subscription->id . "\n";
                }
            }
        }
    }

    public function handle()
    {
        $this->info("\nChecking expired subscriptions. Subscription will be paid for price: " . $this->argument('price') . "\n");
        $this->check_subscriptions();
        $this->info("\nExpired subscriptions successfully renewed.");

        return true;
    }
}
