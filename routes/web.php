<?php

use App\Livewire\Auth\Login;
use App\Livewire\Category\CreateCategory;
use App\Livewire\Category\EditCategory;
use App\Livewire\Category\ListCategory;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Item\CreateItem;
use App\Livewire\Item\EditItem;
use App\Livewire\Item\ListItem;
use App\Livewire\Landing;
use App\Livewire\ShopListNow;
use Illuminate\Support\Facades\Route;

Route::get('/', Landing::class)->name('landing');

Route::get('/auth/login', Login::class)->name('login')->middleware('guest');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/category', ListCategory::class)->name('category');
    Route::get('/category/create', CreateCategory::class)->name('category-create');
    Route::get('/category/edit/{id}', EditCategory::class)->name('category-edit');
    Route::get('/item', ListItem::class)->name('item');
    Route::get('/item/create', CreateItem::class)->name('item-create');
    Route::get('/item/edit/{id}', EditItem::class)->name('item-edit');

    Route::get('/shop-list-now', ShopListNow::class)->name('shop-list-now');
});
