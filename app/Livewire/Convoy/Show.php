<?php

namespace App\Livewire\Convoy;

use App\Models\Convoy;
use App\Models\Vehicle;
use Livewire\Component;

class Show extends Component
{
    public Convoy $convoy;

    public function render()
    {
        $vehicles = Vehicle::where([['is_usable_for_convoy', true], ['in_use', false]])->get();
        return view('livewire.convoy.show')->with(['vehicles' => $vehicles]);
    }

    public function startStopConvoy($id)
    {
        $convoy = Convoy::find($id);
        if($convoy->is_started)
        {
            $convoy->is_finished = true;
        } else {
            $convoy->is_started = !$convoy->is_started;
        }
        $convoy->save();
    }

    public function addVehicleToConvoy($id)
    {
        $convoy = Convoy::find($id);
        if ($convoy)
        {

        }
    }
}
