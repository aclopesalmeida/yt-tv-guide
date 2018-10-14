<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Auth;

class UserRepository extends GenericRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

}