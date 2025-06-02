<?php

namespace App\Livewire;

use App\Repositories\Selected\SelectedRepository;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class ShopListNow extends Component
{
    #[Title('Shop List')]
    public $title = 'Shopping list';
    public $selectedItems = [];
    public bool $showModalConfirmDone = false;

    protected $selectedRepository;

    public function boot(SelectedRepository $selectedRepository)
    {
        $this->selectedRepository = $selectedRepository;
    }

    public function saveItems()
    {
        // Check if the user has already submitted items this month
        if ($this->selectedRepository->hasSubmittedItemsThisPeriod(Auth::user()->id)) {
            $this->dispatch('error', message: 'You have already submitted your items this month.');
            return;
        }

        $this->selectedRepository->saveSelectedItems($this->selectedItems, Auth::user()->id);

        // flash message
        $this->dispatch('saved-item', message: 'Selected items saved successfully!');
        // reset selected items
        $this->selectedItems = [];
    }

    public function render()
    {
        return view('livewire.shop-list-now', [
            'allItems' => $this->selectedRepository->getAllItems(),
        ]);
    }
}
