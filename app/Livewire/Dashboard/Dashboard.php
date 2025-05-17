<?php

namespace App\Livewire\Dashboard;

use App\Repositories\Dashboard\DashboardRepository;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\On;

class Dashboard extends Component
{
    #[Title('Dashboard')]

    protected $dashboardRepository;

    public function boot(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function render()
    {
        $users = $this->dashboardRepository->countUsers();
        $categories = $this->dashboardRepository->countCategories();
        $items = $this->dashboardRepository->countItems();

        return view('livewire.dashboard.dashboard', [
            'title' => 'Dashboard',
            'users' => $users,
            'categories' => $categories,
            'items' => $items,
        ]);
    }
}
