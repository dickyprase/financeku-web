<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\AuthService;

class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public string $error = '';
    public bool $loading = false;

    public function login(AuthService $auth): void
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $this->loading = true;
        $this->error = '';

        $result = $auth->login($this->email, $this->password);

        if ($result['success']) {
            $this->redirect('/');
        } else {
            $this->error = $result['message'];
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.auth.login')
            ->layout('components.layouts.guest');
    }
}
