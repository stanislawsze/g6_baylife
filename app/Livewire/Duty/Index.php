<?php

namespace App\Livewire\Duty;

use App\Models\DiscordUserRole;
use App\Models\GoingOnDuty;
use App\Models\Salary;
use App\Models\SalaryEarned;
use App\Models\Vehicle;
use App\Traits\DiscordWebhookTrait;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
    use DiscordWebhookTrait;

    public bool $isRunning = false;
    public $startTime;
    public $endTime;
    public $duration;
    public bool $serviceType = false;
    public string $mission;
    public int $vehicleTaken;

    protected $listeners = ['refreshTimer'];

    public function startStopTimer(): void
    {
        $this->validate([
            'vehicleTaken' => 'required:integer',
            'mission' => 'required|min:2'
        ]);
        $this->isRunning = !$this->isRunning;

        if ($this->isRunning) {
            $serviceType = $this->serviceType ? 1 : 0;

            $this->startTime = now();
            $this->endTime = null;
            $this->dispatch('startTimerInterval');
            GoingOnDuty::create([
                'user_id' => auth()->id(),
                'starts_at' => now(),
                'service_type' => $serviceType,
                'mission' => $this->mission,
                'vehicle_id' => $this->vehicleTaken
            ]);
            $vehicle = Vehicle::find($this->vehicleTaken);
            $vehicle->in_use = true;
            $vehicle->save();
            $message = 'pris son service';
        } else {
            $currentDuty = GoingOnDuty::updateOrCreate([
                'user_id' => auth()->id(),
                'starts_at' => $this->startTime,
                'stops_at' => null,
            ],[
                'stops_at' => now(),
                'salary' => $this->calculateSalary(now()->diffInSeconds($this->startTime))
            ]);
            $vehicle = Vehicle::find($currentDuty->vehicle_id);
            $vehicle->in_use = false;
            $vehicle->save();
            $this->endTime = now();
            SalaryEarned::create([
                'user_id' => auth()->user()->id,
                'going_on_duty_id' => $currentDuty->id,
                'salary' => $this->calculateSalary($this->endTime->diffInSeconds($this->startTime))
            ]);
            $message = 'mis fin à son service';
            $this->dispatch('stopTimerInterval');
        }
        $webhook = 'https://discord.com/api/webhooks/1207108956204306564/2lvn5QIJh_VwE55AIGOZGtpFtm7PEp7nVlspAFNPWWoc6i-1Ifg7w4sfnTf7vi0EiZw3';
        $this->sendWebhook($webhook, $message, $this->duration, $vehicle->plate, $this->mission);
        if(!$this->isRunning && $this->endTime != null)
        {
            $this->reset();
        }
    }

    public function render(): View
    {
        $this->calculateDuration();
        $duties = auth()->user()->duties;
        if($duties->whereNull('stops_at')->count() > 0)
        {
            $currentDuty = $duties->whereNull('stops_at')->first();
            $this->isRunning = true;
            $this->mission = $currentDuty->mission;
            $this->vehicleTaken = $currentDuty->vehicle_id;
            $this->startTime = $currentDuty->starts_at;
            $this->serviceType = $currentDuty->service_type;
            $this->refreshTimer();
        }
        $availableVehicles = Vehicle::where('in_use', false)->get();
        $otherDuties = GoingOnDuty::whereNull('stops_at')->get();
        return view('livewire.duty.index')->with([
            'duties' => $duties,
            'otherDuties' => $otherDuties,
            'vehicles' => $availableVehicles
        ]);
    }

    public function refreshTimer(): void
    {
        $this->duration = $this->calculateDuration();
        $this->dispatch('timerUpdated', $this->duration);
    }

    public function joinDuty($id): void
    {
        $dutyToJoin = GoingOnDuty::find($id);
        if($dutyToJoin)
        {
            $this->startTime = now();
            $this->serviceType = $dutyToJoin->service_type;
            $this->mission = $dutyToJoin->mission;
            $this->endTime = null;
            $this->dispatch('startTimerInterval');
            GoingOnDuty::create([
                'user_id' => auth()->id(),
                'starts_at' => now(),
                'service_type' => $this->serviceType,
                'mission' => $this->mission,
                'vehicle_id' => $dutyToJoin->vehicle_id
            ]);
            $webhook = 'https://discord.com/api/webhooks/1207108956204306564/2lvn5QIJh_VwE55AIGOZGtpFtm7PEp7nVlspAFNPWWoc6i-1Ifg7w4sfnTf7vi0EiZw3';

            $this->sendWebhook($webhook, 'pris son service', null);
            $this->refreshTimer();
        }

    }
    private function calculateDuration(): string
    {
        if ($this->startTime) {
            $endTime = $this->endTime ?: now();
            return gmdate("H:i:s", $endTime->diffInSeconds($this->startTime));
        }
        return '00:00:00';
    }

    private function calculateSalary($time): float|int
    {
        $roles = DiscordUserRole::where('user_id', auth()->user()->id)->get('discord_role_id')->toArray();
        $salary = Salary::whereIn('discord_role_id', $roles)->first();
        if($this->serviceType)
        {
            $salaryToEarn = $salary->salary_mission;
        } else {
            $salaryToEarn = $salary->salary_patrol;
        }
        $salaryPerSecond = round($salaryToEarn/3600, 2, PHP_ROUND_HALF_UP);
        return $salaryPerSecond*$time;
    }

    private function sendWebhook($webhook, $message, ?string $duration = '00:00:00', ?string $plate = null, string $mission): void
    {
        try{
            $this->sendDiscordWebhookDuty($webhook, auth()->user(), $message, $duration, $this->serviceType, $plate, $mission);
        } catch( \Exception $e)
        {
            \Log::debug($e);
        }
    }
}
