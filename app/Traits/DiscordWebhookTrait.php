<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Http;
trait DiscordWebhookTrait
{
    public function sendDiscordWebhook($webhookUrl, User $user, string $action)
    {
        $timestamp = now()->toIso8601String();
        $data = [
            "content" => "<@".$user->id."> a effectué une action",
            "embeds" => [
                [
                    "title" => "Information Intranet",
                    "description" => "<@".$user->id."> a effectué $action",
                    "color" => 16711680,
                    "timestamp" => $timestamp,
                    "footer" => [
                        "text" => "G6",
                        "icon_url" => "https://cdn.discordapp.com/icons/869345535318958110/846c9858c39ef37d6d636d50438f6d2a.webp?size=96"
                    ],
                    "author" => [
                        "name" => "G6 - Assistant Direction",
                        "icon_url" => "https://cdn.discordapp.com/icons/869345535318958110/846c9858c39ef37d6d636d50438f6d2a.webp?size=96"
                    ],
                    "thumbnail" => [
                        "url" => "https://cdn.discordapp.com/icons/869345535318958110/846c9858c39ef37d6d636d50438f6d2a.webp?size=96"
                    ],
                    "content" => "<@".$user->id."> a effectué $action"
                ]
            ]
        ];
        $response = Http::post($webhookUrl, $data);

        if($response->successful())
        {
            return true;
        } else {
            throw new \Exception('Failed to send Discord webhook. Error: '.$response->status());
        }
    }
    public function sendDiscordWebhookDuty($webhookUrl, User $user, string $action, ?string $duration = null, int $serviceType)
    {
        $timestamp = now()->toIso8601String();

        $serviceType = $serviceType != 0 ? 'mission de sécurité' : 'patrouille';

        if($duration != null)
        {
            $message = "<@".$user->id."> a $action en $serviceType et celui-ci a duré : $duration";
        } else {
            $message = "<@".$user->id."> a $action en $serviceType";
        }
        $data = [
            "embeds" => [
                [
                    "title" => "Information Intranet",
                    "description" => $message,
                    "color" => 16711680,
                    "timestamp" => $timestamp,
                    "footer" => [
                        "text" => "G6",
                        "icon_url" => "https://cdn.discordapp.com/icons/869345535318958110/846c9858c39ef37d6d636d50438f6d2a.webp?size=96"
                    ],
                    "author" => [
                        "name" => "G6 - Assistant Direction",
                        "icon_url" => "https://cdn.discordapp.com/icons/869345535318958110/846c9858c39ef37d6d636d50438f6d2a.webp?size=96"
                    ],
                    "thumbnail" => [
                        "url" => "https://cdn.discordapp.com/icons/869345535318958110/846c9858c39ef37d6d636d50438f6d2a.webp?size=96"
                    ],
                ]
            ]
        ];
        $response = Http::post($webhookUrl, $data);

        if($response->successful())
        {
            return true;
        } else {
            throw new \Exception('Failed to send Discord webhook. Error: '.$response->status());
        }
    }
}
