<?php

namespace App\Repositories\Selected;

use LaravelEasyRepository\Repository;

interface SelectedRepository extends Repository
{
    public function getAllItems();
    public function saveSelectedItems(array $itemIds, $userId);
    public function hasSubmittedItemsThisMonth($userId);
}
