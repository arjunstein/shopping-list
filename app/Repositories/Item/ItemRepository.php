<?php

namespace App\Repositories\Item;

use LaravelEasyRepository\Repository;

interface ItemRepository extends Repository
{
    public function getAllItems($perPage);
    public function getAllCategories();
    public function searchItem($search, $perPage);
    public function createItem(array $data);
    public function getItemById($id);
    public function updateItem($id, array $data);
    public function deleteItem($id);
}
