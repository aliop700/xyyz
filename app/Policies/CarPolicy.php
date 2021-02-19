<?php

namespace App\Policies;

use App\Car;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->role_id == 1) {
            return true;
        }
    }
}
