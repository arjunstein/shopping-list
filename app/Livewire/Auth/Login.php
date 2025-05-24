<?php

namespace App\Livewire\Auth;

use App\Repositories\Auth\AuthRepository;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Title('Login page')]
    #[Layout('components.layouts.auth')]

    public $username, $password;
    public $remember = false;

    protected $authRepository;

    public function boot(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function signIn()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            $this->authRepository->login($this->username, $this->password, $this->remember);

            $intendedUrl = session()->pull('url.intended', route('dashboard'));

            return $this->redirect($intendedUrl, navigate: true);
        } catch (\Throwable $e) {
            $this->addError('username', $e->getMessage());
        }
    }
}
