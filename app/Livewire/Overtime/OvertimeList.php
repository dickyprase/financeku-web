<?php

namespace App\Livewire\Overtime;

use Livewire\Component;
use App\Services\ApiClient;

class OvertimeList extends Component
{
    public array $overtimes = [];
    public bool $loading = true;
    public string $error = '';

    public function mount(ApiClient $api): void
    {
        $response = $api->get('/overtime');

        if ($response->successful()) {
            $this->overtimes = $response->json('data') ?? [];
        } else {
            $this->error = 'Failed to load overtime records';
        }

        $this->loading = false;
    }

    public function delete(int $id, ApiClient $api): void
    {
        $response = $api->delete("/overtime/{$id}");

        if ($response->successful()) {
            $this->overtimes = array_filter($this->overtimes, fn($o) => $o['id'] !== $id);
            $this->overtimes = array_values($this->overtimes);
        }
    }

    public function render()
    {
        return view('livewire.overtime.overtime-list')
            ->layout('components.layouts.app');
    }
}
