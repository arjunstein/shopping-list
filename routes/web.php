<?php

use App\Livewire\Category\CreateCategory;
use App\Livewire\Category\EditCategory;
use App\Livewire\Category\ListCategory;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/category', ListCategory::class)->name('category');
Route::get('/category/create', CreateCategory::class)->name('category-create');
Route::get('/category/edit/{id}', EditCategory::class)->name('category-edit');
