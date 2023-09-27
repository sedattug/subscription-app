<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show(Request $request)
    {
        $user = $this->userService->show($request->user);

        return $user;
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->validated());

        return UserResource::make($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }
}
