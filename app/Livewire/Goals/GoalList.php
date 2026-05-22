<?php

namespace App\Livewire\Goals;

use Livewire\Component;
use App\Services\ApiClient;

class GoalList extends Component
{
    public array $goals = [];
    public bool $loading = true;
    public string $error = '';

    // Create form
    public bool $showForm = false;
    public string $name = '';
    public string $target_amount = '';
    public string $target_date = '';

    public function mount(ApiClient $api): void
    {
        $this->loadGoals($api);
    }

    public function loadGoals(ApiClient $api): void
    {
        $response = $api->get('/goals');

        if ($response->successful()) {
            $this->goals = $response->json('data') ?? [];
        } else {
            $this->error = 'Failed to load goals';
        }

        $this->loading = false;
    }

    public function save(ApiClient $api): void
    {
        $this->validate([
            'name' => 'required|min:2',
            'target_amount' => 'required|numeric|min:1',
        ]);

        $data = [
            'name' => $this->name,
            'target_amount' => (float) $this->target_amount,
        ];

        if ($this->target_date) {
            $data['target_date'] = $this->target_date;
        }

        $response = $api->post('/goals', $data);

        if ($response->successful()) {
            $this->showForm = false;
            $this->name = '';
            $this->target_amount = '';
            $this->target_date = '';
            $this->loadGoals($api);
        } else {
            $this->error = $response->json('message', 'Failed to create goal');
        }
    }

    public function delete(int $id, ApiClient $api): void
    {
        $response = $api->delete("/goals/{$id}");

        if ($response->successful()) {
            $this->goals = array_values(
                array_filter($this->goals, fn($g) => $g['id'] !== $id)
            );
        }
    }

    public function render()
    {
        return view('livewire.goals.goal-list')
            ->layout('components.layouts.app');
    }
}
