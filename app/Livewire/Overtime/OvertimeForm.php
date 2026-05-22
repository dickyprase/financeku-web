<?php

namespace App\Livewire\Overtime;

use Livewire\Component;
use App\Services\ApiClient;

class OvertimeForm extends Component
{
    public string $date = '';
    public string $hours = '';
    public bool $is_holiday = false;
    public string $description = '';
    public string $error = '';
    public bool $loading = false;
    public ?array $calculation = null;

    public function mount(): void
    {
        $this->date = now()->format('Y-m-d');
    }

    public function calculate(ApiClient $api): void
    {
        if (!$this->hours) return;

        $response = $api->get('/overtime/calculate', [
            'hours' => $this->hours,
            'is_holiday' => $this->is_holiday,
        ]);

        if ($response->successful()) {
            $this->calculation = $response->json('data');
        }
    }

    public function save(ApiClient $api): void
    {
        $this->validate([
            'date' => 'required|date',
            'hours' => 'required|numeric|min:0.5',
        ]);

        $this->loading = true;
        $this->error = '';

        $response = $api->post('/overtime', [
            'date' => $this->date,
            'hours' => (float) $this->hours,
            'is_holiday' => $this->is_holiday,
            'description' => $this->description,
        ]);

        if ($response->successful()) {
            $this->redirect('/overtime');
        } else {
            $this->error = $response->json('message', 'Failed to save overtime');
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.overtime.overtime-form')
            ->layout('components.layouts.app');
    }
}
