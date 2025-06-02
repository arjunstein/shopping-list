<?php

namespace App\Repositories\Selected;

use App\Models\Item;
use App\Models\Selected;
use App\Repositories\Selected\SelectedRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use LaravelEasyRepository\Implementations\Eloquent;

class SelectedRepositoryImplement extends Eloquent implements SelectedRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected Selected $model;
    protected Item $item;

    public function __construct(Selected $model, Item $item)
    {
        $this->model = $model;
        $this->item = $item;
    }

    public function getAllItems()
    {
        $today = now();

        if ($today->day <= 10) {
            $startDate = now()->subMonth()->setDay(25)->startOfDay();
            $endDate = now()->setDay(10)->endOfDay();
        } else {
            $startDate = now()->setDay(25)->startOfDay();
            $endDate = now()->addMonth()->setDay(10)->endOfDay();
        }

        $cacheKey = "items_in_shop_list_" . $startDate->format('Y_m_d') . '_' . $endDate->format('Y_m_d');

        if ($today->between($startDate, $endDate)) {
            return Cache::remember($cacheKey, 60 * 60 * 2, function () {
                return $this->item->with('category')
                    ->orderBy('category_id', 'asc')
                    ->get();
            });
        }

        return collect([]);
    }

    public function hasSubmittedItemsThisMonth($userId)
    {
        $startDate = now()->startOfMonth()->setDay(25)->startOfDay();
        $endDate = now()->addMonth()->startOfMonth()->setDay(10)->endOfDay();

        return $this->model->where('user_id', $userId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->exists();
    }

    public function saveSelectedItems(array $itemIds, $userId)
    {
        // Validate the input data
        $this->_validate(['selectedItems' => $itemIds]);

        $selectedItems = [];
        foreach ($itemIds as $itemId) {
            $selectedItems[] = [
                'id' => (string) Str::uuid(),
                'user_id' => $userId,
                'item_id' => $itemId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Clear cache before inserting new items
        $this->_clearCache();

        // Insert new selected items
        return $this->model->insert($selectedItems);
    }

    // validate
    private function _validate(array $data)
    {
        $rules = [
            'selectedItems' => 'required|array',
        ];

        $messages = [
            'selectedItems.required' => 'You must select at least one item.',
            'selectedItems.array' => 'Selected items must be an array.',
        ];

        return validator($data, $rules, $messages)->validate();
    }

    private function _clearCache()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        $cacheKey = "monthly_selected_counts_{$currentYear}_{$currentMonth}";

        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
        }
    }
}
