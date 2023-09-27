<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class UserService
{
    public function show(int $user_id)
    {
        return User::with('subscriptions.transactions')->where('id', $user_id)->first();
    }

    public function store(array $userData)
    {
        $userData["password"] = Hash::make($userData["password"]);

        $user = User::create($userData);

        return $user;
    }

    public function update(array $userData, User $user)
    {
        $user->update($userData);

    }

}
