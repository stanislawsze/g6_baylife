<?php

namespace App\Livewire\Convoy;

use App\Models\Convoy;
use App\Models\ConvoyConfig;
use App\Models\ConvoyVehicle;
use App\Models\SalaryEarned;
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
    public $stockadeId = [];
    public $nightSharkId = [];
    public $u2rId = [];
    public $userSalary = [];
    public function mount(Convoy $convoy)
    {
        $this->convoy = $convoy;
        $this->convoyName = $convoy->name;
        $this->convoyAmount = $convoy->convoy_amount;
        $this->nbreNightshark = $convoy->config->where('is_nightshark', true)->count();
        $this->nbreStockade = $convoy->config->where('is_stockade', true)->count();
        $this->nbreU2R = $convoy->config->where('is_u2r', true)->count();
        $this->startAt = $convoy->start_at->format('Y-m-d\TH:i');
        foreach($this->convoy->users as $u)
        {
            $this->userSalary[$u->id] = $u->salary($convoy->id);
        }
        foreach(ConvoyConfig::where([['is_stockade', true], ['convoy_id', $convoy->id]])->get(['vehicle_id'])->toArray() as $cv)
        {
            $this->stockadeId[] = $cv['vehicle_id'];
        }
        foreach(ConvoyConfig::where([['is_nightshark', true], ['convoy_id', $convoy->id]])->get(['vehicle_id'])->toArray() as $cv)
        {
            $this->nightSharkId[] = $cv['vehicle_id'];
        }
        foreach(ConvoyConfig::where([['is_u2r', true], ['convoy_id', $convoy->id]])->get(['vehicle_id'])->toArray() as $cv)
        {
            $this->u2rId[] = $cv['vehicle_id'];
        }
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
            foreach($convoy->users as $user)
            {
                $this->userSalary[$user->id] = ($convoy->convoy_amount/2)/$convoy->users->count();
                $this->updateSalary($user->id);
            }
        } else {
            $convoy->is_started = !$convoy->is_started;
        }
        $convoy->save();
        toastify()->success('Convoi créer avec succès');
        return redirect(route('convoy.show', ['convoy' => $convoy]));
    }

    public function updateSalary($userId)
    {
        SalaryEarned::updateOrCreate([
            'user_id' => $userId,
            'convoy_id' => $this->convoy->id
        ], [
           'salary' => $this->userSalary[$userId] ?? 0
        ]);
        toastify()->success('Prime de l\'agent mis à jour.');
        return redirect(route('convoy.show', ['convoy' => $this->convoy]));
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
                $vehicleAvailable = Vehicle::whereNotIn('id', $this->stockadeId)->where('name', 'like', '%Stockade%')->get();
                for($i = 0; $i < ($this->nbreStockade-$oldNbreS); $i++)
                {
                    ConvoyConfig::create([
                        'convoy_id' => $this->convoy->id,
                        'vehicle_id' => $vehicleAvailable[$i]->id,
                        'is_stockade' => true,
                        'position' => $i
                    ]);
                }

            } else {
                for($i = 0; $i < ($oldNbreS - $this->nbreStockade); $i++)
                {
                    $lastEntry = ConvoyConfig::where([['convoy_id', $this->convoy->id], ['is_stockade', true]])->first();
                    $userVeh = ConvoyVehicle::where([['vehicle_id',$lastEntry->vehicle_id], ['convoy_id', $this->convoy->id]])->first();
                    if($userVeh)
                    {
                        $userVeh->delete();
                    }
                    $lastEntry->delete();
                }
            }
        }
        if($this->nbreNightshark != $oldNbreN)
        {
            if($this->nbreNightshark > $oldNbreN)
            {
                $vehicleAvailable = Vehicle::whereNotIn('id', $this->nightSharkId)->where('name', 'like', '%Nightshark%')->get();
                for($i = 0; $i < ($this->nbreNightshark-$oldNbreN); $i++)
                {
                    ConvoyConfig::create([
                        'convoy_id' => $this->convoy->id,
                        'vehicle_id' => $vehicleAvailable[$i]->id,
                        'is_nightshark' => true,
                        'position' => $i
                    ]);
                }

            } else {
                for($i = 0; $i < ($oldNbreN - $this->nbreNightshark); $i++)
                {
                    $lastEntry = ConvoyConfig::where([['convoy_id', $this->convoy->id], ['is_nightshark', true]])->first();
                    $userVeh = ConvoyVehicle::where([['vehicle_id',$lastEntry->vehicle_id], ['convoy_id', $this->convoy->id]])->first();
                    if($userVeh)
                    {
                        $userVeh->delete();
                    }
                    $lastEntry->delete();

                }
            }
        }
        if($this->nbreU2R != $oldNbreU)
        {
            if($this->nbreU2R > $oldNbreU)
            {
                $vehicleAvailable = Vehicle::whereNotIn('id', $this->stockadeId)->where('name', 'like', '%Moto Police%')->get();
                for($i = 0; $i < ($this->nbreU2R-$oldNbreU); $i++)
                {
                    ConvoyConfig::create([
                        'convoy_id' => $this->convoy->id,
                        'vehicle_id' => $vehicleAvailable[$i]->id,
                        'is_u2r' => true,
                        'position' => $i
                    ]);
                }

            } else {
                for($i = 0; $i < ($oldNbreU - $this->nbreU2R); $i++)
                {
                    $lastEntry = ConvoyConfig::where([['convoy_id', $this->convoy->id], ['is_u2r', true]])->first();
                    $userVeh = ConvoyVehicle::where([['vehicle_id',$lastEntry->vehicle_id], ['convoy_id', $this->convoy->id]])->first();
                    if($userVeh)
                    {
                        $userVeh->delete();
                    }

                    $lastEntry->delete();
                }
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

    public function updateUserSalary($value, $key)
    {
        dd($key, $value);
    }
}
