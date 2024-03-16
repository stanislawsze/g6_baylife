<?php

namespace App\Traits;

use App\Models\Convoy;
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
    public function sendDiscordWebhookConvoy($channelId, int $convoyId)
    {
        $convoy = Convoy::find($convoyId);
        $message = "Convoi du ".$convoy->start_at->format('d/m/Y H:i');
        $message .= "\n\n **Besoin d'un maximum d'agents**";
        $message .= "\n\n".$convoy->start_at->format('H:i')." RDV ".$convoy->start_at->subMinutes(30)->format('H:i');
        $message .= "\n\n Merci d'être présent au locaux 10 minutes avant le début du convoi.";
        $message .= "\n\n Un check pour confirmer votre présence";
        //$message .= "\n <@963856088552337460> <@889650698944405535> <@882003696714649630> <@894675446514462720> <@899712271389949962>";
        $timestamp = now()->toIso8601String();
        $data = [
            "content" => '<@&963856088552337460> <@&889650698944405535> <@&882003696714649630> <@&894675446514462720> <@&899712271389949962>',
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
        $discordUrl = "https://discord.com/api/channels/{$channelId}/messages";
        $response = Http::withHeaders([
            'Authorization' => 'Bot ' . config('larascord.token'),
            'Content-Type' => 'application/json',
        ])->post($discordUrl, $data);
        $emoji = "✅";
        $newDisc = "https://discord.com/api/channels/{$channelId}/messages/{$response->json('id')}/reactions/{$emoji}/@me";
        $secondResponse = Http::withHeaders([
            'Authorization' => 'Bot ' . config('larascord.token'),
            'Content-Type' => 'application/json',
        ])->put($newDisc);
        $convoy->discord_message_id = $response->json('id');
        $convoy->save();
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
