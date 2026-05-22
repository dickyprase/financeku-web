<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\ApiClient;

class Dashboard extends Component
{
    public array $stats = [];
    public bool $loading = true;
    public string $error = '';

    public function mount(ApiClient $api): void
    {
        $response = $api->get('/reports/dashboard');

        if ($response->successful()) {
            $this->stats = $response->json('data') ?? [];
        } else {
            $this->error = 'Failed to load dashboard data';
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('components.layouts.app');
    }
}
