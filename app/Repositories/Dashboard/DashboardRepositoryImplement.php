<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;
use App\Models\Item;
use App\Models\Selected;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class DashboardRepositoryImplement extends Eloquent implements DashboardRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected User $user;
    protected Category $category;
    protected Item $item;

    public function __construct(User $user, Category $category, Item $item)
    {
        $this->user = $user;
        $this->category = $category;
        $this->item = $item;
    }

    public function countUsers(): int
    {
        return $this->user->count();
    }

    public function countCategories(): int
    {
        return $this->category->count();
    }

    public function countItems(): int
    {
        return $this->item->count();
    }

    public function countMonthlyItems(): array
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $counts = Selected::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', '<=', $currentMonth)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthlyCounts = [];
        foreach (range(1, $currentMonth) as $month) {
            $monthlyCounts[] = $counts[$month] ?? 0;
        }

        return $monthlyCounts;
    }

    public function getMonthLabels(): array
    {
        $currentMonth = now()->month;
        $labels = [];

        foreach (range(1, $currentMonth) as $month) {
            $labels[] = now()->month($month)->format('F');
        }

        return $labels;
    }
}
