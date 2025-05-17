<?php

namespace App\Livewire\Item;

use App\Repositories\Item\ItemRepository;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateItem extends Component
{
    use WithFileUploads;

    #[Title('Create Item')]
    public $item_name;
    public $category_id;
    public $image;
    protected $itemRepository;

    public function boot(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function saveItem()
    {
        $this->itemRepository->createItem([
            'item_name' => Str::title($this->item_name),
            'category_id' => $this->category_id,
            'image' => $this->image,
        ]);

        session()->flash('success', 'Item created successfully.');
        return $this->redirect(route('item'), navigate: true);
    }

    public function render()
    {
        return view('livewire.item.create-item', [
            'title' => 'Create Item',
            'categories' => $this->itemRepository->getAllCategories(),
        ]);
    }
}
