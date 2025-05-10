<?php

namespace App\Livewire\Category;

use App\Repositories\Category\CategoryRepository;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategory extends Component
{
    use WithPagination;

    #[Title('List Category')]
    public $perPage = 10;
    protected $categoryRepository;

    public function boot(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function render()
    {
        $categories = $this->categoryRepository->getAllCategories($this->perPage);

        return view('livewire.category.list-category', [
            'title' => 'List Category',
            'categories' => $categories,
        ]);
    }

    public function deleteCategory($id)
    {
        $this->categoryRepository->deleteCategory($id);
        session()->flash('message', 'Category deleted successfully.');
    }
}
