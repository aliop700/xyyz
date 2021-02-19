<?php

namespace App\Actions;

use App\User;
use App\Consts\Roles;

class GetRedirectAction 
{
    public function __invoke(User $user): string
    {
        $roleId = $user->role_id;

        switch($roleId) {
            case Roles::ADMIN:
                return route('admin');
            case Roles::USER:
                return route('home');
            default:
                throw new \Exception;
        }
    }
}