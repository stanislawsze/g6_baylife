<?php

namespace App\Listeners;

use App\Models\DiscordUserRole;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class GetDiscordGuildUserRolesListener
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $authUser = Auth::user();
        if($authUser)
        {
            try {
                $guildMember = $authUser->getGuildMember('869345535318958110')->roles;
                foreach($guildMember as $role)
                {
                    DiscordUserRole::updateOrCreate([
                        'discord_role_id' => $role,
                        'user_id' => $authUser->id
                    ]);
                }
            } catch(\Exception $exception) {
                dd($exception);
            }
        }
    }
}
