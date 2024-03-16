<?php

namespace App\Livewire\Roles;

use App\Models\DiscordRole;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Index extends Component
{

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $roles = DiscordRole::all();
        return view('livewire.roles.index', ['roles' => $roles]);
    }

    public function delete($id)
    {
        $role = DiscordRole::find($id);
        $role->delete();
        toastify()->success('Rôle supprimé avec succès');
        return redirect(route('roles.index'));
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
            }
        } else {
            throw new \Exception('Unable to fetch Discord roles. Error: ' . $response->status());
        }
        toastify()->success(count($roles) . ' rôles discord récupérés');
        return redirect(route('roles.index'));
    }
}
