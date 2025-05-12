<?php

namespace App\Livewire\Item;

use App\Repositories\Item\ItemRepository;
use Livewire\Attributes\Title;
use Livewire\Component;

class EditItem extends Component
{
    #[Title('Edit Item')]
    public $item_id;
    public $item_name;
    public $category_id;
    public $image;
    protected $itemRepository;

    public function boot(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function mount($id)
    {
        $this->item_id = $id;
        $item = $this->itemRepository->getItemById($id);

        $this->item_name = $item->item_name;
        $this->category_id = $item->category_id;
        $this->image = $item->image;
    }

    public function render()
    {
        return view('livewire.item.edit-item', [
            'title' => 'Edit Item',
            'categories' => $this->itemRepository->getAllCategories(),
        ]);
    }

    public function editItem()
    {
        $this->itemRepository->updateItem($this->item_id, [
            'item_name' => $this->item_name,
            'category_id' => $this->category_id,
            'image' => $this->image,
        ]);

        session()->flash('success', 'Item updated successfully.');
        return $this->redirect(route('item'), navigate: true);
    }
}
