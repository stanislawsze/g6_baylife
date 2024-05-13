<?php

namespace App\Livewire\Duty;

use App\Models\GoingOnDuty;
use Livewire\Component;

class ListDuty extends Component
{
    public $duties;
    public $userId = null;

    public function mount()
    {
        $this->duties = GoingOnDuty::when(['user_id', $this->userId])->get();
    }
    public function render()
    {
        return view('livewire.duty.list-duty');
    }
}
