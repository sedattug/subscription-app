<?php

namespace App\Services;

use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class TransactionService
{
    public function store(array $transactionData)
    {
        $transaction = Transaction::create($transactionData);

        return $transaction;
    }

    public function delete(int $id)
    {
        //
    }

}
