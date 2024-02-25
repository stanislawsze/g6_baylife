<?php

namespace App\Livewire\Convoy;

use App\Models\Convoy;
use App\Models\ConvoyConfig;
use App\Models\ConvoyVehicle;
use App\Models\Vehicle;
use Livewire\Component;

class Show extends Component
{
    public Convoy $convoy;
    public int $selectedUserId;

    public int $vehicleId;
    public string $convoyName;
    public int $convoyAmount;
    public int $nbreNightshark;
    public int $nbreStockade;
    public int $nbreU2R;
    public $startAt;
    public function mount(Convoy $convoy)
    {
        $this->convoy = $convoy;
        $this->convoyName = $convoy->name;
        $this->convoyAmount = $convoy->convoy_amount;
        $this->nbreNightshark = $convoy->config->where('is_nightshark', true)->count();
        $this->nbreStockade = $convoy->config->where('is_stockade', true)->count();
        $this->nbreU2R = $convoy->config->where('is_u2r', true)->count();
        $this->startAt = $convoy->start_at->format('Y-m-d\TH:i');
    }
    public function render()
    {
        $vehiclesId = ConvoyConfig::select('vehicle_id')->where('convoy_id', $this->convoy->id)->get();
        $vehicles = Vehicle::whereIn('id', $vehiclesId)->get();
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
        toastify()->success('Convoi créer avec succès');
        return redirect(route('convoy.show', ['convoy' => $convoy]));
    }

    public function updatePosition($list)
    {
        foreach($list as $l)
        {
            $convoyVehicle = ConvoyConfig::find((int) $l['value']);
            //dd($convoyVehicle);
            $convoyVehicle->position = (int) $l['order'];
            $convoyVehicle->save();
        }
    }

    public function updateUserVehicle($id)
    {
        ConvoyVehicle::create([
            'convoy_id' => $this->convoy->id,
            'vehicle_id' => $this->vehicleId,
            'user_id' => (int) $id
        ]);
    }
    public function update($id)
    {
        $oldNbreN = $this->convoy->config->where('is_nightshark', true)->count();
        $oldNbreS = $this->convoy->config->where('is_stockade', true)->count();
        $oldNbreU = $this->convoy->config->where('is_u2r', true)->count();
        if($this->nbreStockade != $oldNbreS)
        {
            if($this->nbreStockade > $oldNbreS)
            {
                $newStock = Vehicle::where('name', 'like', '%Stockade%')->get();
            } else {

            }

        }

        Convoy::updateOrCreate(['id' => $id],
        [
            'name' => $this->convoyName,
            'convoy_amount' => $this->convoyAmount,
            'start_at' => $this->startAt
        ]);

        toastify()->success('Convoi mis à jour avec succès');
        return redirect(route('convoy.show', ['convoy' => $this->convoy]));
    }

    public function deleteFromVeh($id)
    {
        $delete = ConvoyVehicle::find($id);
        $delete->delete();
    }
}
