<?php

namespace App\Livewire\Cashflow;

use Livewire\Component;
use App\Services\ApiClient;

class TransactionForm extends Component
{
    public string $type = 'expense';
    public string $amount = '';
    public string $description = '';
    public string $date = '';
    public string $category_id = '';
    public string $wallet_id = '';
    public string $error = '';
    public bool $loading = false;
    public array $categories = [];
    public array $wallets = [];

    public function mount(ApiClient $api): void
    {
        $this->date = now()->format('Y-m-d');

        $catResponse = $api->get('/categories');
        if ($catResponse->successful()) {
            $this->categories = $catResponse->json('data') ?? [];
        }

        $walletResponse = $api->get('/wallets');
        if ($walletResponse->successful()) {
            $this->wallets = $walletResponse->json('data') ?? [];
        }
    }

    public function save(ApiClient $api): void
    {
        $this->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|min:2',
            'date' => 'required|date',
            'wallet_id' => 'required',
        ]);

        $this->loading = true;
        $this->error = '';

        $response = $api->post('/transactions', [
            'type' => $this->type,
            'amount' => (float) $this->amount,
            'description' => $this->description,
            'date' => $this->date,
            'category_id' => $this->category_id ?: null,
            'wallet_id' => (int) $this->wallet_id,
        ]);

        if ($response->successful()) {
            $this->redirect('/cashflow');
        } else {
            $this->error = $response->json('message', 'Failed to save transaction');
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.cashflow.transaction-form')
            ->layout('components.layouts.app');
    }
}
