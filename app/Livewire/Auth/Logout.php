<?php

namespace App\Livewire\Auth;

use App\Repositories\Auth\AuthRepository;
use Livewire\Component;

class Logout extends Component
{
    protected $authRepository;

    public function boot(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }

    public function signOut()
    {
        $this->authRepository->logout();
        return $this->redirect(route('login'), navigate: true);
    }
}
