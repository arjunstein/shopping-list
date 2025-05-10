<?php

namespace App\Repositories\Category;

use LaravelEasyRepository\Repository;

interface CategoryRepository extends Repository
{
    public function getAllCategories($perPage);
    public function createCategory(array $data);
    public function getCategoryById($id);
    public function updateCategory($id, array $data);
    public function deleteCategory($id);
}
