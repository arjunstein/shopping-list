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
        return $this->item->get();
    }

    public function saveSelectedItems(array $itemIds, $userId)
    {
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
}
