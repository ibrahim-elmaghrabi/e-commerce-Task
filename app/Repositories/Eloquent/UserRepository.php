<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepositoryContract;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function __construct(User $user)
    {
        $this->setModel($user);
    }

    public function logout(): void
    {
        request()->user()->currentAccessToken()->delete();
    }
}