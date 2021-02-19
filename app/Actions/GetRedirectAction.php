<?php

namespace App\Actions;

use App\User;
use App\Consts\Roles;

class GetRedirectAction 
{
    public function __invoke(User $user): string
    {
        $roleId = $user->role_id;

        switch($role_id) {
            case Roles::ADMIN:
                return route('admin');
            case Roles::USER:
                return route();
            default:
                throw new \Exception;
        }
    }
}