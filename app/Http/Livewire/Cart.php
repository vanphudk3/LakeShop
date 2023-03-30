<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $selectedProducts = [];

    public $selectAll = false;

    public $bulkDisabled = true;



    public function render()
    {
        $this->bulkDisabled = count($this->selectedProducts) < 1;
        return view('livewire.cart');
    }
}
