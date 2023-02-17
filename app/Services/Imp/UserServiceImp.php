<?php

namespace App\Services\Imp;

use App\Services\UserService;

class UserServiceImp implements UserService
{
    private array $users = ["admin" => "rahasia"];

    public function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) return false;
        $correctPassword = $this->users[$user];
        return $password == $correctPassword ? true : false;
    }
}
