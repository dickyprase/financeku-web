<?php

namespace App\Livewire\Cashflow;

use Livewire\Component;
use App\Services\ApiClient;

class WalletList extends Component
{
    public array $wallets = [];
    public bool $loading = true;
    public string $error = '';

    // Create wallet form
    public bool $showForm = false;
    public string $name = '';
    public string $type = 'cash';
    public string $balance = '0';

    public function mount(ApiClient $api): void
    {
        $this->loadWallets($api);
    }

    public function loadWallets(ApiClient $api): void
    {
        $response = $api->get('/wallets');

        if ($response->successful()) {
            $this->wallets = $response->json('data') ?? [];
        } else {
            $this->error = 'Failed to load wallets';
        }

        $this->loading = false;
    }

    public function save(ApiClient $api): void
    {
        $this->validate([
            'name' => 'required|min:2',
            'type' => 'required',
        ]);

        $response = $api->post('/wallets', [
            'name' => $this->name,
            'type' => $this->type,
            'balance' => (float) $this->balance,
        ]);

        if ($response->successful()) {
            $this->showForm = false;
            $this->name = '';
            $this->type = 'cash';
            $this->balance = '0';
            $this->loadWallets($api);
        } else {
            $this->error = $response->json('message', 'Failed to create wallet');
        }
    }

    public function delete(int $id, ApiClient $api): void
    {
        $response = $api->delete("/wallets/{$id}");

        if ($response->successful()) {
            $this->wallets = array_values(
                array_filter($this->wallets, fn($w) => $w['id'] !== $id)
            );
        }
    }

    public function render()
    {
        return view('livewire.cashflow.wallet-list')
            ->layout('components.layouts.app');
    }
}
