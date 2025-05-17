<?php

namespace App\Repositories\Auth;

use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use LaravelEasyRepository\Implementations\Eloquent;

class AuthRepositoryImplement extends Eloquent implements AuthRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login(string $username, string $password, bool $remember = false)
    {
        if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
            return true;
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid username or password',
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }
}
