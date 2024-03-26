<?php

namespace App\Http\Controllers;

use App\Models\Convoy;
use App\Models\DiscordRole;
use App\Models\DiscordUserRole;
use App\Models\Salary;
use App\Models\User;
use App\Traits\DiscordWebhookTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscordRoleHandlerController extends Controller
{
    use DiscordWebhookTrait;
    protected string $tokenURL = "https://discord.com/api/oauth2/token";
    protected string $baseApi = 'https://discord.com/api';

    protected array $tokenData = [
        "client_id" => null,
        "client_secret" => null,
        "grant_type" => "authorization_code",
        "code" => null,
        "redirect_uri" => null,
        "scope" => null
    ];

    public function __construct()
    {
        $this->tokenData['client_id'] = config('larascord.client_id');
        $this->tokenData['client_secret'] = config('larascord.client_secret');
        $this->tokenData['grant_type'] = config('larascord.grant_type');
        $this->tokenData['redirect_uri'] = config('larascord.redirect_uri');
        $this->tokenData['scope'] = config('larascord.scopes');
    }
    public function index(){
        $this->authorize('manage', DiscordRole::class);
        return view('discord.roles');
    }

    public function getDiscordRoles()
    {
        $this->authorize('manage', DiscordRole::class);
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
    }
    public function webhook()
    {
        $this->authorize('manage', DiscordRole::class);
        $roles = DiscordUserRole::where('user_id', auth()->user()->id)->get('discord_role_id')->toArray();
        $salary = Salary::whereIn('discord_role_id', $roles)->first();
        dd($roles,$salary);
    }

    public function timer()
    {
        return view('timer.test');
    }

    public function edit(DiscordRole $role)
    {
        $this->authorize('manage', DiscordRole::class);
        return view('discord.edit', ['discord_role' => $role]);
    }
}
