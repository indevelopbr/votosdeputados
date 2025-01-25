<?php

namespace App\Livewire\Senator;

use App\Models\Senator;
use Livewire\Component;

class ListSenators extends Component
{
    public $showModal = false;

    public function render()
    {
        $senators = Senator::with('party')->paginate(10);

        return view('livewire.senator.list-senators', [
            'senators' => $senators
        ]);
    }
}
