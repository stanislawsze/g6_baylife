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
            ]);
            $this->sendDiscordWebhookDuty('https://discord.com/api/webhooks/1207108956204306564/2lvn5QIJh_VwE55AIGOZGtpFtm7PEp7nVlspAFNPWWoc6i-1Ifg7w4sfnTf7vi0EiZw3', auth()->user(), 'pris son service', null, $this->serviceType);
        } else {
            GoingOnDuty::updateOrCreate([
                'user_id' => auth()->id(),
                'starts_at' => $this->startTime,
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
        return view('livewire.prise-de-service')->with([
            'duties' => $duties
        ]);
    }

    public function refreshTimer()
    {
        $this->duration = $this->calculateDuration();
        $this->dispatch('timerUpdated', $this->duration);
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
