<?php

namespace App\Repositories\Dashboard;

use LaravelEasyRepository\Repository;

interface DashboardRepository extends Repository
{
    public function countUsers();
    public function countCategories();
    public function countItems();
}
