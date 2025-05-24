<?php

namespace App\Livewire\Category;

use App\Repositories\Category\CategoryRepository;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{
    use WithFileUploads;

    #[Title('Create Category')]
    public $name;
    public $description;
    public $image;

    protected $categoryRepository;

    public function boot(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function render()
    {
        return view('livewire.category.create-category', [
            'title' => 'Create Category',
        ]);
    }

    public function saveCategory()
    {
        $this->categoryRepository->createCategory([
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
        ]);

        session()->flash('success', 'Category created successfully.');
        return $this->redirect(route('category'), navigate: true);
    }
}
