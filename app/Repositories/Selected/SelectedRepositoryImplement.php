<?php

namespace App\Repositories\Selected;

use App\Models\Item;
use App\Models\Selected;
use App\Repositories\Selected\SelectedRepository;
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

        // range date
        $startDate = now()->startOfMonth()->setDay(27)->startOfDay();
        $endDate = now()->addMonth()->startOfMonth()->setDay(10)->endOfDay();

        if ($today->between($startDate, $endDate)) {
            return $this->item->with('category')
                ->orderBy('item_name', 'asc')
                ->get();
        }

        return collect([]);
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
}
