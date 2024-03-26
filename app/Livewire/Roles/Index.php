<?php

namespace App\Livewire\Roles;

use App\Models\DiscordRole;
use App\Models\RolePermission;
use App\Models\Salary;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $roles = DiscordRole::orderBy('discord_id')->get();
        return view('livewire.roles.index', ['roles' => $roles]);
    }

    public function delete($id)
    {
        $role = DiscordRole::find($id);
        $discord_id = $role->discord_id;
        $role->delete();
        $perm = RolePermission::where('discord_role_id', $discord_id)->first();
        $perm->delete();
        toastify()->success('Rôle supprimé avec succès');
        return redirect(route('roles.index'));
    }

    public function edit($id)
    {
        return redirect(route('roles.edit', ['role' => DiscordRole::find($id)]));
    }

    public function getDiscordRoles()
    {
        $guildId = 869345535318958110;
        $discordToken = config('larascord.token');
        $response = Http::withHeaders([
            'Authorization' => 'Bot ' . $discordToken,
        ])->get("https://discord.com/api/guilds/{$guildId}/roles");

        if ($response->successful()) {
            $roles = $response->json();
            foreach($roles as $r)
            {
                DiscordRole::updateOrCreate([
                    'discord_id' => $r['id']
                ],[
                    'role_name' => $r['name'],
                    'role_color' => $r['color']
                ]);
                RolePermission::updateOrCreate([
                    'discord_role_id' => $r['id']
                ],[
                    'convoy_manager' => false,
                    'atm_manager' => false,
                    'team_manager' => false,
                    'salary_manager' => false,
                    'role_manager' => false,
                    'webhook_manager' => false
                ]);
                Salary::updateOrCreate([
                    'discord_role_id' => $r['id'],
                ],[
                    'salary_patrol' => 0,
                    'salary_mission' => 0,
                    'salary_bonus' => 0,
                ]);
            }
        } else {
            throw new \Exception('Unable to fetch Discord roles. Error: ' . $response->status());
        }
        toastify()->success(count($roles) . ' rôles discord récupérés');
        return redirect(route('roles.index'));
    }
}
