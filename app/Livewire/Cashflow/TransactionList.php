<?php

namespace App\Livewire\Cashflow;

use Livewire\Component;
use App\Services\ApiClient;

class TransactionList extends Component
{
    public array $transactions = [];
    public bool $loading = true;
    public string $error = '';

    public function mount(ApiClient $api): void
    {
        $response = $api->get('/transactions');

        if ($response->successful()) {
            $this->transactions = $response->json('data') ?? [];
        } else {
            $this->error = 'Failed to load transactions';
        }

        $this->loading = false;
    }

    public function delete(int $id, ApiClient $api): void
    {
        $response = $api->delete("/transactions/{$id}");

        if ($response->successful()) {
            $this->transactions = array_values(
                array_filter($this->transactions, fn($t) => $t['id'] !== $id)
            );
        }
    }

    public function render()
    {
        return view('livewire.cashflow.transaction-list')
            ->layout('components.layouts.app');
    }
}
