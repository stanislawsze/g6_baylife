<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class ListUsers extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::with(['employee', 'getRole', 'warnings'])->get();
    }
    public function render()
    {
        return view('livewire.profile.list-users');
    }
}
