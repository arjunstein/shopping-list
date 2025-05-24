<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Landing extends Component
{
    #[Title('Welcome')]
    #[Layout('components.layouts.landing_layout')]

    public function render()
    {
        return view('livewire.landing');
    }
}
