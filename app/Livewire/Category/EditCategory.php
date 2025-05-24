<?php

namespace App\Livewire\Category;

use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCategory extends Component
{
    use WithFileUploads;

    #[Title('Edit Category')]
    public $category_id;
    public $name;
    public $description;
    public $image;
    protected $categoryRepository;

    public function boot(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function mount($id)
    {
        $this->category_id = $id;

        $category = $this->categoryRepository->getCategoryById($id);

        $this->name = $category->name;
        $this->description = $category->description;
        $this->image = $category->image;
    }

    public function editCategory()
    {
        $this->categoryRepository->updateCategory($this->category_id, [
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
        ]);

        session()->flash('success', 'Category updated successfully.');
        return $this->redirect(route('category'), navigate: true);
    }

    public function render()
    {
        return view('livewire.category.edit-category', [
            'title' => 'Edit Category',
        ]);
    }
}
