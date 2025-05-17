<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;
use App\Models\Item;
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
}
