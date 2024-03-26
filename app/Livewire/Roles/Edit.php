<?php

namespace App\Livewire\Roles;

use App\Livewire\Forms\PermissionForm;
use App\Models\DiscordRole;
use App\Models\RolePermission;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Edit extends Component
{

    public DiscordRole $discordRole;
    public PermissionForm $permission;


    public function mount(DiscordRole $role): void
    {
        $this->discordRole = $role;
        $this->permission->setRole(RolePermission::where('discord_role_id', $role->discord_id)->first());
    }

    public function render(): View
    {
        return view('livewire.roles.edit');
    }

    public function save()
    {
        $this->permission->update();
    }
}
