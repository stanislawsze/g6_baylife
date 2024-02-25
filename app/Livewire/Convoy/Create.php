<?php

namespace App\Livewire\Convoy;

use App\Models\Convoy;
use App\Models\ConvoyConfig;
use App\Models\ConvoyVehicle;
use App\Models\Vehicle;
use Livewire\Component;

class Create extends Component
{
    public $nightNumber;
    public $stockNumber;
    public $u2rNumber;
    public $customer;
    public $amount;
    public $name;
    public $startsAt;

    public function render()
    {
        return view('livewire.convoy.create');
    }

    public function create()
    {
        $stockade = Vehicle::where('name', 'like', '%Stockade%')->get();
        $nightshark = Vehicle::where('name', 'like', '%Nightshark%')->get();
        $u2r = Vehicle::where('name', 'like', '%Moto Police%')->get();

        $convoy = Convoy::create([
            'name' => $this->name,
            'is_started' => false,
            'is_finished' => false,
            'user_id' => auth()->user()->id,
            'convoy_amount' => $this->amount,
            'start_at' => $this->startsAt
        ]);
        $total = $this->stockNumber + $this->nightNumber + $this->u2rNumber;
        if($this->stockNumber > 0 && $stockade->count() > 0)
        {
            for($i = 0; $i < $this->stockNumber; $i++)
            {
                ConvoyConfig::create([
                    'convoy_id' => $convoy->id,
                    'vehicle_id' => $stockade[$i]->id,
                    'is_stockade' => true,
                    'position' => $total
                ]);
                $total -= 1;
            }
        }
        if($this->nightNumber > 0 && $nightshark->count() > 0)
        {
            for($i = 0; $i < $this->nightNumber; $i++)
            {
                ConvoyConfig::create([
                    'convoy_id' => $convoy->id,
                    'vehicle_id' => $nightshark[$i]->id,
                    'is_nightshark' => true,
                    'position' => $total
                ]);
                $total -= 1;
            }
        }

        if($this->u2rNumber > 0 && $u2r->count() > 0)
        {
            for($i = 0; $i < $this->u2rNumber; $i++)
            {
                ConvoyConfig::create([
                    'convoy_id' => $convoy->id,
                    'vehicle_id' => $u2r[$i]->id,
                    'is_u2r' => true,
                    'position' => $total
                ]);
                $total -= 1;
            }
        }
        toastify()->success('Convoi créer avec succès');
        return redirect(route('convoy.index'));
    }
}
