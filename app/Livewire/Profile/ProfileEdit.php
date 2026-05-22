<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Services\ApiClient;
use Illuminate\Support\Facades\Session;

class ProfileEdit extends Component
{
    public string $name = '';
    public string $phone = '';
    public string $telegram = '';
    public string $salary = '';
    public string $meal_allowance = '';
    public string $error = '';
    public string $success = '';
    public bool $loading = false;

    public function mount(ApiClient $api): void
    {
        $user = Session::get('api_user');
        if ($user) {
            $this->name = $user['name'] ?? '';
            $this->phone = $user['phone'] ?? '';
            $this->telegram = $user['telegram'] ?? '';
            $this->salary = (string) ($user['salary'] ?? '');
            $this->meal_allowance = (string) ($user['meal_allowance'] ?? '');
        }
    }

    public function save(ApiClient $api): void
    {
        $this->validate([
            'name' => 'required|min:2',
        ]);

        $this->loading = true;
        $this->error = '';
        $this->success = '';

        $response = $api->put('/profile', [
            'name' => $this->name,
            'phone' => $this->phone,
            'telegram' => $this->telegram,
            'salary' => (float) $this->salary,
            'meal_allowance' => (float) $this->meal_allowance,
        ]);

        if ($response->successful()) {
            $this->success = 'Profile updated successfully';
            $user = $response->json('data');
            if ($user) {
                Session::put('api_user', $user);
            }
        } else {
            $this->error = $response->json('message', 'Failed to update profile');
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.profile.profile-edit')
            ->layout('components.layouts.app');
    }
}
