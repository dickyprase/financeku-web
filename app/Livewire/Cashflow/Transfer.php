<?php

namespace App\Livewire\Cashflow;

use Livewire\Component;
use App\Services\ApiClient;

class Transfer extends Component
{
    public string $from_wallet_id = '';
    public string $to_wallet_id = '';
    public string $amount = '';
    public string $admin_fee = '0';
    public string $description = '';
    public string $date = '';
    public string $error = '';
    public string $success = '';
    public bool $loading = false;
    public array $wallets = [];

    public function mount(ApiClient $api): void
    {
        $this->date = now()->format('Y-m-d');

        $response = $api->get('/wallets');
        if ($response->successful()) {
            $this->wallets = $response->json('data') ?? [];
        }
    }

    public function save(ApiClient $api): void
    {
        $this->validate([
            'from_wallet_id' => 'required',
            'to_wallet_id' => 'required|different:from_wallet_id',
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
        ]);

        $this->loading = true;
        $this->error = '';
        $this->success = '';

        $response = $api->post('/wallets/transfer', [
            'from_wallet_id' => (int) $this->from_wallet_id,
            'to_wallet_id' => (int) $this->to_wallet_id,
            'amount' => (float) $this->amount,
            'admin_fee' => (float) $this->admin_fee,
            'description' => $this->description,
            'date' => $this->date,
        ]);

        if ($response->successful()) {
            $this->success = 'Transfer completed successfully';
            $this->amount = '';
            $this->admin_fee = '0';
            $this->description = '';
            // Reload wallets
            $walletResponse = $api->get('/wallets');
            if ($walletResponse->successful()) {
                $this->wallets = $walletResponse->json('data') ?? [];
            }
        } else {
            $this->error = $response->json('message', 'Transfer failed');
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.cashflow.transfer')
            ->layout('components.layouts.app');
    }
}
