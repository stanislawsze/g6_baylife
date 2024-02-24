<?php

namespace App\Livewire;

use App\Models\GoingOnDuty;
use App\Traits\DiscordWebhookTrait;
use Livewire\Component;

class PriseDeService extends Component
{
    use DiscordWebhookTrait;

    public $isRunning = false;
    public $startTime;
    public $endTime;
    public $duration;
    public $serviceType;
    public $mission;

    protected $listeners = ['refreshTimer'];

    public function startStopTimer()
    {
        $this->isRunning = !$this->isRunning;

        if ($this->isRunning) {
            $this->startTime = now();
            $this->endTime = null;
            $this->dispatch('startTimerInterval');
            GoingOnDuty::create([
                'user_id' => auth()->id(),
                'starts_at' => now(),
                'service_type' => $this->serviceType,
                'mission' => $this->mission,
            ]);
            $this->sendDiscordWebhookDuty('https://discord.com/api/webhooks/1207108956204306564/2lvn5QIJh_VwE55AIGOZGtpFtm7PEp7nVlspAFNPWWoc6i-1Ifg7w4sfnTf7vi0EiZw3', auth()->user(), 'pris son service', null, $this->serviceType);
        } else {
            $lastDuty = GoingOnDuty::updateOrCreate([
                'user_id' => auth()->id(),
                'starts_at' => $this->startTime,
                'stops_at' => null,
            ],[
                'stops_at' => now()
            ]);
            $this->endTime = now();
            $this->sendDiscordWebhookDuty('https://discord.com/api/webhooks/1207108956204306564/2lvn5QIJh_VwE55AIGOZGtpFtm7PEp7nVlspAFNPWWoc6i-1Ifg7w4sfnTf7vi0EiZw3', auth()->user(), 'mis fin à son service', $this->duration, $this->serviceType);
            $this->dispatch('stopTimerInterval');
        }
    }

    public function render()
    {
        $this->calculateDuration();
        $duties = auth()->user()->duties;
        if($duties->whereNull('stops_at')->count() > 0)
        {
            $currentDuty = $duties->whereNull('stops_at')->first();
            $this->isRunning = true;
            $this->startTime = $currentDuty->starts_at;
            $this->serviceType = $currentDuty->service_type;
            $this->refreshTimer();
        }
        $otherDuties = GoingOnDuty::whereNull('stops_at')->get();
        return view('livewire.prise-de-service')->with([
            'duties' => $duties,
            'otherDuties' => $otherDuties,
        ]);
    }

    public function refreshTimer()
    {
        $this->duration = $this->calculateDuration();
        $this->dispatch('timerUpdated', $this->duration);
    }

    public function joinDuty($id)
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
            ]);
            $this->sendDiscordWebhookDuty('https://discord.com/api/webhooks/1207108956204306564/2lvn5QIJh_VwE55AIGOZGtpFtm7PEp7nVlspAFNPWWoc6i-1Ifg7w4sfnTf7vi0EiZw3', auth()->user(), 'pris son service', null, $this->serviceType);
            $this->refreshTimer();
        }

    }
    private function calculateDuration()
    {
        if ($this->startTime) {
            $endTime = $this->endTime ?: now();
            return gmdate("H:i:s", $endTime->diffInSeconds($this->startTime));
        }
        return '00:00:00';
    }
}
