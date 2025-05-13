<?php

namespace App\Livewire\Item;

use App\Repositories\Item\ItemRepository;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ListItem extends Component
{
    use WithPagination;

    #[Title('List Item')]
    public $search = '';
    public $perPage = 10;
    public $selectedItem = null;
    public $showModalDetailItem = false;
    public $showModalConfirmDeleteItem = false;
    public $deleteItemId = null;

    protected $itemRepsository;

    public function boot(ItemRepository $itemRepository)
    {
        $this->itemRepsository = $itemRepository;
    }

    public function render()
    {
        if ($this->search) {
            $items = $this->itemRepsository->searchItem($this->search, $this->perPage);
        } else {
            $items = $this->itemRepsository->getAllItems($this->perPage);
        }

        return view('livewire.item.list-item', [
            'title' => 'List Item',
            'items' => $items,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function showDetailItem($item_id)
    {
        $this->selectedItem = $this->itemRepsository->getItemById($item_id);
        $this->showModalDetailItem = true;
    }

    public function deleteItem($id)
    {
        $this->itemRepsository->deleteItem($id);
        $this->showModalConfirmDeleteItem = false;
        $this->dispatch('show-alert', message: 'Item deleted successfully!');
    }

    public function confirmDeleteItem($id)
    {
        $this->deleteItemId = $id;
        $this->showModalConfirmDeleteItem = true;
    }
}
