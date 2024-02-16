<?php

namespace App\Http\Controllers;

use App\Models\DiscordRole;
use App\Traits\DiscordWebhookTrait;
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
        return view('discord.roles', ['roles' => DiscordRole::all()]);
    }

    public function getDiscordRoles()
    {
        $guildId = 869345535318958110;
        $discordToken = 'MTIwNzA0NTgyMzg2MzQ1OTkwMA.GI-g6s._YAALrCJVGG2iajCJhFjzSsGcNgMg0OLSFGWCA';
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
        $action = "a récupéré la liste des rôles";
        $webhookUrl = 'https://discord.com/api/webhooks/1207108956204306564/2lvn5QIJh_VwE55AIGOZGtpFtm7PEp7nVlspAFNPWWoc6i-1Ifg7w4sfnTf7vi0EiZw3';
        try{
            $response = $this->sendDiscordWebhook($webhookUrl, auth()->user(), $action);
            return response()->json(['success' => true, 'response' => $response]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }



        return $response->body();
    }

    public function timer()
    {
        return view('timer.test');
    }
}
