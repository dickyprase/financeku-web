<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use App\Services\ApiClient;

class MonthlyReport extends Component
{
    public string $month = '';
    public array $report = [];
    public bool $loading = true;
    public string $error = '';

    public function mount(ApiClient $api): void
    {
        $this->month = now()->format('Y-m');
        $this->loadReport($api);
    }

    public function updatedMonth(ApiClient $api): void
    {
        $this->loadReport($api);
    }

    public function loadReport(ApiClient $api): void
    {
        $this->loading = true;
        $response = $api->get('/reports/cashflow', ['month' => $this->month]);

        if ($response->successful()) {
            $this->report = $response->json('data') ?? [];
        } else {
            $this->error = 'Failed to load report';
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.reports.monthly-report')
            ->layout('components.layouts.app');
    }
}
