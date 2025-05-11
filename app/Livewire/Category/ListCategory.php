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
    public $search = '';
    public $perPage = 10;
    public $selectedCategory = null;
    public $showModal = false;
    protected $categoryRepository;

    public function boot(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function render()
    {
        $categories = $this->categoryRepository->searchCategories($this->search, $this->perPage);

        if ($this->search) {
            $categories = $this->categoryRepository->searchCategories($this->search, $this->perPage);
        } else {
            $categories = $this->categoryRepository->getAllCategories($this->perPage);
        }

        return view('livewire.category.list-category', [
            'title' => 'List Category',
            'categories' => $categories,
        ]);
    }

    public function deleteCategory($id)
    {
        $this->categoryRepository->deleteCategory($id);
        $this->dispatch('show-alert', message: 'Category deleted successfully!');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function showDetailCategory($category_id)
    {
        $this->selectedCategory = $this->categoryRepository->getCategoryById($category_id);
        $this->showModal = true;
    }
}
