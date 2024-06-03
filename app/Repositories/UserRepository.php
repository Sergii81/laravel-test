<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    public function getModel(): Model
    {
        return new User();
    }
}
