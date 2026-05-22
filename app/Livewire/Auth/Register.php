<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\AuthService;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $error = '';
    public bool $loading = false;

    public function register(AuthService $auth): void
    {
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $this->loading = true;
        $this->error = '';

        $result = $auth->register($this->name, $this->email, $this->password);

        if ($result['success']) {
            $this->redirect('/');
        } else {
            $this->error = $result['message'];
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.auth.register')
            ->layout('components.layouts.guest');
    }
}
