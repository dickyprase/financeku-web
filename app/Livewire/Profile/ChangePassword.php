<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Services\ApiClient;

class ChangePassword extends Component
{
    public string $old_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';
    public string $error = '';
    public string $success = '';
    public bool $loading = false;

    public function save(ApiClient $api): void
    {
        $this->validate([
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $this->loading = true;
        $this->error = '';
        $this->success = '';

        $response = $api->put('/profile/password', [
            'old_password' => $this->old_password,
            'new_password' => $this->new_password,
        ]);

        if ($response->successful()) {
            $this->success = 'Password changed successfully';
            $this->old_password = '';
            $this->new_password = '';
            $this->new_password_confirmation = '';
        } else {
            $this->error = $response->json('message', 'Failed to change password');
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.profile.change-password')
            ->layout('components.layouts.app');
    }
}
