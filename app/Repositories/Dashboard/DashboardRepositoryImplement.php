<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;
use App\Models\Item;
use App\Models\Selected;
use App\Models\User;
use App\Repositories\Dashboard\DashboardRepository;
use Illuminate\Support\Facades\Cache;
use LaravelEasyRepository\Implementations\Eloquent;

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
        $cacheKey = "user_count";
        return Cache::remember($cacheKey, 60 * 60 * 2, function () {
            return $this->user->count();
        });
    }

    public function countCategories(): int
    {
        $cacheKey = "category_count";
        return Cache::remember($cacheKey, 60 * 60 * 2, function () {
            return $this->category->count();
        });
    }

    public function countItems(): int
    {
        $cacheKey = "item_count";
        return Cache::remember($cacheKey, 60 * 60 * 2, function () {
            return $this->item->count();
        });
    }

    public function countMonthlyItems(): array
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $cacheKey = "monthly_selected_counts_{$currentYear}_{$currentMonth}";

        return Cache::remember($cacheKey, 60 * 60, function () use ($currentYear, $currentMonth) {
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
        });
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
