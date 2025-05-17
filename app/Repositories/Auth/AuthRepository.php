<?php

namespace App\Repositories\Auth;

use LaravelEasyRepository\Repository;

interface AuthRepository extends Repository
{
    public function login(string $username, string $password, bool $remember = false);
    public function logout();
}
