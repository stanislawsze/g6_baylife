<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Component;

class Index extends Component
{
    public $vehicles;

    public function mount()
    {
        $this->vehicles = Vehicle::all();
    }
    public function render()
    {
        return view('livewire.vehicles.index');
    }
}
