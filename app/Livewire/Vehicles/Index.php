<?php

namespace App\Livewire\Vehicles;

use App\Models\Vehicle;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    #[Validate('image|max:4096')]
    public $image;
    public $vehicleName = '';
    public $vehiclePlate = '';
    public $vehicles;
    public $isCreating = false;
    public function mount()
    {
        $this->vehicles = Vehicle::all();
    }
    public function render()
    {
        return view('livewire.vehicles.index');
    }

    public function create()
    {
        $this->isCreating = !$this->isCreating;
    }

    public function save()
    {
        $this->image->storeAs(path: 'vehicles', name: \Str::snake(strtolower($this->vehicleName)).'.'.$this->image->extension());
        Vehicle::create([
            'name' => $this->vehicleName,
            'plate' => $this->vehiclePlate,
            'image' => 'img/vehicle/' . \Str::snake(strtolower($this->vehicleName)) . '.'.$this->image->extension(),
            'in_use' => false,
            'is_maintained' => true,
            'is_refuel' => true,
            'is_usable_for_convoy' => false,
        ]);
        $this->vehicleName = '';
        $this->vehiclePlate = '';
        $this->vehicles = Vehicle::all();
        $this->isCreating = false;
        $this->dispatch('success', ['message' => 'Véhicule créé avec succès']);
    }

    public function delete($id)
    {
        $vehicle = Vehicle::find($id);
        if($vehicle)
        {
            $vehicle->delete();
        }
        $this->vehicles = Vehicle::all();
        $this->dispatch('success', ['message' => 'Véhicule supprimé avec succès']);
    }
}
