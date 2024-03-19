<?php

namespace App\Livewire\Roles;

use App\Models\DiscordRole;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component
{

    public DiscordRole $discordRole;

    public function mount(DiscordRole $role): void
    {
        $this->discordRole = $role;
    }

    public function render(): View
    {
        return view('livewire.roles.edit');
    }
}
