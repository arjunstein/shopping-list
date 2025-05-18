<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class ShopListNow extends Component
{
    #[Title('Shop List')]
    public $title = 'Shoping list';

    public function render()
    {
        return view('livewire.shop-list-now');
    }
}
